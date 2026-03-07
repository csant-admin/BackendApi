<?php
namespace App\Modules\InvestmentApp\Payments\Services;

use Illuminate\Support\Facades\DB;
use App\Repositories\Payments\Contracts\QrPaymentGatewayInterface;
use App\Modules\Payments\DTOs\CreatePaymentIntentData;
use App\Modules\Payments\DTOs\ValidatePaymentData;
use App\Modules\Payments\Enums\PaymentStatus;
use App\Repositories\Payments\Contracts\PaymentRepositoryInterface;
use App\Modules\Shared\Audit\AuditLoggerInterface;
use App\Models\Payment;

class PaymentService
{
    public function __construct(
        private QrPaymentGatewayInterface $gateway,
        private PaymentRepositoryInterface $payments,
        private AuditLoggerInterface $audit,
        private ReceiptService $receipts,
        private PaymentPostingService $posting, // posts to Loan/Investment ledgers
    ) {}

    public function createIntent(CreatePaymentIntentData $dto): Payment
    {
        return DB::transaction(function () use ($dto) {
            $intent = $this->gateway->createIntent($dto);

            $payment = $this->payments->create([
                'member_id'         => $dto->memberId,
                'amount'            => $dto->amount,
                'currency'          => $dto->currency,
                'reference'         => $dto->reference,
                'gateway_reference' => $intent->gatewayReference,
                'qr_payload'        => $intent->qrPayload,
                'status'            => PaymentStatus::PENDING->value,
                'purpose'           => $dto->purpose,
                'meta'              => $dto->meta,
                'expires_at'        => $intent->expiresAt,
            ]);

            $this->audit->log('member', $dto->memberId, 'payment_intent_created', [
                'payment_id' => $payment->id,
                'reference'  => $dto->reference,
            ]);

            return $payment;
        });
    }

    public function validateAndPost(ValidatePaymentData $dto): Payment
    {
        return DB::transaction(function () use ($dto) {
            $result = $this->gateway->validate($dto);

            $payment = $this->payments->findByGatewayReference($dto->gatewayReference);

            if (!$result->valid) {
                $this->payments->markFailed($payment->id, $result->reason ?? 'validation_failed');
                return $this->payments->findById($payment->id);
            }

            $this->payments->markPaid($payment->id, [
                'paid_amount' => $dto->paidAmount,
                'paid_at'     => now(),
                'raw_payload' => $dto->rawPayload,
            ]);

            // Post to Loan/Investment based on purpose
            $this->posting->post($payment->id);

            // Generate receipt
            $this->receipts->generateForPayment($payment->id);

            return $this->payments->findById($payment->id);
        });
    }
}

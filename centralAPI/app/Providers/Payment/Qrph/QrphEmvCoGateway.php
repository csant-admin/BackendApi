<?php
namespace App\Modules\InvestmentApp\Payments\Providers\Qrph;

use App\Modules\InvestmentApp\Payments\Contracts\QrPaymentGatewayInterface;
use App\Modules\InvestmentApp\Payments\Contracts\QrphPayloadBuilderInterface;
use App\Modules\InvestmentApp\Payments\DTOs\CreatePaymentIntentData;
use App\Modules\InvestmentApp\Payments\DTOs\QrPaymentIntentResult;
use App\Modules\InvestmentApp\Payments\DTOs\ValidatePaymentData;
use App\Modules\InvestmentApp\Payments\DTOs\ValidatePaymentResult;

class QrphEmvCoGateway implements QrPaymentGatewayInterface
{
    public function __construct(
        private QrphPayloadBuilderInterface $builder,
    ) {}

    public function createIntent(CreatePaymentIntentData $dto): QrPaymentIntentResult
    {
        $gatewayReference = 'QRPH-' . $dto->reference;

        $payload = $this->builder->buildDynamic([
            'currency'  => '608', // example code for PHP in many EMV contexts
            'amount'    => number_format($dto->amount, 2, '.', ''),
            'merchant'  => 'INVESTMENT APP',
            'reference' => $gatewayReference,
        ]);

        return new QrPaymentIntentResult(
            gatewayReference: $gatewayReference,
            qrPayload: $payload,
            qrImageUrl: null,
            expiresAt: now()->addMinutes(15)
        );
    }

    public function validate(ValidatePaymentData $dto): ValidatePaymentResult
    {
        // If you use webhooks: validate signature/hmac here
        // For pure EMV generation without PSP: validation may come from bank settlement file / manual reconciliation
        $valid = $this->verifySignature($dto->rawPayload, $dto->signature);

        return new ValidatePaymentResult(
            valid: $valid,
            status: $valid ? 'paid' : 'failed',
            reason: $valid ? null : 'Invalid signature'
        );
    }

    private function verifySignature(array $payload, string $signature): bool
    {
        // Replace with real HMAC/PKI validation based on your provider
        return !empty($signature);
    }
}

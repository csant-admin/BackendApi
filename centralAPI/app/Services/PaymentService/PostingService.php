<?php
namespace App\Modules\InvestmentApp\Payments\Services;

use App\Repositories\Payments\Contracts\PaymentRepositoryInterface;
use App\Modules\InvestmentApp\Loans\Services\LoanPaymentService;
use App\Modules\InvestmentApp\Investments\Services\InvestmentFundingService;

class PaymentPostingService
{
    public function __construct(
        private PaymentRepositoryInterface $payments,
        private LoanPaymentService $loanPayments,
        private InvestmentFundingService $investmentFunding,
    ) {}

    public function post(int $paymentId): void
    {
        $payment = $this->payments->findById($paymentId);

        match ($payment->purpose) {
            'loan_installment' => $this->loanPayments->applyInstallment($payment),
            'investment'       => $this->investmentFunding->fund($payment),
            default            => null,
        };
    }
}

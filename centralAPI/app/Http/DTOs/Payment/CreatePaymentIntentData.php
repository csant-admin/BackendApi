<?php
namespace App\Modules\InvestmentApp\Payments\DTOs;

class CreatePaymentIntentData {
    public function __construct(
        public int $memberId,
        public float $amount,
        public string $currency,     // 'PHP'
        public string $reference,    // internal reference
        public string $purpose,      // 'loan_installment' | 'investment' etc
        public array $meta = [],
    ) {}
}

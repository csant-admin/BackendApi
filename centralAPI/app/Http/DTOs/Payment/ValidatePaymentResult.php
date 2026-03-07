<?php
namespace App\Modules\InvestmentApp\Payments\DTOs;

class ValidatePaymentResult {
    public function __construct(
        public bool $valid,
        public string $status,      // 'paid' etc
        public ?string $reason = null
    ) {}
}

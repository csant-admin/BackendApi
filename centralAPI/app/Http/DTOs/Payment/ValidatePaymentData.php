<?php
namespace App\Modules\InvestmentApp\Payments\DTOs;

class ValidatePaymentData {
    public function __construct(
        public string $gatewayReference,
        public float $paidAmount,
        public string $signature,
        public array $rawPayload,
    ) {}
}

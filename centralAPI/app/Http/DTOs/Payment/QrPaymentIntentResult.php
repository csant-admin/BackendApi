<?php
namespace App\Modules\InvestmentApp\Payments\DTOs;

class QrPaymentIntentResult {
    public function __construct(
        public string $gatewayReference,
        public string $qrPayload,       // EMV text payload
        public ?string $qrImageUrl = null,
        public ?\DateTimeInterface $expiresAt = null,
    ) {}
}

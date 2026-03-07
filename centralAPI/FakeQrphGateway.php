<?php

namespace Tests\Fakes;

use App\Modules\InvestmentApp\Payments\Contracts\QrPaymentGatewayInterface;
use App\Modules\InvestmentApp\Payments\DTOs\CreatePaymentIntentData;
use App\Modules\InvestmentApp\Payments\DTOs\QrPaymentIntentResult;
use App\Modules\InvestmentApp\Payments\DTOs\ValidatePaymentData;
use App\Modules\InvestmentApp\Payments\DTOs\ValidatePaymentResult;

class FakeQrphGateway implements QrPaymentGatewayInterface
{
    public function createIntent(CreatePaymentIntentData $dto): QrPaymentIntentResult
    {
        return new QrPaymentIntentResult(
            gatewayReference: 'FAKE-' . $dto->reference,
            qrPayload: '000201010212FAKEPAYLOAD6304ABCD',
            qrImageUrl: null,
            expiresAt: now()->addMinutes(15)
        );
    }

    public function validate(ValidatePaymentData $dto): ValidatePaymentResult
    {
        // Simple rule for tests: signature "valid" means success
        $valid = $dto->signature === 'valid';

        return new ValidatePaymentResult(
            valid: $valid,
            status: $valid ? 'paid' : 'failed',
            reason: $valid ? null : 'Invalid signature'
        );
    }
}

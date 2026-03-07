<?php
namespace App\Modules\InvestmentApp\Payments\Contracts;

use App\Modules\InvestmentApp\Payments\DTOs\CreatePaymentIntentData;
use App\Modules\InvestmentApp\Payments\DTOs\QrPaymentIntentResult;
use App\Modules\InvestmentApp\Payments\DTOs\ValidatePaymentData;
use App\Modules\InvestmentApp\Payments\DTOs\ValidatePaymentResult;

interface QrPaymentGatewayInterface {
    public function createIntent(CreatePaymentIntentData $dto): QrPaymentIntentResult;

    public function validate(ValidatePaymentData $dto): ValidatePaymentResult;
}

<?php

namespace Tests;

use Tests\Fakes\FakeQrphGateway;
use App\Modules\InvestmentApp\Payments\Contracts\QrPaymentGatewayInterface;

class BindFakeQrphGatewayTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->app->bind(QrPaymentGatewayInterface::class, FakeQrphGateway::class);
    }
}

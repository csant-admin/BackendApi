<?php
namespace App\Modules\InvestmentApp\Payments\Contracts;

interface QrphPayloadBuilderInterface {
    public function buildDynamic(array $fields): string;
}

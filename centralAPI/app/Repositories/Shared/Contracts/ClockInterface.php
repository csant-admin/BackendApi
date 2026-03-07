<?php
// app/Modules/InvestmentApp/Shared/Contracts/ClockInterface.php
namespace App\Modules\InvestmentApp\Shared\Contracts;

interface ClockInterface {
    public function now(): \Carbon\CarbonInterface;
}

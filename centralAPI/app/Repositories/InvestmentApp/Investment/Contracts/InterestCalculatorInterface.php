<?php
namespace App\InvestmentApp\Investments\Contracts;

use App\Models\Investment;

interface InterestCalculatorInterface {
    public function calculateAccrued(Investment $investment): float;
}

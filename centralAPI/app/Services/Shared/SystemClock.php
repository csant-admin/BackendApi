<?php
// app/Modules/InvestmentApp/Shared/Services/SystemClock.php
namespace App\Modules\InvestmentApp\Shared\Services;

use App\Modules\InvestmentApp\Shared\Contracts\ClockInterface;
use Carbon\Carbon;

class SystemClock implements ClockInterface {
    public function now(): \Carbon\CarbonInterface {
        return Carbon::now();
    }
}

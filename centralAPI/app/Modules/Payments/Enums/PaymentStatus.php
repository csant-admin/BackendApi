<?php

namespace App\Modules\InvestmentApp\Payments\Enums;

final class PaymentStatus
{
    public const PENDING = 'pending';
    public const PAID = 'paid';
    public const FAILED = 'failed';
    public const EXPIRED = 'expired';

    public static function values(): array
    {
        return [
            self::PENDING,
            self::PAID,
            self::FAILED,
            self::EXPIRED,
        ];
    }
}

<?php

namespace App\Enums;

class StatusEnum
{
    const PENDING = 1;
    const PAID = 2;

    const WITHOUT_MONEY = 3;

    const LATE = 4;

    public static function getLabels()
    {
        return [
            self::PENDING => 'Pending',
            self::PAID => 'Paid',
            self::WITHOUT_MONEY => 'Without Money',
            self::LATE => 'Late',
           
        ];
    }
}

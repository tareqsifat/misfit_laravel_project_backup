<?php

namespace App\Enums;

class PricePlanTypEnums
{
    const MONTHLY = 0;
    const YEARLY = 1;
    const LIFETIME = 2;

    const CUSTOM = 3;


    public static function getText($const)
    {
        if ($const == self::MONTHLY){
            return __('Monthly');
        }elseif ($const == self::YEARLY){
            return __('Yearly');
        }elseif ($const == self::LIFETIME){
            return __('Lifetime');
        }elseif ($const == self::CUSTOM){
            return __('Custom');
        }
    }
}

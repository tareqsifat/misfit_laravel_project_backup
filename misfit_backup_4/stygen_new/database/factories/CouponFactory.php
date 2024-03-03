<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Coupon;
use Carbon\Carbon;

class CouponFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model = Coupon::class;

    public function definition()
    {
        $code = 'Kf-'.(string)mt_rand(pow(5, 5), pow(5, 6) - 1);
        return [
            'code' => $code,
            'discount_type' => 'Fixed',
            'amount' => 700,
            'title' => 'Khas food coupon',
            'start_date' => Carbon::today(),
            'expire_date' => Carbon::now()->addMonth(3),
            'coupon_type' => 'temp',
            'use_limit' => 1,
            'status' => 1,
        ];
    }
}

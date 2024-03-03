<?php

namespace App\Charts;

use App\Models\Order;
use App\Models\User;
use ArielMejiaDev\LarapexCharts\LarapexChart;
use Carbon\Carbon;

class hourlyChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\AreaChart
    {

        $user_phone = User::where('status',1)->pluck('phone');

        $return_user = Order::where('created_at', '>=', Carbon::now()->subDay())->whereIn('phone', $user_phone)->get()->groupBy(function($date) {
            return Carbon::parse($date->created_at)->format('d');
        });

        $return_users[] = $return_user->first()->toArray();
        dd($return_users);
        return $this->chart->AreaChart()
            ->setTitle('hourly return user')
            ->setSubtitle('Physical sales vs Digital sales.')
            ->addData('Return User', $return_users)
            // ->addData('Digital sales', [70, 29, 77, 28, 55, 45])
            ->setXAxis(['January', 'February', 'March', 'April', 'May', 'June']);
    }
}

<?php

namespace App\Charts;

use App\Models\Order;
use App\Models\User;
use ArielMejiaDev\LarapexCharts\LarapexChart;
use Carbon\Carbon;
use DateTime;
use Illuminate\Support\Facades\DB;

class DailySales
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }
    private function convert($value) {
        if ($value >= 1000) {
            return round($value/1000, 1) . "k";
        } else {
            return $value;
        }
    }

    public function build(): \ArielMejiaDev\LarapexCharts\BarChart
    {
        $orderCount = [];
        $days = [];
        for($i = 1; $i<=31; $i++) {
            $days[] = Carbon::now()->subdays($i);
            $countdays[] = Carbon::now()->subdays($i)->format('m-d');
        }

        $user_phone = User::where('status',1)->pluck('phone');

        foreach($days as $day) {
            $ordertemp[] = Order::whereDate('created_at', $day)->count();
            $orderCount = array_reverse($ordertemp);

            $temp_sum[] = Order::whereDate('created_at', $day)->pluck('total_amount')->toArray();
            $ordertotal[] = $this->convert(Order::whereDate('created_at', $day)->pluck('total_amount')->sum());
            // $ordertotal = $this->convert($ordertotal_temp);
            // $return_user[] = $this->convert(Order::whereIn('phone', $user_phone)->where('created_at', $day)->count());
        }
        $return_user = Order::where('created_at', '>=', Carbon::now()->subDay())->whereIn('phone', $user_phone)->get()->groupBy(function($date) {
            return Carbon::parse($date->created_at)->format('d');
        });

        // $return_users[] = count($return_user->first()->toArray());
        // $total_amount = array_sum($ordertotal);
        // dd($return_users);

        return $this->chart->BarChart()
            ->setTitle('Sales')
            ->setSubtitle('Daily Acquisition')
            ->addData('orders', $orderCount)
            ->addData('order value (K)', array_reverse($ordertotal))
            // ->addData('Return User', array_reverse($return_users))
            ->setXAxis(array_reverse($countdays))
	    ->setGrid(false, '#3F51B5', 0.1);
    }

}


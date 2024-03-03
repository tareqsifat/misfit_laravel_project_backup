<?php

namespace App\Charts;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\User;
use ArielMejiaDev\LarapexCharts\LarapexChart;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class MonthlySalesChart
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

    public function build(): \ArielMejiaDev\LarapexCharts\AreaChart
    {


        $user_phone = User::where('status',1)->distinct('phone')->pluck('phone');

        $return_users = [];
        $orders = [];
        $to = \Carbon\Carbon::createFromFormat('Y-m-d', '2021-4-16');
        $from = Carbon::today();
        $diff_in_months = $to->diffInMonths($from);

        $order_data = Order::select(DB::raw("(COUNT(*)) as count"), DB::raw("MONTHNAME(created_at) as monthname"))
        ->whereBetween('created_at', [$to,$from])
        ->orderBy('created_at','ASC')
        ->groupBy('monthname')
        ->get()->toArray();

        $order_totals = Order::select(DB::raw("(SUM(total_amount)) as total_amount"), DB::raw("MONTHNAME(created_at) as monthname"))
        ->whereBetween('created_at', [$to,$from])
        ->orderBy('created_at','ASC')
        ->groupBy('monthname')
        ->get()->toArray();

        $duplicates = DB::table('orders')
        ->select('phone', DB::raw('COUNT(*) as count'))
        ->whereBetween('created_at', [$to,$from])
        ->groupBy(DB::raw('Date(created_at)'))
        ->whereIn('phone', $user_phone)
        ->havingRaw('COUNT(*) > 1')
        ->get();
        array_push($return_users, $duplicates);


        $month_name = array();

        for ($i = $diff_in_months; $i >= 0; $i--) {
            $month = Carbon::today()->startOfMonth()->subMonth($i);
            $year = Carbon::today()->startOfMonth()->subMonth($i)->format('Y');
            array_push($month_name,
                $month->shortMonthName,
            );
        }

        $ordertotal = Order::select(DB::raw("(SUM(total_amount)) as total_amount"),DB::raw("MONTHNAME(created_at) as monthname"))
        ->whereBetween('created_at', [$to,$from])
        ->where('shipping_status_id','!=','Canceled')
        ->groupBy('monthname')
        ->orderBy('created_at','ASC')
        ->get();


        $order_return_data = Order::select(DB::raw("(COUNT(*)) as count"), DB::raw("MONTHNAME(created_at) as monthname"))
        ->whereYear('created_at', date('Y', strtotime('-1 year')))
        ->whereIn('phone', $user_phone)
        ->distinct('phone')
        ->groupBy('monthname')
        ->orderBy('created_at','ASC')
        ->get();

        foreach($order_totals as $total_amount) {
            $order_total[] = $this->convert($total_amount['total_amount']);
            $order_month[] = $total_amount['monthname'];
        }


        foreach($order_data as $order) {
            $order_count[] = $order['count'];
        }
        // dd($order_data, $order_totals, $month_name);

        return $this->chart->areaChart()
            ->setTitle('Sales during 2021.')
            ->addData('Monthly sales', $order_count)
            ->addData('Total Value (k)', $order_total)

            ->setFontFamily('DM Sans')
            ->setXAxis($month_name);
    }
}

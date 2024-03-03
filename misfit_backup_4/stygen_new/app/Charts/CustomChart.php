<?php

namespace App\Charts;

use App\Models\Order;
use ArielMejiaDev\LarapexCharts\LarapexChart;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CustomChart
{
    protected $chart;

    private function convert($value) {
        if ($value >= 1000) {
            return round($value/1000, 1) . "k";
        } else {
            return $value;
        }
    }

    public function __construct(LarapexChart $chart,Request $request)
    {
        $this->chart = $chart;
        $this->request = $request;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\LineChart
    {
        // dd($this->request->all());
        $startDate = $this->request->start_date;
        $endDate = $this->request->end_date;

        $order_data = Order::select(DB::raw("(COUNT(*)) as count"), DB::raw("DAY(created_at) as day"))
        ->whereBetween('created_at', [$startDate,$endDate])
        ->orderBy('created_at','ASC')
        ->groupBy('day')
        ->get()->toArray();

        $order_totals = Order::select(DB::raw("(SUM(total_amount)) as total_amount"), DB::raw("DAY(created_at) as day"))
        ->whereBetween('created_at', [$startDate,$endDate])
        ->orderBy('created_at','ASC')
        ->groupBy('day')
        ->get()->toArray();

        foreach($order_totals as $total_amount) {
            $order_total[] = $this->convert($total_amount['total_amount']);
            $order_day[] = $total_amount['day'];
        }


        foreach($order_data as $order) {
            $order_count[] = $order['count'];
        }

        return $this->chart->lineChart()
            ->setTitle('Sales data')
            ->addData('Total value', $order_total)
            ->addData('Sales', $order_count)
            ->setXAxis($order_day);
    }
}

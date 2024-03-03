<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Trade;
use App\Models\Wallet;
use App\Models\Transaction;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function open()
    {
        $pageTitle = "Open Order";
        $orders    = $this->orderData('open');
        return view('admin.order.list', compact('pageTitle', 'orders'));
    }
    public function history()
    {
        $pageTitle = "Order History";
        $orders    = $this->orderData();
        return view('admin.order.list', compact('pageTitle', 'orders'));
    }
        
    public function send_comission() {
        // dd(request()->all());
        foreach (request()->order_ids as $id) {
            $order = Order::where('id', $id)->first();
            $userCoinWallet = Wallet::where('user_id', $order->user_id)->where('currency_id', $order->coin_id)->first();
            $user_commission = ($order->total / 100) * request()->amount;
            $user_payment_amount = $order->total+$user_commission;
            
            $userCoinWallet->balance += $user_payment_amount;
            $userCoinWallet->save();
            
            if($order->order_side == 1){
                $trx_details = 'trade_buy';
                $remark = 'Buy';
            }else {
                $trx_details = 'trade_sell';
                $remark = 'Sell';
            }
            $transactions[] = [
                'user_id'      => $order->user_id,
                'wallet_id'    => $userCoinWallet->id,
                'amount'       => $user_payment_amount,
                'post_balance' => $userCoinWallet->balance,
                'charge'       => $order->charge,
                'trx_type'     => '+',
                'details'      => $trx_details,
                'trx'          => getTrx(),
                'remark'       => $remark,
            ];
            
            Transaction::insert($transactions);
            
            $order->status = 1;
            $order->filed_percentage = 100;
            $order->save();
        }
        
        $notify[] = ['success', 'Comission Sent successfully'];
        return back()->withNotify($notify);
    }
    
    protected function orderData($scope = null)
    {
        $query = Order::filter(['order_side','user_id','status'])->searchable(['pair:symbol', 'pair.coin:symbol', 'pair.market.currency:symbol'])->with('pair','pair.coin','pair.market.currency')->orderBy('id', 'desc');
        if ($scope) {
            $query->$scope();
        }
        return $query->paginate(getPaginate());
    }

    public function tradeHistory()
    {
        $pageTitle = "Trade History";
        $trades    = Trade::filter(['trade_side','trader_id'])->searchable(['order.pair:symbol', 'order.pair.coin:symbol', 'order.pair.market.currency:symbol'])->with('order.pair','order.pair.coin','order.pair.market.currency')->orderBy('id', 'desc')->paginate(getPaginate());
        return view('admin.order.trade_history', compact('pageTitle', 'trades'));
    }
}

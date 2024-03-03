<?php

namespace App\Http\Controllers\User;

use Exception;
use App\Models\Order;
use App\Models\Wallet;
use App\Models\CoinPair;
use App\Constants\Status;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Events\Order as EventsOrder;
use App\Http\Controllers\Controller;
use App\Models\AdminNotification;
use App\Models\Trade;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    public function open()
    {
        $pageTitle = "Open Order";
        $orders    = $this->orderData('open');
        return view($this->activeTemplate . 'user.order.list', compact('pageTitle', 'orders'));
    }
    public function completed()
    {
        $pageTitle = "Completed Order";
        $orders    = $this->orderData('completed');
        return view($this->activeTemplate . 'user.order.list', compact('pageTitle', 'orders'));
    }
    public function canceled()
    {
        $pageTitle = "Canceled Order";
        $orders    = $this->orderData('canceled');
        return view($this->activeTemplate . 'user.order.list', compact('pageTitle', 'orders'));
    }

    public function history()
    {
        $pageTitle = "My Order";
        $orders    = $this->orderData();
        return view($this->activeTemplate . 'user.order.list', compact('pageTitle', 'orders'));
    }

    protected function orderData($scope = null)
    {
        $query = Order::where('user_id', auth()->id())->filter(['order_side', 'order_type'])->searchable(['pair:symbol', 'pair.coin:symbol', 'pair.market.currency:symbol'])->with('pair', 'pair.coin', 'pair.market.currency')->orderBy('id', 'desc');
        if ($scope) {
            $query->$scope();
        }
        return $query->paginate(getPaginate());
    }

    public function tradeHistory()
    {
        $pageTitle = "Trade History";
        $trades    = Trade::where('trader_id', auth()->id())->filter(['trade_side'])->searchable(['order.pair:symbol', 'order.pair.coin:symbol', 'order.pair.market.currency:symbol'])->with('order.pair.coin', 'order.pair.market.currency')->orderBy('id', 'desc')->paginate(getPaginate());
        return view($this->activeTemplate . 'user.order.trade_history', compact('pageTitle', 'trades'));
    }


    public function save(Request $request, $symbol)
    {
        $validator = Validator::make($request->all(), [
            'rate'       => 'required|numeric|gt:0',
            'amount'     => 'required|numeric|gt:0',
            'order_side' => 'required|in:' . Status::BUY_SIDE_ORDER . ',' . Status::SELL_SIDE_ORDER . '',
            'order_type' => 'required|in:' . Status::ORDER_TYPE_LIMIT . ',' . Status::ORDER_TYPE_MARKET . '',
        ]);

        if ($validator->fails()) {
            return $this->response($validator->errors()->all());
        }
        $pair = CoinPair::activeMarket()->activeCoin()->with('market.currency', 'coin', 'marketData')->where('symbol', $symbol)->first();

        if (!$pair) return $this->response('Pair not found');

        $amount      = $request->amount;
        $rate        = $request->order_type == Status::ORDER_TYPE_LIMIT ? $request->rate : $pair->marketData->price;
        $totalAmount = $amount * $rate;

        $coin           = $pair->coin;
        $marketCurrency = $pair->market->currency;
        $user           = auth()->user();

        if ($request->order_side ==  Status::BUY_SIDE_ORDER) {

            $userMarketCurrencyWallet = Wallet::where('user_id', $user->id)->where('currency_id', $marketCurrency->id)->first();

            if (!$userMarketCurrencyWallet) {
                return $this->response('Your market currency wallet not found');
            }

            if ($amount < $pair->minimum_buy_amount) {
                return $this->response("Minimum buy amount " . showAmount($pair->minimum_buy_amount) . ' ' . $coin->symbol);
            }

            if ($amount > $pair->maximum_buy_amount &&  $pair->maximum_buy_amount != -1) {  //-1 for unlimited maximum amount
                return $this->response("Maximum buy amount " . showAmount($pair->maximum_buy_amount) . ' ' . $coin->symbol);
            }

            $charge = ($totalAmount / 100) * $pair->percent_charge_for_buy;
            if (($charge + $totalAmount) > $userMarketCurrencyWallet->balance) {
                return $this->response('You don\'t have sufficient ' . $marketCurrency->symbol . ' wallet balance for buy coin.');
            }
            $orderSide = "Buy";
        }

        if ($request->order_side ==  Status::SELL_SIDE_ORDER) {
            $userCoinWallet = Wallet::where('user_id', $user->id)->where('currency_id', $coin->id)->first();

            if (!$userCoinWallet) {
                return $this->response('Your coin wallet not found');
            }
            if ($request->amount < $pair->minimum_sell_amount) {
                return $this->response("Minimum sell amount " . showAmount($pair->minimum_sell_amount) . ' ' . $coin->symbol);
            }
            if ($request->amount > $pair->maximum_sell_amount && $pair->maximum_sell_amount != -1) {
                return $this->response("Maximum sell amount " . showAmount($pair->maximum_sell_amount) . ' ' . $coin->symbol);
            }
            $charge = ($totalAmount / 100) * $pair->percent_charge_for_sell;
            if ($request->amount > $userCoinWallet->balance) {
                return $this->response('You don\'t have sufficient ' . $userCoinWallet->symbol . ' wallet balance for sell coin.');
            }
            $orderSide = "Sell";
        }

        $order                     = new Order();
        $order->trx                = getTrx();
        $order->user_id            = $user->id;
        $order->pair_id            = $pair->id;
        $order->order_side         = $request->order_side;
        $order->order_type         = $request->order_type;
        $order->rate               = $rate;
        $order->amount             = $amount;
        $order->price              = $pair->marketData->price;
        $order->total              = $totalAmount;
        $order->charge             = $charge;
        $order->coin_id            = $coin->id;
        $order->market_currency_id = $marketCurrency->id;
        $order->save();

        if ($request->order_side ==  Status::BUY_SIDE_ORDER) {
            $details       = "Open order for buy coin on " . $pair->symbol . " pair";
            $walletBalance = $this->createTrx($userMarketCurrencyWallet, 'order_buy', $totalAmount, $charge, $details, $user);
        } else {
            $details       = "Open order for sell coin on " . $pair->symbol . " pair";
            $walletBalance = $this->createTrx($userCoinWallet, 'order_sell', $amount, 0, $details, $user);
        }

        try {
            event(new EventsOrder($order, $pair->symbol));
        } catch (Exception $ex) {
        }

        $adminNotification            = new AdminNotification();
        $adminNotification->user_id   = $user->id;
        $adminNotification->title     = $user->username . $details;
        $adminNotification->click_url = urlPath('admin.order.history');
        $adminNotification->save();

        notify($user, 'ORDER_OPEN', [
            'pair'                   => $pair->symbol,
            'amount'                 => showAmount($order->amount),
            'total'                  => showAmount($order->total),
            'rate'                   => showAmount($order->rate),
            'price'                  => showAmount($order->price),
            'coin_symbol'            => @$coin->symbol,
            'order_side'             => $orderSide,
            'market_currency_symbol' => @$marketCurrency->symbol,
            'market'                 => $pair->market->name
        ]);

        $data = [
            'wallet_balance' => $walletBalance,
            'order'          => $order,
            'pair_symbol'    => $pair->symbol
        ];

        return $this->response("Your order open successfully", true, $data);
    }

    private function response($message, $status = false, $data = [])
    {
        return response()->json([
            'success' => $status,
            'message' => $message,
            'data'    => $data
        ]);
    }

    public function createTrx($wallet, $remark, $amount, $charge, $details, $user, $type = "-")
    {

        if ($type == '-') {
            $wallet->balance  -= $amount + $charge;
            $wallet->on_order += $amount;
        } else {
            $wallet->balance  += $amount + $charge;
            $wallet->on_order -= $amount;
        }

        $wallet->save();

        $transaction               = new Transaction();
        $transaction->user_id      = $user->id;
        $transaction->wallet_id    = $wallet->id;
        $transaction->amount       = $amount + $charge;
        $transaction->post_balance = $wallet->balance;
        $transaction->charge       = $charge;
        $transaction->trx_type     = $type;
        $transaction->details      = $details;
        $transaction->trx          = getTrx();
        $transaction->remark       = $remark;
        $transaction->save();

        return $wallet->balance;
    }

    public function cancel($id)
    {
        $user   = auth()->user();
        $order  = Order::where('user_id', $user->id)->where('id', $id)->open()->with('pair', 'pair.coin', 'pair.market.currency')->firstOrFail();
        $amount = $order->amount - $order->filled_amount;

        if ($order->order_side == Status::BUY_SIDE_ORDER) {
            $symbol           = @$order->pair->market->currency->symbol;
            $duePercentage    = ($amount / $order->amount) * 100;
            $chargeBackAmount = ($order->charge / 100) * $duePercentage;
            $amount           = ($amount * $order->rate) + $chargeBackAmount;
            $wallet           = Wallet::where('user_id', $user->id)->where('currency_id', $order->pair->market->currency->id)->first();
            $details          = "Return $amount $symbol for order cancel";
        } else {
            $symbol        = @$order->pair->coin->symbol;
            $wallet        = Wallet::where('user_id', $user->id)->where('currency_id', $order->pair->coin->id)->first();
            $details       = "Return $amount $symbol for order cancel";
        }

        if ($amount <= 0 || !$wallet) {
            $notify[] = ['error', "Something went to wrong"];
            return back()->withNotify($notify);
        }

        $order->status = Status::ORDER_CANCELED;
        $order->save();

        $wallet->balance  += $amount;
        $wallet->on_order -= $amount;
        $wallet->save();

        $transaction               = new Transaction();
        $transaction->user_id      = $user->id;
        $transaction->wallet_id    = $wallet->id;
        $transaction->amount       = $amount;
        $transaction->post_balance = $wallet->balance;
        $transaction->charge       = 0;
        $transaction->trx_type     = '+';
        $transaction->details      = $details;
        $transaction->trx          = getTrx();
        $transaction->remark       = 'order_canceled';
        $transaction->save();

        notify($user, 'ORDER_CANCEL', [
            'pair'                   => $order->pair->symbol,
            'amount'                 => showAmount($order->amount),
            'coin_symbol'            => @$order->pair->coin->symbol,
            'market_currency_symbol' => @$order->pair->market->currency->symbol,
        ]);

        $notify[] = ['success', "Order canceled successfully"];
        return back()->withNotify($notify);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'amount' => 'required|gt:0'
        ]);

        if ($validator->fails()) {
            return $this->response($validator->errors()->all());
        }

        $user  = auth()->user();
        $order = Order::where('user_id', $user->id)->where('id', $id)->open()->whereHas('pair', function ($q) {
            $q->activeMarket()->activeCoin();
        })->with('pair', 'pair.coin', 'pair.market.currency')->open()->first();

        if (!$order) {
            return $this->response("Order not found");
        }

        $pair = $order->pair;

        if ($request->amount == $order->amount) {
            return $this->response("Please change order amount");
        }
        if ($request->amount == $order->filled_amount) {
            return $this->response("Already filled " . showAmount($order->filled_amount));
        }

        if ($order->order_side ==  Status::BUY_SIDE_ORDER) {
            $chargePercentage = $pair->percent_charge_for_buy;
            $currency     = $pair->market->currency;
            $minAmount    = $pair->minimum_buy_amount;
            $maxAmount    = $pair->maximum_buy_amount;
            $wallet       = Wallet::where('user_id', $user->id)->where('currency_id', $currency->id)->first();
            $type         = "buy";
        } else {
            $chargePercentage = $pair->percent_charge_for_sell;
            $currency     = $pair->coin;
            $minAmount    = $pair->minimum_sell_amount;
            $maxAmount    = $pair->maximum_sell_amount;
            $wallet       = Wallet::where('user_id', $user->id)->where('currency_id', $currency->id)->first();
            $type         = "sell";
        }

        if ($request->amount > $order->amount) {
            $updatedAmount  = $request->amount - $order->amount;
            $orderAmount    = $order->amount + $updatedAmount;
            $charge         = (($updatedAmount * $order->rate) / 100) * $chargePercentage;
            $order->charge += $charge;
        } else {
            $updatedAmount  = $order->amount - $request->amount;
            $orderAmount    = $order->amount - $updatedAmount;
            $charge         = (($updatedAmount * $order->rate) / 100) * $chargePercentage;
            $order->charge -= $charge;
        }

        $oldOrderAmount = $order->amount;

        if ($request->amount < $minAmount) {
            return $this->response("Minimum $type amount " . showAmount($minAmount) . ' ' . $currency->symbol);
        }

        if ($request->amount > $maxAmount &&  $maxAmount != -1) {
            return $this->response("Maximum $type amount " . showAmount($maxAmount) . ' ' . $currency->symbol);
        }

        if ($request->amount > $order->amount) {
            $requiredAmount = $order->order_side == Status::BUY_SIDE_ORDER ? ($charge + ($updatedAmount * $order->rate)) : $updatedAmount;
            if ($requiredAmount > $wallet->balance) {
                return $this->response('You don\'t have sufficient ' . $currency->symbol . ' wallet balance for ' . $type . ' coin.');
            }
        }

        $totalAmount   = $orderAmount * $order->rate;
        $order->amount = $orderAmount;
        $order->total  = $totalAmount;
        $order->save();

        if ($order->order_side ==  Status::BUY_SIDE_ORDER) {
            $details = "Update buy order on  " . $pair->symbol . " pair. updated amount is $updatedAmount " . @$order->pair->coin->symbol;
            if ($request->amount > $oldOrderAmount) {
                $this->createTrx($wallet, 'order_buy', ($updatedAmount * $order->rate), $charge, $details, $user);
            } else {
                $chargePercent    = ($updatedAmount / $oldOrderAmount) * 100;
                $chargeBackAmount = ($order->charge / 100) * $chargePercent;
                $backAmount       = ($updatedAmount * $order->rate) + $chargeBackAmount;
                $this->createTrx($wallet, 'order_buy', $backAmount, 0, $details, $user, '+');
            }
        } else {
            $details = "Update sell order on  " . $pair->symbol . " pair. updated amount is $updatedAmount " . @$order->pair->coin->symbol;
            $this->createTrx($wallet, 'order_sell', $updatedAmount, 0, $details, $user, $request->amount > $oldOrderAmount ? '-' : '+');
        }
        $data = [
            'order_amount' => showAmount($order->amount),
            'order_id'     => $order->id
        ];

        return $this->response("Your order update successfully", true, $data);
    }
}

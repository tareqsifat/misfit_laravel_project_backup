<?php

namespace App\Lib;

use App\Models\Order;
use App\Models\Trade;
use App\Models\Wallet;
use App\Constants\Status;
use App\Events\Trade as EventsTrade;
use App\Models\Transaction;
use Exception;

class TradeManager
{
    private $transactions    = [];
    private $trades          = [];
    private $tradeWithSymbol = [];

    public function trade()
    {
        $buySideOrders  = Order::with('pair.coin', 'pair.market', 'user')->buySideOrder()->open()->orderBy('id', 'ASC')->get();
        $sellSideOrders = Order::with('pair', 'user')->sellSideOrder()->open()->orderBy('id', 'ASC')->get();

        $tradeSideSell = Status::SELL_SIDE_ORDER;
        $tradeSideBuy  = Status::BUY_SIDE_TRADE;

        foreach ($buySideOrders as $buySideOrder) {

            $pairId             = $buySideOrder->pair_id;
            $rate               = $buySideOrder->rate;
            $matchingSellOrders = $sellSideOrders->where('pair_id', $pairId)->where('rate',$rate);
            $buyAmount          = $buySideOrder->amount - $buySideOrder->filled_amount;

            if (!$matchingSellOrders->count() || ($buyAmount <= 0)) {
                continue;
            }

            foreach ($matchingSellOrders as $matchingSellOrder) {
                $sellingAmount     = $matchingSellOrder->amount - $matchingSellOrder->filled_amount;
                if ($sellingAmount <= 0) {
                    continue;
                }
                if ($sellingAmount >= $buyAmount) {
                    $tradeAmount = $buyAmount;
                } else {
                    $tradeAmount = $sellingAmount;
                }

                $this->createTrade($tradeSideBuy, $buySideOrder, $rate, $tradeAmount, $buySideOrder->user_id);
                $buyerWallet = Wallet::where('user_id', $buySideOrder->user_id)->where('currency_id', $buySideOrder->pair->coin->id)->first();
                $this->updateOrder($buySideOrder, $tradeAmount);
                $buyerMarketCurrencyWallet = Wallet::where('user_id', $buySideOrder->user_id)->where('currency_id', $buySideOrder->pair->market->currency_id)->first();
                $this->updateWalletOnOrderAmount($buyerMarketCurrencyWallet, ($tradeAmount * $rate));

                $details = showAmount($tradeAmount) . ' ' . $buySideOrder->pair->coin->symbol . ' Buy completed on pair ' . $buySideOrder->pair->symbol;
                $this->createTrx($buySideOrder, $buyerWallet, $tradeAmount, 'trade_buy', 0, $details, $tradeAmount, "Buy");

                $totalSellingAmount = $tradeAmount * $rate;
                $charge             = 0;

                if ($matchingSellOrder->charge > 0) {
                    $sellingPercentage   = ($tradeAmount / $matchingSellOrder->amount) * 100;
                    $charge              = ($matchingSellOrder->charge / 100) * $sellingPercentage;
                    $totalSellingAmount -= $charge;
                }

                $this->createTrade($tradeSideSell, $matchingSellOrder, $rate, $tradeAmount, $matchingSellOrder->user_id, $charge);
                $sellerWallet = Wallet::where('user_id', $matchingSellOrder->user_id)->where('currency_id', $matchingSellOrder->pair->market->currency_id)->first();
                $this->updateOrder($matchingSellOrder, $tradeAmount);

                $sellerWalletCoinWallet = Wallet::where('user_id', $matchingSellOrder->user_id)->where('currency_id', $matchingSellOrder->pair->coin->id)->first();
                $this->updateWalletOnOrderAmount($sellerWalletCoinWallet, $tradeAmount);

                $details = showAmount($tradeAmount) . ' ' . $matchingSellOrder->pair->coin->symbol . ' Sell completed on pair ' . $matchingSellOrder->pair->symbol;
                $this->createTrx($matchingSellOrder, $sellerWallet, $totalSellingAmount, 'trade_sell', $charge, $details, $tradeAmount, "Sell");
            }
        }

        Transaction::insert($this->transactions);
        Trade::insert($this->trades);
        try {
            event(new EventsTrade($this->tradeWithSymbol));
        } catch (Exception $ex) {
            $general                     = gs();
            $general->cron_error_message = $ex->getMessage();
            $general->save();
        }
    }

    private function createTrx($order, $wallet, $amount, $remark, $charge = 0, $details, $tradeAmount, $orderSide)
    {
        $wallet->balance += $amount;
        $wallet->save();

        $this->transactions[] = [
            'user_id'      => $order->user_id,
            'wallet_id'    => $wallet->id,
            'amount'       => $amount,
            'post_balance' => $wallet->balance,
            'charge'       => $charge,
            'trx_type'     => '+',
            'details'      => $details,
            'trx'          => getTrx(),
            'remark'       => $remark,
        ];

        notify($order->user, 'ORDER_COMPLETE', [
            'pair'                   => $order->pair->symbol,
            'amount'                 => showAmount($tradeAmount),
            'total'                  => showAmount($order->total),
            'rate'                   => showAmount($order->rate),
            'price'                  => showAmount($order->price),
            'coin_symbol'            => @$order->pair->coin->symbol,
            'order_side'             => $orderSide,
            'market_currency_symbol' => @$order->pair->market->currency->symbol,
            'market'                 => @$order->pair->market->name,
            'filled_amount'          => showAmount(@$order->filled_amount),
            'filled_percentage'      => getAmount(@$order->filed_percentage),
        ]);

        if (gs('trade_commission')) {
            levelCommission($order->user, $tradeAmount, 'trade_commission', $order->trx, $order->coin_id);
        }
    }

    private function createTrade($tradeSide, $order, $rate, $amount, $traderId, $charge = 0)
    {
        $trade = [
            'trader_id'  => $traderId,
            'pair_id'    => $order->pair_id,
            'trade_side' => $tradeSide,
            'order_id'   => $order->id,
            'rate'       => $rate,
            'amount'     => $amount,
            'total'      => $rate * $amount,
            'charge'     => $charge
        ];
        $this->tradeWithSymbol[@$order->pair->symbol][] = $trade;
        $this->trades[] = $trade;
    }

    private function updateOrder($order, $amount)
    {
        $filedAmount    = $order->filled_amount + $amount;
        $filePercentage = ($filedAmount / $order->amount) * 100;

        if ($filedAmount == $order->amount) {
            $order->status = Status::ORDER_COMPLETED;
        }
        $order->filled_amount    = $filedAmount;
        $order->filed_percentage = $filePercentage;
        $order->save();
    }

    private function updateWalletOnOrderAmount($wallet, $amount)
    {
        $wallet->on_order -= $amount;
        $wallet->save();
    }
}

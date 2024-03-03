<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\CoinPair;
use App\Models\Trade;
use App\Models\User;
use App\Models\Wallet;
use App\Models\Order;
use App\Models\Transaction;

class AiRobot extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'trade:run';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $users = User::where('status', 1)->get();
        
        
        foreach($users as $user) {
            $pair = CoinPair::active()->activeMarket()->activeCoin()->with('market', 'coin', 'marketData')->where('is_default', 1)->first();
            // $pair = CoinPair::activeMarket()->activeCoin()->with('market.currency', 'coin', 'marketData')->where('is_default', 1)->first();
            
            if (!$pair) return $this->info('Pair not found');

            $amount      = $pair->minimum_buy_amount;
            $rate        = $pair->marketData->price;
            $totalAmount = $amount * $rate;
    
            $coin           = $pair->coin;
            $marketCurrency = $pair->market->currency;
            // $user           = auth()->user();
    
            
            $userCoinWallet = Wallet::where('user_id', $user->id)->where('currency_id', $coin->id)->first();
    
            if ($userCoinWallet) {
                $charge = ($totalAmount / 100) * $pair->percent_charge_for_sell;
                if ($pair->minimum_sell_amount < $userCoinWallet->balance) {
                    return $this->info('You don\'t have sufficient ' . $userCoinWallet->symbol . ' wallet balance for sell coin.');
                    // return response()->json('You don\'t have sufficient ' . $userCoinWallet->symbol . ' wallet balance for sell coin.');
                }
                $orderSide = "Sell";
                
        
                $order                     = new Order();
                $order->trx                = getTrx();
                $order->user_id            = $user->id;
                $order->pair_id            = $pair->id;
                $order->order_side         = $orderSide;
                $order->order_type         = 1;
                $order->rate               = $rate;
                $order->amount             = $amount;
                $order->price              = $pair->marketData->price;
                $order->total              = $totalAmount;
                $order->charge             = $charge;
                $order->coin_id            = $coin->id;
                $order->market_currency_id = $marketCurrency->id;
                $order->save();
                
                $trade = new Trade();
                $trade->trader_id = $user->id;
                $trade->pair_id = $order->pair_id;
                $trade->trade_side = 2;
                $trade->order_id = $order->id;
                $trade->rate = $order->rate;
                $trade->amount = $order->amount;
                $trade->total = $order->total;
                $trade->charge = $order->charge;
                $trade->save();
                
                // $user_commission = ($order->total / 100) * $pair->commission;
                // $user_payment_amount = $order->total+$user_commission;
                
                // $userCoinWallet->balance += $user_payment_amount;
                // $userCoinWallet->save();
                
                // $transactions[] = [
                //     'user_id'      => $order->user_id,
                //     'wallet_id'    => $userCoinWallet->id,
                //     'amount'       => $user_payment_amount,
                //     'post_balance' => $userCoinWallet->balance,
                //     'charge'       => $charge,
                //     'trx_type'     => '+',
                //     'details'      => 'trade_sell',
                //     'trx'          => getTrx(),
                //     'remark'       => 'Sell',
                // ];
                
                // Transaction::insert($this->transactions);
                
                // $order->status = Status::ORDER_COMPLETED;
                // $order->filled_amount    = $totalAmount;
                // $order->filed_percentage = 100;
                // $order->save();
                
            }
            
            $user->lock_amount = 0;
            $user->save();
            // if ($request->amount < $pair->minimum_sell_amount) {
            //     return $this->response("Minimum sell amount " . showAmount($pair->minimum_sell_amount) . ' ' . $coin->symbol);
            // }
            // if ($request->amount > $pair->maximum_sell_amount && $pair->maximum_sell_amount != -1) {
            //     return $this->response("Maximum sell amount " . showAmount($pair->maximum_sell_amount) . ' ' . $coin->symbol);
            // }
            
            
        }

        return Command::SUCCESS;
        
    }
}

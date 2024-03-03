<?php

namespace App\Http\Controllers\User;

use App\Constants\Status;
use App\Models\Wallet;
use App\Models\Currency;
use App\Http\Controllers\Controller;
use App\Models\Deposit;
use App\Models\GatewayCurrency;
use App\Models\Order;
use App\Models\Transaction;
use App\Models\Withdrawal;
use App\Models\WithdrawMethod;

class WalletController extends Controller
{
    public function list($type = null)
    {
        $pageTitle = "My Wallets";
        $query     = Wallet::with('currency')->where('user_id', auth()->id())->with('currency');
        if ($type == 'crypto') {
            $query->whereHas('currency', function ($q) {
                $q->crypto();
            });
            $pageTitle = "My Crypto Wallets";
        }
        if ($type == 'fiat') {
            $query->whereHas('currency', function ($q) {
                $q->fiat();
            });
            $pageTitle = "My Fiat Currency Wallets";
        }
        $wallets = $query->orderBy('balance', 'desc')->paginate(getPaginate());
        return view($this->activeTemplate . 'user.wallet.list', compact('pageTitle', 'wallets'));
    }

    public function view($curSymbol)
    {
        $currency  = Currency::where('symbol', $curSymbol)->firstOrFail();
        $wallet    = Wallet::where('user_id', auth()->id())->where('currency_id', $currency->id)->firstOrFail();
        $pageTitle = $curSymbol . " Wallet";
        $user      = auth()->user();

        $trxQuery     = Transaction::where('wallet_id', $wallet->id)->with('wallet.currency');
        $transactions = (clone $trxQuery)->latest('id')->paginate(getPaginate());
        $orderQuery   = Order::where('user_id', $user->id);

        if ($currency->type == Status::CRYPTO_CURRENCY) {
            $widget['total_order'] = (clone $orderQuery)->where(function ($q) use ($currency) {
                $q->where('market_currency_id', $currency->id)->orWhere('coin_id', $currency->id);
            })->count();
        } else {
            $widget['total_order'] = (clone $orderQuery)->where('market_currency_id', $currency->id)->count();
        }


        $widget['total_deposit']     = Deposit::successful()->where('wallet_id', $wallet->id)->sum('amount');
        $widget['total_withdraw']    = Withdrawal::approved()->where('wallet_id', $wallet->id)->sum('amount');
        $widget['total_transaction'] = (clone $trxQuery)->sum('amount');

        $gateways = GatewayCurrency::where('currency', $curSymbol)->whereHas('method', function ($gate) {
            $gate->active();
        })->with('method')->get();

        $withdrawMethods = WithdrawMethod::active()->where('currency', $curSymbol)->get();

        return view($this->activeTemplate . 'user.wallet.view', compact('pageTitle', 'wallet', 'widget', 'transactions', 'gateways', 'withdrawMethods'));
    }
}

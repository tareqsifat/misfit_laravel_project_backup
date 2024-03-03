<?php

namespace App\Http\Controllers\Admin;

use App\Constants\Status;
use App\Models\Market;
use App\Models\CoinPair;
use App\Models\Currency;
use App\Models\MarketData;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CoinPairController extends Controller
{
    public function list()
    {
        $pageTitle = "Coin Pair";
        $pairs     = CoinPair::with('market.currency', 'coin')->orderBy('is_default','DESC')->filter(['market_id'])->searchable(['coin:name,symbol', 'market.currency:name,symbol'])->paginate(getPaginate());
        return view('admin.coin_pair.list', compact('pageTitle', 'pairs'));
    }
    public function create()
    {
        $pageTitle = "New Coin Pair";
        $markets   = Market::with('currency')->active()->orderBy('name')->get();
        return view('admin.coin_pair.create', compact('pageTitle', 'markets'));
    }

    public function edit($id)
    {
        $pageTitle = "Edit Coin Pair";
        $coinPair  = CoinPair::where('id', $id)->firstOrFail();
        $markets   = Market::with('currency')->active()->get();
        return view('admin.coin_pair.create', compact('pageTitle', 'markets', 'coinPair'));
    }
    public function save(Request $request, $id = 0)
    {

        $request->validate([
            'market'             => "required|integer",
            'coin'               => "required|integer",
            'minimum_buy_amount' => 'required|numeric|gt:0',
            'maximum_buy_amount' => ['required', 'numeric', function ($attribute, $value, $fail) use ($request) {
                if ($value <= 0  && $value !=  -1) return  $fail("Only -1 for no maximum buy limit.");
                if ($value < $request->minimum_buy_amount && $value != -1) return  $fail("The maximum buy amount must be greater then minimum buy amount.");
            }],
            'minimum_sell_amount' => 'required|numeric|gt:0',
            'maximum_sell_amount' => ['required', 'numeric', function ($attribute, $value, $fail) use ($request) {
                if ($value <= 0  && $value !=  -1) return  $fail("Only -1 for no maximum sell limit.");
                if ($value < $request->minimum_sell_amount && $value != -1) return  $fail("The maximum sell amount must be greater then minimum sell amount.");
            }],
            'percent_charge_for_buy'  => 'required|numeric|gte:0|lt:100',
            'percent_charge_for_sell' => 'required|numeric|gte:0',
            'listed_market_name'      => 'required'
        ]);

        $market = Market::active()->where('id', $request->market)->whereHas('currency', function ($q) {
            $q->active();
        })->active()->first();

        if (!$market) {
            $notify[] = ['error', "Selected market is invalid."];
            return back()->withNotify($notify)->withInput();
        }
        //only crypto
        $coin = Currency::where('id', $request->coin)->active()->crypto()->first();

        if (!$coin) {
            $notify[] = ['error', "Selected coin is invalid."];
            return back()->withNotify($notify)->withInput();
        }

        if (strtoupper($market->currency->symbol) == strtoupper($coin->symbol)) {
            $notify[] = ['error', "Market currency & coin can't be the same."];
            return back()->withNotify($notify)->withInput();
        }

        $symbol        = $coin->symbol . '_' . $market->currency->symbol;
        $alreadyExists = CoinPair::where('id', '!=', $id)->where('symbol', $symbol)->exists();

        if ($alreadyExists) {
            $notify[] = ['error', "Can't make one more coin pair with the same currency & market"];
            return back()->withNotify($notify)->withInput();
        }

        if ($id) {
            $message  = "CoinPair updated successfully";
            $coinPair = CoinPair::findOrFail($id);
        } else {
            $message             = "CoinPair saved successfully";
            $coinPair            = new CoinPair();
            $coinPair->market_id = $request->market;
            $coinPair->coin_id   = $coin->id;
            $coinPair->symbol    = $symbol;
        }

        $coinPair->minimum_buy_amount      = $request->minimum_buy_amount;
        $coinPair->maximum_buy_amount      = $request->maximum_buy_amount;
        $coinPair->minimum_sell_amount     = $request->minimum_sell_amount;
        $coinPair->maximum_sell_amount     = $request->maximum_sell_amount;
        $coinPair->percent_charge_for_sell = $request->percent_charge_for_sell;
        $coinPair->percent_charge_for_buy  = $request->percent_charge_for_buy;
        $coinPair->listed_market_name      = strtoupper($request->listed_market_name);

        if ($request->is_default) {
            CoinPair::where('id', '!=', $id)->where('is_default', Status::YES)->update(['is_default' => Status::NO]);
            $coinPair->is_default = Status::YES;
        } else {
            $defaultPair = CoinPair::where('id', '!=', $id)->where('is_default', Status::YES)->exists();
            if (!$defaultPair) {
                $notify[] = ['error', "Default coin pair is required."];
                return back()->withNotify($notify)->withInput();
            }
            $coinPair->is_default = Status::NO;
        }

        $coinPair->save();

        $marketData = MarketData::where('pair_id', $coinPair->id)->where('currency_id', 0)->first();

        if (!$marketData) {
            $coinPairData          = new MarketData();
            $coinPairData->pair_id = $coinPair->id;
            $coinPairData->symbol  = $coin->symbol;
            $coinPairData->save();
        }



        $notify[] = ['success', $message];
        return back()->withNotify($notify);
    }

    public function status($id)
    {
        return CoinPair::changeStatus($id);
    }
}

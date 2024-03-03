<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Market;
use App\Models\Wallet;
use App\Models\CoinPair;
use App\Constants\Status;
use App\Http\Controllers\Controller;
use App\Models\FavoritePair;
use App\Models\Trade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TradeController extends Controller
{
    public function trade($symbol = null)
    {
        $pageTitle = "Trade";
        $pair      = CoinPair::active()->activeMarket()->activeCoin()->with('market', 'coin', 'marketData');

        if ($symbol) {
            $pair = $pair->where('symbol', $symbol)->first();
        } else {
            $pair = $pair->where('is_default', Status::YES)->first();
        }
        if (!$pair) {
            $notify[] = ['error', 'No pair found'];
            return back()->withNotify($notify);
        }
        $markets              = Market::with('currency:id,name,symbol')->active()->get();
        $userId               = auth()->id() ?? 0;
        $coinWallet           = Wallet::where('user_id', $userId)->where('currency_id', $pair->coin->id)->first();
        $marketCurrencyWallet = Wallet::where('user_id', $userId)->where('currency_id', $pair->market->currency->id)->first();
        $orders               = Order::where('user_id', auth()->id())->take(30)->get();
        return view($this->activeTemplate . 'trade.index', compact('pageTitle', 'pair', 'markets', 'coinWallet', 'marketCurrencyWallet'));
    }

    public function history($symbol)
    {
        $pair = $this->findPair($symbol);

        if (!$pair) {
            return response()->json([
                'success' => false,
                'message' => "Coin Pair not found"
            ]);
        }
        $trades = Trade::where('pair_id', $pair->id)->orderBy('id', 'desc')->take(50)->get();
        return response()->json([
            'success' => true,
            'trades'  => $trades
        ]);
    }
    public function orderList(Request $request, $symbol)
    {
        $validator = Validator::make($request->all(), [
            'status' => 'nullable|in:all,open,canceled,completed'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->all()
            ]);
        }

        $query = Order::with('pair')->where('user_id', auth()->id());

        if ($request->status && $request->status != 'all') {
            $scope = $request->status;
            $query->$scope();
        }

        $orders = $query->orderBy('id', 'desc')->take(20)->get();

        return response()->json([
            'success' => true,
            'orders'  => $orders
        ]);
    }

    public function orderBook($symbol = null)
    {
        $pair = $this->findPair($symbol);
        if (!$pair) {
            return response()->json([
                'success' => false,
                'message' => "Coin Pair not found"
            ]);
        }

        $orderType = request()->order_type;
        $query     = Order::open()->where('pair_id', $pair->id)->orderBy('rate', 'desc');

        if ($orderType == 'all' || $orderType == 'sell') {
            $sellSideOrders = (clone $query)->selectRaw("*,SUM(amount) as total_amount")->groupBy('rate')->sellSideOrder()->take(15)->get();
        }
        if ($orderType == 'all' || $orderType == 'buy') {
            $buySideOrders = (clone $query)->selectRaw("*,SUM(amount) as total_amount")->groupBy('rate')->buySideOrder()->take(12)->get();
        }

        return response()->json([
            'success'          => true,
            'sell_side_orders' => @$sellSideOrders ?? [],
            'buy_side_orders'  => @$buySideOrders ?? [],
        ]);
    }

    private function findPair($symbol = null)
    {
        $pair      = CoinPair::active()->activeMarket()->activeCoin();
        if ($symbol) {
            $pair = $pair->where('symbol', $symbol)->first();
        } else {
            $pair = $pair->where('is_default', Status::YES)->first();
        }
        return  $pair;
    }

    public function pairs()
    {

        $query = CoinPair::activeMarket()->activeCoin()->with('coin:name,id,symbol', 'market:id,name,currency_id', 'market.currency:id,symbol', 'marketData:id,pair_id,price,html_classes,percent_change_1h');

        if (request()->marketId) {
            $query->where('market_id', request()->marketId);
        }

        if (request()->search) {
            $query->where('symbol', 'Like', "%" . request()->search . "%");
        }

        $pairs          = $query->orderBy('id', 'desc')->take(50)->get();
        $favoritePairId = FavoritePair::where('user_id', auth()->id() ?? 0)->pluck('pair_id')->toArray();

        return response()->json([
            'success'        => true,
            'pairs'          => $pairs,
            'favoritePairId' => $favoritePairId
        ]);
    }
}

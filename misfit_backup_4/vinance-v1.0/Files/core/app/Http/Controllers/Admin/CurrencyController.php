<?php

namespace App\Http\Controllers\Admin;

use App\Constants\Status;
use App\Models\Currency;
use Illuminate\Http\Request;
use App\Rules\FileTypeValidate;
use App\Http\Controllers\Controller;
use App\Models\MarketData;

class CurrencyController extends Controller
{
    public function crypto()
    {
        $pageTitle  = "Crypto Currency List";
        $currencies = $this->currencyData('crypto');
        $type       = Status::CRYPTO_CURRENCY;
        return view('admin.currency.list', compact('pageTitle', 'currencies', 'type'));
    }

    public function fiat()
    {
        $pageTitle  = "Fiat Currency List";
        $currencies = $this->currencyData('fiat');
        $type       = Status::FIAT_CURRENCY;
        return view('admin.currency.list', compact('pageTitle', 'currencies', 'type'));
    }

    private function currencyData($scope = null)
    {
        $query = Currency::query();

        if ($scope) $query->$scope();
        if ($scope && $scope == 'crypto') $query->orderByRank();

        return $query->with('marketData')->searchable(['name', 'symbol', 'rank'])->paginate(getPaginate());
    }

    public function save(Request $request, $id = 0)
    {

        $imageValidation = $id ? 'nullable' : 'required';

        $request->validate([
            'name'   => "required|max:255|unique:currencies,name,$id",
            'symbol' => "required|max:40|unique:currencies,symbol,$id",
            'image'  => ["$imageValidation", 'image', new FileTypeValidate(['jpg', 'jpeg', 'png'])],
            'type'   => 'required|in:' . Status::FIAT_CURRENCY . ',' . Status::CRYPTO_CURRENCY . '',
            'price'  => 'nullable|numeric|gte:0',
        ]);

        if ($request->rank && Currency::where('rank', $request->rank)->where('id', '!=', $id)->exists()) {
            $notify[] = ['error', "Can't be one more currency with the same rank."];
            return back()->withNotify($notify)->withInput();
        }

        if ($id) {
            $currency = Currency::findOrFail($id);
            $message  = "Currency updated successfully";
        } else {
            $currency = new Currency();
            $message  = "Currency added successfully";
        }

        $currency->type             = $request->type;
        $currency->name             = $request->name;
        $currency->symbol           = strtoupper($request->symbol);
        $currency->rate             = $request->price;
        $currency->highlighted_coin = $request->is_highlighted_coin ? Status::YES : Status::NO;

        if ($request->hasFile('image')) {
            $path = getFilePath('currency');
            $size = getFileSize('currency');
            try {
                $filename      = fileUploader($request->image, $path, $size, @$currency->image);
                $currency->image = $filename;
            } catch (\Exception $exp) {
                $notify[] = ['error', 'Couldn\'t upload your image'];
                return back()->withNotify($notify);
            }
        }

        $currency->save();

        if ($currency->type == Status::CRYPTO_CURRENCY) {
            $marketData = MarketData::where('pair_id', 0)->where('currency_id', $currency->id)->first();
            if (!$marketData) {
                $marketData              = new MarketData();
                $marketData->currency_id = $currency->id;
                $marketData->symbol      = $currency->symbol;
            }
            $marketData->price = $request->price;
            $marketData->save();
        }

        $notify[] = ['success', $message];
        return back()->withNotify($notify);
    }

    public function status($id)
    {
        return Currency::changeStatus($id);
    }

    public function all()
    {
        $query = Currency::active();

        if (request()->type == Status::CRYPTO_CURRENCY) $query->where('type', Status::CRYPTO_CURRENCY)->orderByRank();
        if (request()->type == Status::FIAT_CURRENCY) $query->where('type', Status::FIAT_CURRENCY)->orderBy('id', 'desc');
        if (request()->search) $query->where(function ($q) {
            $q->where('name', 'like', '%' . request()->search . '%')->orWhere('symbol', 'like', '%' . request()->search . '%');
        });

        $currencies = $query->paginate(getPaginate());

        return response()->json([
            'success'    => true,
            'currencies' => $currencies,
            'more'       => $currencies->hasMorePages()
        ]);
    }
}

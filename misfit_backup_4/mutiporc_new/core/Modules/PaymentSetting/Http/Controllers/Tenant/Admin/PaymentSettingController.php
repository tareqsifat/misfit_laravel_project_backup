<?php
namespace Modules\PaymentSetting\Http\Controllers\Tenant\Admin;

use App\Helpers\FlashMsg;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
// use Modules\CountryManage\Entities\Country;
// use Modules\CountryManage\Http\Requests\StoreCountryManageRequest;
// use Modules\CountryManage\Http\Requests\UpdateCountryManageRequest;

class PaymentSettingController extends Controller
{
    private const BASE_PATH = 'generalsetting::tenant.admin.';

    public function __construct()
    {
        $this->middleware('permission:pageSetting',['only' => 'index']);
        // $this->middleware('auth:admin')->except(['getCountryInfo', 'getStateInfo']);
        // $this->middleware('permission:country-list|country-create|country-edit|country-delete', ['only', ['index']]);
        // $this->middleware('permission:country-create', ['only', ['store']]);
        // $this->middleware('permission:country-edit', ['only', ['update']]);
        // $this->middleware('permission:country-delete', ['only', ['destroy', 'bulk_action']]);
    }


    public function authorizeNet()
    {
        return view('PaymentSetting.authorizeNet');
    }
    public function bankTransfer()
    {
        return view('PaymentSetting.bankTransfer');
    }
    public function billPlz()
    {
        return view('PaymentSetting.billPlz');
    }
    public function cashFree()
    {
        return view('PaymentSetting.cashFree');
    }
    public function cinetPay()
    {
        return view('PaymentSetting.cinetPay');
    }
    public function flutterWave()
    {
        return view('PaymentSetting.flutterWave');
    }
    public function instaMojo()
    {
        return view('PaymentSetting.instaMojo');
    }
    public function kinetic()
    {
        return view('PaymentSetting.kinetic');
    }
    public function manualPayment()
    {
        return view('PaymentSetting.manualPayment');
    }
    public function marCadoPago()
    {
        return view('PaymentSetting.manualPamarCadoPagoyment');
    }
    public function midTrans()
    {
        return view('PaymentSetting.midTrans');
    }
    public function mollie()
    {
        return view('PaymentSetting.mollie');
    }
    public function pagali()
    {
        return view('PaymentSetting.pagali');
    }
    public function payFast()
    {
        return view('PaymentSetting.payFast');
    }
    public function paypal()
    {
        return view('PaymentSetting.paypal');
    }
    public function payStack()
    {
        return view('PaymentSetting.payStack');
    }
    public function payTabs()
    {
        return view('PaymentSetting.payTabs');
    }
    public function paytm()
    {
        return view('PaymentSetting.paytm');
    }
    public function razorPay()
    {
        return view('PaymentSetting.razorPay');
    }
    public function sitesWay()
    {
        return view('PaymentSetting.sitesWay');
    }
    public function squareUp()
    {
        return view('PaymentSetting.squareUp');
    }
    public function stripe()
    {
        return view('PaymentSetting.stripe');
    }
    public function toyyibPay()
    {
        return view('PaymentSetting.toyyibPay');
    }
    public function zitoPay()
    {
        return view('PaymentSetting.zitoPay');
    }
    public function paymentSetting()
    {
        return view('PaymentSetting.paymentSetting');
    }
 
}

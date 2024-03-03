<?php
namespace Modules\GeneralSetting\Http\Controllers\Tenant\Admin;

use App\Helpers\FlashMsg;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
// use Modules\CountryManage\Entities\Country;
// use Modules\CountryManage\Http\Requests\StoreCountryManageRequest;
// use Modules\CountryManage\Http\Requests\UpdateCountryManageRequest;

class GeneralSettingController extends Controller
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


    public function index()
    {
        return view('generalSetting.pageSetting');
    }
    public function besicSetting()
    {
        return view('generalSetting.basicSetting');
    }
    public function colorSetting()
    {
        return view('generalSetting.colorSetting');
    }
    public function typography()
    {
        return view('generalSetting.typographySetting');
    }
    public function seoSetting()
    {
        return view('generalSetting.seoSetting');
    }
    public function siteIdentity()
    {
        return view('generalSetting.siteIdentity');
    }
    public function emailSetting()
    {
        return view('generalSetting.emailSetting');
    }
    public function thirdParty()
    {
        return view('generalSetting.thirdParty');
    }
    public function css()
    {
        return view('generalSetting.css');
    }
    public function js()
    {
        return view('generalSetting.js');
    }
}

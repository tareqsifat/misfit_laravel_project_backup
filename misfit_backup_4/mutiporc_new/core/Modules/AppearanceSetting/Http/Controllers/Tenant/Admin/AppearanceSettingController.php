<?php
namespace Modules\AppearanceSetting\Http\Controllers\Tenant\Admin;

use App\Helpers\FlashMsg;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\Menu;
// use Modules\CountryManage\Entities\Country;
// use Modules\CountryManage\Http\Requests\StoreCountryManageRequest;
// use Modules\CountryManage\Http\Requests\UpdateCountryManageRequest;

class AppearanceSettingController extends Controller
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


    public function setting()
    {
        return view('appearanceSetting.404setting');
    }
    public function maintainanceSetting()
    {
        return view('appearanceSetting.maintainanceSetting');
    }
    public function menuManage()
    {
        $all_menu = Menu::all();
        return view('appearanceSetting.menuManage', compact('all_menu'));
    }
    public function otherSetting()
    {
        return view('appearanceSetting.otherSetting');
    }
    public function topBarSetting()
    {
        return view('appearanceSetting.topBarSetting');
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

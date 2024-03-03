<?php
namespace Modules\Integration\Http\Controllers\Tenant\Admin;

use App\Helpers\FlashMsg;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
// use Modules\CountryManage\Entities\Country;
// use Modules\CountryManage\Http\Requests\StoreCountryManageRequest;
// use Modules\CountryManage\Http\Requests\UpdateCountryManageRequest;

class IntegrationController extends Controller
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


    public function product()
    {
        return view('integration.product_index');
    }
   
   
}

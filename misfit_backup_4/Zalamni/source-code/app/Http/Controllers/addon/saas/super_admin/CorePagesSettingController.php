<?php

namespace App\Http\Controllers\addon\saas\super_admin;


use Exception;
use Illuminate\Http\Request;
use App\Traits\ResponseTrait;
use App\Http\Controllers\Controller;
use App\Http\Requests\CorePagesSettingRequest;
use App\Http\Services\addon\saas\CorePagesSettingService;
use App\Models\CorePagesSetting;

class CorePagesSettingController extends Controller
{
    use ResponseTrait;
    protected $corePagesSetting;

    public function __construct()
    {
        $this->corePagesSetting = new CorePagesSettingService();
    }

    public function index(Request $request){
        $data['pageTitle'] = __('Core Pages Section');
        $data['showFrontendSectionList'] = 'show active';
        $data['activeFrontendList'] = 'active';
        $data['bestFeaturesActiveClass'] = 'active-color-one';
        if($request->ajax()){
            return $this->corePagesSetting->list();
        }
        return view('addon.saas.super_admin.frontend-setting.core-page.index', $data);
    }

    public function store(CorePagesSettingRequest $request){
        return $this->corePagesSetting->bestFeaturesStore($request);
    }

    public function delete($id){
        return $this->corePagesSetting->featuresDelete($id);
    }

    public function edit($id)
    {
        $data['pageTitle'] = __('Core Pages Section');
        try {
            $data['features'] = CorePagesSetting::find($id);
            if (is_null($data['features'])) {
                return $this->error([], getMessage(SOMETHING_WENT_WRONG));
            }
        } catch (Exception $exception) {
            return $this->error([], getMessage(SOMETHING_WENT_WRONG));
        }
        return view('addon.saas.super_admin.frontend-setting.core-page.edit-form', $data);;
    }


}

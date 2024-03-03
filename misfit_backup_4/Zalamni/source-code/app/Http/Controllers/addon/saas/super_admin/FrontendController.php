<?php

namespace App\Http\Controllers\addon\saas\super_admin;

use App\Http\Services\addon\saas\FrontendService;
use App\Models\FrontendSection;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use App\Traits\ResponseTrait;


class FrontendController extends BaseController
{
    use ResponseTrait;

    protected $frontendService;

    public function __construct()
    {
        $this->frontendService = new FrontendService();
    }

    public function sectionSettingIndex(Request $request)
    {
        if ($request->ajax()) {
            return $this->frontendService->list();
        }

        $data['pageTitle'] = __('Frontend Section');
        $data['showFrontendSectionList'] = 'show active';
        $data['activeFrontendList'] = 'active';
        $data['subSectionSettingsActiveClass'] = 'active-color-one';
        return view('addon.saas.super_admin.frontend-setting.section-settings.index', $data);
    }

    public function frontendSectionInfo(Request $request)
    {
        $data['section'] = FrontendSection::findOrFail($request->id);
        return view('addon.saas.super_admin.frontend-setting.section-settings.edit-form', $data);
    }

    public function frontendSectionUpdate(Request $request)
    {
        return $this->frontendService->update($request);
    }

    public function frontendSectionIndex()
    {
        $data['pageTitle'] = __('Frontend Setting');
        $data['showFrontendSectionList'] = 'show active';
        $data['activeFrontendList'] = 'active';
        $data['sectionSettingsActiveClass'] = 'active-color-one';
        return view('addon.saas.super_admin.frontend-setting.frontend-settings', $data);

    }
}

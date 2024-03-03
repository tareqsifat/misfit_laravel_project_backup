<?php

namespace App\Http\Controllers\addon\saas\super_admin;

use App\Http\Controllers\Controller;
use App\Http\Services\SettingsService;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;

class EmailTemplateController extends Controller
{
    use ResponseTrait;
    public $settingsService;

    public function __construct()
    {
        $this->settingsService = new SettingsService();
    }

    public function emailTemplate(Request $request)
    {
        $data['title'] = __('Email Template');
        $data['showManageApplicationSetting'] = 'show';
        $data['activeEmailSetting'] = 'active';
        return view('super_admin.setting.email_temp.email-temp', $data);
    }

    public function emailTemplateConfig(Request $request)
    {
        return $this->settingsService->emailTemplateConfig($request);
    }

    public function emailTemplateConfigUpdate(Request $request)
    {
        return $this->settingsService->emailTemplateConfigUpdate($request);
    }
}

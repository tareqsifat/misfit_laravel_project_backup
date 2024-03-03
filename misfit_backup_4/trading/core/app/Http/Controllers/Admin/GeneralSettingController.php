<?php

namespace App\Http\Controllers\Admin;

use Image;
use App\Models\Frontend;
use App\Constants\Status;
use Illuminate\Http\Request;
use App\Models\GeneralSetting;
use App\Models\AiTrading;
use App\Rules\FileTypeValidate;
use App\Http\Controllers\Controller;

class GeneralSettingController extends Controller
{
    public function index()
    {
        $pageTitle = 'General Setting';
        $timezones = json_decode(file_get_contents(resource_path('views/admin/partials/timezone.json')));
        $ai_status = AiTrading::select('ai_robot')->first();
        return view('admin.setting.general', compact('pageTitle', 'ai_status' , 'timezones'));
    }
    
    public function ai_trading() {
        $pageTitle = 'Ai trading';
        $ai_status = AiTrading::select('ai_robot')->first();
        return view('admin.setting.ai_trading', compact('pageTitle', 'ai_status'));
    }

    public function trading_settings() {
        $pageTitle = 'Trading Settings';
        $trading_settings = AiTrading::select('*')->first();
        return view('admin.setting.trading_setting', compact('pageTitle', 'trading_settings'));
    }

    public function pusherConfiguration()
    {
        $pageTitle = 'Pusher Configuration';
        return view('admin.setting.pusher_configuration', compact('pageTitle'));
    }
    public function chartSetting()
    {
        $pageTitle = 'Chart Configuration';
        return view('admin.setting.chart_setting', compact('pageTitle'));
    }
    
    public function update_ai_status(Request $request) {
        $isChecked = $request->input('isChecked');
    
        if($request->has('ai_status') && $request->ai_status == 'on') {
            $status = 'active';
        }else {
            $status = 'inactive';
        }
        
        $ai_robot = AiTrading::where('id', 1)->first();
        
        $ai_robot->ai_robot = $status;
        
        
        $ai_robot->update();
        

    
        $notify[] = ['success', 'Ai robot setting updated successfully'];
        return back()->withNotify($notify);
        
    }

    public function update_trading_settings(Request $request) {
    
        if($request->has('trading_status') && $request->trading_status == 'on') {
            $status = 'active';
        }else {
            $status = 'inactive';
        }
        
        $trading_setting = AiTrading::where('id', 1)->first();
        
        $trading_setting->trading = $status;
    
        $trading_setting->update();
        

    
        $notify[] = ['success', 'Trading setting updated successfully'];
        return back()->withNotify($notify);
        
    }

    public function update(Request $request)
    {
        $request->validate([
            'site_name'                  => 'required|string|max:40',
            'cur_text'                   => 'required|string|max:40',
            'cur_sym'                    => 'required|string|max:40',
            'base_color'                 => ['nullable', 'regex:/^[a-f0-9]{6}$/i'],
            'timezone'                   => 'required',
            'allow_decimal_after_number' => 'required|integer|gte:1',
        ]);

        $general                             = gs();
        $general->site_name                  = $request->site_name;
        $general->cur_text                   = $request->cur_text;
        $general->cur_sym                    = $request->cur_sym;
        $general->cur_sym                    = $request->cur_sym;
        $general->allow_decimal_after_number = $request->allow_decimal_after_number;
        $general->base_color                 = str_replace('#', '', $request->base_color);
        $general->save();

        $timezoneFile = config_path('timezone.php');
        $content      = '<?php $timezone = ' . $request->timezone . ' ?>';
        file_put_contents($timezoneFile, $content);

        $notify[] = ['success', 'General setting updated successfully'];
        return back()->withNotify($notify);
    }

    public function chartSettingUpdate(Request $request)
    {
        $request->validate([
            'trading_view_widget' => 'required',
        ]);

        $general                      = gs();
        $general->trading_view_widget = $request->trading_view_widget;
        $general->save();

        $notify[] = ['success', 'Chart setting updated successfully'];
        return back()->withNotify($notify);
    }

    public function pusherConfigurationUpdate(Request $request)
    {
        $request->validate([
            'pusher_app_id'      => 'required|string',
            'pusher_app_key'     => 'required|string',
            'pusher_app_secret'  => 'required|string',
            'pusher_app_cluster' => 'required|string'
        ]);

        $pusherConfigFile = config_path('pusher.php');

        $pusherConfig = '<?php' . PHP_EOL .
            '$pusherAppId       = ' . '"' . $request->pusher_app_id . '"' . ";" . PHP_EOL .
            '$pusherAppKey      =' . '"' . $request->pusher_app_key . '"' . ";" . PHP_EOL .
            '$pusherAppSecret   =' . '"' . $request->pusher_app_secret . '"' . ';' . PHP_EOL .
            '$pusherAppCluster  =' . '"' . $request->pusher_app_cluster . '"' . ';' . PHP_EOL .
            "?>";

        file_put_contents($pusherConfigFile,  $pusherConfig);

        $notify[] = ['success', 'Pusher configuration updated successfully'];
        return back()->withNotify($notify);
    }

    public function socialiteCredentials()
    {
        $pageTitle = 'Social Login Credentials';
        return view('admin.setting.social_credential', compact('pageTitle'));
    }

    public function updateSocialiteCredentialStatus($key)
    {
        $general = gs();
        $credentials = $general->socialite_credentials;
        try {
            $credentials->$key->status = $credentials->$key->status == Status::ENABLE ? Status::DISABLE : Status::ENABLE;
        } catch (\Throwable $th) {
            abort(404);
        }

        $general->socialite_credentials = $credentials;
        $general->save();

        $notify[] = ['success', 'Status changed successfully'];
        return back()->withNotify($notify);
    }

    public function updateSocialiteCredential(Request $request, $key)
    {
        $general = gs();
        $credentials = $general->socialite_credentials;
        try {
            @$credentials->$key->client_id = $request->client_id;
            @$credentials->$key->client_secret = $request->client_secret;
        } catch (\Throwable $th) {
            abort(404);
        }
        $general->socialite_credentials = $credentials;
        $general->save();

        $notify[] = ['success', ucfirst($key) . ' credential updated successfully'];
        return back()->withNotify($notify);
    }

    public function systemConfiguration()
    {
        $pageTitle = 'System Configuration';
        return view('admin.setting.configuration', compact('pageTitle'));
    }


    public function systemConfigurationSubmit(Request $request)
    {
        $general                     = gs();
        $general->kv                 = $request->kv ? Status::ENABLE : Status::DISABLE;
        $general->ev                 = $request->ev ? Status::ENABLE : Status::DISABLE;
        $general->en                 = $request->en ? Status::ENABLE : Status::DISABLE;
        $general->sv                 = $request->sv ? Status::ENABLE : Status::DISABLE;
        $general->sn                 = $request->sn ? Status::ENABLE : Status::DISABLE;
        $general->force_ssl          = $request->force_ssl ? Status::ENABLE : Status::DISABLE;
        $general->secure_password    = $request->secure_password ? Status::ENABLE : Status::DISABLE;
        $general->registration       = $request->registration ? Status::ENABLE : Status::DISABLE;
        $general->agree              = $request->agree ? Status::ENABLE : Status::DISABLE;
        $general->multi_language     = $request->multi_language ? Status::ENABLE : Status::DISABLE;
        $general->save();

        $notify[] = ['success', 'System configuration updated successfully'];
        return back()->withNotify($notify);
    }


    public function logoIcon()
    {
        $pageTitle = 'Logo & Favicon';
        return view('admin.setting.logo_icon', compact('pageTitle'));
    }

    public function logoIconUpdate(Request $request)
    {
        $request->validate([
            'logo'    => ['image', new FileTypeValidate(['jpg', 'jpeg', 'png'])],
            'logo_base'    => ['image', new FileTypeValidate(['jpg', 'jpeg', 'png'])],
            'favicon' => ['image', new FileTypeValidate(['png'])],
        ]);
        if ($request->hasFile('logo')) {
            try {
                $path = getFilePath('logoIcon');
                if (!file_exists($path)) {
                    mkdir($path, 0755, true);
                }
                Image::make($request->logo)->save($path . '/logo.png');
            } catch (\Exception $exp) {
                $notify[] = ['error', 'Couldn\'t upload the logo'];
                return back()->withNotify($notify);
            }
        }
        if ($request->hasFile('logo_base')) {
            try {
                $path = getFilePath('logoIcon');
                if (!file_exists($path)) {
                    mkdir($path, 0755, true);
                }
                Image::make($request->logo_base)->save($path . '/logo_base.png');
            } catch (\Exception $exp) {
                $notify[] = ['error', 'Couldn\'t upload the base logo'];
                return back()->withNotify($notify);
            }
        }

        if ($request->hasFile('favicon')) {
            try {
                $path = getFilePath('logoIcon');
                if (!file_exists($path)) {
                    mkdir($path, 0755, true);
                }
                $size = explode('x', getFileSize('favicon'));
                Image::make($request->favicon)->resize($size[0], $size[1])->save($path . '/favicon.png');
            } catch (\Exception $exp) {
                $notify[] = ['error', 'Couldn\'t upload the favicon'];
                return back()->withNotify($notify);
            }
        }
        $notify[] = ['success', 'Logo & favicon updated successfully'];
        return back()->withNotify($notify);
    }

    public function customCss()
    {
        $pageTitle   = 'Custom CSS';
        $file        = activeTemplate(true) . 'css/custom.css';
        $fileContent = @file_get_contents($file);
        return view('admin.setting.custom_css', compact('pageTitle', 'fileContent'));
    }


    public function customCssSubmit(Request $request)
    {
        $file = activeTemplate(true) . 'css/custom.css';
        if (!file_exists($file)) {
            fopen($file, "w");
        }
        file_put_contents($file, $request->css);
        $notify[] = ['success', 'CSS updated successfully'];
        return back()->withNotify($notify);
    }

    public function maintenanceMode()
    {
        $pageTitle   = 'Maintenance Mode';
        $maintenance = Frontend::where('data_keys', 'maintenance.data')->firstOrFail();
        return view('admin.setting.maintenance', compact('pageTitle', 'maintenance'));
    }

    public function maintenanceModeSubmit(Request $request)
    {
        $request->validate([
            'description' => 'required',
            'heading'     => 'required',
            'image'       => ['nullable', new FileTypeValidate(['jpg', 'jpeg', 'png'])],
        ]);

        $general                   = gs();
        $general->maintenance_mode = $request->status ? Status::ENABLE : Status::DISABLE;
        $general->save();

        $maintenance = Frontend::where('data_keys', 'maintenance.data')->firstOrFail();

        if ($request->hasFile('image')) {
            try {
                $path      = getFilePath('maintenance');
                $size      = getFileSize('maintenance');
                $imageName = fileUploader($request->image, $path, $size, @$maintenance->data_values->image);
            } catch (\Exception $exp) {
                $notify[] = ['error', 'Couldn\'t upload your image'];
                return back()->withNotify($notify);
            }
        }

        $dataValues  = [
            'description' => $request->description,
            'image'       => @$imageName ?? @$maintenance->data_values->image,
            'heading'     => $request->heading,
        ];
        $maintenance->data_values = $dataValues;
        $maintenance->save();

        $notify[] = ['success', 'Maintenance mode updated successfully'];
        return back()->withNotify($notify);
    }

    public function cookie()
    {
        $pageTitle = 'GDPR Cookie';
        $cookie    = Frontend::where('data_keys', 'cookie.data')->firstOrFail();
        return view('admin.setting.cookie', compact('pageTitle', 'cookie'));
    }

    public function cookieSubmit(Request $request)
    {
        $request->validate([
            'short_desc'  => 'required|string|max:255',
            'description' => 'required',
        ]);
        $cookie              = Frontend::where('data_keys', 'cookie.data')->firstOrFail();
        $cookie->data_values = [
            'short_desc'  => $request->short_desc,
            'description' => $request->description,
            'status'      => $request->status ? Status::ENABLE : Status::DISABLE,
        ];
        $cookie->save();
        $notify[] = ['success', 'Cookie policy updated successfully'];
        return back()->withNotify($notify);
    }
}

<?php

namespace App\Http\Middleware\Tenant;

use App\Models\StaticOption;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class TenantConfigureMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (tenant()){
            //todo if it is tenant configure smtp from here

            $smtp_settings_values = StaticOption::select(['option_name','option_value'])->whereIn('option_name',[
                'site_smtp_driver',
                'site_smtp_host',
                'site_smtp_port',
                'site_smtp_username',
                'site_smtp_password',
                'site_smtp_encryption',
            ])->get()->pluck('option_value','option_name')->toArray();
            Config::set('mail.mailers',$smtp_settings_values['site_smtp_driver'] ?? "");
            Config::set([
                'mail.mailers.smtp.transport' => $smtp_settings_values['site_smtp_driver'] ?? '',
                'mail.mailers.smtp.host' => $smtp_settings_values['site_smtp_host'] ?? '',
                'mail.mailers.smtp.port' => $smtp_settings_values['site_smtp_port'] ?? '',
                'mail.mailers.smtp.username' => $smtp_settings_values['site_smtp_username'] ?? '',
                'mail.mailers.smtp.password' => $smtp_settings_values['site_smtp_password'] ?? '',
                'mail.mailers.smtp.encryption' => $smtp_settings_values['site_smtp_encryption'] ?? ''
            ]);

            Config::set('app.timezone',get_static_option('timezone'));
        }
        return $next($request);
    }
}

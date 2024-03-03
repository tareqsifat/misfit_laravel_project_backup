<?php

namespace App\Http\Controllers;

use App\Lib\CurlRequest;
use App\Lib\TradeManager;
use App\Models\CronJob;
use App\Models\CronJobLog;
use Carbon\Carbon;
use Exception;

class CronController extends Controller
{
    public function cron()
    {
        $general            = gs();
        $general->last_cron = now();
        $general->save();

        $crons = CronJob::with('schedule');

        if (request()->alias) {
            $crons->where('alias', request()->alias);
        } else {
            $crons->where('next_run', '<', now())->where('is_running', 1);
        }
        $crons = $crons->get();
        foreach ($crons as $cron) {
            $cronLog              = new CronJobLog();
            $cronLog->cron_job_id = $cron->id;
            $cronLog->start_at    = now();
            if ($cron->is_default) {
                $controller = new $cron->action[0];
                try {
                    $method = $cron->action[1];
                    $controller->$method();
                } catch (\Exception $e) {
                    $cronLog->error = $e->getMessage();
                }
            } else {
                try {
                    CurlRequest::curlContent($cron->url);
                } catch (\Exception $e) {
                    $cronLog->error = $e->getMessage();
                }
            }
            $cron->last_run = now();
            $cron->next_run = now()->addSeconds($cron->schedule->interval);
            $cron->save();

            $cronLog->end_at = $cron->last_run;

            $startTime         = Carbon::parse($cronLog->start_at);
            $endTime           = Carbon::parse($cronLog->end_at);
            $diffInSeconds     = $startTime->diffInSeconds($endTime);
            $cronLog->duration = $diffInSeconds;
            $cronLog->save();
        }
        if (request()->alias) {
            $notify[] = ['success', keyToTitle(request()->alias) . ' executed successfully'];
            return back()->withNotify($notify);
        }
    }

    public function crypto()
    {
        try {
            $defaultProvider      = defaultCurrencyDataProvider();
            $defaultProviderAlias = "App\\Lib\\CurrencyDataProvider\\" . defaultCurrencyDataProvider()->alias;

            $provider           = new $defaultProviderAlias;
            $provider->provider = $defaultProvider;
            return $provider->updateCryptoPrice();
        } catch (Exception $ex) {
            throw new \Exception($ex->getMessage());
        }
    }

    public function market()
    {
        try {
            $defaultProvider      = defaultCurrencyDataProvider();
            $defaultProviderAlias = "App\\Lib\\CurrencyDataProvider\\" . defaultCurrencyDataProvider()->alias;

            $provider           = new $defaultProviderAlias;
            $provider->provider = $defaultProvider;
            return $provider->updateMarkets();
        } catch (Exception $ex) {
            throw new \Exception($ex->getMessage());
        }
    }

    public function trade()
    {
        try {
            $trade = new TradeManager();
            return $trade->trade();
        } catch (Exception $ex) {
            throw new \Exception($ex->getMessage());
        }
    }
}

<?php

namespace App\Http\Controllers\addon\saas\super_admin;

use App\Http\Controllers\Controller;
use App\Http\Services\addon\saas\UserSubscriptionOrderService;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    use ResponseTrait;
    public $subscriptionOrderService;

    public function __construct()
    {
        $this->subscriptionOrderService = new UserSubscriptionOrderService;
    }

    public function orders()
    {
        $data['title'] = __('All User Orders');
        $data['activeSubscriptionIndex'] = 'active';
        return view('addon.saas.super_admin.subscriptions.orders', $data);
    }

    public function ordersStatus(Request $request)
    {
        if ($request->ajax()) {
            return $this->subscriptionOrderService->getByStatus($request);
        }
    }

    public function orderGetInfo(Request $request)
    {
        $data = $this->subscriptionOrderService->orderGetInfo($request->id);
        return $this->success($data);
    }

    public function orderPaymentStatusChange(Request $request)
    {
        return $this->subscriptionOrderService->orderPaymentStatusChange($request);
    }
}

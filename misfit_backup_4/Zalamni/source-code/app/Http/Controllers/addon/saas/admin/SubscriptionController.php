<?php

namespace App\Http\Controllers\addon\saas\admin;

use App\Http\Controllers\Controller;
use App\Http\Services\addon\saas\SubscriptionService;
use App\Http\Services\TransactionService;
use App\Models\Alumni;
use App\Models\Event;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;
use Stancl\Tenancy\Database\Models\Domain;

class SubscriptionController extends Controller
{
    use ResponseTrait;
    public $subscriptionService;

    public function __construct()
    {
        $this->subscriptionService = new SubscriptionService;
    }

    public function index(Request $request)
    {
        $data['activeSubscription'] = 'active';
        $data['title'] = __('My Package');
        $data['userPlan'] = $this->subscriptionService->getCurrentPlan();
        $data['packageHistories'] = $this->subscriptionService->getAllUserPackageByUserId(auth()->id(), 10);
        $data['orderHistories'] = $this->subscriptionService->getAllOrderByUserId(auth()->id(), 10);
        $data['alumniUsed'] = Alumni::where('tenant_id', getTenantId())->count();
        $data['eventUsed'] = Event::where('tenant_id', getTenantId())->count();
        if (!is_null($request->id)) {
            $request->merge(['duration_type' => 1]);
            $data['gateways'] = $this->getGateway($request);
        }
        return view('addon.saas.admin.subscription.details', $data);
    }

    public function getPackage()
    {
        $data['packages'] = $this->subscriptionService->getAllPackages();
        $data['currentPackage'] = $this->subscriptionService->getCurrentPlan();
        return view('addon.saas.admin.subscription.partials.package-list', $data)->render();
    }

    public function cancel()
    {
        $this->subscriptionService->cancel();
        return back()->with('success', __('Canceled Successful!'));
    }

    public function transactionList(Request $request)
    {
        if($request->wantsJson()){
            $transactionService = new TransactionService();
            return $transactionService->userTransactionList(NULL);
        }

        $data['showTransactionNotice'] = 'show';
        $data['activeAdminTransaction'] = 'active';
        $data['title'] = __('My Transaction');
        return view('addon.saas.admin.subscription.transaction', $data);
    }
}

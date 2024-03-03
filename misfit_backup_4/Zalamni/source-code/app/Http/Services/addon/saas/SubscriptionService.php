<?php

namespace App\Http\Services\addon\saas;

use App\Models\User;
use App\Models\Package;
use App\Models\Transaction;
use App\Models\UserPackage;

class SubscriptionService
{
    public function getCurrentPlan($userId = null)
    {
        $userId = $userId == null ? auth()->id() : $userId;
        $ownerPackage = UserPackage::query()
            ->where('user_packages.tenant_id', getTenantId())
            ->where('user_packages.user_id', $userId)
            ->where('user_packages.status', ACTIVE)
            ->whereDate('user_packages.end_date', '>=', now())
            ->select('user_packages.*')
            ->first();

        return $ownerPackage?->makeHidden(['created_at', 'updated_at', 'deleted_at', 'is_trail', 'order_id', 'package_id', 'user_id']);
    }

    public function getAllPackages()
    {
        return Package::where('status', ACTIVE)->where('is_trail', '!=', ACTIVE)->get();
    }

    public function getAllUserPackageByUserId($userId = null, $limit = null)
    {
        $userId = !is_null($userId) ? $userId : auth()->id();
        $orders = UserPackage::query()
            ->join('packages', 'user_packages.package_id', '=', 'packages.id')
            ->LeftJoin('payments', 'payments.id', '=', 'user_packages.payment_id')
            ->where('user_packages.user_id', $userId)
            ->select([
                'user_packages.*',
                'packages.name as packageName',
                'payments.sub_total as total'
            ])
            ->orderByDesc('id')
            ->when($limit, function ($q) use ($limit) {
                $q->limit($limit);
            })
            ->get();
        return $orders;
    }

    public function getAllOrderByUserId($userId = null, $limit = null)
    {
        $userId = !is_null($userId) ? $userId : auth()->id();
        return Transaction::where('user_id', $userId)->orderBy('id','DESC')->limit($limit)->get();
    }

    public function getById($id)
    {
        $package = Package::query()->findOrFail($id);
        return $package?->makeHidden(['created_at', 'deleted_at', 'updated_at']);
    }

    public function getCurrencyByGatewayId($id)
    {
        $userId = User::where('role', USER_ROLE_ADMIN)->first()->id;
        $currencies = GatewayCurrency::where(['gateway_id' => $id])->get();
        foreach ($currencies as $currency) {
            $currency->symbol =  $currency->symbol;
        }
        return $currencies?->makeHidden(['created_at', 'updated_at', 'deleted_at', 'gateway_id', 'owner_user_id']);
    }

    public function cancel()
    {
        return UserPackage::query()
            ->where(['user_id' => auth()->id(), 'status' => ACTIVE])
            ->whereDate('end_date', '>=', now()->toDateTimeString())
            ->update(['status' => DEACTIVATE]);
    }
}

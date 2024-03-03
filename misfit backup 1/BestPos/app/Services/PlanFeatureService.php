<?php

namespace App\Services;

use App\Models\Admin\PlanFeature;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PlanFeatureService
{
    public function create(PlanFeature $plan_feature, array $data):array
    {
        try {
            $this->set_parameter($plan_feature, $data);
            $plan_feature->creator = Auth::guard('admin-api')->id();
            $plan_feature->save();

            return [
                'data' => $plan_feature,
                'status' => true
            ];
        }catch (\Exception $e){
            return [
                'message' => $e->getMessage(),
                'status' => false
            ];
        }
    }

    public function update(PlanFeature $plan_feature, array $data):array
    {
        try {
            $this->set_parameter($plan_feature, $data);
            $plan_feature->save();

            return [
                'data' => $plan_feature,
                'status' => true
            ];
        }catch (\Exception $e){
            return [
                'message' => $e->getMessage(),
                'status' => false
            ];
        }
    }

    private function set_parameter($plan_feature, $data)
    {
        $plan_feature->name = $data['name'];
        $plan_feature->key = Str::slug($data['name']);
        $plan_feature->slug = Str::slug($data['name']);
        $plan_feature->status = 1;
    }


}

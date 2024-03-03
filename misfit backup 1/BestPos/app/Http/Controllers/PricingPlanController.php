<?php

namespace App\Http\Controllers;

use App\Http\Requests\admin\PricingPlanRequest;
use App\Models\Admin\PlanFeature;
use App\Models\Admin\PricingPlan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PricingPlanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pricingPlans = PricingPlan::active()->with('planFeatures')->get();

        return response()->json(['data' => $pricingPlans]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PricingPlanRequest $request)
    {
        $data = $this->getCommonAttributes($request);
        $data['creator'] = Auth::guard('admin-api')->id();

        $pricingPlan = PricingPlan::create($data);

        return response()->json(['data' => $pricingPlan, 'message' => 'Pricing Plan created successfully.']);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $pricingPlan = $this->findPricingPlanById($id);

        return response()->json(['data' => $pricingPlan]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PricingPlanRequest $request, $id)
    {
        $data = $this->getCommonAttributes($request);

        $pricingPlan = $this->findPricingPlanById($id);
        $pricingPlan->update($data);

        return response()->json(['data' => $pricingPlan, 'message' => 'Pricing Plan updated successfully.']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $pricingPlan = $this->findPricingPlanById($id);
        $pricingPlan->delete();

        return response()->json(['message' => 'Pricing Plan deleted successfully.']);
    }

    public function addFeatureToPlan(Request $request, $id)
    {
        $request->validate([
            'feature_ids' => 'required|array'
        ]);

        $pricingPlan = $this->findPricingPlanById($id);
        $plan_features = $this->findPlanFeaturesByIds($request->feature_ids);

//        dd($request->feature_ids,$plan_features);

        $pricingPlan->planFeatures()->attach($plan_features);

        return response()->json([
            'data'=> $pricingPlan->load('planFeatures')
        ]);
    }

    private function getCommonAttributes(PricingPlanRequest $request)
    {
        return [
            'name' => $request->input('name'),
            'monthly_charge' => $request->input('monthly_charge'),
            'yearly_charge' => $request->input('yearly_charge'),
            'half_yearly_charge' => $request->input('half_yearly_charge'),
            'flat_charge' => $request->input('flat_charge'),
            'flat_time' => $request->input('flat_time'),
            'slug' => Str::slug($request->input('name')),
        ];
    }

    private function findPricingPlanById($id)
    {
        $pricingPlan = PricingPlan::active()->find($id);

        abort_if(!$pricingPlan, response()->json(['error' => 'Pricing Plan not found.'], 404));

        return $pricingPlan;
    }

    private function findPlanFeaturesByIds(array $planFeatureIds)
    {
        return PlanFeature::active()->whereIn('id', $planFeatureIds)->get();
    }
}

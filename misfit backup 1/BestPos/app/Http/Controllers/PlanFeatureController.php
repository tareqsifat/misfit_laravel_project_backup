<?php

namespace App\Http\Controllers;

use App\Http\Requests\admin\PlanFeatureRequest;
use App\Models\Admin\PlanFeature;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PlanFeatureController extends Controller
{
    public function index()
    {
        $planFeatures = PlanFeature::active()->get();

        return response()->json(['data' => $planFeatures]);
    }

    public function store(PlanFeatureRequest $request)
    {

        $data = $this->getCommonAttributes($request);
        $data['creator'] = Auth::guard('admin-api')->id();

        $planFeature = PlanFeature::create($data);

        return response()->json(['data' => $planFeature, 'message' => 'Plan Feature created successfully.']);
    }

    public function show($id)
    {
        $planFeature = $this->findPlanFeatureById($id);

        return response()->json(['data' => $planFeature]);
    }

    public function update(PlanFeatureRequest $request, $id)
    {

        $planFeature = $this->findPlanFeatureById($id);

        $data = $this->getCommonAttributes($request);

        $planFeature->update($data);

        return response()->json(['data' => $planFeature, 'message' => 'Plan Feature updated successfully.']);
    }

    public function destroy($id)
    {
        $planFeature = $this->findPlanFeatureById($id);

        $planFeature->delete();

        return response()->json(['message' => 'Plan Feature deleted successfully.']);
    }

    private function getCommonAttributes(Request $request): array
    {
        return [
            'name' => $request->input('name'),
            'key' => Str::slug($request->input('name')),
            'slug' => Str::slug($request->input('name')),
        ];
    }

    private function findPlanFeatureById($id)
    {
        $planFeature = PlanFeature::active()->find($id);

        abort_if(!$planFeature, response()->json(['error' => 'Plan Feature not found.'], 404));

        return $planFeature;
    }
}

<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->keyword;
        if($search != null){
            $companyId = Auth::guard('seller')->user()->company_id;
            $brands = Brand::where('company_id', $companyId)
                ->where('status', 1)
                ->where(function ($query) use ($search) {
                    $query->where("brand_name", "LIKE", "%{$search}%")
                        ->orWhere("brand_website", "LIKE", "%{$search}%")
                        ->orWhere("created_at", "LIKE", "%{$search}%");
                })
                ->orderBy('id', 'desc')
                ->paginate(10);
        } else {
            $companyId = Auth::guard('seller')->user()->company_id;
            $brands = Brand::where('company_id', $companyId)->where('status', 1)->orderBy('id','desc')->paginate(10);
        }
        return response()->json([
            'brands' => $brands
        ], 200);
    }

    //Search
    public function searchBrand(Request $request)
    {
        $search = $request->keyword;
        $companyId = Auth::guard('seller')->user()->company_id;

        if($search != null){
            $brands = Brand::where('company_id', $companyId)
                ->where('status', 1)
                ->where(function ($query) use ($search) {
                    $query->where("brand_name", "LIKE", "%{$search}%")
                        ->orWhere("brand_website", "LIKE", "%{$search}%")
                        ->orWhere("created_at", "LIKE", "%{$search}%");
                })
                ->orderBy('id', 'desc')
                ->paginate(10);
            return response()->json([
                'brands' => $brands
            ], 200);
        }else{
            return $this->index($request);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'brand_name'    => 'required',
            'brand_website' => 'required',
        ]);

        $companyId = Auth::guard('seller')->user()->company_id;
        $userId = Auth::guard('seller')->user()->id;
        $brand = Brand::create([
            'company_id'            => $companyId,
            'brand_name'            => $request->brand_name,
            'brand_website'         => $request->brand_website,
            'brand_slug'            => Str::slug($request->brand_name),
            'brand_description'     => $request->brand_description,
            'status'                => 1,
            'created_by'            => $userId
        ]);
        return 'Success';
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'brand_name'    => 'required',
            'brand_website' => 'required',
        ]);

        $userId = Auth::guard('seller')->user()->id;
        $brand = Brand::where('id', $id)->update([
            'brand_name'            => $request->brand_name,
            'brand_website'         => $request->brand_website,
            'brand_slug'            => Str::slug($request->brand_name),
            'brand_description'     => $request->brand_description,
            'status'                => 1,
            'updated_by'            => $userId
        ]);
        return 'Success';
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $userId = Auth::guard('seller')->user()->id;
        $brand = Brand::find($id)->update(['deleted_by' => $userId, 'status' => 0]);
        Brand::find($id)->delete();
        return $this->index();
    }

    //Multiple Brand Delete
    public function multipleBrandDelete(Request $request){
        $userId = Auth::guard('seller')->user()->id;
        foreach ($request->all()  as $brand){
            Brand::find($brand['id'])->update(['deleted_by' => $userId, 'status' => 0]);
            Brand::find($brand['id'])->delete();
        }
        return 'Success';
    }

    //Brands List
    public function brandsList(){
        $companyId = Auth::guard('seller')->user()->company_id;
        $brands = Brand::where('company_id', $companyId)->where('status', 1)->orderBy('id','desc')->get();
        return response()->json([
            'brands' => $brands
        ], 200);
    }
}

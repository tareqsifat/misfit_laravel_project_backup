<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Attribute;
use App\Models\AttributeValue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AttributeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->keyword;
        $companyId = Auth::guard('seller')->user()->company_id;
        if($search != null){
            $attribute_ids = AttributeValue::where('status', 1)->where('company_id', $companyId)->groupBy('attribute_id')->get()->pluck('attribute_id');
            $attributes = Attribute::whereIn('id', $attribute_ids)
                ->where('status', 1)
                ->where(function ($query) use ($search) {
                    $query->where("attribute_name", "LIKE", "%{$search}%")
                        ->orWhere("attribute_value", "LIKE", "%{$search}%")
                        ->orWhere("created_at", "LIKE", "%{$search}%");
                })
                ->orderBy('id', 'desc')
                ->paginate(10);
        } else {
            $attribute_ids = AttributeValue::where('status', 1)->where('company_id', $companyId)->groupBy('attribute_id')->get()->pluck('attribute_id');
            $attributes = Attribute::whereIn('id', $attribute_ids)->where('status', 1)->orderBy('id','desc')->with('attributes_values')->paginate(10);
        }
        return response()->json([
            'attributes' => $attributes
        ], 200);
    }

    //Search
    public function searchAttribute(Request $request)
    {
        $search = $request->keyword;
        $companyId = Auth::guard('seller')->user()->company_id;
        $attribute_ids = AttributeValue::where('status', 1)->where('company_id', $companyId)->groupBy('attribute_id')->get()->pluck('attribute_id');

        if($search != null){
            $attributes = Attribute::whereIn('id', $attribute_ids)
                ->where('status', 1)
                ->where(function ($query) use ($search) {
                    $query->where("attribute_name", "LIKE", "%{$search}%")
                        ->orWhere("attribute_value", "LIKE", "%{$search}%")
                        ->orWhere("created_at", "LIKE", "%{$search}%");
                })
                ->orderBy('id', 'desc')
                ->paginate(10);
            return response()->json([
                'attributes' => $attributes
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
            'attribute_id'      => 'required',
            'attribute_value'   => 'required',
        ]);

        $companyId = Auth::guard('seller')->user()->company_id;
        $userId = Auth::guard('seller')->user()->id;

        $attribute_value = [];
        $attribute_code  = [];
        foreach ($request->attribute_value as $attr_value){
            array_push($attribute_value, $attr_value['attribute_value']);
            array_push($attribute_code, $attr_value['attribute_code']);
        }


        if(count($attribute_value) > 0){
            foreach ($attribute_value as $key => $attributeVal){
                $attribute_val = AttributeValue::create([
                    'company_id'            => $companyId,
                    'attribute_id'          => $request->attribute_id,
                    'attribute_value'       => $attributeVal,
                    'attribute_code'        => $attribute_code[$key],
                    'status'                => 1,
                    'created_by'            => $userId
                ]);
            }
        }

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
            'attribute_id'      => 'required',
            'attribute_value'   => 'required',
        ]);

        $attribute_values = AttributeValue::where('attribute_id', $id)->get();
        foreach ($attribute_values as $attribute_val){
            $attribute_val->forceDelete();
        }

        $this->store($request);
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
        $attribute = Attribute::find($id);
        if(!empty($attribute)){
            $attribute_values = AttributeValue::where('attribute_id', $id)->get();
            foreach ($attribute_values as $attribute_val){
                $attribute_val->update(['deleted_by' => $userId, 'status' => 0]);
                $attribute_val->delete();
            }
        }

        return $this->index();
    }

    //Multiple Attribute Delete
    public function multipleAttributeDelete(Request $request){
        $userId = Auth::guard('seller')->user()->id;
        foreach ($request->all()  as $attribute){
            $attr = Attribute::find($attribute['id']);
            if(!empty($attr)){
                $attr_values = AttributeValue::where('attribute_id', $attribute['id'])->get();
                foreach ($attr_values as $attribute_val){
                    $attribute_val->update(['deleted_by' => $userId, 'status' => 0]);
                    $attribute_val->delete();
                }
            }
        }
        return 'Success';
    }

    //Attribute Name List
    public function attributeNameList()
    {
        $attribute_names = Attribute::where('status', 1)->get();
        return response()->json([
            'attribute_names' => $attribute_names
        ], 200);
    }
}

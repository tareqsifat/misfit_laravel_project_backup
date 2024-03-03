<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\CompanyInfo;
use App\Models\Seller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Mail;

class CompanyInfoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $company_infos = CompanyInfo::where('status', 1)->orderBy('id','desc')->paginate(10);
        return response()->json([
            'company_infos' => $company_infos
        ], 200);
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
        $company_info = CompanyInfo::create([
            'about'                 => $request->about,
            'privacy_policy'        => $request->privacy_policy,
            'terms_condition'       => $request->terms_condition,
            'warranty_guide'        => $request->warranty_guide,
            'return_policy'         => $request->return_policy,
            'facebook_link'         => $request->facebook_link,
            'youtube_link'          => $request->youtube_link,
            'twitter_link'          => $request->twitter_link,
            'instagram_link'        => $request->instagram_link,
            'status'                => 1
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
        $company_info = CompanyInfo::find($id);
        return response()->json([
            'company_info' => $company_info
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $id = $request->id;
        $company_info = CompanyInfo::where('id', $id)->update([
            'about'                 => ($request->about != 'null')?$request->about:NULL,
            'privacy_policy'        => ($request->privacy_policy != 'null')?$request->privacy_policy:NULL,
            'terms_condition'       => ($request->terms_condition != 'null')?$request->terms_condition:NULL,
            'warranty_guide'        => ($request->warranty_guide != 'null')?$request->warranty_guide:NULL,
            'return_policy'         => ($request->return_policy != 'null')?$request->return_policy:NULL,
            'seller_page'           => ($request->seller_page != 'null')?$request->seller_page:NULL,
            'seller_terms_condition'=> ($request->seller_terms_condition != 'null')?$request->seller_terms_condition:NULL,
            'facebook_link'         => ($request->facebook_link != 'null')?$request->facebook_link:NULL,
            'youtube_link'          => ($request->youtube_link != 'null')?$request->youtube_link:NULL,
            'twitter_link'          => ($request->twitter_link != 'null')?$request->twitter_link:NULL,
            'instagram_link'        => ($request->instagram_link != 'null')?$request->instagram_link:NULL,
            'status'                => 1
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
        $company_info = CompanyInfo::find($id);
        $company_info->update(['status' => 0]);
        CompanyInfo::find($id)->delete();
        return $this->index();
    }

    //Multiple Company Info Delete
    public function multipleCompanyInfoDelete(Request $request){
        foreach ($request->all()  as $companInfo){
            $company_info = CompanyInfo::find($companInfo['id']);
            $company_info->update(['status' => 0]);

            CompanyInfo::find($companInfo['id'])->delete();
        }
        return 'Success';
    }

    //Seller List
    public function sellerList()
    {
        $sellers = Seller::orderBy('status', 'asc')->paginate(10);
        return response()->json([
            'sellers' => $sellers
        ], 200);
    }

    //Seller Approve
    public function sellerApprove(Request $request)
    {
        $id = $request->id;
        return Seller::find($id)->update(['status' => 1]);
        $sellerInfo = Seller::find($id);
        if(isset($sellerInfo->email)){
            $seller_email = $sellerInfo->email;
            $seller_details = [
                'name'  => $sellerInfo->name,
                'title' => 'Registration Approval',
                'body'  => 'Your registration has been approved.'
            ];
            \Mail::to($seller_email)->send(new \App\Mail\SellerApprovalEmail($seller_details));
        }
    }

    //Multiple Seller Approve
    public function multipleSellerApprove(Request $request)
    {
        foreach ($request->all()  as $seller){
            Seller::find($seller['id'])->update(['status' => 1]);
        }
        return 'Success';
    }
}

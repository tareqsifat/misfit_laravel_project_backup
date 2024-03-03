<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $wishlists = Wishlist::where('user_id', Auth::user()->id)->where('status', 1)->with('product')->paginate(3);
        return response()->json([
            'wishlists'  => $wishlists
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
        $prev_wishlist = Wishlist::where('company_id', $request->company_id)->where('user_id', $request->user_id)->where('product_id', $request->product_id)->where('status', 1)->first();
        if(!empty($prev_wishlist)){
            return 'error';
        }else{
            $wishlist = Wishlist::create([
                'company_id'    => $request->company_id,
                'user_id'       => $request->user_id,
                'product_id'    => $request->product_id,
                'status'        => 1,
                'created_by'    => $request->user_id,
            ]);
            return response()->json($wishlist);
        }
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user_id = Auth::user()->id;
        $wishlist = Wishlist::find($id);
        $wishlist->update(['status' => 0, 'deleted_by' => $user_id]);
        $wishlist->delete();
        return 'Success';
    }
}

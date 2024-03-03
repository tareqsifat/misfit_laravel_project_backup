<?php

namespace App\Http\Controllers;

use App\Http\Requests\admin\DomainStoreRequest;
use App\Models\Admin\Domain;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class DomainController extends Controller
{
    public function index()
    {
        $domains = Domain::when(request()->has('relation') && request()->relation === 'user', function ($query) {
            return $query->with('user');
        })->orderBy('created_at', 'DESC')->get();

        if(count($domains) == 0){
            return response()->json([
                'message' => 'There are no domains'
            ], 404);
        }

        return response()->json([
            'data' => $domains
        ]);
    }

    public function store(DomainStoreRequest $request)
    {
        if($request->has('user_id')){
            $user = User::find($request->user_id);
            if(!$user){
                return response()->json([
                    'message' => 'user not found'
                ],404);
            }
        }
        $domain = Domain::where([
            'domain' => $request->domain,
            'sub-domain' => $request->input('sub-domain')
        ])->first();
        if($domain){
            return response()->json([
                'message' => 'Domain Already Exists'
            ], 401);
        }

        $domain = Domain::create([
            'domain' => $request->domain,
            'sub-domain' => $request->input('sub-domain'),
            'creator' => Auth::guard('admin-api')->id(),
            'user_id' => $request->user_id,
            'slug' => Str::slug($request->domain)
        ]);
        return response()->json(['data' => $domain], 201);
    }

    public function show($id)
    {
        $domain = Domain::when(request()->has('relation') && request()->relation === 'user', function ($query) {
            return $query->with('user');
        })->find($id);

        if(!$domain){
            return response()->json([
                'message' => 'domain not found'
            ]);
        }
        return response()->json(['data' => $domain]);
    }
    public function update(Request $request, $id)
    {
        if($request->has('user_id')){
            $user = User::find($request->user_id);
            if(!$user){
                return response()->json([
                    'message' => 'user not found'
                ]);
            }
        }
        $domain = Domain::where([
            'domain' => $request->domain,
            'sub-domain' => $request->input('sub-domain')
        ])->first();

        if($domain){
            return response()->json([
                'message' => 'Domain Already Exists'
            ], 401);
        }
        $domain = Domain::find($id);
        if(!$domain){
            return response()->json([
                'message' => 'domain not found'
            ]);
        }
        $domain->update([
            'domain' => $request->domain,
            'sub-domain' => $request->input('sub-domain'),
            'user_id' => $request->user_id,
            'slug' => Str::slug($request->domain)
        ]);
        return response()->json(['data' => $domain]);
    }
    public function destroy($id)
    {
        $domain = Domain::find($id);
        if(!$domain){
            return response()->json([
                'message' => 'domain not found'
            ]);
        }
        $domain->delete();
        return response()->json([
            'message' => 'domain deleted successfully'
        ]);
    }
}

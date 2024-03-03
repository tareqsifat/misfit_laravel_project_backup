<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserRole;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserRoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */ 
    public function index()
    {
        $collection = UserRole::orderby('serial', 'ASC')->get();
        return view('admin.UserRole.index',compact('collection'));
    }

    public function update(Request $request)
    {
        $user_role = UserRole::find($request->id);
        $user_role -> name  = $request->name;
        $user_role -> serial = $request -> serial;
        $user_role ->id + $request -> id;
        $user_role -> created_at = Carbon::now() -> toDateTimeString(); 
        $user_role -> creator = Auth::user() -> id;
        $user_role -> save();

        return redirect()->back()->with('success','data updated');
    }
}

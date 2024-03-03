<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\admin\auth\AdminLoginRequest;
use App\Models\UserManagement\UserAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuthController extends Controller
{
    public function admin_login()
    {
        return view('admin.auth.login');
    }

    public function login(AdminLoginRequest $request)
    {
        $credentials = $request->only('email', 'password');
        $guard = 'user_account'; // specify the guard name

        if (Auth::guard($guard)->attempt($credentials)) {
            return redirect()->route('dashboard_show'); // Redirect to the intended page after successful login
        } else {
            return back()->withInput()->with(['error' => 'Invalid email or password']);
        }
    }
}

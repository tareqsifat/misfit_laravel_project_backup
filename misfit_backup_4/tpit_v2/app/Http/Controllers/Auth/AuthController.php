<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function login()
    {
        if(auth()->check()){
            return redirect('/');
        }
        return view('frontend.pages.login');
    }

    public function login_submit()
    {
        $this->validate(request(),[
            "email" => ["required","email","exists:users,email"],
            "password" => ["required"],
        ]);

        $user = User::where('email',request()->email)->with(['roles'])->first();
        $check_password = Hash::check(request()->password, $user->password);

        if(!$check_password){
            $error = ValidationException::withMessages([
                'password' => ['invalid password'],
            ]);
            throw $error;
        }

        Auth::login($user);

        $check_admin = $user->roles()->whereIn('role_serial',['1','2'])->exists();
        if($check_admin){
            $this->remove_access_token();
            $token = $user->createToken('accessToken');
            $token_c = cookie("AXRF-TOKEN", $token->accessToken, Carbon::now()->addMinute(60)->format('i'), '/', null, null, false, true);
            return redirect()->route('dashboard')->withCookie($token_c);
        }

        return redirect('/');
    }

    public function logout_submit()
    {
        if(auth()->check()){
            $this->remove_access_token();
            auth()->logout();
        }

        return redirect('/')->withCookie(cookie("AXRF-TOKEN",''));
    }

    public function remove_access_token()
    {
        DB::table('oauth_access_tokens')->where('user_id',auth()->user()->id)->update(['revoked'=>1]);
    }
}

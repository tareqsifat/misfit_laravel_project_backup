<?

namespace App\Helpers;

use Illuminate\Support\Facades\Auth;


if(!function_exists('auth_check')){
    function auth_check($guard){
        return Auth::guard($guard)->check();
    }
}

if(!function_exists('auth_user')){
    function auth_user($guard){
        if(auth_check($guard)){
            return Auth::guard($guard)->user();
        }else{
            return null;
        }
    }
}

if(!function_exists('current_guard')){
    function current_guard(){
        foreach (config('auth.guards') as $guardName) {
            if (Auth::guard($guardName)->check()) {
                return $guardName;
            }
        }
    }
}

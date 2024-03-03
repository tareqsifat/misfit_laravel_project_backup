<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileComplete
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
                // Check if the user is authenticated and is an admin
                if (Auth::user()->complete == '1') {
                    return $next($request);
                }
                // Redirect or return a response if the user is not an admin
                return redirect()->route('profile.incomplete')->with('Warning', 'You Have to must Complete Your Profile.');
    }
}

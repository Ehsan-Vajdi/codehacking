<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // user should be registered and logged in
        if (Auth::check()){
            // user that is Administrator and Active, can access to users and update posts sections
            if (Auth::user()->isAdmin()){
                return $next($request);
            }
        }

//        return redirect(404);
        return redirect('/admin');

    }
}

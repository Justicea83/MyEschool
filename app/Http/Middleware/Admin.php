<?php

namespace App\Http\Middleware;

use Closure;

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
        if(auth()->check()){
            if(auth()->user()->isAdmin() || auth()->user()->isTeacher()){
                return $next($request);
            }else{
                return redirect()->back();
            }
        }else{
                return redirect('/');
        }

    }
}

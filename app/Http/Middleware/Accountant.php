<?php

namespace App\Http\Middleware;

use Closure;

class Accountant
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
            if(auth()->user()->isAccountant() || auth()->user()->isAdmin()){
                return $next($request);
            }else{
                return redirect()->back();
            }
        }else{
            return redirect('/');
        }
    }
}

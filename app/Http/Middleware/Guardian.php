<?php

namespace App\Http\Middleware;

use Closure;

class Guardian
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
            if(auth()->user()->isGuardian()){
                return $next($request);
            }else{
                return redirect()->back();
            }
        }else{
            return redirect('/');
        }
    }
}

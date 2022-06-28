<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Eligible
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
        if(auth()->user()->isAdmin()){
            return redirect()->route('dashboard');
        }
        if(auth()->user()->isEligible()){
            return $next($request);
        }
        return redirect()->route('test.result');
    }
}

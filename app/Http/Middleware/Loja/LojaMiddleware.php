<?php

namespace App\Http\Middleware\Loja;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LojaMiddleware
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
        if(Auth::guard('admin')->check()){
            return $next($request);
        }else
        if (auth()->hasUser()) {
            return $next($request);
        }
        return redirect()->route('user-lojas');



    }
}

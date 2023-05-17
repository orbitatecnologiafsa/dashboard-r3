<?php

namespace App\Http\Middleware\Adm;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdmMiddleware
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
        }
        return redirect()->to('adm/login')->with('msg-error','Ops! aconteceu algum erro ao acessar esse llink!');
    }
}

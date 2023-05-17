<?php

namespace App\Http\Middleware\Visitante;

use Closure;
use Illuminate\Http\Request;

class VisitanteMiddleware
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
        if (!isset(auth()->user()->cnpj)) {
            return $next($request);
        }
        return redirect()->back();
    }
}

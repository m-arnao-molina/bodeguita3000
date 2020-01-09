<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class GerenteGeneral
{
    public function handle($request, Closure $next)
    {
        if ( Auth::check() && Auth::user()->esGerenteGeneral() )
        {
            return $next($request);
        }
        return redirect('home');
    }
}
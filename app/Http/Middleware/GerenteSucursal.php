<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class GerenteSucursal
{
    public function handle($request, Closure $next)
    {
        if ( Auth::check() && Auth::user()->esGerenteSucursal() )
        {
            return $next($request);
        }
        return redirect('home');
    }
}
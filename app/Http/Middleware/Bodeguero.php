<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Bodeguero
{
    public function handle($request, Closure $next)
    {
        if ( Auth::check() && Auth::user()->esBodeguero() )
        {
            return $next($request);
        }
        return redirect('home');
    }
}
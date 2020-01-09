<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Cajero
{
    public function handle($request, Closure $next)
    {
        if ( Auth::check() && Auth::user()->esCajero() )
        {
            return $next($request);
        }
        return redirect('home');
    }
}
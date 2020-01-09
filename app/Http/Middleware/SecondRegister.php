<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class SecondRegister
{
    public function handle($request, Closure $next)
    {
        $usuario = Auth::user();
        
        if(!$usuario->habilitado())
        {
            return $next($request);
        }
        return redirect('home');
    }
}
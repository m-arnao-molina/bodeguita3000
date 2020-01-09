<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class EvaluarRol
{
    public function handle($request, Closure $next)
    {
        $usuario = Auth::user();
        
        if($usuario->habilitado())
        {
            if( $usuario->esGerenteGeneral() ) {
                return redirect()->route('gg_home');
    
            } else if( $usuario->esGerenteSucursal() ) {
                return redirect()->route('gs_home');
    
            } else if( $usuario->esBodeguero() ) {
                return redirect()->route('bo_home');
    
            } else if( $usuario->esCajero() ) {
                return redirect()->route('ca_home');
            }
        } else {
            return redirect()->route('second_register');
        }
        return $next($request);
    }
}

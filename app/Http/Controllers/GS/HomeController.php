<?php

namespace App\Http\Controllers\GS;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function vista()
    {
        $datosUsuario = auth()->user();
        $datosPersonales = $datosUsuario->gerenteSucursal;
        $datosSucursal = $datosPersonales->sucursal;
        $datosEmpresa = $datosSucursal->empresa;
        return view('gs.home', compact('datosUsuario', 'datosPersonales', 'datosSucursal', 'datosEmpresa'));
    }
}

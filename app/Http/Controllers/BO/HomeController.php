<?php

namespace App\Http\Controllers\BO;

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
        $datosPersonales = $datosUsuario->bodeguero;
        $datosSucursal = $datosPersonales->sucursal;
        $datosEmpresa = $datosSucursal->empresa;
        return view('bo.home', compact('datosUsuario', 'datosPersonales', 'datosSucursal', 'datosEmpresa'));
    }
}

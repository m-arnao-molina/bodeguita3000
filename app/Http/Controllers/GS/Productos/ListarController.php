<?php

namespace App\Http\Controllers\GS\Productos;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App;

class ListarController extends Controller
{
    /**
     * Retorna la vista a mostrar correspondiente.
     */
    public function vista()
    {
        $sucursal = Auth::user()->gerenteSucursal->sucursal;
        $productos = $sucursal->productoSucursals;
        return view('gs.productos.listar', compact('productos'));
    }
}

<?php

namespace App\Http\Controllers\GS\Productos;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ControllerInterface;
use Illuminate\Support\Facades\Auth;
use App;
use App\Empresa\Producto;

class ListarCriticosController extends Controller
{
    /**
     * Retorna la vista a mostrar correspondiente.
     */
    public function vista()
    {
        // Se debe modificar por el usuario que este autenticado, que en este caso es un gerente de sucursal
        $usuario = Auth::user();
        $gerenteSucursal = $usuario->gerenteSucursal;
        $sucursal = $gerenteSucursal->sucursal;
        $productosSucursal = $sucursal->productoSucursals;
        $productosBajoStock = array();

        foreach($productosSucursal as $productoSucursal)
        {
            if($productoSucursal->stock_actual < $productoSucursal->stock_minimo)
            {
                array_push($productosBajoStock, $productoSucursal);
            }
        }
        return view('gs.productos.listarCriticos', compact('productosBajoStock'));
    }
}

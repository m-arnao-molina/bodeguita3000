<?php

namespace App\Http\Controllers\GS\Productos;

use Illuminate\Http\Request;
use App;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ControllerInterface;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;
use App\Empresa\Sucursal\ProductoSucursal;

class ModificarController extends Controller implements ControllerInterface
{
    /**
     * Retorna la vista a mostrar correspondiente.
     */
    public function vista()
    {
        $usuario = Auth::user();
        $gs = $usuario->gerenteSucursal;
        $sucursal = $gs->sucursal;
        $productos = $sucursal->productoSucursals;
        
        return view('gs.productos.modificar')->with('productos', $productos);
    }

    /**
     * Ejecuta la acción que tiene como propósito la vista.
     */
    public function accion(Request $request)
    {
        $producto = ProductoSucursal::find($request->producto_id);
        $producto->stock_minimo = $request->stock_minimo;

        try {
            if($producto->save())
            {
                return redirect()->route('gs_prod_modificar')->with('success', 'El stock mínimo del producto se modificó correctamente.');
            }
        } catch(QueryException $e) {
            
        } finally {
            return redirect()->route('gs_prod_modificar')->with('danger', 'El stock mínimo del producto no se pudo modificar.');
        }
    }
}

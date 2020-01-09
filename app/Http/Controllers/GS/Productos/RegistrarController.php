<?php

namespace App\Http\Controllers\GS\Productos;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ControllerInterface;
use Illuminate\Database\QueryException;
use App\Http\Controllers\Auth;
use App\Empresa\Producto;
use App\Empresa\Sucursal\Sucursal;
use App\Empresa\Sucursal\GerenteSucursal;
use App\Empresa\Sucursal\ProductoSucursal;

class RegistrarController extends Controller implements ControllerInterface
{
    public function vista()
    {
        $sucursal = auth()->user()->gerenteSucursal->sucursal;
        $productos = $sucursal->empresa->productosExcepto($sucursal);
        return view('gs.productos.registrar', compact('productos'));
    }

    public function accion(Request $request)
    {
        $sucursal = auth()->user()->gerenteSucursal->sucursal;
        $productoEmpresa = Producto::find($request->producto_id);

        $productoSucursal = new ProductoSucursal;
        $productoSucursal->fill([
            'stock_minimo' => $request->stock_minimo
        ]);

        $productoSucursal->producto()->associate($productoEmpresa);
        $productoSucursal->sucursal()->associate($sucursal);

        try {
            $productoSucursal->save();
            return redirect()->route('gs_prod_registrar')->with('success', 'El producto se ha registrado correctamente.');

        } catch (QueryException $e) {
            return redirect()->route('gs_prod_registrar')->with('danger', 'El producto no se ha podido registrar.');
        }
    }
}

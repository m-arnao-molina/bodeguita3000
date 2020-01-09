<?php

namespace App\Http\Controllers\BO\Productos;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ControllerInterface;
use Illuminate\Support\Facades\Auth;
use App\Empresa\Producto;
use App\Empresa\Marca;
use App\Empresa\Proveedor;
use App\Empresa\Sucursal\ProductoSucursal;
use App\Empresa\Sucursal\RegistroInventario;

class IngresarController extends Controller implements ControllerInterface
{
    /**
     * Retorna la vista a mostrar correspondiente.
     */
    public function vista()
    {
        return view('bo.productos.ingresar');
    }

    public function productoEnSucursal(Request $r)
    {
        if($r->ajax())
        {
            $usuario = Auth::user();
            $bodeguero = $usuario->bodeguero;
            $sucursal = $bodeguero->sucursal;

            $productoEmpresa = Producto::where([
                ['codigo', $r->codigo],
                ['empresa_id', $sucursal->empresa->id]
            ])->first();

            if($productoEmpresa != null)
            {
                $productoSucursal = ProductoSucursal::where([
                    ['producto_id', $productoEmpresa->id],
                    ['sucursal_id', $sucursal->id]
                ])->first();
                
                if($productoSucursal != null)
                {
                    $marca = Marca::find($productoEmpresa->marca->id);
                    $proveedor = Proveedor::find($marca->proveedor->id);
                    $fecha = getDate();

                    return response()->json([
                        'error' => false,
                        'datosProducto' => $productoEmpresa,
                        'marca' => $marca,
                        'proveedor' => $proveedor,
                        'fecha' => $fecha
                    ]);

                } else {
                    return response()->json([
                        'error' => true,
                        'mensajeError' => 'No se encontró el producto en los registros de la sucursal.'
                    ]);
                }
            } else {
                return response()->json([
                    'error' => true,
                    'mensajeError' => 'No se encontró el producto en los registros de la empresa.'
                ]);
            }
        }
    }

    public function accion(Request $r)
    {
        try {
            if($r->ajax())
            {
                if($r->cantidad < 1)
                {
                    return response()->json('La cantidad ingresada debe ser mayor o igual a 1.');
                }

                $usuario = Auth::user();
                $bodeguero = $usuario->bodeguero;
                $sucursal = $bodeguero->sucursal;

                $productoEmpresa = Producto::where([
                    ['codigo', $r->codigo],
                    ['empresa_id', $sucursal->empresa_id]
                ])->first();


                if($productoEmpresa != null)
                {
                    $productoSucursal = ProductoSucursal::where([
                        ['producto_id', $productoEmpresa->id],
                        ['sucursal_id', $sucursal->id]
                    ])->first();

                    if($productoSucursal != null)
                    {
                        $registroInventario = new RegistroInventario;
                        $productoSucursal->stock_actual += $r->cantidad;
                        $registroInventario->cantidad = $r->cantidad;
                        $registroInventario->producto()->associate($productoEmpresa);
                        $registroInventario->bodeguero()->associate($bodeguero);
                        $registroInventario->sucursal()->associate($sucursal);
                        $registroInventario->accion = 'Agregar';
                        $registroInventario->save();
                        $productoSucursal->save();
                        return response()->json('Se ingresó la cantidad indicada correctamente.');
                    }
                }    
            }
        } catch (QueryException $e) {
            return response()->json('Error al intentar ingresar la cantidad indicada.');
        }
    }
}

<?php

namespace App\Http\Controllers\CA\Ventas;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Empresa\Producto;
use App\Empresa\Marca;
use App\Empresa\Sucursal\ProductoSucursal;
use App\Empresa\Sucursal\Venta;
use App\Empresa\Sucursal\DetalleVenta;

class RegistrarController extends Controller
{
    /**
     * Retorna la vista a mostrar correspondiente.
     */
    public function vista(Request $r)
    {
        $r->session()->forget('venta');
        $r->session()->forget('detalles_venta');
        return view('ca.ventas.registrar');
    }

    public function agregar(Request $r)
    {
        if($r->ajax())
        {
            if($r->cantidad < 1)
            {
                return response()->json([
                    'error' => true,
                    'mensajeError' => 'La cantidad ingresada debe ser mayor o igual a 1.'
                ]);
            }

            $cajero = Auth::user()->cajero;
            $sucursal = $cajero->sucursal;
            $productoSucursal = $this->existeProductoEnSucursal($r->codigo, $sucursal);
            
            if(!$productoSucursal)
            {
                return response()->json([
                    'error' => true,
                    'mensajeError' => 'No se encontró el producto en los registros.'
                ]);
            }

            if(!$r->session()->has('detalles_venta'))
            {
                $venta = new Venta;
                $venta->sucursal()->associate($sucursal);
                $venta->cajero()->associate($cajero);
                $r->session()->put('venta', $venta);
                $r->session()->put('detalles_venta', array());

            } else {
                $venta = $r->session()->get('venta');
            }

            $detalleVenta = $this->agregarDetalleVenta($r, $productoSucursal);
            
            if(!$detalleVenta)
            {
                return response()->json([
                    'error' => true,
                    'mensajeError' => 'No hay suficiente stock para el producto indicado.'
                ]);
            }

            return response()->json([
                'error' => false,
                'codigo' => $detalleVenta->producto->codigo,
                'nombre' => $detalleVenta->producto->nombre,
                'marca' => $detalleVenta->producto->marca->nombre,
                'cont_neto' => $detalleVenta->producto->cont_neto,
                'precio' => $detalleVenta->producto->precio,
                'cantidad' => $detalleVenta->cantidad,
                'subtotal' => ($detalleVenta->cantidad * $detalleVenta->producto->precio),
                'total' => $venta->monto
            ]);
        }
    }

    private function existeProductoEnSucursal($codigo, $sucursal)
    {
        $productoEmpresa = Producto::where([
            ['codigo', $codigo],
            ['empresa_id', $sucursal->empresa->id]
        ])->first();
        
        $productoSucursal = null;

        if($productoEmpresa != null)
        {
            $productoSucursal = ProductoSucursal::where([
                ['producto_id', $productoEmpresa->id],
                ['sucursal_id', $sucursal->id]
            ])->first();
        }
        return $productoSucursal;
    }

    private function agregarDetalleVenta(Request $r, $productoSucursal)
    {
        $venta = $r->session()->get('venta');
        $detallesVenta = $r->session()->get('detalles_venta');
        $detalleVenta = null;

        foreach($detallesVenta as $productoVenta)
        {
            if($productoVenta->producto->id == $productoSucursal->producto->id)
            {
                $detalleVenta = $productoVenta;
            }
        }

        if(!$detalleVenta)
        {
            if($productoSucursal->stock_actual < $r->cantidad)
            {
                return null;
            }

            $productoEmpresa = Producto::find($productoSucursal->producto->id);
            $detalleVenta = new DetalleVenta;
            $detalleVenta->producto()->associate($productoEmpresa);
            $detalleVenta->cantidad = $r->cantidad;
            $r->session()->push('detalles_venta', $detalleVenta);

        } else {

            if($productoSucursal->stock_actual < ($detalleVenta->cantidad + $r->cantidad))
            {
                return null;
            }

            $detalleVenta->cantidad += $r->cantidad;
        }
        $venta->monto += $r->cantidad * $detalleVenta->producto->precio;
        return $detalleVenta;
    }

    public function eliminar(Request $r)
    {
        if($r->ajax())
        {
            $venta = $r->session()->get('venta');
            $detallesVenta = $r->session()->get('detalles_venta');

            foreach($detallesVenta as $idx => $productoVenta)
            {
                if($productoVenta->producto->codigo == $r->codigo)
                {
                    $venta->monto -= $productoVenta->cantidad * $productoVenta->producto->precio;
                    $r->session()->forget('detalles_venta.' . $idx);
                }
            }

            if(count($r->session()->get('detalles_venta')) == 0)
            {
                $r->session()->forget('venta');
                $r->session()->forget('detalles_venta');
            }

            return response()->json([
                'total' => $venta->monto
            ]);
        }
    }

    public function cancelar(Request $r)
    {
        if($r->ajax())
        {
            $r->session()->forget('venta');
            $r->session()->forget('detalles_venta');

            if($r->venta_id)
            {
                $venta = Venta::find($r->venta_id);
                $this->actualizarStockSucursal($venta, 1);
                $venta->detalleVentas()->delete();
                $venta->delete();
            }
            return response()->json(true);
        }
    }

    public function limpiar(Request $r)
    {
        if($r->ajax())
        {
            $r->session()->forget('venta');
            $r->session()->forget('detalles_venta');
            return response()->json(true);
        }
    }

    /**
     * Ejecuta la acción que tiene como propósito la vista.
     */
    public function accion(Request $r)
    {
        if($r->ajax())
        {
            $venta = $r->session()->get('venta');
            $detallesVenta = $r->session()->get('detalles_venta');

            $venta->save();

            foreach($detallesVenta as $productoVenta)
            {
                $productoVenta->venta()->associate($venta);
                $productoVenta->save();
            }

            $this->actualizarStockSucursal($venta, -1);

            return response()->json([
                'error' => false,
                'mensajeError' => 'Se completó satisfactoriamente la venta.',
                'venta_id' => $venta->id                         // Util para cuando se desee cancelar una venta previamente confirmada
            ]);
        }
        return response()->json([
            'error' => true,
            'mensajeError' => 'Ocurrió un error al completar la venta.'
        ]);
    }

    private function actualizarStockSucursal($venta, $factor)   // Factor: si es 1 se repone, si es -1 se quita stock
    {
        $detallesVenta = $venta->detalleVentas;

        foreach($detallesVenta as $productoVenta)
        {
            $productoSucursal = ProductoSucursal::where([
                ['sucursal_id', $venta->sucursal->id],
                ['producto_id', $productoVenta->producto->id]
            ])->first();
            $productoSucursal->stock_actual = $productoSucursal->stock_actual + ($factor * $productoVenta->cantidad);
            $productoSucursal->save();
        }
    }
}
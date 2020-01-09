<?php

namespace App\Http\Controllers\GS\Productos;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ControllerInterface;
use Illuminate\Support\Facades\Auth;
use App\Empresa\Proveedor;
use App\Empresa\Producto;
use App\Empresa\Sucursal\ProductoSucursal;
use App\Empresa\Sucursal\OrdenCompra;
use App\Empresa\Sucursal\ProductoOrdenCompra;
use PDF;

class OrdenCompraController extends Controller implements ControllerInterface
{
    public function vista()
    {
        $sucursal = Auth::user()->gerenteSucursal->sucursal;
        $proveedores = Proveedor::all();
        $proveedoresEnSucursal = array();

        foreach($proveedores as $proveedor)
        {
            if($proveedor->estaEnSucursal($sucursal))
            {
                array_push($proveedoresEnSucursal, $proveedor);
            }
        }
        return view('gs.productos.orden_compra_p1', compact('proveedoresEnSucursal'));
    }

    public function productosDeProveedor(Request $r)
    {
        if($r->ajax())
        {
            $sucursal = Auth::user()->gerenteSucursal->sucursal;
            $proveedor = Proveedor::find($r->proveedor_id);
            $productos = $sucursal->productosDeProveedor($proveedor);
            return response()->json($productos);
        }
    }

    public function productosSeleccionados(Request $r)
    {
        if(!empty($r->producto_id))
        {
            $ordenCompra = new OrdenCompra;
            $proveedor = Proveedor::find($r->proveedor_id);
            $sucursal = Auth::user()->gerenteSucursal->sucursal;
            $productosOrdenCompra = array();
            $productos = array();                                   // Este arreglo es solo para ser mostrado en la vista
            
            $ordenCompra->proveedor()->associate($proveedor);
            $ordenCompra->sucursal()->associate($sucursal);
            $r->session()->put('orden_compra', $ordenCompra);

            foreach($r->producto_id as $idProducto)
            {
                $productoOrdenCompra = new ProductoOrdenCompra;
                $producto = Producto::find($idProducto);
                
                $productoOrdenCompra->producto()->associate($producto);
                array_push($productosOrdenCompra, $productoOrdenCompra);

                $productoSucursal = ProductoSucursal::where([
                    ['producto_id', $idProducto],
                    ['sucursal_id', $sucursal->id]
                ])->first();
                array_push($productos, $productoSucursal);
            }
            $r->session()->put('productos_orden_compra', $productosOrdenCompra);

            return view('gs.productos.orden_compra_p2', compact('productos', 'ordenCompra'));
        }
        return redirect()->route('gs_orden_compra');
    }

    public function cantidadesProductos(Request $r)
    {
        if(!empty($r->cantidad))
        {
            $ordenCompra = $r->session()->get('orden_compra');
            $productosOrdenCompra = $r->session()->get('productos_orden_compra');

            foreach($productosOrdenCompra as $productoOrdenCompra)
            {
                $productoOrdenCompra->cantidad = $r->cantidad[$productoOrdenCompra->producto->id];
            }
            return view('gs.productos.orden_compra_p3', compact('ordenCompra', 'productosOrdenCompra'));
        }
        return redirect()->route('gs_orden_compra');
    }

    public function accion(Request $r)
    {
        $ordenCompra = $r->session()->get('orden_compra');
        $productosOrdenCompra = $r->session()->get('productos_orden_compra');

        $ordenCompra->fill([
            'fecha_realizacion' => $r->fecha_realizacion,
            'fecha_limite'=> $r->fecha_limite
        ]);
        $ordenCompra->save();

        foreach($productosOrdenCompra as $productoOrdenCompra)
        {
            $productoOrdenCompra->ordenCompra()->associate($ordenCompra);
            $productoOrdenCompra->save();
        }

        $pdf = PDF::loadView('gs.productos.orden_compra_pdf', compact('ordenCompra'));
        return $pdf->download('Orden de Compra.pdf');
    }
}

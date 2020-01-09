<?php

namespace App\Http\Controllers\GG\Productos;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ControllerInterface;
use Illuminate\Support\Facades\Auth;
use App\Empresa\Marca;
use App\Empresa\Producto;
use App\Empresa\Sucursal\DetalleVenta;
use Carbon\Carbon;

class EstadisticaController extends Controller implements ControllerInterface
{

     /**
     * Retorna la vista a mostrar correspondiente.
     */
    public function vista()
    {
        $empresa = Auth::user()->gerenteGeneral->empresa;
        $marcas = Marca::all();
        $marcasEnEmpresa = array();

        foreach($marcas as $marca)
        {
            if($marca->estaEnEmpresa($empresa))
            {
                array_push($marcasEnEmpresa, $marca);
            }
        }
        return view('gg.productos.estadisticas', compact('marcasEnEmpresa'));
    }

     /**
     * Obtiene productos por sucursal.
     */
    public function productosEnEmpresa(Request $r)
    {
        if($r->ajax())
        {
            $empresa = Auth::user()->gerenteGeneral->empresa;
            $marca = Marca::find($r->marca_id);
            $productos = $empresa->productosDeMarca($marca);
            return response()->json($productos);
        }
    }

     /**
     * Obtiene productos por sucursal.
     */
    public function accion(Request $r)
    {
        $desde = $r->fecha_ini.' 00:00:00';
        $hasta = $r->fecha_fin.' 23:59:59';

        $date = date_create($r->fecha_ini);
        $d = date_format($date, 'd-m-Y');

        $date = date_create($r->fecha_fin);
        $h = date_format($date, 'd-m-Y');

        $nombre = Producto::find($r->producto_id)->nombre;
        $ventas = DetalleVenta::where('producto_id', $r->producto_id)
                ->whereBetween('created_at', array($desde , $hasta))->orderBy('created_at', 'ASC')->get();
        $suma = $ventas->sum('cantidad');
        return view('gg.productos.grafico', compact('ventas', 'nombre', 'd', 'h', 'suma'));
    }
}
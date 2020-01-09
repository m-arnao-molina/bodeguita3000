<?php

namespace App\Http\Controllers\GS\Productos;

use App\Empresa\Marca;
use App\Empresa\Producto;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ControllerInterface;
use Illuminate\Support\Facades\Auth;

class BuscarController extends Controller implements ControllerInterface
{
    /**
     * Retorna la vista a mostrar correspondiente.
     */
    public function vista()
    {
        return view('gs.productos.buscar');
    }

    /**
     * Ejecuta la acción que tiene como propósito la vista.
     */
    public function accion(Request $request)
    {
        // Respuesta con productos filtrados con valor ingresado.
        $response = array();

        if ($request['valor'] != null) {
            $usuario = Auth::user();

            $gerenteSucursal = $usuario->gerenteSucursal()->first();
            $sucursal = $gerenteSucursal->sucursal()->first();
            $empresa = $sucursal->empresa()->first();

            // Lista de productos
            $productos = array();

            // Evalúa si buscará en la sucursal o no.
            if ($request['tipo-busqueda'] == 'Sucursal') {

                // Colección de productos con sus datos.
                foreach ($sucursal->productoSucursals()->get() as $producto) {

                    // Genera nuevo objeto con datos relevantes para la vista.
                    $datos = Producto::find($producto['producto_id']);
                    $marca = Marca::find($datos['marca_id']);

                    $new_producto = array(
                        'codigo' => $datos['codigo'],
                        'nombre' => $datos['nombre'],
                        'cont_neto' => $datos['cont_neto'],
                        'precio' => $datos['precio'],
                        'marca' => $marca['nombre']
                    );

                    array_push($productos, $new_producto);
                }

            } else {

                // Colección de productos con sus datos.
                foreach ($empresa->productos()->get() as $producto) {

                    // Genera nuevo objeto con datos relevantes para la vista.
                    $marca = Marca::find($producto['marca_id']);

                    $new_producto = array(
                        'codigo' => $producto['codigo'],
                        'nombre' => $producto['nombre'],
                        'cont_neto' => $producto['cont_neto'],
                        'precio' => $producto['precio'],
                        'marca' => $marca['nombre']
                    );

                    array_push($productos, $new_producto);
                }
            }

            // FILTRO DE DATOS
            $valor = strtoupper($request['valor']);
            foreach ($productos as $producto) {

                $nombre = strtoupper($producto['nombre']);
                $marca = strtoupper($producto['marca']);

                if (strpos($nombre, $valor) !== false or strpos($marca, $valor) !== false or strpos($producto['codigo'], $valor) !== false)
                    array_push($response, $producto);
            }
        }

        return json_encode($response);
    }
}

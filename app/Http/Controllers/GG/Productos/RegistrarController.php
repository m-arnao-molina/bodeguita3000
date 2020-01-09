<?php

namespace App\Http\Controllers\GG\Productos;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ControllerInterface;
use App\Http\Controllers\Auth;
use App\Empresa\Proveedor;
use App\Empresa\Marca;
use App\Empresa\Empresa;
use App\Empresa\Producto;

class RegistrarController extends Controller implements ControllerInterface
{
    /**
     * Retorna la vista a mostrar correspondiente.
     */
    public function vista()
    {
        $proveedores = Proveedor::all();
        return view('gg.productos.registrar', compact('proveedores'));
    }

    /**
     * Obtiene marcas para select dinamico.
     */
    public function marcasEnProveedor(Request $r)
    {
        if($r->ajax())
        {
            $marcas = Proveedor::find($r->proveedor_id)->marcas;
            return response()->json($marcas);
        }
    }

    /**
     * Ejecuta la acción que tiene como propósito la vista.
     */
    public function accion(Request $r)
    {
        $empresa = auth()->user()->gerenteGeneral->empresa;
        $marca = Marca::find($r->marca_id);

        $producto = new Producto;
        $producto->fill([
            'codigo' => $r->codigo,
            'nombre' => $r->nombre,
            'cont_neto' => $r->cont_neto,
            'precio' => $r->precio
        ]);

        $producto->empresa()->associate($empresa);
        $producto->marca()->associate($marca);

        try {
            $producto->save();
            return redirect()->route('gg_prod_registrar')->with('success', 'El producto se ha registrado correctamente.');

        } catch (QueryException $e) {
            return redirect()->route('gg_prod_registrar')
                ->with('danger', 'El producto no se ha podido registrar.')
                ->withInput();
        }
    }

    /**
     * Valida formulario registrar producto.
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'codigo' => ['required', 'string', 'max:255'],
            'nombre' => ['required', 'string', 'max:255'],
            'cont_neto' => ['required', 'string', 'max:255'],
            'precio' => ['required', 'integer'],
            'marca_id' => ['integer'],
            'empresa_id' => ['integer'],
        ]);
    }
}

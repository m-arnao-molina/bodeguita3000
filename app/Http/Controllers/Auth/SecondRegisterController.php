<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;
use App\Http\Controllers\Controller;
use App\Http\Requests\SecondRegisterCreateRequest;
use App\User;
use App\Empresa\Empresa;
use App\Empresa\GerenteGeneral;
use App\Empresa\Sucursal\Sucursal;
use App\Empresa\Sucursal\GerenteSucursal;
use App\Empresa\Sucursal\Bodeguero;
use App\Empresa\Sucursal\Cajero;

class SecondRegisterController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function vista()
    {
        $empresas = Empresa::all();

        if( auth()->user()->esGerenteGeneral() )
        {    
            return view('auth.second_register.gerente_general', compact('empresas'));

        } else {

            return view('auth.second_register.funcionario_suc', compact('empresas'));
        }
        return view('home');
    }

    public function sucursalesEnEmpresa(Request $r)
    {
        if($r->ajax())
        {
            $sucursales = Empresa::find($r->empresa_id)->sucursals;
            return response()->json($sucursales);
        }
    }

    public function accionRegistrar(SecondRegisterCreateRequest $r)
    {
        $usuario = Auth::user();
        $datosPersonales = [
            'p_nombre' => $r->p_nombre,
            's_nombre' => $r->s_nombre,
            'p_apellido' => $r->p_apellido,
            's_apellido' => $r->s_apellido,
            'rut' => $r->rut
        ];

        try {
            if( $usuario->esGerenteGeneral() ) {
                
                $gGeneral = new GerenteGeneral;
                $empresa = Empresa::find($r->empresa_id);
                $gGeneral->fill($datosPersonales);
                $gGeneral->empresa()->associate($empresa);
                $gGeneral->user()->associate($usuario);
                $gGeneral->save();

            } else {
            
                if( $usuario->esGerenteSucursal() ) {

                    $usuarioRol = new GerenteSucursal;
                
                } else if( $usuario->esBodeguero() ) {
                
                    $usuarioRol = new Bodeguero;
                
                } else if( $usuario->esCajero() ) {
                
                    $usuarioRol = new Cajero;
                }
                $sucursal = Sucursal::find($r->sucursal_id);
                $usuarioRol->fill($datosPersonales);
                $usuarioRol->sucursal()->associate($sucursal);
                $usuarioRol->user()->associate($usuario);
                $usuarioRol->save();
            }
            $usuario->habilitado = true;
            $usuario->save();
            return redirect()->route('home');

        } catch (QueryException $e) {

            return redirect()->route('second_register')
                ->with('danger', 'El registro no pudo completarse. ')
                ->withInput();
        }
    }

    public function accionEliminar(Request $r)
    {
        $usuario = Auth::user();

        try {
            if($usuario->delete() != NULL)
            {
                return redirect()->route('register')->with('success', 'El registro fue cancelado correctamente.');
            }
        } catch(QueryException $e) {
            
        } finally {
            return redirect()->route('register')->with('danger', 'Ocurrió un error al intentar cancelar el registro.');
        }
    }
}
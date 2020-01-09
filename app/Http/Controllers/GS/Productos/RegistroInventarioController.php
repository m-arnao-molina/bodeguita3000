<?php

namespace App\Http\Controllers\GS\Productos;

use Illuminate\Http\Request;
use App;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;

class RegistroInventarioController extends Controller
{
    public function vista()
    {
        $sucursal = Auth::user()->gerenteSucursal->sucursal;
        $productos = $sucursal->registroInventario;
        return view('gs.productos.registroInventario')->with('productos', $productos);
    }
}
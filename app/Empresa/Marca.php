<?php

namespace App\Empresa;

use Illuminate\Database\Eloquent\Model;
use App\Empresa\Producto;
use App\Empresa\Proveedor;

class Marca extends Model
{
    public function productos() {
        return $this->hasMany(Producto::class);
    }

    public function proveedor() {
        return $this->belongsTo(Proveedor::class);
    }

    public function estaEnSucursal($sucursal)
    {
        $productos = $this->productos;

        foreach($productos as $producto)
        {
            if($producto->estaEnSucursal($sucursal))
            {
                return true;
            }
        }
        return false;
    }

    public function estaEnEmpresa($empresa)
    {
        $productos = $this->productos;

        foreach($productos as $producto)
        {
            if($producto->empresa->id == $empresa->id)
            {
                return true;
            }
        }
        return false;
    }
}
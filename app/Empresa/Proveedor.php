<?php

namespace App\Empresa;

use Illuminate\Database\Eloquent\Model;
use App\Empresa\Marca;

class Proveedor extends Model
{
    public function marcas() {
        return $this->hasMany(Marca::class);
    }

    public function ordenCompras() {
        return $this->hasMany(OrdenCompra::class);
    }

    public function estaEnSucursal($sucursal)
    {
        $marcas = $this->marcas;

        foreach($marcas as $marca)
        {
            if($marca->estaEnSucursal($sucursal))
            {
                return true;
            }
        }
        return false;
    }
}

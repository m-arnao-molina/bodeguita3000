<?php

namespace App\Empresa;

use Illuminate\Database\Eloquent\Model;
use App\Empresa\GerenteGeneral;
use App\Empresa\Sucursal\Sucursal;
use App\Empresa\Producto;

class Empresa extends Model
{
    public function gerenteGeneral() {
        return $this->hasOne(GerenteGeneral::class);
    }

    public function sucursals() {
        return $this->hasMany(Sucursal::class);
    }

    public function productos() {
        return $this->hasMany(Producto::class);
    }

    public function productosExcepto($sucursal)
    {
        $productosEmpresa = $this->productos;
        $productos = array();

        foreach($productosEmpresa as $productoEmpresa)
        {
            if(!$productoEmpresa->estaEnSucursal($sucursal))
            {
                array_push($productos, $productoEmpresa);
            }
        }
        return $productos;
    }

    public function productosDeMarca($marca)
    {
        $productos = $this->productos;
        $productosDeMarca = array();

        foreach($productos as $producto)
        {
            if($producto->marca->id == $marca->id)
            {
                array_push($productosDeMarca, $producto);
            }
        }
        return $productosDeMarca;
    }
}

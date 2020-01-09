<?php

namespace App\Empresa\Sucursal;

use Illuminate\Database\Eloquent\Model;
use App\Empresa\Empresa;
use App\Empresa\Sucursal\Venta;
use App\Empresa\Sucursal\RegistroInventario;

class Sucursal extends Model
{
    public function empresa() {
        return $this->belongsTo(Empresa::class);
    }

    public function gerenteSucursal() {
        return $this->hasOne(GerenteSucursal::class);
    }

    public function bodegueros() {
        return $this->hasMany(Bodeguero::class);
    }

    public function cajeros() {
        return $this->hasMany(Cajero::class);
    }

    public function productoSucursals() {
        return $this->hasMany(ProductoSucursal::class);
    }

    public function ventas() {
        return $this->hasMany(Venta::class);
    }

    public function registroInventario() {
        return $this->hasMany(RegistroInventario::class);
    }

    public function ordenCompras() {
        return $this->hasMany(OrdenCompra::class);
    }

    public function productosDeProveedor($proveedor)
    {
        $productos = $this->productoSucursals;
        $productosDeProveedor = array();

        foreach($productos as $producto)
        {
            if($producto->producto->marca->proveedor->id == $proveedor->id)
            {
                array_push($productosDeProveedor, $producto);
            }
        }
        return $productosDeProveedor;
    }
}

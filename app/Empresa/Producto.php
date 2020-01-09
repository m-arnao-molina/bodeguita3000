<?php

namespace App\Empresa;

use Illuminate\Database\Eloquent\Model;
use App\Empresa\Empresa;
use App\Empresa\Marca;
use App\Empresa\Sucursal\ProductoSucursal;
use App\Empresa\Sucursal\DetalleVenta;
use App\Empresa\Sucursal\RegistroInventario;

class Producto extends Model
{

	protected $fillable = [
        'codigo', 'nombre', 'cont_neto', 'precio'
    ];

    public function empresa() {
        return $this->belongsTo(Empresa::class);
    }

    public function marca() {
        return $this->belongsTo(Marca::class);
    }

    public function productoSucursals() {
        return $this->hasMany(ProductoSucursal::class);
    }

    public function detalleVentas() {
        return $this->hasMany(DetalleVenta::class);
    }

    public function registroInventario() {
        return $this->hasMany(RegistroInventario::class);
    }

    public function productosOrdenCompra() {
        return $this->hasMany(ProductoOrdenCompra::class);
    }

    public function estaEnSucursal($sucursal)
    {
        $productoSucursales = $this->productoSucursals;

        foreach($productoSucursales as $productoSucursal)
        {
            if($productoSucursal->sucursal->id == $sucursal->id)
            {
                return true;
            }
        }
        return false;
    }
}

<?php

namespace App\Empresa\Sucursal;

use Illuminate\Database\Eloquent\Model;
use App\Empresa\Proveedor;
use App\Empresa\Sucursal\Sucursal;
use App\Empresa\Sucursal\ProductoOrdenCompra;

class OrdenCompra extends Model
{
    protected $fillable = [
        'fecha_realizacion', 'fecha_limite'
    ];

    public function proveedor() {
        return $this->belongsTo(Proveedor::class);
    }

    public function sucursal() {
        return $this->belongsTo(Sucursal::class);
    }

    public function productoOrdenCompras() {
        return $this->hasMany(ProductoOrdenCompra::class);
    }
}

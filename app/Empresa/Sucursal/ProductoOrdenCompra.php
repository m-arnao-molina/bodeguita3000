<?php

namespace App\Empresa\Sucursal;

use Illuminate\Database\Eloquent\Model;
use App\Empresa\Producto;
use App\Empresa\Sucursal\OrdenCompra;

class ProductoOrdenCompra extends Model
{
    protected $fillable = [
        'cantidad'
    ];

    public function producto() {
        return $this->belongsTo(Producto::class);
    }

    public function ordenCompra() {
        return $this->belongsTo(OrdenCompra::class);
    }
}

<?php

namespace App\Empresa\Sucursal;

use Illuminate\Database\Eloquent\Model;
use App\Empresa\Producto;
use App\Empresa\Sucursal\Venta;

class DetalleVenta extends Model
{
    protected $fillable = [
        'cantidad'
    ];

    public function producto() {
        return $this->belongsTo(Producto::class);
    }

    public function venta() {
        return $this->belongsTo(Venta::class);
    }
}

<?php

namespace App\Empresa\Sucursal;

use Illuminate\Database\Eloquent\Model;
use App\Empresa\Sucursal\Sucursal;
use App\Empresa\Sucursal\Cajero;
use App\Empresa\Sucursal\DetalleVenta;

class Venta extends Model
{
    protected $fillable = [
        'monto'
    ];

    public function sucursal() {
        return $this->belongsTo(Sucursal::class);
    }

    public function cajero() {
        return $this->belongsTo(Cajero::class);
    }

    public function detalleVentas() {
        return $this->hasMany(DetalleVenta::class);
    }
}

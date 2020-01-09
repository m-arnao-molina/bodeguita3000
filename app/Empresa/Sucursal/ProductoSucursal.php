<?php

namespace App\Empresa\Sucursal;

use Illuminate\Database\Eloquent\Model;
use App\Empresa\Producto;

class ProductoSucursal extends Model
{
    protected $fillable = [
        'stock_minimo'
    ];

    public function sucursal() {
        return $this->belongsTo(Sucursal::class);
    }

    public function producto() {
        return $this->belongsTo(Producto::class);
    }

    public function productos() {
        return $this->hasMany(Producto::class);
    }
}

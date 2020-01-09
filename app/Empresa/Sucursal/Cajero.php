<?php

namespace App\Empresa\Sucursal;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Empresa\Sucursal\Sucursal;
use App\Empresa\Sucursal\Venta;

class Cajero extends Model
{
    protected $fillable = [
        'p_nombre', 's_nombre', 'p_apellido', 's_apellido', 'rut'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function sucursal() {
        return $this->belongsTo(Sucursal::class);
    }

    public function ventas() {
        return $this->hasMany(Venta::class);
    }
}

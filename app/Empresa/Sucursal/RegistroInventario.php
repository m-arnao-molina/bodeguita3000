<?php

namespace App\Empresa\Sucursal;

use Illuminate\Database\Eloquent\Model;
use App\Empresa\Sucursal\Sucursal;
use App\Empresa\Sucursal\Bodeguero;
use App\Empresa\Producto;

class RegistroInventario extends Model
{
    public function sucursal() {
        return $this->belongsTo(Sucursal::class);
    }

    public function bodeguero() {
        return $this->belongsTo(Bodeguero::class);
    }

    public function producto() {
        return $this->belongsTo(Producto::class);
    }
}

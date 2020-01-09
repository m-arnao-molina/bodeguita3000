<?php

namespace App\Empresa;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Empresa\Empresa;

class GerenteGeneral extends Model
{
    protected $fillable = [
        'p_nombre', 's_nombre', 'p_apellido', 's_apellido', 'rut'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function empresa() {
        return $this->belongsTo(Empresa::class);
    }
}

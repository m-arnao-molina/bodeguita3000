<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Empresa\GerenteGeneral;
use App\Empresa\Sucursal\GerenteSucursal;
use App\Empresa\Sucursal\Bodeguero;
use App\Empresa\Sucursal\Cajero;

class User extends Authenticatable
{
    use Notifiable;
    const GERENTE_GENERAL_TYPE = 'g_general';
    const GERENTE_SUCURSAL_TYPE = 'g_sucursal';
    const BODEGUERO_TYPE = 'bodeguero';
    const CAJERO_TYPE = 'cajero';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email', 'password', 'type'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function habilitado() {
        return $this->habilitado;
    }

    public function esGerenteGeneral() {
        return $this->type === self::GERENTE_GENERAL_TYPE;
    }

    public function esGerenteSucursal() {
        return $this->type === self::GERENTE_SUCURSAL_TYPE;
    }

    public function esBodeguero() {
        return $this->type === self::BODEGUERO_TYPE;
    }

    public function esCajero() {
        return $this->type === self::CAJERO_TYPE;
    }

    public function gerenteGeneral() {
        return $this->hasOne(GerenteGeneral::class);
    }

    public function gerenteSucursal() {
        return $this->hasOne(GerenteSucursal::class);
    }

    public function bodeguero() {
        return $this->hasOne(Bodeguero::class);
    }

    public function cajero() {
        return $this->hasOne(Cajero::class);
    }
}
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

interface ControllerInterface
{
    /**
     * Retorna la vista a mostrar correspondiente.
     */
    public function vista();

    /**
     * Ejecuta la acción que tiene como propósito la vista.
     */
    public function accion(Request $request);
}

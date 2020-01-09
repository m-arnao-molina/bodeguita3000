<?php $datos = Auth::user()->gerenteSucursal; ?>

<b>{{ $datos->p_nombre }} {{ $datos->p_apellido}}</b><br>
Gerente Sucursal N° {{ $datos->sucursal->numero }}<br>
Empresa {{ $datos->sucursal->empresa->nombre }}
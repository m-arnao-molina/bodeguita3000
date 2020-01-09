<?php $datos = Auth::user()->cajero; ?>

<b>{{ $datos->p_nombre }} {{ $datos->p_apellido}}</b><br>
Cajero Sucursal N° {{ $datos->sucursal->numero }}<br>
Empresa {{ $datos->sucursal->empresa->nombre }}
<?php $datos = Auth::user()->bodeguero; ?>

<b>{{ $datos->p_nombre }} {{ $datos->p_apellido}}</b><br>
Bodeguero Sucursal N° {{ $datos->sucursal->numero }}<br>
Empresa {{ $datos->sucursal->empresa->nombre }}
<?php $datos = Auth::user()->gerenteGeneral; ?>

<b>{{ $datos->p_nombre }} {{ $datos->p_apellido}}</b><br>
Gerente General<br>
Empresa {{ $datos->empresa->nombre }}
<div class="row mb-4">
    <div class="col-md-6">
        <div class="card text-secondary border-info">
            <div class="card-header">Información Personal</div>
            <div class="card-body">
                <table class="table-sm">
                    <tr>
                        <td style="min-width: 100px;"><b>RUT</b></td>
                        <td>{{ $datosPersonales->rut }}</td>
                    </tr>
                    <tr>
                        <td><b>Nombre</b></td>
                        <td>{{ $datosPersonales->p_nombre }} {{ $datosPersonales->s_nombre }}</td>
                    </tr>
                    <tr>
                        <td><b>Apellido</b></td>
                        <td>{{ $datosPersonales->p_apellido }} {{ $datosPersonales->s_apellido }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card text-secondary border-info">
        <div class="card-header">Perfil de Usuario</div>
            <div class="card-body">
                <table class="table-sm">
                    <tr>
                        <td style="min-width: 100px;"><b>E-mail</b></td>
                        <td>{{ $datosUsuario->email }}</td>
                    </tr>
                    <tr>
                        <td><b>Cargo</b></td>
                        @if(auth()->user()->esGerenteGeneral())
                            <td>Gerente General</td>
                        @elseif(auth()->user()->esGerenteSucursal())
                            <td>Gerente de Sucursal</td>
                        @elseif(auth()->user()->esBodeguero())
                            <td>Bodeguero</td>
                        @elseif(auth()->user()->esCajero())
                            <td>Cajero</td>
                        @endif
                    </tr>
                    <tr>
                        <td><b>Habilitado</b></td>
                        @if($datosUsuario->habilitado)
                            <td>Si</td>
                        @else
                            <td>No</td>
                        @endif
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card text-secondary border-info">
            <div class="card-header">Lugar de Trabajo</div>
            <div class="card-body">
                <table class="table-sm">
                    <tr>
                        <td style="min-width: 100px;"><b>Empresa</b></td>
                        <td>{{ $datosEmpresa->nombre }}</td>
                    </tr>
                    <tr>
                        <td><b>RUT</b></td>
                        <td>{{ $datosEmpresa->rut }}</td>
                    </tr>
                    @if(! auth()->user()->esGerenteGeneral())
                        <tr>
                            <td><b>Sucursal</b></td>
                            <td>N°{{ $datosSucursal->numero }} - {{ $datosSucursal->nombre }}</td>
                        </tr>
                        <tr>
                            <td><b>Dirección</b></td>
                            <td>{{ $datosSucursal->direccion }}</td>
                        </tr>
                        <tr>
                            <td><b>Fono</b></td>
                            <td>{{ $datosSucursal->telefono }}</td>
                        </tr>
                    @endif
                </table>
            </div>
        </div>
    </div>
</div>
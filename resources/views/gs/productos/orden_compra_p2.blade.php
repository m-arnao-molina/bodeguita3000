@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="card border-info">
        <div class="card-header">
            <div class="row">
                <div class="col-md-9">Crear Una Orden de Compra</div>
                <div class="col-md-3">
                    <div class="progress mt-1">
                        <div class="progress-bar" role="progressbar" style="width:66%"><span>Paso 2</span> </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            @include('layouts.errores')

            <form method="POST" action="paso_3">
                @csrf
                
                <table id="tabla-productos" class="table table-striped table-sm table-hover">
                    <thead class="table-primary">
                        <tr>
                            <th class="align-middle">Codigo</th>
                            <th class="align-middle">Nombre</th>
                            <th class="align-middle">Marca</th>
                            <th class="align-middle">Cont. Neto</th>
                            <th class="align-middle">Stock Actual</th>
                            <th class="align-middle">Stock Mínimo</th>
                            <th class="align-middle">Cantidad</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($productos as $producto)
                            <tr>
                                <td class="align-middle">{{ $producto->producto->codigo }}</td>
                                <td class="align-middle">{{ $producto->producto->nombre }}</td>
                                <td class="align-middle">{{ $producto->producto->marca->nombre }}</td>
                                <td class="align-middle">{{ $producto->producto->cont_neto }}</td>
                                <td class="align-middle">{{ $producto->stock_actual }}</td>
                                <td class="align-middle">{{ $producto->stock_minimo }}</td>
                                <td class="align-middle text-center">
                                    <input type="number" min="1" class="form-control form-control-sm" name="cantidad[{{ $producto->producto_id }}]" value="1" required>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="form-group text-right mt-3 mb-0">
                    <button type="submit" class="btn btn-primary">
                        {{ __('Siguiente Paso') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    $('#tabla-productos').DataTable({
        "lengthChange": false,
        "pageLength": 10,
        "processing": true,
        "searching": false,

        "language": {
            "sProcessing":     "Procesando...",
            "sLengthMenu":     "Mostrar _MENU_ registros",
            "sZeroRecords":    "No se encontraron resultados",
            "sEmptyTable":     "Ningún dato disponible en esta tabla",
            "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
            "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
            "sInfoPostFix":    "",
            "sSearch":         "Buscar:",
            "sUrl":            "",
            "sInfoThousands":  ",",
            "sLoadingRecords": "Cargando...",
            "oPaginate": {
                "sFirst":    "Primero",
                "sLast":     "Último",
                "sNext":     "Siguiente",
                "sPrevious": "Anterior"
            },
            "oAria": {
                "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            }
        }
    });
</script>
@endsection
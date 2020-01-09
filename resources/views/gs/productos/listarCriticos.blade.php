@extends('layouts.app')

@section('content')
<div class='container-fluid'>
    <div class="card border-info">
        <div class="card-header">Productos Con Bajo Stock</div>
            <div class="card-body">
                <table id="productosBajoStock" class="table table-striped table-sm table-hover">
                    <thead class="table-primary">
                        <tr>
                            <th class="align-middle">Codigo</th>
                            <th class="align-middle">Nombre</th>
                            <th class="align-middle">Stock Actual</th>
                            <th class="align-middle">Stock Mínimo</th>
                            <th class="align-middle" hidden>Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($productosBajoStock as $producto)
                            <tr>
                                <td class="align-middle">{{ $producto->producto->codigo }}</td>
                                <td class="align-middle">{{ $producto->producto->nombre }}</td>
                                <td class="align-middle">{{ $producto->stock_actual }}</td>
                                <td class="align-middle">{{ $producto->stock_minimo }}</td>
                                <td class="align-middle text-center" hidden>
                                    <input type="button" value="Generar Orden de Compra" class="btn btn-primary"
                                    onclick=""/>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    const TABLA_DATOS = $('#productosBajoStock').DataTable({
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
                "sInfoFiltered":   "(filtrado de un total de MAX registros)",
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

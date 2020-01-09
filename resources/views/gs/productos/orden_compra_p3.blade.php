@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="card border-info">
        <div class="card-header">
            <div class="row">
                <div class="col-md-9">Crear Una Orden de Compra</div>
                <div class="col-md-3">
                    <div class="progress mt-1">
                        <div class="progress-bar" role="progressbar" style="width:100%"><span>Paso 3</span> </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            @include('layouts.errores')
            
            <form id="confirmar_orden" method="POST" action="confirmar_orden">
                @csrf

                <div class="form-group row">
                    <label for="proveedor" class="col-md-4 col-form-label text-md-right">{{ __('Proveedor') }}</label>
                    <div class="col-md-6">
                        <input id="proveedor" type="text" class="form-control" value="{{ $ordenCompra->proveedor->nombre }}" disabled>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="fecha_realizacion" class="col-md-4 col-form-label text-md-right">{{ __('Fecha de Solicitud') }}</label>

                    <div class="col-md-6">
                        <input id="fecha_realizacion" type="date" class="form-control" name="fecha_realizacion" value="{{ date('Y-m-d') }}" required>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="fecha_limite" class="col-md-4 col-form-label text-md-right">{{ __('Fecha de Entrega (Plazo)') }}</label>

                    <div class="col-md-6">
                        <input id="fecha_limite" type="date" class="form-control" name="fecha_limite" value="{{ date('Y-m-d', strtotime ('+ 1 week'))}}" required>
                    </div>
                </div>
            </form>
            
            <table id="tabla-productos" class="table table-striped table-sm table-hover mt-5">
                <thead class="table-primary">
                    <tr>
                        <th class="align-middle">Codigo</th>
                        <th class="align-middle">Nombre</th>
                        <th class="align-middle">Marca</th>
                        <th class="align-middle">Cont. Neto</th>
                        <th class="align-middle">Cantidad</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($productosOrdenCompra as $producto)
                        <tr>
                            <td class="align-middle">{{ $producto->producto->codigo }}</td>
                            <td class="align-middle">{{ $producto->producto->nombre }}</td>
                            <td class="align-middle">{{ $producto->producto->marca->nombre }}</td>
                            <td class="align-middle">{{ $producto->producto->cont_neto }}</td>
                            <td class="align-middle">{{ $producto->cantidad }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="form-group text-right mt-3 mb-0">
                <button form="confirmar_orden" type="submit" class="btn btn-primary" name="productos" onclick="mostrarMensaje()">
                    {{ __('Confirmar Orden') }}
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div id="mensaje_modal">Espere un momento mientras se genera la Orden de Compra en un documento PDF.</div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Entendido</button>
            </div>
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

    function mostrarMensaje()
    {
        $("#modal").modal('show');
    }
</script>
@endsection
@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-5">
            <div class="card border-info">
                <div class="card-header">Registrar Producto en la Sucursal</div>
                <div class="card-body">
                    @include('layouts.errores')
                    <form method="POST" action="registrar">
                        @csrf

                        <div class="form-group row">
                            <label for="codigo" class="col-md-4 col-form-label text-md-right">{{ __('Código') }}</label>
                            <div class="col-md-6">
                                <input id="codigo" type="text" class="form-control" value="{{ old('codigo') }}" disabled>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="stock_minimo" class="col-md-4 col-form-label text-md-right">{{ __('Stock Mínimo') }}</label>

                            <div class="col-md-6">
                                <input id="stock_minimo" type="number" min="0" class="form-control{{ $errors->has('stock_minimo') ? ' is-invalid' : '' }}" name="stock_minimo" required>

                                @if ($errors->has('stock_minimo'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('stock_minimo') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div>
                            <input type="hidden" id="producto_id" name="producto_id" value="">
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Registrar') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-7">
            <div class="card border-info">
                <div class="card-header">
                    Lista de Productos no Registrados en la Sucursal
                </div>
                <div class="card-body">
                    <table id="example" class="table table-striped table-sm table-hover">
                        <thead class="table-primary">
                            <tr>
                                <th class="align-middle">Codigo</th>
                                <th class="align-middle">Nombre</th>
                                <th class="align-middle">Marca</th>
                                <th class="align-middle">Cont. Neto</th>
                                <th class="align-middle">Precio Venta</th>
                                <th class="align-middle">Registrar</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($productos as $producto)
                                <tr>
                                    <td class="align-middle">{{ $producto->codigo }}</td>
                                    <td class="align-middle">{{ $producto->nombre }}</td>
                                    <td class="align-middle">{{ $producto->marca->nombre }}</td>
                                    <td class="align-middle">{{ $producto->cont_neto }}</td>
                                    <td class="align-middle">{{ $producto->precio }}</td>
                                    <td class="align-middle text-center">
                                        <button onclick="Registrar({{ $producto->id }}, {{ $producto->codigo }})" class="btn btn-outline-primary btn-sm">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function Registrar(prod_id, prod_codigo)
    {
        var producto_id = document.getElementById("producto_id");
        producto_id.value = prod_id;

        var codigo = document.getElementById("codigo");
        codigo.value = prod_codigo;
    }

    $(document).ready(function() {
        $('#example').DataTable({
            "lengthChange": false,
            "pageLength": 10,
            "processing": true,
            "searching": true,

            "language": {
                "sProcessing":     "Procesando...",
                "sLengthMenu":     "Mostrar _MENU_ registros",
                "sZeroRecords":    "No se encontraron resultados",
                "sEmptyTable":     "Ningún dato disponible en esta tabla",
                "sInfo":           "Registros del _START_ al _END_ de un total de _TOTAL_ registros",
                "sInfoEmpty":      "Registros del 0 al 0 de un total de 0 registros",
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
    });
</script>
@endsection

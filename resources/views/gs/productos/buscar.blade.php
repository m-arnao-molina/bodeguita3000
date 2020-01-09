@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="card border-info">
            <div class="card-header">Buscar Productos</div>
            <div class="card-body">
                <div class="text-center">
                    <h5>¿Dónde desea realizar su busqueda?</h5>

                    <div class="btn-group btn-group-toggle" role="group" data-toggle="buttons">
                        <label class="btn btn-primary active">
                            <input value="Empresa" type="radio" name="options" checked> Empresa
                        </label>
                        <label class="btn btn-primary">
                            <input value="Sucursal" type="radio" name="options"> Sucursal
                        </label>
                    </div>
                </div>

                <div class="text-right mb-1">
                    <a href="#" id="ayuda-popover" title="Ayuda"
                       data-content="Ingrese algún dato del producto a buscar. Puede ser el código, descripción, marca, etc."
                       data-trigger="hover"
                       data-toggle="popover">
                        <i class="fas fa-info-circle" style="font-size: 22px"></i>
                    </a>
                </div>

                <div class="input-group mb-3">
                    <input id="search-field" type="search" class="form-control ds-input" placeholder="Código, marca, descripción...">
                    <div class="input-group-append">
                        <button class="btn btn-primary" onclick="buscar()">Buscar</button>
                    </div>
                </div>

                <table id="searchTable" class="table table-striped table-sm table-hover">
                    <thead class="table-primary">
                        <tr>
                            <th class="align-middle">Código</th>
                            <th class="align-middle">Nombre</th>
                            <th class="align-middle">Marca</th>
                            <th class="align-middle">Contenido Neto</th>
                            <th class="align-middle">Precio</th>
                        </tr>
                    </thead>
                    <tbody id="table-body">
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(function () {
            $('#ayuda-popover').popover();
        });

        const TABLA_DATOS = $('#searchTable').DataTable({
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

        function buscar() {

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "buscar",
                method: "POST",
                data: {
                    'valor': $('#search-field').val(),
                    'tipo-busqueda': $('label.active > input').val()
                },
                dataType: "json",
                success: function (response) {

                    TABLA_DATOS.clear();

                    response.forEach(function (elemento) {

                        if (elemento['marca'] == null)
                            elemento['marca'] = '';

                        TABLA_DATOS.row.add([elemento['codigo'], elemento['nombre'], elemento['marca'], elemento['cont_neto'], elemento['precio']])

                    });

                    TABLA_DATOS.draw();
                }
            });
        }
    </script>
@endsection

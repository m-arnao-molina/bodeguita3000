@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="card border-info">
            <div class="card-header">Registrar Venta</div>
            <div class="card-body">
                <div class="d-flex mb-3">
                    <input id="codigo" type="search" class="form-control ds-input col-2" placeholder="Código de barras">

                    <div class="input-group col-3 mr-auto">
                        <input id="cantidad" type="number" min="1" class="form-control ds-input" placeholder="Cantidad">
                        <div class="input-group-append">
                            <button class="btn btn-primary" onclick="agregar()">Agregar</button>
                        </div>
                    </div>

                    <button id="btn-cancelar-venta" class="btn btn-danger col-auto" onclick="cancelar()" disabled>Cancelar Venta</button>
                    <input id="venta_id" type="hidden" value="">
                </div>

                <table id="productTable" class="table table-striped table-sm table-hover">
                    <thead class="table-primary">
                        <tr>
                            <th class="th-sm">Código</th>
                            <th class="th-sm">Nombre</th>
                            <th class="th-sm">Marca</th>
                            <th class="th-sm">Contenido Neto</th>
                            <th class="th-sm">Precio</th>
                            <th class="th-sm">Cantidad</th>
                            <th class="th-sm">Sub-total</th>
                            <th class="th-sm">Acción</th>
                        </tr>
                    </thead>
                    <tbody id="table-body">
                    </tbody>
                </table>
                <div class="mt-3 text-right">
                    <h4>Total: <div id="total">0</div></h4>
                </div>
                <div class="row mt-3">
                    <div class="col-md-6 text-left">
                        <button id="btn-limpiar" class="btn btn-primary mt-2" onclick="limpiar()" disabled>Realizar Otra Venta</button>
                    </div>
                    <div class="col-md-6 text-right">
                        <button id="btn-finalizar-venta" class="btn btn-success mt-2" onclick="registrar()" disabled>Finalizar Venta</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div id="mensaje_modal"></div>
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

        const TABLA_DATOS = $('#productTable').DataTable({
            lengthChange: false,
            processing: true,
            searching: false,
            paging: false,
            info: false,
            scrollY: "300px",
            scrollCollapse: true,
            ordering: false,

            /*
            * 0: codigo
            * 1: nombre
            * 2: marca
            * 3: neto
            * 4: precio
            * 5: cantidad
            * 6: sub-total
            * 7: accion
            */
            columnDefs: [
                { orderable: true, className: "align-middle", targets: 0 },
                { orderable: true, className: "align-middle", targets: 1 },
                { orderable: true, className: "align-middle", targets: 2 },
                { orderable: true, className: "align-middle", targets: 3 },
                { orderable: true, className: "align-middle", targets: 4 },
                { orderable: true, className: "align-middle", targets: 5 },
                { orderable: true, className: "align-middle", targets: 6 },
                { orderable: false, className: "align-middle text-center", width:"30px", defaultContent: '<button class="btn btn-outline-primary btn-sm eliminar"><i class="far fa-trash-alt"></i></button>', targets: 7 }
            ],

            language: {
                "sProcessing":     "Procesando...",
                "sLengthMenu":     "Mostrar _MENU_ registros",
                "sZeroRecords":    "No se encontraron resultados",
                "sEmptyTable":     "Ingrese un producto",
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

        // Agrega acción al boton eliminar de la tabla.
        $('#productTable tbody').on( 'click', 'button', function () {

            // Obtiene los datos de la fila que corresponde al boton presionado.
            const data = TABLA_DATOS.row( $(this).parents('tr') ).data();
            var celda = this;

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "eliminar",
                method: "POST",
                data: {
                    'codigo': data[0]
                },
                dataType: "json",

                success: function (response) {

                    TABLA_DATOS.row( $(celda).parents('tr') ).remove().draw();
                    $('#total').text(response.total);
                    
                    if(response.total == 0)
                    {
                        $('#btn-finalizar-venta').prop("disabled", true);
                        $('#btn-cancelar-venta').prop("disabled", true);
                        $('#btn-limpiar').prop("disabled", true);
                    }
                }
            });
        });

        /**
         * Limpia la tabla.
         */
        function cancelar() {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "cancelar",
                method: "POST",
                data: {
                    'venta_id': $('#venta_id').val()
                },
                dataType: "json",

                success: function (response) {

                    TABLA_DATOS.clear();
                    TABLA_DATOS.draw();
                    $('#total').text(0);
                    $('#venta_id').val(null);
                    $('#btn-finalizar-venta').prop("disabled", true);
                    $('#btn-cancelar-venta').prop("disabled", true);
                    $('#btn-limpiar').prop("disabled", true);
                },
            });
        }

        function limpiar() {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "limpiar",
                method: "POST",
                dataType: "json",

                success: function (response) {

                    TABLA_DATOS.clear();
                    TABLA_DATOS.draw();
                    $('#total').text(0);
                    $('#venta_id').val(null);
                    $('#btn-finalizar-venta').prop("disabled", true);
                    $('#btn-cancelar-venta').prop("disabled", true);
                    $('#btn-limpiar').prop("disabled", true);
                },
            });
        }

        /**
         * Busca el producto en la bd y lo agrega a la tabla.
         */
        function agregar() {

            if(!$('#codigo').val() || !$('#cantidad').val())
            {
                return;
            }

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "agregar",
                method: "POST",
                data: {
                    'codigo': $('#codigo').val(),
                    'cantidad': $('#cantidad').val()
                },
                dataType: "json",

                success: function (response) {

                    if(response.error)
                    {
                        $('#mensaje_modal').text(response.mensajeError);
                        $('#modal').modal('show');
                        return;
                    }

                    var index = TABLA_DATOS.column(0).data().indexOf($('#codigo').val());
                    // Valida si existe o no el producto en la lista.

                    if (index >= 0) {

                        TABLA_DATOS.cell(index, 5).data(response.cantidad);
                        TABLA_DATOS.cell(index, 6).data(response.subtotal);

                    } else {
                        TABLA_DATOS.row.add([
                            response.codigo,
                            response.nombre,
                            response.marca,
                            response.cont_neto,
                            response.precio,
                            response.cantidad,
                            response.subtotal
                        ]).node().id = response.codigo;
                    }

                    TABLA_DATOS.draw();
                    $('#total').text(response.total);
                    $('#btn-finalizar-venta').prop("disabled", false);
                    $('#btn-cancelar-venta').prop("disabled", false);
                }
            });
        }

        /**
         * Registra la venta en la base de datos.
         */
        function registrar() {

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "registrar",
                method: "POST",
                dataType: "json",

                success: function (response) {
                    
                    $('#mensaje_modal').text(response.mensajeError);
                    $('#modal').modal('show');
                    $('#venta_id').val(response.venta_id);
                    $('#btn-finalizar-venta').prop("disabled", true);
                    $('.eliminar').prop("disabled", true);
                    $('#btn-limpiar').prop("disabled", false);
                }
            });
        }
    </script>
@endsection

@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        
        <div class="col-md-12">
            <div class="card border-info">
                <div class="card-header">
                    Lista de Productos Registrados en la Sucursal 
                </div>
                <div class="card-body">
                    <table id="example" class="table table-striped table-sm table-hover">
                        <thead class="table-primary">
                            <tr>
                                <th class="align-middle">Codigo</th>
                                <th class="align-middle">Nombre</th>
                                <th class="align-middle">Marca</th>
                                <th class="align-middle">Stock Ingresado</th>
                                <th class="align-middle">Bodeguero</th>
                                <th class="align-middle">Accion</th>
                                <th class="align-middle">Fecha Ingreso</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($productos as $producto)
                            <tr>
                                <td class="align-middle">{{ $producto->producto->codigo }}</td>
                                <td class="align-middle">{{ $producto->producto->nombre }}</td>
                                <td class="align-middle">{{ $producto->producto->marca->nombre }}</td>
                                <td class="align-middle">{{ $producto->cantidad }}</td>
                                <td class="align-middle">{{ $producto->bodeguero->p_nombre.' '.$producto->bodeguero->p_apellido }}</td>
                                <td class="align-middle">{{ $producto->accion }}</td>
                                <td class="align-middle">{{ $producto->created_at->format('d-m-Y / H:i') }}</td>
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
    function Modificar(obj)
    {
        productoSucursal = JSON.parse(obj);

        var codigo = document.getElementById("codigo");
        codigo.value = productoSucursal.producto.codigo;

        var stock_minimo = document.getElementById("stock_minimo");
        stock_minimo.value = productoSucursal.stock_minimo;

        var producto_id = document.getElementById("producto_id");
        producto_id.value = productoSucursal.id;
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

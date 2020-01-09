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

function cargarProductosProveedor()
{
    var selecProveedor = document.getElementById("proveedor_id"),
        tablaProductos = document.getElementById("tabla-productos"),
        tablaProductosBody = document.getElementById("tabla-productos-body");
        proveedor_id = selecProveedor.value,
        params = {
            "proveedor_id"    : proveedor_id
        };

    if(!proveedor_id)
    {
        return;
    }

    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
        },
        
        url			: 'paso_1/prod_proveedor',
        method		: 'GET',
        data		: params,
        dataType	: 'json',
        
        success		: function (respServidor) {

            limpiarTabla();
            console.log(respServidor);
            completarTabla(respServidor);
        }
    });

    function completarTabla(productos)
    {
        productos.forEach(function(producto) {

            var fila = document.createElement("tr"),
                celdaCodigo = document.createElement("td"),
                celdaNombre = document.createElement("td"),
                celdaMarca = document.createElement("td"),
                celdaContNeto = document.createElement("td"),
                celdaStockAct = document.createElement("td"),
                celdaStockMin = document.createElement("td"),
                celdaSeleccion = document.createElement("td"),
                codigo = document.createTextNode(producto.producto.codigo),
                nombre = document.createTextNode(producto.producto.nombre),
                marca = document.createTextNode(producto.producto.marca.nombre),
                contNeto = document.createTextNode(producto.producto.cont_neto),
                stockAct = document.createTextNode(producto.stock_actual),
                stockMin = document.createTextNode(producto.stock_minimo),
                seleccion = document.createElement("input");

            celdaCodigo.appendChild(codigo);
            celdaNombre.appendChild(nombre);
            celdaMarca.appendChild(marca);
            celdaContNeto.appendChild(contNeto);
            celdaStockAct.appendChild(stockAct);
            celdaStockMin.appendChild(stockMin);
            
            seleccion.setAttribute("type", "checkbox");
            seleccion.setAttribute("value", producto.producto.id);
            seleccion.setAttribute("name", "producto_id[]");
            celdaSeleccion.appendChild(seleccion);

            fila.appendChild(celdaCodigo);
            fila.appendChild(celdaNombre);
            fila.appendChild(celdaMarca);
            fila.appendChild(celdaContNeto);
            fila.appendChild(celdaStockAct);
            fila.appendChild(celdaStockMin);
            fila.appendChild(celdaSeleccion);
            tablaProductosBody.appendChild(fila);
        });
    }

    function limpiarTabla()
    {
        while(tablaProductos.rows.length > 1)
            tablaProductos.deleteRow(1);
    }
}
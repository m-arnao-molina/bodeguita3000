$("#marca_id").change(function(event)
{
    var marca_id = event.target.value,
        params = {
            "marca_id"    : marca_id
        };

    if(!marca_id)
    {
        return;
    }

    configurarSelecProducto();

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });

    $.ajax({
        data		: params,
        url			: 'vista_estadisticas/prod_empresa',
        dataType	: 'json',
        method		: 'GET',

        success		: function (respServidor) {

			completarSelecProducto(respServidor);
        }
    });

    function completarSelecProducto(productos)
    {
        var selectProductos = document.getElementById("producto_id");

        productos.forEach(function(producto) {
            var opcion = document.createElement("option"),
                valor = document.createTextNode(producto.nombre);

            opcion.appendChild(valor);
            opcion.setAttribute("value", producto.id);

            selectProductos.appendChild(opcion);
        });
    }

    function configurarSelecProducto()
    {
		var selectMarca = document.getElementById("marca_id"),
			selectProductos = document.getElementById("producto_id");

        function limpiaSelectProducto()
        {
            while(selectProductos.length > 1)
                selectProductos.remove(1);
        };

        limpiaSelectProducto();

        if(!selectMarca.value)
        {
            selectProductos.setAttribute("disabled","");
            return;
        }
        selectProductos.removeAttribute("disabled");
    };
});
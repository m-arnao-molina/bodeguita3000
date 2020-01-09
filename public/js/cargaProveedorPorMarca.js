$("#proveedor_id").change(function(event)
{
    var proveedor_id = event.target.value,
        params = {
            "proveedor_id"    : proveedor_id
        };
    
    if(!proveedor_id)
    {
        return;
    }

    configurarSelecMarca();
    
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });

    $.ajax({
        data		: params,
        url			: 'marcas',
        dataType	: 'json',
        method		: 'GET',

        success		: function (respServidor) {
            
			completarSelecMarca(respServidor);
        }
    });

    function completarSelecMarca(marcas)
    {
        var selecMarca = document.getElementById("marca_id");

        marcas.forEach(function(marca) {
            var opcion = document.createElement("option"),
                valor = document.createTextNode(marca.nombre);
                
            opcion.appendChild(valor);
            opcion.setAttribute("value", marca.id);

            selecMarca.appendChild(opcion);
        });	
    }

    function configurarSelecMarca()
    {
		var selecProveedor = document.getElementById("proveedor_id"),
			selecMarca = document.getElementById("marca_id");

        function limpiaSelecMarca()
        {    
            while(selecMarca.length > 1)
                selecMarca.remove(1);
        };
        
        limpiaSelecMarca();

        if(!selecProveedor.value)
        {
            selecMarca.setAttribute("disabled","");
            return;
        }

        selecMarca.removeAttribute("disabled");
    };
});
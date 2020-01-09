function cargarSucursales()
{
    var selecEmpresa = document.getElementById("empresa_id"),
        selecSucursal = document.getElementById("sucursal_id"),
        empresa_id = selecEmpresa.value,
        params = {
            "empresa_id"    : empresa_id
        };
    
    if(!empresa_id)
    {
        return;
    }

    configurarSelecSucursal();
    
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });

    $.ajax({
        data		: params,
        url			: 'selec_sucursales',
        dataType	: 'json',
        method		: 'GET',

        success		: function (respServidor) {

            completarSelecSucursal(respServidor);
        }
    });

    function completarSelecSucursal(sucursales)
    {
        selecSucursal = document.getElementById("sucursal_id");

        sucursales.forEach(function(sucursal) {
            var opcion = document.createElement("option"),
                valor = document.createTextNode(sucursal.numero + " - " + sucursal.nombre);
                
            opcion.appendChild(valor);
            opcion.setAttribute("value", sucursal.id);

            selecSucursal.appendChild(opcion);
        });	
    }

    function configurarSelecSucursal()
    {    
        function limpiaSelecSucursales()
        {    
            while(selecSucursal.length > 1)
                selecSucursal.remove(1);
        };
        
        limpiaSelecSucursales();

        if(!selecEmpresa.value)
        {
            selecSucursal.setAttribute("disabled","");
            return;
        }

        selecSucursal.removeAttribute("disabled");
    };
}
function cargarDatosProducto()
{
    var campoCodigo = document.getElementById("codigo"),
        campoCantidad = document.getElementById("cantidad"),
        botonCantidad = document.getElementById("btnCantidad"),
        codigo = campoCodigo.value,
        params = {
            "codigo"    : codigo
        };

    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
        },
        
        url			: 'prod_sucursal',
        method		: 'GET',
        data		: params,
        dataType	: 'json',
        
        success		: function (respServidor) {

            if(!respServidor.error)
            {
                completarCamposProducto(respServidor);
                configurarBotonCampoCantidad(true);

            } else {

                limpiarCamposProducto();
                configurarBotonCampoCantidad(false);
                mostrarMensajeError(respServidor.mensajeError);
            }
        }
    });

    function completarCamposProducto(respServidor)
    {
        campoCodigo = document.getElementById("codigo");
        campoNombre = document.getElementById("nombre");
        campoMarca = document.getElementById("marca");
        campoContenido = document.getElementById("contenido");
        campoProveedor = document.getElementById("proveedor");
        campoFecha = document.getElementById("fecha");

        campoCodigo.value = respServidor.datosProducto.codigo;
        campoNombre.value = respServidor.datosProducto.nombre;
        campoMarca.value = respServidor.marca.nombre;
        campoContenido.value = respServidor.datosProducto.cont_neto;
        campoProveedor.value = respServidor.proveedor.nombre;
        campoFecha.value = respServidor.fecha.mday +"/"+ respServidor.fecha.mon +"/"+ respServidor.fecha.year;
    }

    function limpiarCamposProducto()
    {
        document.getElementById("nombre").value = "";
        document.getElementById("marca").value = "";
        document.getElementById("contenido").value = "";
        document.getElementById("proveedor").value = "";
        document.getElementById("fecha").value = "";
    }

    function configurarBotonCampoCantidad(activar)
    {
        if(activar)
        {
            campoCantidad.removeAttribute("disabled");
            botonCantidad.removeAttribute("disabled");

        } else {
            campoCantidad.setAttribute("disabled","");
            botonCantidad.setAttribute("disabled","");
        }
    };

    function mostrarMensajeError(mensaje)
    {
        $("#mensaje_modal").text(mensaje);
        $("#modal").modal('show');
    }
}
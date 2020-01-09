function enviarCodigoProducto()
{
    var campoCodigo = document.getElementById("codigo"),
        campoCantidad = document.getElementById("cantidad"),
        codigo = campoCodigo.value,
        cantidad = campoCantidad.value,
        params = {
            "codigo"    : codigo,
            "cantidad"  : cantidad
        };

    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
        },
        
        url			: 'ingresar',
        method		: 'GET',
        data		: params,
        dataType	: 'json',
        
        success		: function (respServidor) {

            mostrarMensajeRespuesta(respServidor);
            $('#cantidad').val(null);
        }
    });

    function mostrarMensajeRespuesta(mensaje)
    {
        $("#mensaje_modal").text(mensaje);
        $("#modal").modal('show');
    }
}
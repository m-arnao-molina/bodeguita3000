<!DOCTYPE html>
<html>
    <head>
        <title>Generando PDF</title>
        
        <link href="https://fonts.googleapis.com\css?family=Nunito:200,600" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        
        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
            h2 {
                font-family: 'Nunito', sans-serif;
            }
        </style>
    </head>

    <body>
        <div class="row">
            <div class="col-md-6 text-right">
                <h2>Orden de Compra a Proveedor</h2>
                <p>Fecha Emisión: {{ date('d-m-Y', strtotime($ordenCompra->fecha_realizacion)) }}</p>
                <p>Fecha Límite: {{ date('d-m-Y', strtotime($ordenCompra->fecha_limite)) }}</p>
            </div>
        </div>
        <hr>
        <table class="table table-striped table-bordered">
            <tr>
                <th class="bg-warning text-center" colspan="4">Datos de la Sucursal</th>
            </tr>
            <tr>
                <th class="table-warning">Empresa</th>
                <td>{{ $ordenCompra->sucursal->empresa->nombre }}</td>
                <th class="table-warning">RUT Empresa</th>
                <td>{{ $ordenCompra->sucursal->empresa->rut }}</td>
            </tr> 
            <tr>   
                <th class="table-warning">Número</th>
                <td>{{ $ordenCompra->sucursal->numero }}</td>
                <th class="table-warning">Nombre</th>
                <td>{{ $ordenCompra->sucursal->nombre }}</td>
            </tr>
            <tr>
                <th class="table-warning">Direccion</th>
                <td>{{ $ordenCompra->sucursal->direccion }}</td>
                <th class="table-warning">Teléfono</th>
                <td>{{ $ordenCompra->sucursal->telefono }}</td>
            </tr>
        </table>
        <br>
        <table class="table table-striped table-bordered">
            <tr>
                <th class="bg-warning text-center" colspan="4">Datos del Proveedor</th>
            </tr>
            <tr>
                <th class="table-warning">Nombre</th>
                <td>{{ $ordenCompra->proveedor->nombre }}</td>
                <th class="table-warning">Email Contacto</th>
                <td>{{ $ordenCompra->proveedor->email }}</td>
            </tr>
        </table>
        <br>
        <table class="table table-striped table-bordered">
            <thead class="table-warning">
                <tr>
                    <th class="bg-warning text-center" colspan="5">Productos Solicitados</th>
                </tr>
                <tr>
                    <th>Codigo</th>
                    <th>Nombre</th>
                    <th>Marca</th>
                    <th>Cont. Neto</th>
                    <th>Cantidad</th>
                </tr>
            </thead>
            <tbody>
                
                @foreach($ordenCompra->productoOrdenCompras as $producto)
                    <tr>
                        <td>{{ $producto->producto->codigo }}</td>
                        <td>{{ $producto->producto->nombre }}</td>
                        <td>{{ $producto->producto->marca->nombre }}</td>
                        <td>{{ $producto->producto->cont_neto }}</td>
                        <td>{{ $producto->cantidad }}</td>
                    </tr>
                @endforeach
                
            </tbody>
        </table>
        <br>
         <div class="row">
            <div class="col-md-6 text-center">
                <p>**Si tiene alguna pregunta sobre este pedido contactar vía telefónica a la brevedad**</p>
            </div>
        </div>
    </body>
</html>
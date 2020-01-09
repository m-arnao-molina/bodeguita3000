@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="card border-info">
        <div class="card-header">Ingresar Unidades de Producto</div>
        <div class="card-body">
            @include('layouts.errores')
            <div class="form-group row justify-content-center">
                <div class="col-md-4">
                    <label for="codigo">{{ __('Código') }}</label>
                    
                    <div class="input-group mb-3">
                        <input type="text" name="codigo" id="codigo" class="form-control">
                        <div class="input-group-append">
                            <button onclick="cargarDatosProducto()" class="btn btn-outline-secondary" type="button">Buscar Producto</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <label for="cantidad">{{ __('Cantidad') }}</label>

                        <div class="input-group mb-3">
                            <input type="number" min="1" name="cantidad" id="cantidad" class="form-control" disabled>
                            <div class="input-group-append">
                                <button id="btnCantidad" onclick="enviarCodigoProducto()" class="btn btn-outline-primary" type="button" disabled>Ingresar Producto</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group row justify-content-center">
                    <div class="col-md-4">
                        <label for="nombre">{{ __('Nombre') }}</label>
                        <input type="text" name="nombre" id="nombre" class="form-control" disabled>
                    </div>
                    <div class="col-md-4">
                        <label for="proveedor">{{ __('Proveedor') }}</label>
                        <input type="text" name="proveedor" id="proveedor" class="form-control" disabled>
                    </div>
                </div>

                <div class="form-group row justify-content-center">
                    <div class="col-md-4">
                        <label for="marca">{{ __('Marca') }}</label>
                        <input type="text" name="marca" id="marca" class="form-control" disabled>
                    </div>
                    <div class="col-md-4">
                        <label for="fecha">{{ __('Fecha') }}</label>
                        <input type="text" name="fecha" id="fecha" class="form-control" disabled>
                    </div>
                </div>

                <div class="form-group row justify-content-center">
                    <div class="col-md-4">
                        <label for="contenido">{{ __('Contenido Neto') }}</label>
                        <input type="text" name="contenido" id="contenido" class="form-control" disabled>
                    </div>
                    <div class="col-md-4"></div>
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
    <script src="{{ asset('js/cargaDatosProducto.js') }}" defer></script>
    <script src="{{ asset('js/enviaCodigoProducto.js') }}" defer></script>
@endsection




@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="card border-info">
        <div class="card-header">Registrar Producto</div>
        <div class="card-body">
            @include('layouts.errores')
            <form method="POST" action="registrar">
                @csrf

                <div class="form-group row justify-content-center">
                    <div class="col-md-4">
                        <label for="codigo">{{ __('Código') }}</label>
                        <input id="codigo" type="text" class="form-control{{ $errors->has('codigo') ? ' is-invalid' : '' }}" name="codigo" value="{{ old('codigo') }}" required autofocus>
                    </div>
                    <div class="col-md-4">
                        <label for="proveedor_id">{{ __('Proveedor') }}</label>
                        <select class="form-control" id="proveedor_id" class="form-control" name="proveedor_id" required>
                            <option value="" selected>Seleccione Proveedor</option>
                            @foreach ($proveedores as $proveedor)
                                <option value="{{ $proveedor->id }}">{{ $proveedor->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group row justify-content-center">
                    <div class="col-md-4">
                        <label for="nombre">{{ __('Nombre') }}</label>
                        <input id="nombre" type="text" class="form-control{{ $errors->has('nombre') ? ' is-invalid' : '' }}" name="nombre" value="{{ old('nombre') }}" required autofocus>
                    </div>
                    <div class="col-md-4">
                        <label for="marca">{{ __('Marca') }}</label>
                        <select class="form-control" id="marca_id" class="form-control" name="marca_id" required>
                            <option value="" selected>Seleccione Marca</option>
                        </select>
                    </div>
                </div>

                <div class="form-group row justify-content-center">
                    <div class="col-md-4">
                        <label for="cont_neto">{{ __('Contenido Neto') }}</label>
                        <input id="cont_neto" type="text" class="form-control{{ $errors->has('cantidad') ? ' is-invalid' : '' }}" name="cont_neto" value="{{ old('cont_neto') }}" required autofocus>
                    </div>
                    <div class="col-md-4"></div>
                </div>

                <div class="form-group row justify-content-center">
                    <div class="col-md-4">
                        <label for="precio">{{ __('Precio ($)') }}</label>
                        <input id="precio" type="number" min="1" class="form-control{{ $errors->has('precio') ? ' is-invalid' : '' }}" name="precio" value="{{ old('precio') }}" required autofocus>
                    </div>
                    <div class="col-md-4"></div>
                </div>
                <div class="form-group row justify-content-center mb-0">
                    <div class="col-md-4">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Registrar') }}
                        </button>
                    </div>
                    <div class="col-md-4"></div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('script')
    <script src="{{ asset('js/cargaProveedorPorMarca.js') }}" defer></script>
@endsection
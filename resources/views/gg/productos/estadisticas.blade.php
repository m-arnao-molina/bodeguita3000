@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="card border-info">
        <div class="card-header">Estadisticas Ventas Por Producto</div>
        <div class="card-body">
            @include('layouts.errores')
            <form method="POST" action="vista_grafico">
                @csrf

                <div class="form-group row">
                    <label for="marca_id" class="col-md-4 col-form-label text-md-right">{{ __('Marca') }}</label>

                    <div class="col-md-4">
                        <select class="form-control" id="marca_id" class="form-control" name="marca_id" required>
                            <option value="" selected>Seleccione Marca</option>
                            @foreach ($marcasEnEmpresa as $marca)
                                <option value="{{ $marca->id }}">{{ $marca->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="producto_id" class="col-md-4 col-form-label text-md-right">{{ __('Producto') }}</label>

                    <div class="col-md-4">
                        <select class="form-control" id="producto_id" class="form-control" name="producto_id" required>
                            <option value="" selected>Seleccione Producto</option>
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="fecha_ini" class="col-md-4 col-form-label text-md-right">{{ __('Fecha Inicio') }}</label>

                    <div class="col-md-4">
                        <input id="fecha_ini" type="date" class="form-control" name="fecha_ini" value="{{ date('Y-m-d', strtotime ('- 1 month')) }}" required>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="fecha_fin" class="col-md-4 col-form-label text-md-right">{{ __('Fecha Fin') }}</label>

                    <div class="col-md-4">
                        <input id="fecha_fin" type="date" class="form-control" name="fecha_fin" value="{{ date('Y-m-d') }}" required>
                    </div>
                </div>

                <div class="form-group row mb-0">
                    <div class="col-md-4 offset-md-4">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Ver Ventas') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('script')
    <script src="{{ asset('js/cargaProductosEnEmpresa.js') }}" defer></script>
@endsection
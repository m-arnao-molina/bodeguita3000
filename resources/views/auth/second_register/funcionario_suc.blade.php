@extends('layouts.second_register')

@section('id_lugar_trabajo')
    <div class="form-group row">
        <label for="empresa_id" class="col-md-4 col-form-label text-md-right">{{ __('Seleccione Empresa') }}</label>

        <div class="col-md-6">
            <select id="empresa_id" class="form-control" name="empresa_id" onchange="cargarSucursales()" required>
                <option value="" selected>Indique la empresa...</option>
                @foreach ($empresas as $empresa)
                    <option value="{{ $empresa->id }}">{{ $empresa->nombre }} - {{ $empresa->rut }}</option>
                @endforeach
            </select>
        </div>
    </div>
    
    <div class="form-group row">
        <label for="sucursal_id" class="col-md-4 col-form-label text-md-right">{{ __('Seleccione Sucursal') }}</label>

        <div class="col-md-6">
            <select id="sucursal_id" class="form-control" name="sucursal_id" disabled required>
                <option value="" selected>Indique la sucursal...</option>
            </select>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('js/cargaSucursales.js') }}" defer></script>
@endsection
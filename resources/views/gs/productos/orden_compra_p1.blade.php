@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="card border-info">
        <div class="card-header">
            <div class="row">
                <div class="col-md-9">Crear Una Orden de Compra</div>
                <div class="col-md-3">
                    <div class="progress mt-1">
                        <div class="progress-bar" role="progressbar" style="width:33%"><span>Paso 1</span> </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            @include('layouts.errores')
            
            <form method="POST" action="paso_2">
                @csrf
                
                <div class="form-group row">
                    <label for="proveedor_id" class="col-md-4 col-form-label text-md-right">{{ __('Proveedor') }}</label>
                
                    <div class="col-md-4">
                        <select class="form-control" id="proveedor_id" class="form-control" name="proveedor_id" onchange="cargarProductosProveedor()" required>
                            <option value="" selected>Seleccione Proveedor</option>
                            @foreach ($proveedoresEnSucursal as $proveedor)
                                <option value="{{ $proveedor->id }}">{{ $proveedor->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <table id="tabla-productos" class="table table-striped table-sm table-hover">
                    <thead class="table-primary">
                        <tr>
                            <th class="align-middle">Codigo</th>
                            <th class="align-middle">Nombre</th>
                            <th class="align-middle">Marca</th>
                            <th class="align-middle">Cont. Neto</th>
                            <th class="align-middle">Stock Actual</th>
                            <th class="align-middle">Stock Mínimo</th>
                            <th class="align-middle">Seleccionar</th>
                        </tr>
                    </thead>
                    <tbody id="tabla-productos-body">
                    </tbody>
                </table>
                <div class="form-group text-right mt-3 mb-0">
                    <button type="submit" class="btn btn-primary">
                        {{ __('Siguiente Paso') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('script')
    <script src="{{ asset('js/cargaProductosProveedor.js') }}" defer></script>
@endsection
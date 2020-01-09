@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Registro de Perfil') }}</div>
                <div class="card-body">
                    @include('layouts.errores')
                    <form method="POST" action="registrar">
                        @csrf

                        <div class="form-group row">
                            <label for="nombres" class="col-md-4 col-form-label text-md-right">{{ __('Nombres') }}</label>
                            <div id="nombres" class="col-md-6 input-group">
    
                                <input id="p_nombre" type="text" placeholder="Primer Nombre" class="form-control{{ $errors->has('p_nombre') ? ' is-invalid' : '' }}" name="p_nombre" value="{{ old('p_nombre') }}" required>

                                @if ($errors->has('p_nombre'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('p_nombre') }}</strong>
                                    </span>
                                @endif
                                
                                <input id="s_nombre" type="text" placeholder="Segundo Nombre" class="form-control{{ $errors->has('s_nombre') ? ' is-invalid' : '' }}" name="s_nombre" value="{{ old('s_nombre') }}">

                                @if ($errors->has('s_nombre'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('s_nombre') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="apellidos" class="col-md-4 col-form-label text-md-right">{{ __('Apellidos') }}</label>
                            <div id="apellidos" class="col-md-6 input-group">
    
                                <input id="p_apellido" type="text" placeholder="Primer Apellido" class="form-control{{ $errors->has('p_apellido') ? ' is-invalid' : '' }}" name="p_apellido" value="{{ old('p_apellido') }}" required>

                                @if ($errors->has('p_apellido'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('p_apellido') }}</strong>
                                    </span>
                                @endif
                                
                                <input id="s_apellido" type="text" placeholder="Segundo Apellido" class="form-control{{ $errors->has('s_nombre') ? ' is-invalid' : '' }}" name="s_apellido" value="{{ old('s_apellido') }}">

                                @if ($errors->has('s_apellido'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('s_apellido') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="rut" class="col-md-4 col-form-label text-md-right">{{ __('RUT') }}</label>

                            <div class="col-md-6">
                            <input id="rut" type="text" placeholder="12345678-9" class="form-control{{ $errors->has('rut') ? ' is-invalid' : '' }}" name="rut" value="{{ old('rut') }}">

                                @if ($errors->has('rut'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('rut') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        @yield('id_lugar_trabajo')
                        
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary form-group">
                                    {{ __('Completar Registro') }}
                                </button>
                                <button type="submit" form="f_eliminar" class="btn btn-default form-group">
                                    {{ __('Cancelar Registro') }}
                                </button>
                            </div>
                        </div>
                    </form>
                    <form id="f_eliminar" method="POST" action="eliminar">
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

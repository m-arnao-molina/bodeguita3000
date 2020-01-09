@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Verificar su Dirección de Correo') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('Se ha enviado un enlace de verificación a su dirección de correo electrónico.') }}
                        </div>
                    @endif
                    
                    {{ __('Antes de continuar, compruebe haya llegado el enlace de verificación a su casilla de correo electrónico.') }}
                    {{ __('Si no recibió el mensaje de correo con el enlace') }}, <a href="{{ route('verification.resend') }}">{{ __('haga click aquí para reintentar el envío') }}</a>.
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

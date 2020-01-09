@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        @include('layouts.menu')
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">Opción Seleccionada</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    Usted ya está autentificado.

                    <div class="links">
                        <ul class= "nav navbar-nav">
                          <li><a href="{{ route('gs_prod_registrar') }}">Agregar Productos </a></li>
                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

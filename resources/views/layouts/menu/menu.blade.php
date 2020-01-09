<div class="contenedor-menu">
    <div class="contenedor-logo">
        <img src="{{ asset('img/logo-menu.png') }}" alt="Logo Bodeguita 3000" height="70"> 
    </div>
    <ul class="menu">
        <li class="item"><a href="">Mi Cuenta<span class="icono dropdown-toggle"></span></a>
            <ul class="subitems">
                <li class="{{ Request::is('*/home') ? 'subitem-activado' : ''}}">
                    <a href="{{ route('home') }}">Mis Datos</a>
                </li>
                <li>
                    <a href="{{ route('logout') }}">Cerrar Sesión</a>
                </li>
            </ul>
        </li>
        @if(auth()->user()->esGerenteGeneral())
            @include('layouts.menu.opciones-gg')
        @elseif(auth()->user()->esGerenteSucursal())
            @include('layouts.menu.opciones-gs')
        @elseif(auth()->user()->esBodeguero())
            @include('layouts.menu.opciones-bo')
        @elseif(auth()->user()->esCajero())
            @include('layouts.menu.opciones-ca')
        @endif
    </ul>
    <div class="contenedor-perfil">
        @if(auth()->user()->esGerenteGeneral())
            @include('layouts.menu.perfil-gg')
        @elseif(auth()->user()->esGerenteSucursal())
            @include('layouts.menu.perfil-gs')
        @elseif(auth()->user()->esBodeguero())
            @include('layouts.menu.perfil-bo')
        @elseif(auth()->user()->esCajero())
            @include('layouts.menu.perfil-ca')
        @endif
    </div>
</div>
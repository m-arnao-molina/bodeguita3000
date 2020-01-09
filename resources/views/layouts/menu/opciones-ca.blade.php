<li class="item"><a href="#">Gestión de Ventas<span class="icono dropdown-toggle"></span></a>
    <ul class="subitems">
        <li class="{{ Request::is('*/vista_registrar') ? 'subitem-activado' : ''}}">
            <a href="{{ route('ca_venta_registrar') }}">Registrar</a>
        </li>
    </ul>
</li>
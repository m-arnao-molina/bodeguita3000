<li class="item"><a href="#">Gestión de Productos<span class="icono dropdown-toggle"></span></a>
    <ul class="subitems">
        <li class="{{ Request::is('*/vista_buscar') ? 'subitem-activado' : ''}}" hidden>
            <a href="#">Buscar</a>
        </li>
        <li class="{{ Request::is('*/vista_listar') ? 'subitem-activado' : ''}}" hidden>
            <a href="#">Listar</a>
        </li>
        <li class="{{ Request::is('*/vista_registrar') ? 'subitem-activado' : ''}}">
            <a href="{{ route('gg_prod_registrar') }}">Registrar</a>
        </li>
        <li class="{{ Request::is('*/estadisticas/*') ? 'subitem-activado' : ''}}">
            <a href="{{ route('gg_prod_estadisticas') }}">Estadísticas</a>
        </li>
        <li class="{{ Request::is('*/vista_modificar') ? 'subitem-activado' : ''}}" hidden>
            <a href="#">Modificar</a>
        </li>
        <li class="{{ Request::is('*/vista_eliminar') ? 'subitem-activado' : ''}}" hidden>
            <a href="#">Eliminar</a>
        </li>
    </ul>
</li>
<li class="item"><a href="#">Gestión de Productos<span class="icono dropdown-toggle"></span></a>
    <ul class="subitems">
        <li class="{{ Request::is('*/vista_buscar') ? 'subitem-activado' : ''}}">
            <a href="{{ route('gs_prod_buscar') }}">Buscar</a>
        </li>
        <li class="{{ Request::is('*/vista_listar') ? 'subitem-activado' : ''}}">
            <a href="{{ route('gs_prod_listar') }}">Listar</a>
        </li>
        <li class="{{ Request::is('*/vista_registrar') ? 'subitem-activado' : ''}}">
            <a href="{{ route('gs_prod_registrar') }}">Registrar</a>
        </li>
        <li class="{{ Request::is('*/vista_modificar') ? 'subitem-activado' : ''}}">
            <a href="{{ route('gs_prod_modificar') }}">Modificar</a>
        </li>
        <li class="{{ Request::is('*/vista_eliminar') ? 'subitem-activado' : ''}}" hidden>
            <a href="#">Eliminar</a>
        </li>
        <li class="{{ Request::is('*/vista_stock_critico') ? 'subitem-activado' : ''}}">
            <a href="{{ route('gs_stock_critico') }}">Stock Crítico</a>
        </li>
        <li class="{{ Request::is('*/vista_orden_compra/*') ? 'subitem-activado' : ''}}">
            <a href="{{ route('gs_orden_compra') }}">Orden de Compra</a>
        </li>
        <li class="{{ Request::is('*/vista_registro_inventario') ? 'subitem-activado' : ''}}">
            <a href="{{ route('gs_registro_inventario') }}">Historial de Ingresos</a>
        </li>
    </ul>
</li>

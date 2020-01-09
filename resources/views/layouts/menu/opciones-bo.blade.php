<li class="item"><a href="#">Gestión de Productos<span class="icono dropdown-toggle"></span></a>
    <ul class="subitems">
        <li class="{{ Request::is('*/vista_ingresar') ? 'subitem-activado' : ''}}">
            <a href="{{ route('bo_prod_ingresar') }}">Ingresar</a>
        </li>
    </ul>
</li>
<li class="dropdown">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true" v-pre>
        {{ Auth::user()->name }} <span class="caret"></span>
    </a>
    <ul class="dropdown-menu">
        <li>
            <a href="{{ url('/home')}}">Registrar Nuevo Turno</a>
        </li>
        <li>
            <a href="#">No definido</a>
        </li>
        {{-- <li>
            <a href="{{ url('/admin/products')}}">Gestionar Productos</a>
        </li>
        <li>
            <a href="{{ url('/admin/promotions')}}">Gestionar Promociones</a>
        </li>
        <li>
            <a href="{{ url('/admin/categories')}}">Gestionar Categorias</a>
        </li>
        <li>
            <a href="{{ url('/admin/clients')}}">Gestionar Clientes</a>
        </li>
        <li>
            <a href="{{ url('/admin/pagos')}}">Gestionar Pagos</a>
        </li>
        <li>
            <a href="{{ url('/admin/sectors')}}">Gestionar Sectores</a>
        </li> --}}
        {{-- Menu de Cajas --}}
        <li>
            <a href="{{ route('logout') }}"
                onclick="event.preventDefault();
                         document.getElementById('logout-form').submit();">
                Desconectarse
            </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>
        </li>
    </ul>
</li>
<li class="dropdown">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true" v-pre>
        Cajas <span class="caret"></span>
    </a>
    <ul class="dropdown-menu">
        
        <li>
            <a href="{{ url('/usuario/cajas')}}">Cajas</a>
        </li>
        <li>
            <a href="{{ url('/usuario/cajascerradas') }}">Cerradas</a>
        </li>
        <li>
            <a href="{{ url('/usuario/controladmcaja') }}">Control Administrativo</a>
        </li>
        <li>
            <a href="{{ url('/usuario/autitarcajas')}}">Auditoria</a>
        </li>
        <li>
            <a href="{{ url('/usuario/reportescajas')}}">Reportes</a>
        </li>     
        
    </ul>
</li>
<li class="dropdown">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true"
        v-pre>
        {{ Auth::user()->name }} <span class="caret"></span>
    </a>
    <ul class="dropdown-menu">
        {{-- <li>
            <a href="{{ url('/home') }}">Registrar Nuevo Turno</a>
        </li> --}}

        <li>
            <a href="{{ route('admin.products') }}">Gestionar Productos</a>
        </li>
        <li>
            <a href="{{ route('tanques.index') }}">Gestionar Tanques</a>
        </li>
        <li>
            <a href="{{ route('admin.surtidors') }}">Gestionar Surtidores</a>
        </li>

        <li>
            <a href="{{ route('user.index') }}">Gestionar Usuarios</a>
        </li>

        <li>
            <a href="{{ route('admin.turnoscheck') }}">Controlar Cierres de Turnos</a>
        </li>

        {{--
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
<!-- <li class="dropdown">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true" v-pre>
        Cajas <span class="caret"></span>
    </a>
    <ul class="dropdown-menu">

        <li>
            <a href="{{ url('/usuario/cajas') }}">Cajas</a>
        </li>
        <li>
            <a href="{{ url('/usuario/cajascerradas') }}">Cerradas</a>
        </li>
        <li>
            <a href="{{ url('/usuario/controladmcaja') }}">Control Administrativo</a>
        </li>
        <li>
            <a href="{{ url('/usuario/autitarcajas') }}">Auditoria</a>
        </li>
        <li>
            <a href="{{ url('/usuario/reportescajas') }}">Reportes</a>
        </li>

    </ul>
</li> -->

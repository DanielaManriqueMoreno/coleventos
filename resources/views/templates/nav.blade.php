<!DOCTYPE html>
<html>
    <body>
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">COLEVENTOS</div>
            </a>

            <hr class="sidebar-divider my-0" />

            <li class="nav-item">
                <a class="nav-link" href="#"> <i class="fas fa-fw fa-calendar-alt"></i>
                    <span>Ver Eventos</span>
                </a>
            </li>

            <hr class="sidebar-divider"/>

            @can('admin')
                <div class="sidebar-heading">
                    Administración 
                </div>
                
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseArtistas"
                    aria-expanded="true" aria-controls="collapseArtistas">
                        <i class="fas fa-fw fa-user-music"></i>
                        <span>Artistas</span>
                    </a>
                    <div id="collapseArtistas" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <a class="collapse-item" href="{{ route('artista.index') }}">Consultar</a>
                            <a class="collapse-item" href="{{ route('artista.create') }}">Crear</a>
                        </div>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseEventos"
                    aria-expanded="true" aria-controls="collapseEventos">
                        <i class="fas fa-fw fa-calendar-check"></i>
                        <span>Eventos</span>
                    </a>
                    <div id="collapseEventos" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <a class="collapse-item" href="{{ route('evento.index') }}">Consultar</a>
                            <a class="collapse-item" href="{{ route('evento.create') }}">Crear</a>
                            </div>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLocalidad"
                    aria-expanded="true" aria-controls="collapseLocalidad">
                        <i class="fas fa-fw fa-map-marker-alt"></i>
                        <span>Localidades</span>
                    </a>
                    <div id="collapseLocalidad" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <a class="collapse-item" href="{{ route('localidad.index') }}">Consultar</a>
                            <a class="collapse-item" href="{{ route('localidad.create') }}">Crear</a>
                        </div>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBoleteria"
                    aria-expanded="true" aria-controls="collapseBoleteria">
                        <i class="fas fa-fw fa-ticket-alt"></i>
                        <span>Boletería</span>
                    </a>
                    <div id="collapseBoleteria" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <a class="collapse-item" href="{{ route('boleteria.index') }}">Consultar</a>
                            <a class="collapse-item" href="{{ route('boleteria.create') }}">Crear</a>
                        </div>
                    </div>
                </li>
            @endcan
            @can('comprador')
                <hr class="sidebar-divider"/>

                <div class="sidebar-heading">
                    Mi Cuenta
                </div>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('compras.index') }}">
                        <i class="fas fa-fw fa-shopping-basket"></i>
                        <span>Mis Compras</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('profile.edit') }}">
                        <i class="fas fa-fw fa-user-edit"></i>
                        <span>Mi Perfil</span>
                    </a>
                </li>
            @endcan
            <hr class="sidebar-divider d-none d-md-block" />

            @auth
                <li class="nav-item">
                    <a class="nav-link" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fas fa-fw fa-sign-out-alt"></i>
                        <span>Cerrar Sesión</span>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
            @endauth
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>

    </body>
</html>
<!DOCTYPE html>
<html>
    <body>
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
            <!-- Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('admin.index') }}">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-ticket-alt"></i>
                </div>
                <div class="sidebar-brand-text mx-3">COLEVENTOS</div>
            </a>

            <hr class="sidebar-divider my-0" />

            <!-- Dashboard -->
            @auth
                @if(Auth::user()->rol === 'admin')
                    <li class="nav-item {{ request()->routeIs('admin.index') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('admin.index') }}">
                            <i class="fas fa-fw fa-tachometer-alt"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                @endif
            @endauth

            <li class="nav-item">
                <a class="nav-link" href="{{ route('home') }}">
                    <i class="fas fa-fw fa-calendar-alt"></i>
                    <span>Ver Eventos</span>
                </a>
            </li>

            <hr class="sidebar-divider"/>

            <!-- Sección Admin -->
            @auth
                @if(Auth::user()->rol === 'admin')
                    <div class="sidebar-heading">
                        Administración 
                    </div>
                    
                    <li class="nav-item {{ request()->is('admin/users*') ? 'active' : '' }}">
                        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUsers">
                            <i class="fas fa-fw fa-users-cog"></i> <span>Gestionar Usuarios</span>
                        </a>
                        <div id="collapseUsers" class="collapse {{ request()->is('admin/users*') ? 'show' : '' }}" data-parent="#accordionSidebar">
                            <div class="bg-white py-2 collapse-inner rounded">
                                <a class="collapse-item" href="{{ route('admin.users.index') }}">Consultar</a>
                                <a class="collapse-item" href="{{ route('admin.users.create') }}">Crear Usuario</a>
                            </div>
                        </div>
                    </li>
                    {{-- FIN NUEVO MENÚ --}}

                    <hr class="sidebar-divider"/>
                    <!-- Artistas -->
                    <li class="nav-item">
                        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseArtistas"
                        aria-expanded="true" aria-controls="collapseArtistas">
                            <i class="fas fa-fw fa-users"></i>
                            <span>Artistas</span>
                        </a>
                        <div id="collapseArtistas" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                            <div class="bg-white py-2 collapse-inner rounded">
                                <a class="collapse-item" href="{{ route('admin.artista.index') }}">
                                    <i class="fas fa-list"></i> Consultar
                                </a>
                                <a class="collapse-item" href="{{ route('admin.artista.create') }}">
                                    <i class="fas fa-plus"></i> Crear
                                </a>
                            </div>
                        </div>
                    </li>

                    <!-- Eventos -->
                    <li class="nav-item">
                        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseEventos"
                        aria-expanded="true" aria-controls="collapseEventos">
                            <i class="fas fa-fw fa-calendar-check"></i>
                            <span>Eventos</span>
                        </a>
                        <div id="collapseEventos" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                            <div class="bg-white py-2 collapse-inner rounded">
                                <a class="collapse-item" href="{{ route('admin.evento.index') }}">
                                    <i class="fas fa-list"></i> Consultar
                                </a>
                                <a class="collapse-item" href="{{ route('admin.evento.create') }}">
                                    <i class="fas fa-plus"></i> Crear
                                </a>
                            </div>
                        </div>
                    </li>

                    <!-- Localidades -->
                    <li class="nav-item">
                        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLocalidad"
                        aria-expanded="true" aria-controls="collapseLocalidad">
                            <i class="fas fa-fw fa-map-marker-alt"></i>
                            <span>Localidades</span>
                        </a>
                        <div id="collapseLocalidad" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                            <div class="bg-white py-2 collapse-inner rounded">
                                <a class="collapse-item" href="{{ route('admin.localidad.index') }}">
                                    <i class="fas fa-list"></i> Consultar
                                </a>
                                <a class="collapse-item" href="{{ route('admin.localidad.create') }}">
                                    <i class="fas fa-plus"></i> Crear
                                </a>
                            </div>
                        </div>
                    </li>

                    <!-- Boletería -->
                    <li class="nav-item">
                        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBoleteria"
                        aria-expanded="true" aria-controls="collapseBoleteria">
                            <i class="fas fa-fw fa-ticket-alt"></i>
                            <span>Boletería</span>
                        </a>
                        <div id="collapseBoleteria" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                            <div class="bg-white py-2 collapse-inner rounded">
                                <a class="collapse-item" href="{{ route('admin.boleteria.index') }}">
                                    <i class="fas fa-list"></i> Consultar
                                </a>
                                <a class="collapse-item" href="{{ route('admin.boleteria.create') }}">
                                    <i class="fas fa-plus"></i> Crear
                                </a>
                            </div>
                        </div>
                    </li>

                    <hr class="sidebar-divider"/>
                @endif

                <!-- Sección Comprador -->
                @if(Auth::user()->rol === 'comprador')
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

                    <hr class="sidebar-divider"/>
                @endif

                <!-- Cerrar Sesión -->
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

            <hr class="sidebar-divider d-none d-md-block" />

            <!-- Sidebar Toggler -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>

    </body>
</html>
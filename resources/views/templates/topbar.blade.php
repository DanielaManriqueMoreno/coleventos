<!DOCTYPE html>
<html>
    <body>
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
            <!-- Sidebar Toggle (Topbar) -->
            <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                <i class="fa fa-bars"></i>
            </button>

            <!-- Topbar Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Nav Item - Alerts -->
                <div class="topbar-divider d-none d-sm-block"></div>
                <!-- Nav Item - User Information -->
                <div class="topbar-divider d-none d-sm-block"></div>
                <li class="nav-item dropdown no-arrow">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        
                        <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->name }}</span>
                        
                        <img src="{{ asset('img/undraw_profile.svg') }}" class="img-profile rounded-circle" alt="Perfil" />
                    </a>
                    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                        aria-labelledby="userDropdown">
                        
                        <a class="dropdown-item" href="{{ route('profile.edit') }}">
                            <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                            Perfil
                        </a>
                        
                        <div class="dropdown-divider"></div>
                        
                        <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('logout-form-topbar').submit();">
                            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                            Cerrar Sesión
                        </a>
                        <form id="logout-form-topbar" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>

            </ul>
        </nav>

    </body>
</html>


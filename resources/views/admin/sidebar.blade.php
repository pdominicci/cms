<header class="bg-dark mb-2 shadow-sm border-bottom border-light">
    <nav class="container navbar navbar-expand-lg navbar-dark">

        <a class="navbar-brand" href="#">{{ env('APP_NAME') }}</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav m-auto">
                <a class="nav-item nav-link" href="/admin">
                    {{-- <i class="fas fa-home" data-toggle="tooltip" data-placement="top" title="Ir a Dashboard"></i> --}}
                    Dashboard
                </a>
                <a class="nav-item nav-link" href="/admin/products">
                    {{-- <i class="fas fa-boxes" data-toggle="tooltip" data-placement="top" title="Administrar Productos"></i> --}}
                    Productos
                </a>
                <a class="nav-item nav-link" href="/admin/categories/0">
                    {{-- <i class="fas fa-folder" data-toggle="tooltip" data-placement="top" title="Administrar Categorías"></i> --}}
                    Categorías
                </a>
                <a class="nav-item nav-link" href="/admin/users">
                    {{-- <i class="fas fa-users" data-toggle="tooltip" data-placement="top" title="Administrar Usuarios"></i> --}}
                    Usuarios
                </a>
                <div class="row userinfo">




                </div>

                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true"> <span class="nav-label">Services</span> <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li>
                            <div class="name">
                                {{ Auth::user()->name }} {{ Auth::user()->lastname }}
                            </div>
                        </li>
                        <li>
                            <div class="email">
                                {{ Auth::user()->email }}
                            </div>
                        </li>
                        <li>
                            <a href="/logout" data-toggle="tooltip" data-placement="bottom" title="Salir"><i class="salir fas fa-power-off"></i></a>
                        </li>

                        <li class="dropdown-submenu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <span class="nav-label">Service C</span><span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="#">Service C5</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
            </div>
        </div>
    </nav>

</header>


{{--
<div class="sidebar shadow">
    <div class="section-top">
        <div class="logo">
            <img src=" {{ url('static/images/logoPraga.png') }} " class="img-fluid">
        </div>


    </div>
    <div class="main">
        <ul>
            <li>
                <a href="{{ url('/admin') }}">
                    <i class="fas fa-home" data-toggle="tooltip" data-placement="top" title="Ir a Dashboard"></i>
                    Dashboard
                </a>
            </li>
            <li>
                <a href="{{ url('/admin/products') }}">
                    <i class="fas fa-boxes" data-toggle="tooltip" data-placement="top" title="Administrar Productos"></i>
                    Productos
                </a>
            </li>
            <li>
                <a href="{{ url('/admin/categories/0') }}">
                    <i class="fas fa-folder" data-toggle="tooltip" data-placement="top" title="Administrar Categorías"></i>
                    Categorías
                </a>
            </li>
            <li>
                <a href="{{ url('/admin/users') }}">
                    <i class="fas fa-users" data-toggle="tooltip" data-placement="top" title="Administrar Usuarios"></i>
                    Usuarios
                </a>
            </li>
        </ul>
    </div>
</div> --}}




<header class="bg-dark mb-2 shadow-sm border-bottom border-light">
    <nav class="container navbar navbar-expand-lg navbar-dark">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <a class="navbar-brand" href="#">
            <img src="/static/images/logoCMSrojo.png" width="100"  alt="">
          </a>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav m-auto">
                <a class="nav-item nav-link" href="/admin">
                    <i class="fas fa-home" data-toggle="tooltip" data-placement="top" title="Ir a Dashboard"></i>
                    Dashboard
                </a>
                <a class="nav-item nav-link mr-3" href="/admin/products">
                    <i class="fas fa-boxes" data-toggle="tooltip" data-placement="top" title="Administrar Productos"></i>
                    Productos
                </a>
                <a class="nav-item nav-link mr-3" href="/admin/categories/0">
                    <i class="fas fa-folder" data-toggle="tooltip" data-placement="top" title="Administrar Categorías"></i>
                    Categorías
                </a>
                <a class="nav-item nav-link mr-3" href="/admin/users">
                    <i class="fas fa-users" data-toggle="tooltip" data-placement="top" title="Administrar Usuarios"></i>
                    Usuarios
                </a>

                <li class="dropdown nav-link">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true"> <span class="nav-label">{{ Auth::user()->name }} {{ Auth::user()->lastname }}</span> <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li class="nav-item">
                            <div class="email">
                                {{ Auth::user()->email }}
                            </div>
                        </li>
                    </ul>
                </li>
                <a href="/logout" data-toggle="tooltip" data-placement="bottom" title="Salir" class="fas fa-power-off salir"></a>
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


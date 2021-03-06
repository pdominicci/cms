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
</div>


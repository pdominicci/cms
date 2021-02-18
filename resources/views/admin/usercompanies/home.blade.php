@extends('admin.master')

@section('title', 'Empresas del Usuario')

@section('breadcrumb')
<li class="breadcrumb-item">
    <a href="{{ url('/admin/users') }}">
        <i class="far fa-copyright"></i>
        Usuarios
    </a>
</li>
<li class="breadcrumb-item">
    <a href="/admin/usercompanies/{{$user_id}}">
        <i class="far fa-copyright"></i>
        Empresas del Usuario: {{$user->name}} - {{$user->email}}
    </a>
</li>

@endsection

@section('content')

    @if ( session('mensaje') )
        <div class="alert alert-success">
            {{ session('mensaje') }}
        </div>
    @endif

    <table class="table table-borderless table-striped table-hover">
        <thead>
            <tr>
                <th>#</th>
                <th>Nombre</th>
                <th colspan="2">
                    <a href="/admin/usercompanies/add/{{$user_id}}" class="btn btn-dark">
                        Agregar
                    </a>
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($usercompanies as $uc)
            <tr>
                <td>{{ $uc->id }}</td>
                <td>{{ $uc->companies->company }}</td>
                <td>
                    <a href="/admin/usercompanies/delete/{{ $uc->id}}" class="btn btn-outline-secondary">
                        Eliminar
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endsection

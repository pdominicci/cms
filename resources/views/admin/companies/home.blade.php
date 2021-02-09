@extends('admin.master')

@section('title', 'Empresas ')

@section('breadcrumb')
<li class="breadcrumb-item">
    <a href="{{ url('/admin/companies') }}">
        <i class="far fa-copyright"></i>
        Empresas
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
                <th>País</th>
                <th>Provincia</th>
                <th>Ciudad</th>
                <th colspan="2">
                    <a href="/admin/companies/add" class="btn btn-dark">
                        Agregar
                    </a>
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($companies as $c)
            <tr>
            <td>{{ $c->id }}</td>
                <td>{{ $c->relCountry->country }}</td>
                <td>{{ $c->relState->state }}</td>
                <td>{{ $c->city }}</td>
                <td>
                    <a href="/admin/companies/update/{{ $c->id }}" class="btn btn-outline-secondary">
                        Modificar
                    </a>
                </td>
                <td>
                    <a href="/admin/companies/delete/{{ $c->id}}" class="btn btn-outline-secondary">
                        Eliminar
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endsection

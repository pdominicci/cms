@extends('admin.master')

@section('title', 'Provincias ')

@section('breadcrumb')
<li class="breadcrumb-item">
    <a href="{{ url('/admin/states') }}">
        <i class="fas fa-globe-americas"></i>
        Provincias
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
                <th colspan="2">
                    <a href="/admin/states/add" class="btn btn-dark">
                        Agregar
                    </a>
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($states as $s)
            <tr>
            <td>{{ $s->id }}</td>
                <td>{{ $s->relCountry->country }}</td>
                <td>{{ $s->state }}</td>
                <td>
                    <a href="/admin/states/update/{{ $s->id }}" class="btn btn-outline-secondary">
                        Modificar
                    </a>
                </td>
                <td>
                    <a href="/admin/states/delete/{{ $s->id}}" class="btn btn-outline-secondary">
                        Eliminar
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endsection

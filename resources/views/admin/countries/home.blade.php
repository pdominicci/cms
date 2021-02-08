@extends('admin.master')

    @section('title', 'Países ')

    @section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ url('/admin/countries') }}">
            <i class="fas fa-globe-americas"></i>
            Países
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
                    <th colspan="2">
                        <a href="/admin/countries/add" class="btn btn-dark">
                            Agregar
                        </a>
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($countries as $c)
                <tr>
                <td>{{ $c->id }}</td>
                    <td>{{ $c->country }}</td>
                    <td>
                        <a href="/admin/countries/update/{{ $c->id }}" class="btn btn-outline-secondary">
                            Modificar
                        </a>
                    </td>
                    <td>
                        <a href="/admin/countries/delete/{{ $c->id}}" class="btn btn-outline-secondary">
                            Eliminar
                        </a>
                    </td>
                </tr>
                @endforeach



            </tbody>
        </table>


    @endsection

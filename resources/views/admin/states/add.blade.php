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

        <div class="alert bg-light border border-white shadow round col-8 mx-auto p-4">

            <form action="/admin/states/add" method="post">
                @csrf
                País: <br>
                <select name="country_id" class="form-control" required>
                    <option value="">Seleccione un País</option>
                    @foreach ($countries as $c)
                        <option value="{{$c->id}}">{{$c->country}}</option>
                    @endforeach
                </select>
                <br>
                <div class="form-group">
                    <label for="state">Provincia</label>
                    <input type="text" name="state"
                           class="form-control" id="state">
                </div>
                <button class="btn btn-dark mr-3">Guardar</button>
                <a href="/admin/states/home" class="btn btn-outline-secondary">
                    Volver
                </a>
            </form>
        </div>
    @endsection

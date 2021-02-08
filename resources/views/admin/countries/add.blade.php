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

        <div class="alert bg-light border border-white shadow round col-8 mx-auto p-4">

            <form action="/admin/countries/add" method="post">
                @csrf
                <div class="form-group">
                    <label for="country">País</label>
                    <input type="text" name="country"
                           class="form-control" id="country">
                </div>
                <button class="btn btn-dark mr-3">Guardar</button>
                <a href="/admin/countries/home" class="btn btn-outline-secondary">
                    Volver
                </a>
            </form>
        </div>
    @endsection

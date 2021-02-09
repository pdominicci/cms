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

        <div class="alert bg-light border border-white shadow round col-8 mx-auto p-4">

            <form action="/admin/companies/add" method="post">
                @csrf
                <label for="country">País</label>
                <select class="browser-default custom-select" name="country_id" id="country">
                    <option selected>Seleccionar País</option>
                    @foreach ($countries as $c)
                        <option value="{{ $c->id }}">{{ $c->country }}</option>
                    @endforeach
                </select>
                <label for="state">Provincia</label>
                <select class="browser-default custom-select" name="state_id" id="state">
                </select>
                <br>
                <label for="city">Ciudad</label>
                <select class="browser-default custom-select" name="city_id" id="city">
                </select>
                <button class="btn btn-dark mr-3">Guardar</button>
                <a href="/admin/cities/home" class="btn btn-outline-secondary">
                    Volver
                </a>
            </form>
        </div>







    @endsection

    {{-- <script type="text/javascript">

    </script> --}}

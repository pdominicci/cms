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
                <div class="form-group">
                    <label for="company">Nombre</label>
                    <input type="text" name="company" class="form-control" id="company" value="{{ old('company') }}">
                </div>
                <div class="form-group">
                    <label for="email">E-mail</label>
                    <div class="input-group-prepend">
                        <div class="input-group-text"><i class="far fa-envelope-open"></i></div>
                        <input type="text" name="email" class="form-control" id="email" value="{{ old('email') }}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="phone">Nº Celular</label>
                    <div class="input-group-prepend">
                        <div class="input-group-text"><i class="fas fa-mobile-alt"></i></div>
                        <input type="text" name="phone" class="form-control"
                                placeholder="sin el 0 y sin el 15 ej: 29543212453" id="phone" value="{{ old('phone') }}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="country">País</label>
                    <select class="browser-default custom-select" name="country_id" id="country">
                        <option {{ old('country_id')==''?'selected':'' }}>Seleccionar País</option>
                        @foreach ($countries as $c)
                            <option value="{{ $c->id }}" {{ old('country_id')==$c->id?'selected':'' }}>{{ $c->country }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="state">Provincia</label>
                    <select class="browser-default custom-select" name="state_id" id="state">
                    </select>
                </div>
                <div class="form-group">
                    <label for="city">Ciudad</label>
                    <select class="browser-default custom-select" name="city_id" id="city">
                    </select>
                </div>
                <div class="form-group">
                    <label for="address">Domicilio</label>
                    <div class="input-group-prepend">
                        <div class="input-group-text"><i class="fas fa-map-marker-alt"></i></div>
                        <input type="text" name="address" class="form-control" id="address" value="{{ old('address') }}">
                    </div>
                </div>
                <button class="btn btn-dark mr-3">Guardar</button>
                <a href="/admin/cities/home" class="btn btn-outline-secondary">
                    Volver
                </a>
            </form>
        </div>







    @endsection

    {{-- <script type="text/javascript">

    </script> --}}

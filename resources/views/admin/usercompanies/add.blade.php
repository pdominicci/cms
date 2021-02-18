@extends('admin.master')

    @section('title', 'Usuarios ')

    @section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ url('/admin/users') }}">
            <i class="fas fa-users"></i>
            Usuarios
        </a>
    </li>
    <li class="breadcrumb-item">
        <a href="/admin/usercompanies/{{$user_id}}">
            <i class="far fa-copyright"></i>
            Empresas por Usuario
        </a>
    </li>
    <li class="breadcrumb-item">
        <a href='/admin/usercompanies/add/{{$user_id}}'>
            <i class="fas fa-user"></i>
            Agregar Empresa a Usuario {{$user->name}}
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

            <form action="/admin/usercompanies/add/{{$user_id}}" method="post">
                @csrf
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
                    <label for="company">Empresa</label>
                    <select class="browser-default custom-select" name="company_id" id="company">
                    </select>
                </div>
                <button class="btn btn-dark mr-3">Guardar</button>
                <a href="/admin/usercompanies/home" class="btn btn-outline-secondary">
                    Volver
                </a>
            </form>
        </div>







    @endsection

    {{-- <script type="text/javascript">

    </script> --}}

@extends('admin.master')

    @section('title', 'Ciudades ')

    @section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ url('/admin/cities') }}">
            <i class="fas fa-globe-americas"></i>
            Ciudades
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

            <form action="/admin/cities/add" method="post">
                @csrf

                    <h4>Country</h4>
                    <select class="browser-default custom-select" name="country_id" id="country">
                        <option selected>Seleccionar País</option>
                        @foreach ($countries as $c)
                            <option value="{{ $c->id }}">{{ $c->country }}</option>
                        @endforeach
                    </select>
                    <h4>State</h4>
                    <select class="browser-default custom-select" name="state_id" id="state">
                    </select>


                <br>
                <div class="form-group">
                    <label for="city">Ciudad</label>
                    <input type="text" name="city"
                           class="form-control" id="city">
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

@extends('admin.master')

@section('title', 'Categorías ')

@section('breadcrumb')
    <li class="breadcrumb-item">        
        <a href="{{ url('/admin/categories') }}">
            <i class="fas fa-folder"></i>
            Categorías
        </a>        
    </li>  

@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">
                <div class="panel">
                    <div class="header">
                        <h2 class="title">
                            <i class="fas fa-plus"></i>
                            Agregar Categoría
                        </h2>            
                    </div>

                    <div class="inside">
                        {!! Form::open(['url' => '/admin/categories/add']) !!}
                        <label for="name"> Nombre de la Categoría:</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="far fa-keyboard"></i></span>
                            </div>
                            {!! Form::text('name', null, ['class' => 'form-control']) !!}
                        </div>

                        <label for="module" class="mtop16"> Módulo:</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="far fa-keyboard"></i></span>
                            </div>
                            {!!Form::select('module', getModulesArray(), 0, ['class' => 'custom-select']) !!}
                        </div>

                        <label for="icon" class="mtop16"> Icono:</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="far fa-keyboard"></i></span>
                            </div>
                            {!! Form::text('icon', null, ['class' => 'form-control']) !!}
                        </div>
                        {!! Form::submit('Guardar', ['class' => 'btn btn-dark mtop16'])!!}
                        {!! Form::close() !!}

                        @if(Session::has('message'))                            
                            <div class="mtop16 alert alert-{{ Session::get('typealert')}}">
                                {{ Session::get('message')}}
                                @if ($errors->any()) 
                                    <ul>
                                        @foreach($errors->all() as $error)
                                            <li>{{ $error }}</li>    
                                        @endforeach                
                                    </ul>
                                @endif
                                <script>
                                    $('.alert').slideDown();
                                    setTimeout(function(){
                                                        $('.alert').slideUp();
                                                        }, 10000);
                                </script>
                            </div>
                        @endif

                    </div>
                </div>
            </div>

            <div class="col-md-9">
                <div class="panel">
                    <div class="header">
                        <h2 class="title">
                            <i class="fas fa-folder"></i>
                            Categorías
                        </h2>            
                    </div>

                    <div class="inside">
                        <nav class="nav"> 
                            @foreach (getModulesArray() as $m => $k)
                                <a href="{{ url('/admin/categories/'.$m) }}" class="nav-link"><i class="fas fa-list"></i> {{ $k }}</a>
                            @endforeach                            
                        </nav>
                        <table class="table mtop16">
                            <thead>
                                <tr>
                                    <td width="50"></td>
                                    <td>Nombre</td>
                                    <td></td>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cats as $cat)
                                    <tr>
                                    <td class='celdaicono'>{!! htmlspecialchars_decode($cat->icono) !!}</td>
                                    <td>{{$cat->name}}</td>
                                    <td></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

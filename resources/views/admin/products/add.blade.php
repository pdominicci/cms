@extends('admin.master')

@section('title', 'Agregar Producto')

@section('breadcrumb')
    <li class="breadcrumb-item">        
        <a href="{{ url('/admin/products') }}">
            <i class="fas fa-boxes"></i>
            Productos
        </a>        
    </li>
    <li class="breadcrumb-item">        
        <a href="{{ url('/admin/products/add') }}">
            <i class="fas fa-plus"></i>
            Agregar Producto
        </a>        
    </li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="panel">
            <div class="header">
                <h2 class="title">
                    <i class="fas fa-plus"></i>
                    Agregar Producto
                </h2>            
            </div>
            <div class="inside">
                {!! Form::open(['url' => '/admin/products/add']) !!}
                <div class="row">

                    <div class="col-md-6">
                        <label for="title"> Nombre del Producto:</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="far fa-keyboard"></i></span>
                            </div>
                            {!! Form::text('name', null, ['class' => 'form-control']) !!}
                        </div>
                    </div>

                    <div class="col-md-3">
                        <label for="title"> Categoría:</label>
                    </div>
                    <div class="col-md-3">
                        
                        <label for="title"> Imagen Destacada:</label>
                        <div class="custom-file">
                            {!! Form::file('img', ['class' => 'custom-file-input', 'id' =>'customFile']) !!}
                            <label class="custom-file-label" for="customFile">Choose file</label>
                        </div>

                    </div>
                </div>
                <div class="row mtop16">
                    <div class="col-md-3">
                        <label for="price">Precio:</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="far fa-keyboard"></i></span>
                            </div>
                            {!!Form::number('price', null, ['class' => 'form-control', 'min' => '0.00', 'step' => 'any'])!!}
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label for="indiscount">¿En Descuento?</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="far fa-keyboard"></i></span>
                            </div>
                            {!!Form::select('indiscount', ['0' => 'No', '1' => 'Si'], 0, ['class' => 'custom-select']) !!}
                        </div>
                    </div>
                    <div class="col-md-2">
                        <label for="discount">Descuento:</label>
                        <div class="input-group">
                            
                            {!!Form::number('discount', 0, ['class' => 'form-control', 'min' => '0', 'step' => 'any'])!!}
                            <div class="input-group-append">
                                <span class="input-group-text" id="basic-addon1">%</span>
                            </div>
                        </div>
                    </div>
                </div>

                
                <div class="row mtop16">
                    <div class="col-md-12">
                        <label for="" class="content">Descripción</label>
                        {!! Form::textarea('content', null, ['class' => 'form-control'] )!!}
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
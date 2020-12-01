@extends('admin.master')

@section('title', 'Editar Producto')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="/admin/products">
            <i class="fas fa-boxes"></i>
            Productos
        </a>
    </li>
    <li class="breadcrumb-item">
        <a href="/admin/products/add">
            <i class="fas fa-edit"></i>
            Editar Producto
        </a>
    </li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8">
                <div class="panel">
                    <div class="header">
                        <h2 class="title">
                            <i class="fas fa-edit"></i>
                            Editar Producto
                        </h2>
                    </div>
                    <div class="inside">
                        {!! Form::open(['url' => '/admin/products/'.$p->id.'/edit', 'files' => true]) !!}
                        <div class="row">

                            <div class="col-md-6">
                                <label for="title"> Nombre del Producto:</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1"><i class="far fa-keyboard"></i></span>
                                    </div>
                                    {!! Form::text('name', $p->name, ['class' => 'form-control']) !!}
                                </div>
                            </div>

                            <div class="col-md-3">
                                <label for="category"> Categoría:</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1"><i class="far fa-keyboard"></i></span>
                                    </div>
                                    {!!Form::select('category',$cats, $p->category_id, ['class' => 'custom-select']) !!}
                                </div>
                            </div>
                            <div class="col-md-3">

                                <label for="title"> Imagen Destacada:</label>
                                <div class="custom-file">
                                    {!! Form::file('img', ['class' => 'custom-file-input', 'id' =>'customFile', 'accept'=>'image/*']) !!}
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
                                    {!!Form::number('price', $p->price, ['class' => 'form-control', 'min' => '0.00', 'step' => 'any'])!!}
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label for="indiscount">¿En Descuento?</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1"><i class="far fa-keyboard"></i></span>
                                    </div>
                                    {!!Form::select('indiscount', ['0' => 'No', '1' => 'Si'], $p->in_discount, ['class' => 'custom-select']) !!}
                                </div>
                            </div>
                            <div class="col-md-2">
                                <label for="discount">Descuento:</label>
                                <div class="input-group">

                                    {!!Form::number('discount', $p->discount, ['class' => 'form-control', 'min' => '0', 'step' => 'any'])!!}
                                    <div class="input-group-append">
                                        <span class="input-group-text" id="basic-addon1">%</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label for="status">Estado</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1"><i class="far fa-keyboard"></i></span>
                                    </div>
                                    {!!Form::select('status', ['0' => 'Borrador', '1' => 'Publico'], $p->status, ['class' => 'custom-select']) !!}
                                </div>
                            </div>
                        </div>


                        <div class="row mtop16">
                            <div class="col-md-12">
                                <label for="" class="content">Descripción</label>
                                {!! Form::textarea('content', $p->contenido, ['class' => 'form-control', 'id' => 'editor'] )!!}
                            </div>
                        </div>
                        <div class="row mtop16">
                            <div class="col-md-12">
                                {!!Form::submit('Guardar', ['class' => 'btn btn-dark'])!!}
                            </div>
                        </div>

                        {!! Form::close() !!}
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="panel">
                    <div class="header">
                        <h2 class="title">
                            <i class="far fa-image"></i>
                            Imagen Destacada
                            <div class="inside">
                                <img src="../../../{{$p->file_path.$p->image}}" alt="" class="img-fluid" width="">
                            </div>
                        </h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

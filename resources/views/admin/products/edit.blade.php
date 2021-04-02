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
            <div class="col-md-12">
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

                        <input id = "file1" type="file" class="inputdrag" multiple>

                        <hr>
                        <div id="drop" class="row d-flex justify-content-center">
                            <input id="open_file" type="file" multiple class="ocultar">
                            <label id="open_label" for="open_file" class="open col-md-6"><i class="fas fa-images"></i><span class="mleft">Elija o Arrastre las fotos aquí</span></label>
                            <label for="file1" class="ocultar"></label>
                        </div>

                        <input type='hidden' id='product_id' name='product_id' value="{{ $p->id }}"/>
                        <input type='hidden' id='company_id' name='company_id'/>
                        <input type='hidden' id='sub_id' name='sub_id'/>
                        <input type='hidden' id='id' name='id'/>
                        <input id="uploadImage" type="file" accept="image/*" name="image" />
                        <input id="uploadImageMiniature" type="file" accept="image/*" name="image" />

                        <div class="productos" id="gallery">
                            @foreach ($p->getGallery as $img)
                                <article id="{{$img->id}}">
                                    <img src="{{url($img->file_path.'t_'.$img->file_name)}}">
                                    <div class="row">
                                        <div class="col-md-6 d-flex justify-content-center">
                                            <a class="eliminar_foto" data-toggle="tooltip" data-placement="top" title="Eliminar Foto">
                                                <input type="hidden" value="{{$img->id}}">
                                                <i class="far fa-trash-alt"></i>
                                            </a>
                                        </div>
                                        <div class="col-md-6 d-flex justify-content-center">
                                            <a class="cover" data-toggle="tooltip" data-placement="top" title="Foto de Portada">
                                                <input id="input_{{$img->id}}" type="hidden" value="{{$img->id}}">
                                                @if ($img->cover_image == 'S')
                                                    <i id="star" name="{{$img->id}}" class="base fas fa-star"></i>
                                                @else
                                                    <i id="star" name="{{$img->id}}" class="base far fa-star"></i>
                                                @endif
                                            </a>
                                        </div>
                                    </div>
                                </article>
                            @endforeach
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
        </div>
    <script src="{{ url('/static/js/draganddrop.js?='.time()) }}"></script>
@endsection



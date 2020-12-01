@extends('admin.master')

@section('title', 'Productos')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ url('/admin/products') }}">
            <i class="fas fa-boxes"></i>
            Productos
        </a>
    </li>
@endsection

@if ( session('mensaje') )
    <div class="alert alert-success">
        {{ session('mensaje') }}
    </div>
@endif

@section('content')
    <div class="container-fluid">
        <div class="panel">
            <div class="header">
                <h2 class="title">
                    <i class="fas fa-boxes"></i>
                    Administrar Productos
                </h2>
            </div>
            <div class="inside">
                <div class="btns">
                    <a href="/admin/products/add" class="btn btn-dark"><i class="fas fa-plus"></i> Agregar Producto</a>
                </div>
                <table class="table table-stripped mtop16">
                    <thead>
                        <tr>
                            <td>ID</td>
                            <td></td>
                            <td>Nombre</td>
                            <td>Categoria</td>
                            <td>Precio</td>
                            <td></td>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($products as $product)
                        <tr>
                            <td width="30">{{$product->id}}</td>
                            {{-- http://mycms.com/products/1606681755.png anda
                                 http://mycms.com/admin/products/1606681755.png no anda --}}
                            <td width="90">
                                {{-- se le agrego fancybox en el href y en el master tambien se agregan dos scripts --}}
                                <a href="../{{$product->file_path.$product->image}}" data-fancybox="gallery">
                                    {{-- <img src="../products/{{$product->relCategory->name}}/t_{{$product->image}}" alt="" class="img-thumbnail" width="90"> --}}
                                    <img src="../{{$product->file_path.$product->image}}" alt="" class="img-thumbnail" width="90">
                                </a>
                            </td>
                            <td>{{$product->name}}</td>
                            <td>{{$product->relCategory->name}}</td>
                            <td>{{$product->price}}</td>
                            <td>
                                <div class="opts">
                                    <a href="/admin/product/{{$product->id}}/edit">
                                        <i class="fas fa-edit" data-toggle="tooltip" data-placement="top" title="Modificar Producto"></i>
                                    </a>
                                    <a href="/admin/product/{{$product->id}}/delete">
                                        <i class="far fa-trash-alt" data-toggle="tooltip" data-placement="top" title="Eliminar Producto"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

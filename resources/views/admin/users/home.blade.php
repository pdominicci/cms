@extends('admin.master')

@section('title', 'Usuarios')

@section('breadcrumb')
    <li class="breadcrumb-item">        
        <a href="{{ url('/admin/users') }}">
            <i class="fas fa-users"></i>
            Usuarios
        </a>        
    </li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="panel">
            <div class="header">
                <h2 class="title">
                    <i class="fas fa-users"></i>
                    Administrar Usuarios
                </h2>            
            </div>
            <div class="inside">
                <table class="table">
                    <thead>
                        <tr>
                            <td>ID</td>
                            <td>Nombre</td>
                            <td>Apellido</td>
                            <td>Email</td>
                            <td></td>
                        </tr>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{$user->id}}</td>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->lastname}}</td>
                                    <td>{{$user->email}}</td>                                    
                                    <td>
                                        <div class="opts">                                            
                                            <a href="{{url('/admin/users/'.$user->id.'/edit')}}">
                                                <i class="fas fa-edit" data-toggle="tooltip" data-placement="top" title="Modificar Usuario"></i>
                                            </a>
                                            <a href="{{url('/admin/users/'.$user->id.'/delete')}}">
                                                <i class="far fa-trash-alt" data-toggle="tooltip" data-placement="top" title="Eliminar Usuario"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </thead>
                </table>
            </div>
        </div>
    </div>
@endsection
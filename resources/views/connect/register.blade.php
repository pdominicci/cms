@extends('connect.master')

@section('title', 'Registrarse')

@section('content')

<div class="box box_register shadow">
    <div class="header">
        <a href="{{url('/')}}"></a>
        <img src="{{url('/static/images/logoPraga.png')}}" alt="">
    </div>
    <div class="inside">
        {!! Form::open(['url' => '/register']) !!}
        <label for="nombre">Nombre</label>
        <div class="input-group">        
            <div class="input-group-prepend">
                <div class="input-group-text"><i class="fas fa-user"></i></div>
            </div>
                {!! Form::text('name', null, ['class' => 'form-control', 'required']) !!}
            
        </div>
        <label for="apellido" class="mtop16">Apellido</label>
        <div class="input-group">        
            <div class="input-group-prepend">
                <div class="input-group-text"><i class="far fa-user"></i></div>
            </div>
                {!! Form::text('lastname', null, ['class' => 'form-control', 'required']) !!}
            
        </div>
        <label for="email" class="mtop16">E-mail</label>
        <div class="input-group">        
            <div class="input-group-prepend">
                <div class="input-group-text"><i class="far fa-envelope-open"></i></div>
            </div>
                {!! Form::email('email', null, ['class' => 'form-control', 'required']) !!}
            
        </div>
        <label for="password" class="mtop16">Clave:</label>
        <div class="input-group">        
            <div class="input-group-prepend">
                <div class="input-group-text"><i class="fas fa-lock"></i></div>
            </div>
                {!! Form::password('password', ['class' => 'form-control', 'required']) !!}
            
        </div>
        <label for="cpassword" class="mtop16">Confirmar Clave:</label>
        <div class="input-group">        
            <div class="input-group-prepend">
                <div class="input-group-text"><i class="fas fa-lock"></i></div>
            </div>
                {!! Form::password('cpassword', ['class' => 'form-control', 'required']) !!}
            
        </div>
        {!! Form::submit('Registrarse',  ['class' => 'btn btn-success mtop16'])!!}
        {!! Form::close() !!}

        @if(Session::has('message'))
            <div class="mtop16 alert alert-{{ Session::get('typealert') }}" style="display:none;">
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

        <div class="footer mtop16">
            <a href="{{ url('/login') }}">Ya tengo cuenta, Ingresar</a>
        </div>
    </div>
    
</div>
@stop
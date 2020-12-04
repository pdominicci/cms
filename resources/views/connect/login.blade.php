@extends('connect.master')

@section('title', 'Login')

@section('content')

<div class="box box_login shadow">
    <div class="header">
        <a href="{{url('/')}}"></a>
        <img src="{{url('/static/images/logoCms.png')}}" alt="">
    </div>
    <div class="inside">
        {!! Form::open(['url' => '/login']) !!}
        <label for="email">E-mail</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <div class="input-group-text"><i class="far fa-envelope-open"></i></div>
            </div>
                {!! Form::email('email', null, ['id' => 'txtEmail','class' => 'form-control']) !!}
        </div>
        <label for="password" class="mtop16">Clave:</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <div class="input-group-text"><i class="fas fa-lock"></i></div>
            </div>
                {!! Form::password('password', ['class' => 'form-control']) !!}
            <div class="msgPassword"></div>
        </div>
        {!! Form::submit('Ingresar',  ['class' => 'btn btn-success mtop16'])!!}
        {!! Form::close() !!}

        @if(Session::has('message'))
            <div class="mtop16 alert alert-{{ Session::get('typealert')}}" style="display:none;">
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
            <a href="{{ url('/register') }}">¿No tienes una cuenta?, Registrate!</a>
            <a href="{{ url('/recover') }}">Recuperar contraseña</a>

        </div>
    </div>

</div>
@stop

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name='csrf-token' content="{{ csrf_token() }}">
    <meta name='routeName' content="{{ Route::currentRouteName() }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ url('/static/css/admin.css?='.time()) }}">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/ea6267f3f1.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <script src="{{ url('/static/libs/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ url('/static/js/admin.js') }}"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />
    <script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>
    <script>
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip()
        })
    </script>
    <title>@yield('title') - CMS</title>
</head>
<body>

    <div class="wrapper">
        <div class="">
            @include('admin.sidebar')
        </div>
        <div class="col2">

            <div class="page">
                <div class="container-fluid">
                    <nav aria-label="breadcrumb shadow">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ url('/admin') }}">
                                    <i class="fas fa-home"></i>
                                    Dashboard
                                </a>
                            </li>
                            @section('breadcrumb')
                            @show
                        </ol>
                    </nav>
                </div>
{{--
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
                @endif --}}

                @if ($errors->any())
                    <ul class="list-group col-8 mx-auto" id='errores'>
                        <li class="list-group-item bg-light text-danger">
                            <i class="fas fa-exclamation-triangle mr-2"></i>
                            Se encontraron errores:
                        </li>
                        @foreach ($errors->all() as $error)
                            <li class="list-group-item list-group-item-danger">
                                <i class="fas fa-exclamation-circle mr-2"></i>
                                {{ $error }}
                            </li>
                        @endforeach
                    </ul>
                @endif
                <script>
                    $('#errores').slideDown();
                    setTimeout(function(){
                                        $('#errores').slideUp();
                                        }, 10000);
                </script>

                @section('content')
                @show
            </div>


        </div>

    </div>

</body>
</html>

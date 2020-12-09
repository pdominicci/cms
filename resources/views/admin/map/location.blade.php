@extends('admin.master')

@section('title', 'Ubicación')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ url('/admin/products') }}">
            <i class="fas fa-map-marker-alt"></i>
            Ubicación
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
            <div class="inside">
            <div class="row">Hardcodeado con Santa Rosa en MapController <?php echo phpinfo() ?></div>
            <div class="row">{{ $geo->geoplugin_latitude }}</div>
            <div class="row">{{ $geo->geoplugin_longitude }}</div>
        </div>
    </div>
@endsection

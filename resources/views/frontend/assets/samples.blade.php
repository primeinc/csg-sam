@extends('frontend.layouts.master')

@push('styles')
<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" />
@endpush

@section('page-header')
    <h1>{{ $page->title or app_name() }}</h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Samples</a></li>
        <li class="active">{{ $page->breadcrumb or '' }}</li>
    </ol>
@endsection

@section('content')
    @foreach ($assets->chunk(2) as $chunk)
    <div class="row">
        @foreach($chunk as $asset)
            @include('frontend.assets._assetBox')
        @endforeach
    </div>
    <div class="clearfix"></div>
    @endforeach

@endsection

@include('frontend.checkout._modalScripts')

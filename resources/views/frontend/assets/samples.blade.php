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
    @forelse ($assets->chunk(2) as $chunk)
    <div class="row">
        @foreach($chunk as $asset)
            @include('frontend.assets._assetBox')
        @endforeach
    </div>
    <div class="clearfix"></div>
    @empty
        <div class="row">
            <div class="col-md-12">
                <div class="box box-solid box-warning">
                    <div class="box-header">
                        <h3 class="box-title">No Checked-Out Samples to List</h3>
                    </div><!-- /.box-header -->
                </div><!-- /.box -->
            </div>
        </div>
        <div class="clearfix"></div>
    @endforelse

@endsection

@include('frontend.checkout._modalScripts')

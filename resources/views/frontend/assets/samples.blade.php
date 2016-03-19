@extends('frontend.layouts.master')

@push('styles')
<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" />
@endpush

@section('content')
    @foreach ($assets->chunk(2) as $chunk)
    <div class="row">
        @foreach($chunk as $asset)
            <div class="col-md-6">
                <div class="box box-default">
                    <div class="box-header with-border">
                        <h3 class="box-title">#{{ $asset->id }}</h3>
                        <div class="box-tools pull-right">
                            @if($asset->location_id != 1)
                                <span class="label label-info">@ {!! $asset->location->name !!}</span>
                            @endif
                            @if ($asset->status == 2 && $asset->activeCheckout)
                                <span class="label label-default ">{!! $asset->activeCheckout->dealer->name !!}</span>
                                <span class="label label-primary hidden-xs">{!! $asset->activeCheckout->dealer->dealership->name !!}</span>
                                @if($asset->activeCheckout->permanent)
                                    <span class="label label-danger">Permanently Checked Out</span>
                                @else
                                    <span class="label label-warning hidden-xs hidden-sm">Checked Out</span>
                                    <span class="label label-default hidden-xs hidden-sm">Due {!! $asset->activeCheckout->expected_return_date->toFormattedDateString() !!}</span>
                                    <span class="label label-warning hidden-md hidden-lg">Due {!! $asset->activeCheckout->expected_return_date->toFormattedDateString() !!}</span>
                                @endif
                            @elseif ($asset->status == 3)
                                <span class="label label-info">In-Storage</span>
                            @else
                                <span class="label label-success">Available</span>
                            @endif
                        </div><!-- /.box-tools -->
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <div class="col-xs-12">
                            <div class="col-xs-12 col-sm-6 col-md-5" >  {{--style="max-width: 200px !important;"--}}
                                <img class="img-responsive" src="/uploads/{{ $asset->image }}" alt="message user image">
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-7">
                                <dl>
                                    <dt>Manufacturer</dt>
                                    <dd class="hideOverflow-1">{{ $asset->mfr->name }}</dd>
                                    <dt>Description</dt>
                                    <dd class="hideOverflow-1">{{ $asset->description }}</dd>
                                    @if ($asset->status == 2)  <!--Checked Out-->
                                    @if(!$asset->activeCheckout->permanent)
                                        <dt>Expected Return</dt>
                                        <dd>{!! $asset->activeCheckout->expected_return_date->diffForHumans() !!}</dd>
                                    @endif
                                        <dt>CSG Rep</dt>
                                        <dd class="hideOverflow-1"><a href="{{ route('samples.out.rep', $asset->activeCheckout->user->id) }}">{{ $asset->activeCheckout->user->name }}</a></dd>
                                    @endif
                                </dl>
                            </div>
                        </div>
                    </div><!-- /.box-body -->
                    <div class="box-footer">
                        <div class="pull-right">
                            <div class="btn-group">
                                {{--<button type="button" class="btn btn-danger">Left</button>--}}
                                <a href="{!! url('samples/' . $asset->id) !!}" class="btn btn-default" role="button">Details</a>
                                @if ($asset->status == 2) {{-- Checked Out --}}
                                    <button type="button" class="btn btn-info checkin" data-id="{{ $asset->id }}" >Checkin</button>
                                @elseif ($asset->status == 3) {{-- In-Storage --}}
                                    {{--<a href="{!! url('checkout/' . $asset->id) !!}" class="btn btn-primary" role="button">Checkout</a>--}}
                                    <button type="button" class="btn btn-primary checkout" data-id="{{ $asset->id }}" >Checkout</button>
                                @else
                                    {{--<a href="{!! url('checkout/' . $asset->id) !!}" class="btn btn-primary" role="button">Checkout</a>--}}
                                    <button type="button" class="btn btn-primary checkout" data-id="{{ $asset->id }}" >Checkout</button>
                                @endif
                            </div>
                        </div><!-- /.box-tools -->
                    </div><!-- box-footer -->
                </div><!-- /.box -->
        </div>
        @endforeach
    </div>
    <div class="clearfix"></div>
    @endforeach
    {{--<div class='row'>--}}
        {{--<div class='col-md-8'>--}}

            {{--<!-- PRODUCT LIST -->--}}
            {{--<div class="box box-primary">--}}
                {{--<div class="box-header with-border">--}}
                    {{--<h3 class="box-title">Recently Added Samples</h3>--}}
                    {{--<div class="box-tools pull-right">--}}
                        {{--<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>--}}
                        {{--<button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>--}}
                    {{--</div>--}}
                {{--</div><!-- /.box-header -->--}}
                {{--<div class="box-body">--}}
                    {{--<ul class="products-list product-list-in-box">--}}

                        {{--@foreach($assets as $asset)--}}
                        {{--<li class="item">--}}
                            {{--<div class="product-img">--}}
                                {{--<img src="/uploads/{{ $asset['image'] }}" alt="Product Image">--}}
                            {{--</div>--}}
                            {{--<div class="product-info">--}}
                                {{--<a href="javascript::;" class="product-title">CSGID #: {{ $asset['id'] }}<span class="label label-warning pull-right">{{ $asset['msrp'] }}</span></a>--}}
                        {{--<span class="product-description">--}}
                          {{--Part: {{ $asset['part'] }}--}}
                          {{--<strong>Manufacture: </strong>{{ $asset['Mfr']['name'] }}--}}
                          {{--<br><strong>Description: </strong>{{ $asset['description'] }}--}}
                        {{--</span>--}}
                            {{--</div>--}}
                        {{--</li><!-- /.item -->--}}
                        {{--@endforeach--}}
                    {{--</ul>--}}
                {{--</div><!-- /.box-body -->--}}
                {{--<div class="box-footer text-center">--}}
                    {{--<a href="javascript::;" class="uppercase">View All Products</a>--}}
                {{--</div><!-- /.box-footer -->--}}
            {{--</div><!-- /.box -->--}}



        {{--</div>--}}
    {{--</div><!-- /.row -->--}}

@endsection

@include('frontend.checkout._modalScripts')

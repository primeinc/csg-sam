@extends('frontend.layouts.master')

@push('styles')
<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" />
@endpush

@section('page-header')
    <h1>
        Asset Info
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Samples</a></li>
        <li class="active">Edit</li>
    </ol>
@endsection

@section('content')
<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12"><!-- left column -->
            <div class="box box-default">
                <div class="box-header with-border">
                    <h3 class="box-title">CSGID: {{ $asset->id }}</h3>
                    <div class="box-tools pull-right">
                        @if($asset->location_id != 1)
                            <span class="label label-info">@ {!! $asset->location->name !!}</span>
                        @endif
                        @if ($asset->status == 2 && $asset->activeCheckout)
                            <span class="label label-default">{!! $asset->activeCheckout->dealer->name !!}</span>
                            <span class="label label-primary">{!! $asset->activeCheckout->dealer->dealership->name !!}</span>
                                @if($asset->activeCheckout->permanent)
                                    <span class="label label-danger">Permanently Checked Out</span>
                                @else
                                    <span class="label label-warning">Checked Out</span>
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
                        <div class="col-xs-7" style="max-width: 300px !important;">
                            <img class="img-responsive pull-left" src="/uploads/{{ $asset->image }}" alt="asset image">
                        </div>
                        <div class="col-xs-5">
                            {{--<div class="pull-right" style="width: 200px; height: 150px; background-image: url('/uploads/{{ $asset->image }}'); background-size: cover;">--}}
                            {{--</div>--}}
                            <dl>
                                <dt>Manufacturer</dt>
                                <dd>{{ $asset->mfr->name }}</dd>
                                <dt>Description</dt>
                                <dd>{{ $asset->description }}</dd>
                                <dt>Part #</dt>
                                <dd>{{ $asset->part }}</dd>
                                <dt>Acknowledgement #</dt>
                                <dd>{{ $asset->ack }}</dd>
                                <dt>List Price</dt>
                                <dd>{{ $asset->msrp }}</dd>
                            </dl>
                        </div>
                    </div>
                </div><!-- /.box-body -->
                <div class="box-footer">
                    <div class="pull-right">
                        <div class="btn-group">
                            @if($asset->location_id == 1)
                                <button type="button" class="btn btn-default location" data-id="{{ $asset->id }}">Assign Location</button>
                            @else
                                <button type="button" class="btn btn-default location" data-id="{{ $asset->id }}">Change Location</button>
                            @endif
                            @if ($asset->status == 2)  <!--Checked Out-->
                                <button type="button" class="btn btn-info checkin" data-id="{{ $asset->id }}" >Checkin</button>
                            @elseif ($asset->status == 3)  <!--In-Storage-->
                                <button type="button" class="btn btn-primary checkout" data-id="{{ $asset->id }}" >Checkout</button>
                            @else
                                <button type="button" class="btn btn-primary checkout" data-id="{{ $asset->id }}" >Checkout</button>
                            @endif
                        </div>
                    </div><!-- /.box-tools -->
                </div><!-- box-footer -->
            </div><!-- /.box -->

        </div><!-- /left column -->
    </div>

    <div class="row">
        <div class="col-md-6"><!-- left column -->
            <!-- Horizontal Form -->
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Edit Asset</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                {!! Form::model($asset, ['method' => 'PATCH', 'action' => ['Frontend\Asset\AssetController@update', $asset->id], 'files' => true, 'class' => 'form-horizontal']) !!}
                    @include('frontend.assets.form')
                {!! Form::close() !!}
            </div>
            <!-- /.box -->
        </div><!-- /left column -->
        <div class="col-md-6"><!-- right column -->

            <div class="box box-default ">
                <div class="box-header with-border">
                    <h3 class="box-title">Print Label</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <div class="form-group">
                        <label for="labelTextArea" class="control-label">Text on the chair label</label>
                        <textarea class="form-control" name="labelTextArea" id="labelTextArea" rows="5">CSG ID # {{ $asset->id }}&#13;&#10;Manufacturer: {{ $asset->mfr->name }}&#13;&#10;Description: {{ $asset->id }}&#13;&#10;Part # {{ $asset->part }}</textarea>
                    </div>
                </div>
                <div class="box-footer">
                    <div class="pull-right">
                        <button type="button" class="btn btn-primary" id="printButton">Print</button>
                    </div><!-- /.box-tools -->
                    <div id='jobStatusDiv'>
                        <span id='jobStatusMessageSpan'></span>
                    </div>
                </div><!-- box-footer -->
            </div><!-- /.box -->
        </div><!-- /right column -->
    </div>

    <div class="row">
        <div class="col-md-12">

            @foreach($asset->assetLogDates as $logDay)
            <ul class="timeline">
                <!-- timeline time label -->
                <li class="time-label">
                    <span class="bg-grey">
                        {{ $logDay->created_at->toFormattedDateString() }}
                    </span>
                </li>
                <!-- /.timeline-label -->
                @foreach($asset->assetLogs as $log )
                    @if($log->created_at->diffInDays($logDay->created_at) === 0)
                <!-- timeline item -->
                <li>
                    <!-- timeline icon -->
                    @if($log->event == 'audit.asset.create')
                        <i class="fa fa-crosshairs bg-primary"></i>
                    @elseif($log->event == 'audit.asset.edit')
                        <i class="fa fa-edit bg-grey"></i>
                    @elseif($log->event == 'audit.asset.checkout')
                        <i class="fa fa-sign-out bg-red"></i>
                    @elseif($log->event == 'audit.asset.checkin')
                        <i class="fa fa-sign-in bg-aqua"></i>
                    @elseif($log->event == 'audit.asset.location.change')
                        <i class="glyphicon glyphicon-map-marker bg-purple"></i>
                    @endif
                    <div class="timeline-item">
                        <span class="time"><i class="fa fa-clock-o"></i> {{ $log->created_at->diffForHumans() }}</span>

                        <h3 class="timeline-header">
                            <a href="#">{{ $log->user->name }}</a>
                            @if($log->event == 'audit.asset.create')
                                created this asset
                            @elseif($log->event == 'audit.asset.edit')
                                edited this asset
                            @elseif($log->event == 'audit.asset.checkout')
                                @if($log->checkout->dealer->id == 1)
                                    checked out this asset to an {{ $log->checkout->dealer->dealership->name }}
                                @else
                                    @if($log->user->id != $log->checkout->user_id)
                                        (on behalf of <a href="#">{{ $log->checkout->user->name }}</a>)
                                    @endif
                                    checked out this asset to {{ $log->checkout->dealer->name }} @ {{ $log->checkout->dealer->dealership->name }}
                                @endif
                            @elseif($log->event == 'audit.asset.checkin')
                                checked in this asset
                            @elseif($log->event == 'audit.asset.location.change')
                                changed the location to {{ $log->context->location_name->new }}
                            @endif
                        </h3>

                        {{--<div class="timeline-body">--}}
                            {{--@if($log->event == 'audit.asset.create')--}}
                                {{--created this asset--}}
                            {{--@elseif($log->event == 'audit.asset.edit')--}}
                                {{--@foreach(json_decode($log->context) as $field => $changed)--}}
                                    {{--<p>--}}
                                    {{--{{ $field }} | {{ $changed->old }} => {{ $changed->new }}--}}
                                    {{--</p>--}}

                                    {{--{{ debug($field) }}--}}
                                    {{--{{ debug($changed) }}--}}
                                {{--@endforeach--}}
                            {{--@elseif($log->event == 'audit.asset.checkout')--}}
                                {{--checked out this asset to {{ $log->checkout->dealer->name }}--}}
                            {{--@elseif($log->event == 'audit.asset.checkin')--}}
                                {{--checked in this asset--}}
                            {{--@endif--}}
                        {{--</div>--}}

                        {{--<div class="timeline-footer">--}}
                            {{--<a class="btn btn-primary btn-xs">...</a>--}}
                        {{--</div>--}}
                    </div>
                </li>
                    @endif
                @endforeach
                <!-- END timeline item -->

            @endforeach
                <li>
                    <i class="fa fa-clock-o bg-gray"></i>
                </li>
            </ul>
        </div>
    </div>
</section>
@endsection


@section('after-scripts-end')
    <script>
        $.fn.select2.defaults.set( "theme", "bootstrap" );
        $.fn.select2.defaults.set( "width", "off" );

        $("#mfr\\[name\\]").select2({
            placeholder: "Select or add a Manufacturer",
            tags: true,
            ajax: {
                url: "{!! route('api.mfrs.search') !!}",
                dataType: 'json',
                delay: 500,
                width: null,
                data: function (params) {
                    return {
                        q: params.term, // search term
                        page: params.page
                    };
                },
                processResults: function (data, params) {
                    // parse the results into the format expected by Select2
                    // since we are using custom formatting functions we do not need to
                    // alter the remote JSON data, except to indicate that infinite
                    // scrolling can be used
                    params.page = params.page || 1;

                    return {
                        results: data.items,
                        pagination: {
                            more: (params.page * 30) < data.total_count
                        }
                    };
                },
                cache: true
            },
            minimumInputLength: 1
        });
    </script>

@endsection

@include('frontend.checkout._modalScripts')
@include('frontend.location._modalScripts')

@push('scripts')
{!! Html::script('js/plugin/dymo/dymo.js') !!}
<script>
    $("#uploadBtn")[0].onchange = function () {
        $("#uploadFile")[0].value = this.value.replace("C:\\fakepath\\", "");
    };
</script>
@endpush

@extends('frontend.layouts.master')

@push('styles')
<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" />
@endpush

@section('page-header')
    <h1>
        CSG # {{ $asset->id }}
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Samples</a></li>
        <li class="active">Details</li>
    </ol>
@endsection

@section('content')
<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12"><!-- left column -->
            <div class="box box-default">
                <div class="box-header with-border">
                    <h3 class="box-title"></h3>
                    <div class="box-tools pull-right">
                        @if($asset->location_id != 1)
                            <span class="label label-info">@ {!! $asset->location->name !!}</span>
                        @endif
                        @if ($asset->status == 2 && $asset->activeCheckout)
                            <span class="label label-default">{!! $asset->activeCheckout->dealer->name !!}</span>
                            <span class="label label-primary hidden-xs">{!! $asset->activeCheckout->dealer->dealership->name !!}</span>
                                @if($asset->activeCheckout->permanent)
                                    <span class="label label-danger">Permanently Checked Out</span>
                                @else
                                    <span class="label label-warning">Checked Out</span>
                                    <span class="label label-default">Due {!! $asset->activeCheckout->expected_return_date->toFormattedDateString() !!}</span>
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
                        <div class="col-xs-12 col-sm-6 col-md-7" style="max-width: 300px !important;">
                            <img class="img-responsive pull-left" src="/uploads/{{ $asset->image }}" alt="asset image">
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-5">
                            {{--<div class="pull-right" style="width: 200px; height: 150px; background-image: url('/uploads/{{ $asset->image }}'); background-size: cover;">--}}
                            {{--</div>--}}
                            <dl>
                                <dt>Manufacturer</dt>
                                <dd>{{ $asset->mfr->name }}</dd>
                                <dt>Description</dt>
                                <dd>{{ $asset->description }}</dd>
                                <dt>Part #</dt>
                                <dd>{{ $asset->part }}</dd>
                                <dt>Ack #</dt>
                                <dd>{{ $asset->ack }}</dd>
                                <dt>List Price</dt>
                                <dd>{{ $asset->msrp }}</dd>
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
                            <button type="button" class="btn btn-default edit" data-toggle="modal" data-target="#editModal">Edit</button>
                            <button type="button" class="btn btn-default print" data-toggle="modal" data-target="#printModal">Print Label</button>
                            @if($asset->location_id == 1 && $asset->status != 2)
                                <button type="button" class="btn btn-default location hidden-xs" data-id="{{ $asset->id }}">Assign Storage Location</button>
                                <button type="button" class="btn btn-default location hidden-sm hidden-md hidden-lg" data-id="{{ $asset->id }}">Location</button>
                            @elseif($asset->status != 2)
                                <button type="button" class="btn btn-default location hidden-xs" data-id="{{ $asset->id }}">Change Storage Location</button>
                                <button type="button" class="btn btn-default location hidden-sm hidden-md hidden-lg" data-id="{{ $asset->id }}">Location</button>
                            @endif
                            @if ($asset->status == 2)  <!--Checked Out-->
                                @if(!$asset->activeCheckout->permanent)
                                    <a href="{{ route('checkout.remind', $asset->activeCheckout->id) }}" type="button" class="btn bg-teal reminder hidden-xs" data-id="{{ $asset->id }}" >Send Reminder</a>
                                    <a href="{{ route('checkout.remind', $asset->activeCheckout->id) }}" type="button" class="btn bg-teal reminder hidden-sm hidden-md hidden-lg" data-id="{{ $asset->id }}" >Reminder</a>
                                @endif
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
                    @elseif($log->event == 'audit.asset.checkout.reminder')
                        <i class="fa fa-envelope bg-orange"></i>
                    @endif
                    <div class="timeline-item">
                        <span class="time"><i class="fa fa-clock-o"></i> {{ $log->created_at->diffForHumans() }}</span>

                        <h3 class="timeline-header">
                            <a href="{!! route('samples.out.rep', $log->user->id) !!}">{{ $log->user->name }}</a>
                            @if($log->event == 'audit.asset.create')
                                created this asset
                            @elseif($log->event == 'audit.asset.edit')
                                edited this asset
                            @elseif($log->event == 'audit.asset.checkout')
                                @if($log->checkout->dealer->id == 1)
                                    checked out this asset to an {{ $log->checkout->dealer->dealership->name }}
                                @else
                                    @if($log->user->id != $log->checkout->user_id)
                                        (on behalf of <a href="{!! route('samples.out.rep', $log->checkout->user->id) !!}">{{ $log->checkout->user->name }}</a>)
                                    @endif
                                    checked out this asset to <a href="{!! route('samples.out.dsr', $log->checkout->dealer->id) !!}">
                                            {{ $log->checkout->dealer->name }} </a> @ {{ $log->checkout->dealer->dealership->name }}
                                @endif
                            @elseif($log->event == 'audit.asset.checkin')
                                checked in this asset
                            @elseif($log->event == 'audit.asset.location.change')
                                changed the location to {{ $log->context->location_name->new }}
                            @elseif($log->event == 'audit.asset.checkout.reminder')
                                sent a reminder email to {{ $log->context->reminderLog->dealer_name }}
                            @endif
                        </h3>


                        @if($log->event == 'audit.asset.edit')
                            <div class="timeline-body">
                                @foreach($log->context as $field => $changed)
                                    <p>
                                    <code>{{ ucfirst($field) }}</code> has changed from  <code>{{ $changed->old }}</code> to <code>{{ $changed->new }}</code>
                                    </p>
                                @endforeach
                            </div>
                        @elseif($log->event == 'audit.asset.checkout' && !empty($log->checkout->project))
                            <div class="timeline-body">
                                    <p>
                                        <code>Expected Return Date</code> {{ $log->checkout->expected_return_date->toFormattedDateString() }}
                                    </p>
                                    <p class="no-margin">
                                        <code>Project</code> {{ $log->checkout->project }}
                                    </p>
                            </div>
                        @elseif($log->event == 'audit.asset.checkin' && !empty($log->checkout->notes))
                            <div class="timeline-body">
                                <p class="no-margin">
                                    <code>Notes</code> {{ $log->checkout->notes }}
                                </p>
                            </div>
                        @endif

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

    <!-- Modal -->
    <div id="editModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Edit Asset</h4>
                </div>
                <div class="modal-body">
                    {!! Form::model($asset, ['method' => 'PATCH', 'action' => ['Frontend\Asset\AssetController@update', $asset->id], 'files' => true, 'class' => 'form-horizontal']) !!}
                    @include('frontend.assets.form')
                    {!! Form::close() !!}
                </div>
            </div>

        </div>
    </div>
    <!-- Modal -->
    <div id="printModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Print Label</h4>
                </div>
                <div class="modal-body">
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
                </div>
            </div>

        </div>
    </div>
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

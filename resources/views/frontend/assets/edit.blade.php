@extends('frontend.layouts.master')

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
                        {{--$asset->activeCheckout--}}
                        @if ($asset->status == 2)
                        <span class="label label-warning">
                                Checked Out
                            </span>
                        @elseif ($asset->status == 3)
                            <span class="label label-info">
                                In-Storage
                            </span>
                        @else
                            <span class="label label-success">
                                Avaliable
                            </span>
                        @endif
                    </div><!-- /.box-tools -->
                </div><!-- /.box-header -->
                <div class="box-body">
                    <div class="col-xs-12">
                        <div class="col-xs-6 col-md-5" style="max-width: 250px !important;">
                            <img class="img-responsive" src="/uploads/{{ $asset->image }}" alt="message user image">
                        </div>
                        <div class="col-xs-6 col-md-7">
                            <dl>
                                <dt>Manufacturer</dt>
                                <dd>{{ $asset->mfr->name }}</dd>
                                <dt>Description</dt>
                                <dd>{{ $asset->description }}</dd>
                                <dt>Part #</dt>
                                <dd>{{ $asset->part }}</dd>
                                <dt>ACK #</dt>
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
                            @if ($asset->status == 2)  <!--Checked Out-->
                                <button type="button" class="btn btn-default">Move to Storage</button>
                                <button type="button" class="btn btn-info checkin" data-id="{{ $asset->id }}" >Checkin</button>
                            @elseif ($asset->status == 3)  <!--In-Storage-->
                                <button type="button" class="btn btn-default">Remove from Storage</button>
                                <a href="{!! url('checkout/' . $asset->id) !!}" class="btn btn-primary" role="button">Checkout</a>
                            @else
                                <button type="button" class="btn btn-default">Move to Storage</button>
                                <a href="{!! url('checkout/' . $asset->id) !!}" class="btn btn-primary" role="button">Checkout</a>
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
                <form action="/samples/update/{{ $asset->id }}" method="POST" class="form-horizontal" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="box-body">
                        <div class="form-group">
                            <label for="asset-id" class="col-sm-3 control-label">CSGID #</label>

                            <div class="col-sm-9">
                                <input type="text" name="id" id="asset-id" class="form-control" value="{{ $asset->id }}" disabled>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="asset-part" class="col-sm-3 control-label">Part #</label>

                            <div class="col-sm-9">
                                <input type="text" name="part" id="asset-part" class="form-control" value="{{ $asset->part }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="asset-ack" class="col-sm-3 control-label">ACK #</label>

                            <div class="col-sm-9">
                                <input type="text" name="ack" id="asset-ack" class="form-control" value="{{ $asset->ack }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="asset-mfr" class="col-sm-3 control-label">Manufacturer</label>

                            <div class="col-sm-9">
                                <select id="asset-mfr" name="mfr" class="form-control select2">
                                    <option>{{ $asset->mfr->name }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="asset-description" class="col-sm-3 control-label">Description</label>

                            <div class="col-sm-9">
                                <input type="text" name="description" id="asset-description" class="form-control" value="{{ $asset->description }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="asset-msrp" class="col-sm-3 control-label">List Price</label>

                            <div class="col-sm-9">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-dollar"></i></span>
                                    <input type="text" name="msrp" id="asset-msrp" class="form-control" value="{{ $asset->msrp }}">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="asset-image" class="col-sm-3 control-label">Picture</label>
                            <div class="col-sm-9">
                                <input type="file" name="image" id="asset-image" class="form-control">
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <button type="submit" class="btn btn-info pull-right">Save</button>
                    </div>
                    <!-- /.box-footer -->
                </form>
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
                        <button type="button" class="btn btn-primary">Print</button>
                    </div><!-- /.box-tools -->
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
                                checked out this asset to {{ $log->checkout->dealer->employee_name }} @ {{ $log->checkout->dealer->company_name }}
                            @elseif($log->event == 'audit.asset.checkin')
                                checked in this asset
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
                                {{--checked out this asset to {{ $log->checkout->dealer->employee_name }}--}}
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

        $("#asset-mfr").select2({
            placeholder: "Select or add a Manufacturer",
            tags: true,
            ajax: {
                url: "{!! route('frontend.mfrs.search') !!}",
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

@push('scripts')
    <script type="text/javascript">
        jQuery(function($){
            $('button.checkin').click(function(ev){
                ev.preventDefault();
                var uid = $(this).data('id');
                $.get('/samples/checkin/' + uid, function(html){
                    $('#dynModal .modal-content').html(html);
                    $('#dynModal').modal('show', {backdrop: 'static'});
                });
            });
        });
    </script>
@stop

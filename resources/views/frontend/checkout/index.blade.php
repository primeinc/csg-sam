@extends('frontend.layouts.master')

@push('styles')
<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" />
@stop

@section('page-header')
    <h1>
        Checkout Asset
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Samples</a></li>
        <li class="active">Checkout</li>
    </ol>
@endsection

@section('content')
<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-6"><!-- left column -->
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
                                <dt>List Price</dt>
                                <dd>{{ $asset->msrp }}</dd>
                            </dl>
                        </div>
                    </div>
                </div><!-- /.box-body -->
            </div><!-- /.box -->

        </div><!-- /left column -->
        <div class="col-md-6">
            <div class="box box-default">
                <div class="box-header with-border">
                    <h3 class="box-title">Checkout</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form action="/checkout/{{ $asset->id }}" method="POST" class="form-horizontal" >
                    {{ csrf_field() }}
                    <div class="box-body">
                        <!-- Date range -->
                        <div class="form-group">
                            <label for="checkout-daterange" class="col-sm-3 control-label">Return Date</label>

                            <div class="col-sm-9">
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" class="form-control pull-right" name="daterange" id="checkout-daterange">
                                </div>
                            </div>
                            <!-- /.input group -->
                        </div>
                        <!-- /.form group -->
                        <div class="form-group">
                            <label for="checkout-dealer" class="col-sm-3 control-label">Dealer</label>

                            <div class="col-sm-9">
                                <select id="checkout-dealer" name="dealer" class="form-control select2">
                                    <option></option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="checkout-rep" class="col-sm-3 control-label">CSG Rep</label>

                            <div class="col-sm-9">
                                <select id="checkout-rep" name="rep" class="form-control select2">
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="box-footer">
                        <button type="submit" class="btn btn-info pull-right">Checkout</button>
                    </div>
                    <!-- /.box-footer -->
                </form>
            </div><!-- /.box -->
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
@stop

@section('after-scripts-end')
    <script>
        $('input[name="daterange"]').daterangepicker({
            singleDatePicker: true,
            showDropdowns: true
        });
        $.fn.select2.defaults.set( "theme", "bootstrap" );
        $.fn.select2.defaults.set( "width", "off" );

        $("#checkout-dealer").select2({
            placeholder: "Select a Dealer",
            ajax: {
                url: "{!! route('frontend.dealers.search') !!}",
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
        })
        .on('change', function(e) {
            item = $(this).select2('data');
            $("#checkout-rep")
                    .empty()
                    .append($('<option>', {value: item[0].user_id, selected: "selected"})
                            .text(item[0].user_name))
                    .select2({
                        data: reps.responseJSON.items
                    });

        });
        var reps;
        $(document).ready(function() {
            reps = $.getJSON("{!! route('frontend.user.search.all') !!}");
        });
    </script>
@endsection

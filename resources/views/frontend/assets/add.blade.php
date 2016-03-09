@extends('frontend.layouts.master')

@section('content')
    <div class="row">

        <div class="col-md-10 col-md-offset-1">

            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">New Asset</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form action="/samples/add" method="POST" class="form-horizontal" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="box-body">
                        <div class="form-group">
                            <label for="asset-part" class="col-sm-3 control-label">Part #</label>

                            <div class="col-sm-9">
                                <input type="text" name="part" id="asset-part" class="form-control" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="asset-ack" class="col-sm-3 control-label">ACK #</label>

                            <div class="col-sm-9">
                                <input type="text" name="ack" id="asset-ack" class="form-control" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="asset-mfr" class="col-sm-3 control-label">Manufacturer</label>

                            <div class="col-sm-9">
                                <select id="asset-mfr" name="mfr" class="form-control select2">
                                    <option></option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="asset-description" class="col-sm-3 control-label">Description</label>

                            <div class="col-sm-9">
                                <input type="text" name="description" id="asset-description" class="form-control" >
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="asset-msrp" class="col-sm-3 control-label">List Price</label>

                            <div class="col-sm-9">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-dollar"></i></span>
                                    <input type="text" name="msrp" id="asset-msrp" class="form-control" >
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
                        <button type="submit" class="btn btn-info pull-right">Add Asset</button>
                    </div>
                    <!-- /.box-footer -->
                </form>
            </div>
            <!-- /.box -->

        </div><!-- col-md-10 -->
    </div>
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

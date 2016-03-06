@extends('frontend.layouts.master')

@section('content')
    <div class="row">

        <div class="col-md-10 col-md-offset-1">

            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">New Dealer</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form action="/dealers/add" method="POST" class="form-horizontal" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="box-body">
                        <div class="form-group">
                            <label for="dealer-company" class="col-sm-3 control-label">Company</label>

                            <div class="col-sm-9">
                                <input type="text" name="company_name" id="dealer-company" class="form-control" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="dealer-employee" class="col-sm-3 control-label">Employee Name</label>

                            <div class="col-sm-9">
                                <input type="text" name="employee_name" id="dealer-employee" class="form-control" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="dealer-user" class="col-sm-3 control-label">Assigned User</label>

                            <div class="col-sm-9">
                                <select id="dealer-user" name="user_id" class="form-control select2">
                                    <option></option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <button type="submit" class="btn btn-info pull-right">Add Dealer</button>
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

        $("#dealer-user").select2({
            placeholder: "Select a User",
            ajax: {
                url: "{!! route('frontend.user.search') !!}",
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

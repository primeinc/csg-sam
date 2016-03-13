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
                            <label for="dealer-dealership" class="col-sm-3 control-label">Dealership</label>

                            <div class="col-sm-9">
                                <select id="dealer-dealership" name="dealership_id" class="form-control select2">
                                    <option></option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="dealer-employee" class="col-sm-3 control-label">Dealer Sales Rep</label>

                            <div class="col-sm-9">
                                <input type="text" name="employee_name" id="dealer-employee" class="form-control" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="dealer-user" class="col-sm-3 control-label">Assigned Rep</label>

                            <div class="col-sm-9">
                                <select id="dealer-user" name="user_id" class="form-control select2">
                                    <option value="{{ access()->user()->id }}" selected="selected">{{ access()->user()->name }}</option>
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

        $(document).ready(function() {
            $.getJSON("{!! route('frontend.dealerships.search.all') !!}", function (data) {
                $("#dealer-dealership").select2({
                    placeholder: 'Select or add a Dealership',
                    tags: true,
                    data: data.items,
                    createTag: function (params) {
                        return {
                            id: params.term,
                            text: 'New: ' + params.term,
                            newOption: false
                        }
                    }
                })
            });
            $.getJSON("{!! route('frontend.user.search.all') !!}", function (data) {
                $("#dealer-user").select2({
                    data: data.items
                });
            });
        });
    </script>

@endsection

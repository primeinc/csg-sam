@extends('frontend.layouts.master')

@section('content')
    <div class="row">

        <div class="col-md-10 col-md-offset-1">

            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-plus"></i> New Asset
                </div>

                <div class="panel-body">
                    <form action="/samples/add" method="POST" class="form-horizontal" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <!-- Asset Name -->
                        <div class="form-group">
                            <label for="asset-part" class="col-sm-3 control-label">Part #</label>

                            <div class="col-sm-6">
                                <input type="text" name="part" id="asset-part" class="form-control">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="asset-mfr" class="col-sm-3 control-label">Manufacture</label>

                            <div class="col-sm-6">
                                <input type="text" name="part" id="asset-mfr" class="form-control">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="asset-description" class="col-sm-3 control-label">Description</label>

                            <div class="col-sm-6">
                                <input type="text" name="description" id="asset-description" class="form-control">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="asset-msrp" class="col-sm-3 control-label">List Price</label>

                            <div class="col-sm-6">
                                <input type="text" name="msrp" id="asset-msrp" class="form-control">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="asset-image" class="col-sm-3 control-label">Picture</label>
                            <div class="col-sm-6">
                                <input type="file" name="image" id="asset-image" class="form-control">
                            </div>
                        </div>

                        <!-- Add Asset Button -->
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-6">
                                <button type="submit" class="btn btn-default pull-right">
                                    <i class="fa fa-plus"></i> Add Asset
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div><!-- panel -->

        </div><!-- col-md-10 -->
    </div>
@endsection



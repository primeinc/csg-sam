@extends('frontend.layouts.master')

@section('content')
    <div class="row">

        <div class="col-md-10 col-md-offset-1">

            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Update Dealership</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                {!! Form::model($dealership, ['method' => 'PATCH', 'route' => ['dealerships.update', $dealership->id], 'class' => 'form-horizontal']) !!}
                    @include('frontend.dealerships.form')
                {!! Form::close() !!}
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
            $.getJSON("{!! route('api.get.all', 'dealerships') !!}", function (data) {
                $("#name").select2({
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
        });
    </script>

@endsection

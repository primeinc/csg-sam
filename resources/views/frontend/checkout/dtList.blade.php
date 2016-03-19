@extends('frontend.layouts.master')

@push('styles')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/t/dt/dt-1.10.11,b-1.1.2/datatables.min.css"/>
@stop

@section('content')
    <div class="row">

        <div class="col-md-10 col-md-offset-1">
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title">Active Checkouts</h3>

                    <div class="box-tools pull-right">
                    </div>
                </div><!-- /.box-header -->

                {{--<div class="box-body">--}}
                    {!! $dataTable->table(['class' => 'table table-striped']) !!}
                {{--</div>--}}
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script type="text/javascript" src="https://cdn.datatables.net/t/dt/dt-1.10.11,b-1.1.2/datatables.min.js"></script>
<script src="/vendor/datatables/buttons.server-side.js"></script>
{!! $dataTable->scripts() !!}
<script>
    {{-- Readd deleted popups --}}
    $(document).on( 'draw.dt', function () {
        addDeleteForms();
        $(".dataTable").css("width", "");{{-- fix for chrome --}}
    } );
</script>
@stop



@extends('frontend.layouts.master')

@section('page-header')
    <h1>
        {{ trans('labels.backend.access.users.management') }}
        <small>{{ trans('labels.backend.access.users.active') }}</small>
    </h1>
@endsection

@section('content')
    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title">{{ trans('labels.backend.access.users.active') }}</h3>

            <div class="box-tools pull-right">
                @include('backend.access.includes.partials.header-buttons')
            </div>
        </div><!-- /.box-header -->

        <div class="box-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Company Name</th>
                        <th>Employee Name</th>
                        <th>CSG Rep</th>
                        <th class="visible-lg">Created</th>
                        <th class="visible-lg">Last Updated</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($dealers as $dealer)
                        <tr>
                            <td>{!! $dealer->id !!}</td>
                            <td>{!! $dealer->company_name !!}</td>
                            <td>{!! $dealer->employee_name !!}</td>
                            <td>{!! $dealer->User->name !!}</td>
                            <td class="visible-lg">{!! $dealer->created_at->diffForHumans() !!}</td>
                            <td class="visible-lg">{!! $dealer->updated_at->diffForHumans() !!}</td>
                            <td>{!! $dealer->action_buttons !!}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            <div class="pull-left">
{{--                {!! $dealer->total() !!} {{ trans_choice('labels.backend.access.users.table.total', $users->total()) }}--}}
            </div>

            <div class="pull-right">
{{--                {!! $dealer->render() !!}--}}
            </div>

            <div class="clearfix"></div>
        </div><!-- /.box-body -->
    </div><!--box-->
@stop
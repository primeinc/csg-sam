<div class="box-body">
    @if(isset($dealership))
        {{ Form::select2('name', 'Dealership', [$dealership->id => $dealership->name], $dealership->name) }}
    @else
        {{ Form::select2('name', 'Dealership') }}
    @endif
</div>
<!-- /.box-body -->
<div class="box-footer">
    @if(isset($dealership))
        {{ Form::submit('Update Dealership', ['class' => 'btn btn-info pull-right']) }}
    @else
        {{ Form::submit('Add Dealership', ['class' => 'btn btn-info pull-right']) }}
    @endif
</div>
<!-- /.box-footer -->

<div class="box-body">
    @if(isset($mfr))
        {{ Form::select2('name', 'Manufacturer', [$mfr->id => $mfr->name], $mfr->name) }}
    @else
        {{ Form::select2('name', 'Manufacturer') }}
    @endif
</div>
<!-- /.box-body -->
<div class="box-footer">
    @if(isset($mfr))
        {{ Form::submit('Update Manufacturer', ['class' => 'btn btn-info pull-right']) }}
    @else
        {{ Form::submit('Add Manufacturer', ['class' => 'btn btn-info pull-right']) }}
    @endif
</div>
<!-- /.box-footer -->

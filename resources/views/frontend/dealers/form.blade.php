<div class="box-body">
    {{ Form::bsText('name', 'Dealer Sales Rep') }}
    {{ Form::bsText('email') }}
    @if(isset($dealer))
        {{ Form::select2('dealership[name]', 'Dealership', [$dealer->dealership->id => $dealer->dealership->name], $dealer->dealership->name) }}
        {{ Form::select2('user[id]', 'Assigned Rep', [$dealer->user->id => $dealer->user->name], $dealer->user->name) }}
    @else
        {{ Form::select2('dealership[name]', 'Dealership') }}
        {{ Form::select2('user[id]', 'Assigned Rep', [access()->user()->id => access()->user()->name ], access()->user()->name) }}
    @endif
</div>
<!-- /.box-body -->
<div class="box-footer">
    @if(isset($dealer))
        {{ Form::submit('Update DSR', ['class' => 'btn btn-info pull-right']) }}
    @else
        {{ Form::submit('Add DSR', ['class' => 'btn btn-info pull-right']) }}
    @endif
</div>
<!-- /.box-footer -->

{{-- Registered in app/Providers/MacroServiceProvider.php --}}
<div class="form-group">
    {{ Form::label($name, $label, ['class' => 'control-label col-sm-3']) }}

    <div class="col-sm-9">
        {!! Form::select($name, $list, $selected, array_merge(['class' => 'form-control select2'], $attributes)) !!}
    </div>
</div>

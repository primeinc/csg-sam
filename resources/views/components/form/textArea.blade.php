{{-- Registered in app/Providers/MacroServiceProvider.php --}}
<div class="form-group">
    {{ Form::label($name, $label, ['class' => 'control-label col-sm-3']) }}
    <div class="col-sm-9">
        {{ Form::textarea($name, $value, array_merge(['class' => 'form-control'], $attributes)) }}
    </div>
</div>

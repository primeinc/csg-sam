{{-- Registered in app/Providers/MacroServiceProvider.php --}}
<div class="form-group">
    {{ Form::label($name, $label, ['class' => 'control-label col-sm-3']) }}
    <div class="col-sm-9">
        <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-dollar"></i></span>
            {{ Form::text($name, $value, array_merge(['class' => 'form-control'], $attributes)) }}
        </div>
    </div>
</div>

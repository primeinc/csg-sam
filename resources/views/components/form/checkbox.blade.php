{{-- Registered in app/Providers/MacroServiceProvider.php --}}
<div class="form-group">
    <label class="col-sm-3 control-label"></label>
    <div class="col-sm-9">
        <div class="checkbox">
            <label>
                {{ Form::checkbox($name, $value, $checked, $attributes) }}
                {{ $label }}
            </label>
        </div>
    </div>
</div>

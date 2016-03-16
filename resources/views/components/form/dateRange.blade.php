{{-- Registered in app/Providers/MacroServiceProvider.php --}}
<div class="form-group">
    {{ Form::label($name, $label, ['class' => 'control-label col-sm-3']) }}
    <div class="col-sm-9">
        <div class="input-group">
            <div class="input-group-addon">
                <i class="fa fa-calendar"></i>
            </div>
            {{ Form::text($name, $value, array_merge(['class' => 'form-control pull-right'], $attributes)) }}
        </div>
    </div>
</div>

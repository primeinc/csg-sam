{{-- Registered in app/Providers/MacroServiceProvider.php --}}
<div class="form-group">
    {{ Form::label($name, $label, ['class' => 'control-label col-sm-3']) }}
    <div class="col-sm-9">
        <div class="input-group">
            <input class="form-control" id="uploadFile" placeholder="No file chosen" disabled="disabled" />
            <span class="input-group-btn">
                <div class="fileUpload btn btn-primary btn-flat">
                    <span>Choose File</span>
                    {{ Form::file($name, array_merge(['class' => 'upload'], ['id' => 'uploadBtn'], $attributes)) }}
                </div>
            </span>
        </div>
    </div>
</div>

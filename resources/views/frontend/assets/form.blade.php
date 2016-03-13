<div class="box-body">
    {{ Form::bsText('part', 'Part #') }}
    {{ Form::bsText('ack', 'ACK #') }}
    @if(isset($asset))
        {{-- TODO: Change MFR value to MFR_ID --}}
        {{ Form::select2('mfr[name]', 'Manufacturer', [$asset->mfr->name => $asset->mfr->name], $asset->mfr->name) }}
    @else
        {{ Form::select2('mfr[name]', 'Manufacturer') }}
    @endif
    {{ Form::bsText('description') }}
    {{ Form::currencyText('msrp', 'List Price') }}
    {{ Form::bsFile('image', 'Picture') }}
</div>
<!-- /.box-body -->
<div class="box-footer">
    @if(isset($asset))
        {{ Form::submit('Save', ['class' => 'btn btn-info pull-right']) }}
    @else
        {{ Form::submit('Add Asset', ['class' => 'btn btn-info pull-right']) }}
    @endif
</div>
<!-- /.box-footer -->

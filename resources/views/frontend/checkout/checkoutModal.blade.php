<!-- Modal -->
{!! Form::open(['method' => 'POST', 'route' => ['checkout.store', $asset->id], 'class' => 'form-horizontal']) !!}
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span>
        <span class="sr-only">Close</span>
    </button>
    <h4 class="modal-title" id="dynModalLabel">Checkout Asset # {{ $asset->id }}</h4>
</div>
<div class="modal-body">
    {{ Form::dateRange('daterange', 'Return Date') }}
    {{ Form::select2('dealer_id', 'Dealer') }}
    {{ Form::select2('user_id', 'CSG Rep') }}
    {{ Form::bsText('project') }}
    {{ Form::bsCheckbox('permanent', 'Permanent Sample?') }}
</div>
<div class="modal-footer">
    <button type="submit" class="btn btn-info pull-right">Checkout</button>
</div>
<!-- /.box-footer -->
</form>


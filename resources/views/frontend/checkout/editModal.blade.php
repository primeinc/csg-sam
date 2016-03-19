<!-- Modal -->
{!! Form::model($checkout, ['method' => 'PATCH', 'route' => ['checkout.update', $checkout->id], 'class' => 'form-horizontal']) !!}
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span>
        <span class="sr-only">Close</span>
    </button>
    <h4 class="modal-title" id="dynModalLabel">Edit Checkout # {{ $checkout->id }}</h4>
</div>
<div class="modal-body">
    {{ Form::dateRange('daterange', 'Return Date') }}
    {{ Form::select2('dealer[id]', 'Dealer', [$checkout->dealer->id => $checkout->dealer->name], $checkout->dealer->name) }}
    {{ Form::select2('user[id]', 'CSG Rep', [$checkout->user->id => $checkout->user->name], $checkout->user->name) }}
    {{ Form::bsText('project') }}
    {{ Form::bsCheckbox('permanent', 'Permanent Sample?') }}
</div>
<div class="modal-footer">
    <button type="submit" class="btn btn-info pull-right">Checkout</button>
</div>
<!-- /.box-footer -->
</form>


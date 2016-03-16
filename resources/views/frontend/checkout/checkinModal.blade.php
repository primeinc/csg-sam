{{--Modal--}}
{!! Form::open(['method' => 'POST', 'route' => ['checkout.return', $asset->id], 'class' => 'form-horizontal']) !!}
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span>
        <span class="sr-only">Close</span>
    </button>
    <h4 class="modal-title" id="dynModalLabel">Checkin Asset # {{ $asset->id }}</h4>
</div>
<div class="modal-body">
    {{ Form::bsTextArea('notes', null, null, ['rows' => 5]) }}
</div>
<div class="modal-footer">
    <button type="submit" class="btn btn-info pull-right">Checkin</button>
</div>
{!! Form::close()!!}


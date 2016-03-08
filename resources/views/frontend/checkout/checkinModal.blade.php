    <!-- Modal -->
    <form action="/samples/checkin/{{ $asset->id }}" method="POST" class="form-horizontal">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
            </button>
            <h4 class="modal-title" id="myModalLabel">Checkin Asset # {{ $asset->id }}</h4>
        </div>
        <div class="modal-body">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="check-notes" class="col-sm-3 control-label">Notes</label>

                <div class="col-sm-9">
                    <textarea class="form-control" name="notes" id="checkin-notes" rows="5"></textarea>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-info pull-right">Checkin</button>
        </div>
    </form>


    <!-- Modal -->
    <!-- form start -->
    {!! Form::model($asset, ['method' => 'PATCH', 'action' => ['Frontend\Asset\AssetController@updateLocation', $asset->id], 'class' => 'form-horizontal']) !!}
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
            </button>
            <h4 class="modal-title" id="myModalLabel">Change Location</h4>
        </div>
        <div class="modal-body">
            {{ Form::select2('location[name]', 'Location', [$asset->location->id => $asset->location->name], $asset->location->name) }}
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-info pull-right">Update</button>
        </div>
        <!-- /.box-footer -->
    {!! Form::close() !!}

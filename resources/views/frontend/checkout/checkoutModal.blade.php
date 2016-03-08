    <!-- Modal -->
    <!-- form start -->
    <form action="/checkout/{{ $asset->id }}" method="POST" class="form-horizontal" >
        {{ csrf_field() }}
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
            </button>
            <h4 class="modal-title" id="myModalLabel">Checkout Asset # {{ $asset->id }}</h4>
        </div>
        <div class="modal-body">
            <!-- Date range -->
            <div class="form-group">
                <label for="checkout-daterange" class="col-sm-3 control-label">Return Date</label>

                <div class="col-sm-9">
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text" class="form-control pull-right" name="daterange" id="checkout-daterange">
                    </div>
                </div>
                <!-- /.input group -->
            </div>
            <!-- /.form group -->
            <div class="form-group">
                <label for="checkout-dealer" class="col-sm-3 control-label">Dealer</label>

                <div class="col-sm-9">
                    <select id="checkout-dealer" name="dealer" class="form-control select2">
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="checkout-rep" class="col-sm-3 control-label">CSG Rep</label>

                <div class="col-sm-9">
                    <select id="checkout-rep" name="rep" class="form-control select2">
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="checkout-notes" class="col-sm-3 control-label">Notes</label>

                <div class="col-sm-9">
                    <input type="text" name="notes" id="checkout-notes" class="form-control">
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-info pull-right">Checkout</button>
        </div>
        <!-- /.box-footer -->
    </form>


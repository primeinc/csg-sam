<div class="col-md-6">
    <div class="box box-default">
        <div class="box-header with-border">
            <h3 class="box-title">#{{ $asset->id }}</h3>
            <div class="box-tools pull-right">
                @if($asset->location_id != 1)
                    <span class="label label-info">@ {!! $asset->location->name !!}</span>
                @endif
                @if ($asset->status == 2 && $asset->activeCheckout)
                    <span class="label label-default "><a href="{{ route('samples.out.dsr', $asset->activeCheckout->dealer_id ) }}" >{!! $asset->activeCheckout->dealer->name !!}</a></span>
                    <span class="label label-primary hidden-xs hidden-md">{!! $asset->activeCheckout->dealer->dealership->name !!}</span>
                    @if($asset->activeCheckout->permanent)
                        <span class="label label-danger">Permanently Checked Out</span>
                    @else
                        <span class="label label-warning">Due {!! $asset->activeCheckout->expected_return_date->toFormattedDateString() !!}</span>
                    @endif
                @elseif ($asset->status == 3)
                    <span class="label label-info">In-Storage</span>
                @else
                    <span class="label label-success">Available</span>
                @endif
            </div><!-- /.box-tools -->
        </div><!-- /.box-header -->
        <div class="box-body">
            <div class="col-xs-12">
                <div class="col-xs-12 col-sm-6 col-md-5" >  {{--style="max-width: 200px !important;"--}}
                    <img class="img-responsive" src="/uploads/{{ $asset->image }}" alt="message user image">
                </div>
                <div class="col-xs-12 col-sm-6 col-md-7">
                    <dl>
                        <dt>Manufacturer</dt>
                        <dd class="hideOverflow-1">{{ $asset->mfr->name }}</dd>
                        <dt>Description</dt>
                        <dd class="hideOverflow-1">{{ $asset->description }}</dd>
                        @if ($asset->status == 2)  <!--Checked Out-->
                        @if(!$asset->activeCheckout->permanent)
                            <dt>Expected Return</dt>
                            <dd>{!! $asset->activeCheckout->expected_return_date->diffForHumans() !!}</dd>
                        @endif
                        <dt>CSG Rep</dt>
                        <dd class="hideOverflow-1"><a href="{{ route('samples.out.rep', $asset->activeCheckout->user->id) }}">{{ $asset->activeCheckout->user->name }}</a></dd>
                        @endif
                    </dl>
                </div>
            </div>
        </div><!-- /.box-body -->
        <div class="box-footer">
            <div class="pull-right">
                <div class="btn-group">
                    {{--<button type="button" class="btn btn-danger">Left</button>--}}
                    <a href="{!! url('samples/' . $asset->id) !!}" class="btn btn-default" role="button">Details</a>
                    @if ($asset->status == 2) {{-- Checked Out --}}
                    <button type="button" class="btn btn-info checkin" data-id="{{ $asset->id }}" >Check-In</button>
                    @elseif ($asset->status == 3) {{-- In-Storage --}}
                    {{--<a href="{!! url('checkout/' . $asset->id) !!}" class="btn btn-primary" role="button">Checkout</a>--}}
                    <button type="button" class="btn btn-primary checkout" data-id="{{ $asset->id }}" >Checkout</button>
                    @else
                        {{--<a href="{!! url('checkout/' . $asset->id) !!}" class="btn btn-primary" role="button">Checkout</a>--}}
                        <button type="button" class="btn btn-primary checkout" data-id="{{ $asset->id }}" >Checkout</button>
                    @endif
                </div>
            </div><!-- /.box-tools -->
        </div><!-- box-footer -->
    </div><!-- /.box -->
</div>

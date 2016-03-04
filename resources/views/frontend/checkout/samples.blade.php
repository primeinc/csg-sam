@extends('frontend.layouts.master')

@section('content')
    <div class="row">
        @foreach($assets as $asset)
        <div class="col-md-6">
                <div class="box box-default ">
                    <div class="box-header with-border">
                        <h3 class="box-title">#{{ $asset->id }}</h3>
                        <div class="box-tools pull-right">
                            {{--<span class="label label-default">{{ $asset['msrp'] }}</span>--}}
                            @if ($asset->status == 2) {{--$asset->activeCheckout--}}
                            <span class="label label-warning">
                                Checked Out
                            </span>
                            @elseif ($asset->status == 3)
                            <span class="label label-info">
                                In-Storage
                            </span>
                            @else
                            <span class="label label-success">
                                Avaliable
                            </span>
                            @endif
                        </div><!-- /.box-tools -->
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <div class="col-xs-6">
                            <img class="img-responsive" src="/uploads/{{ $asset->image }}" alt="message user image">
                        </div>
                        <dl>
                            <dt>Manufacture</dt>
                            <dd>{{ $asset->Mfr->name }}</dd>
                            <dt>Description</dt>
                            <dd>{{ $asset->description }}</dd>
                        </dl>
                    </div><!-- /.box-body -->
                    <div class="box-footer">
                        <div class="pull-right">
                            <div class="btn-group">
                                {{--<button type="button" class="btn btn-danger">Left</button>--}}
                                @if ($asset->status == 2) {{-- Checked Out --}}
                                    <button type="button" class="btn btn-default">Edit</button>
                                    <button type="button" class="btn btn-info">Checkin</button>
                                @elseif ($asset->status == 3) {{-- In-Storage --}}
                                    <button type="button" class="btn btn-default">Edit</button>
                                    <button type="button" class="btn btn-primary">Checkout</button>
                                @else
                                    <button type="button" class="btn btn-default">Edit</button>
                                    <button type="button" class="btn btn-primary">Checkout</button>
                                @endif
                            </div>
                        </div><!-- /.box-tools -->
                    </div><!-- box-footer -->
                </div><!-- /.box -->
        </div>
        @endforeach
    </div>
    <div class='row'>
        <div class='col-md-8'>

            <!-- PRODUCT LIST -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Recently Added Samples</h3>
                    <div class="box-tools pull-right">
                        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <ul class="products-list product-list-in-box">

                        @foreach($assets as $asset)
                        <li class="item">
                            <div class="product-img">
                                <img src="/uploads/{{ $asset['image'] }}" alt="Product Image">
                            </div>
                            <div class="product-info">
                                <a href="javascript::;" class="product-title">CSGID #: {{ $asset['id'] }}<span class="label label-warning pull-right">{{ $asset['msrp'] }}</span></a>
                        <span class="product-description">
                          {{--Part: {{ $asset['part'] }}--}}
                          <strong>Manufacture: </strong>{{ $asset['Mfr']['name'] }}
                          <br><strong>Description: </strong>{{ $asset['description'] }}
                        </span>
                            </div>
                        </li><!-- /.item -->
                        @endforeach
                    </ul>
                </div><!-- /.box-body -->
                <div class="box-footer text-center">
                    <a href="javascript::;" class="uppercase">View All Products</a>
                </div><!-- /.box-footer -->
            </div><!-- /.box -->



        </div>
    </div><!-- /.row -->
@endsection



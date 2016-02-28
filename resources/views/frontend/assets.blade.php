@extends('frontend.layouts.master')

@section('content')
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



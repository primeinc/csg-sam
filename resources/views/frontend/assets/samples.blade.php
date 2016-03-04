@extends('frontend.layouts.master')

@section('content')
    <div class="row">
        @foreach($assets as $asset)
            <div class="col-md-6">
                <div class="box box-default">
                    <div class="box-header with-border">
                        <h3 class="box-title">CSGID: {{ $asset->id }}</h3>
                        <div class="box-tools pull-right">
                            {{--$asset->activeCheckout--}}
                            @if ($asset->status == 2)
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
                        <div class="col-xs-12">
                            <div class="col-xs-6 col-md-5" style="max-width: 250px !important;">
                                <img class="img-responsive" src="/uploads/{{ $asset->image }}" alt="message user image">
                            </div>
                            <div class="col-xs-6 col-md-7">
                                <dl>
                                    <dt>Manufacturer</dt>
                                    <dd>{{ $asset->Mfr->name }}</dd>
                                    <dt>Description</dt>
                                    <dd>{{ $asset->description }}</dd>
                                    <dt>Part #</dt>
                                    <dd>{{ $asset->part }}</dd>
                                    <dt>List Price</dt>
                                    <dd>{{ $asset->msrp }}</dd>
                                </dl>
                            </div>
                        </div>
                    </div><!-- /.box-body -->
                    <div class="box-footer">
                        <div class="pull-right">
                            <div class="btn-group">
                                {{--<button type="button" class="btn btn-danger">Left</button>--}}
                                @if ($asset->status == 2) {{-- Checked Out --}}
                                    <a href="{!! url('samples/edit/' . $asset->id) !!}" class="btn btn-default" role="button">Edit</a>
                                    <button type="button" class="btn btn-info">Checkin</button>
                                @elseif ($asset->status == 3) {{-- In-Storage --}}
                                    <a href="{!! url('samples/edit/' . $asset->id) !!}" class="btn btn-default" role="button">Edit</a>
                                    <button type="button" class="btn btn-primary">Checkout</button>
                                @else
                                    <a href="{!! url('samples/edit/' . $asset->id) !!}" class="btn btn-default" role="button">Edit</a>
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



    <!-- Main content -->
    <section class="content">
        <!-- Info boxes -->
        <div class="row">
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-aqua"><i class="ion ion-ios-gear-outline"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">CPU Traffic</span>
                        <span class="info-box-number">90<small>%</small></span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-red"><i class="fa fa-google-plus"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Likes</span>
                        <span class="info-box-number">41,410</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->

            <!-- fix for small devices only -->
            <div class="clearfix visible-sm-block"></div>

            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-green"><i class="ion ion-ios-cart-outline"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Sales</span>
                        <span class="info-box-number">760</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-yellow"><i class="ion ion-ios-people-outline"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">New Members</span>
                        <span class="info-box-number">2,000</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
        <div class="row">
            <!-- left column -->
            {{--<div class="col-md-6">--}}
            <div class="col-md-6">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Quick Example</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Email address</label>
                                <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Password</label>
                                <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputFile">File input</label>
                                <input type="file" id="exampleInputFile">

                                <p class="help-block">Example block-level help text here.</p>
                            </div>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox"> Check me out
                                </label>
                            </div>
                        </div>
                        <!-- /.box-body -->

                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
                <!-- /.box -->

                <!-- Form Element sizes -->
                <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title">Different Height</h3>
                    </div>
                    <div class="box-body">
                        <input class="form-control input-lg" type="text" placeholder=".input-lg">
                        <br>
                        <input class="form-control" type="text" placeholder="Default input">
                        <br>
                        <input class="form-control input-sm" type="text" placeholder=".input-sm">
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->

                <div class="box box-danger">
                    <div class="box-header with-border">
                        <h3 class="box-title">Different Width</h3>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-xs-3">
                                <input type="text" class="form-control" placeholder=".col-xs-3">
                            </div>
                            <div class="col-xs-4">
                                <input type="text" class="form-control" placeholder=".col-xs-4">
                            </div>
                            <div class="col-xs-5">
                                <input type="text" class="form-control" placeholder=".col-xs-5">
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->

                <!-- Input addon -->
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">Input Addon</h3>
                    </div>
                    <div class="box-body">
                        <div class="input-group">
                            <span class="input-group-addon">@</span>
                            <input type="text" class="form-control" placeholder="Username">
                        </div>
                        <br>

                        <div class="input-group">
                            <input type="text" class="form-control">
                            <span class="input-group-addon">.00</span>
                        </div>
                        <br>

                        <div class="input-group">
                            <span class="input-group-addon">$</span>
                            <input type="text" class="form-control">
                            <span class="input-group-addon">.00</span>
                        </div>

                        <h4>With icons</h4>

                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                            <input type="email" class="form-control" placeholder="Email">
                        </div>
                        <br>

                        <div class="input-group">
                            <input type="text" class="form-control">
                            <span class="input-group-addon"><i class="fa fa-check"></i></span>
                        </div>
                        <br>

                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-dollar"></i></span>
                            <input type="text" class="form-control">
                            <span class="input-group-addon"><i class="fa fa-ambulance"></i></span>
                        </div>

                        <h4>With checkbox and radio inputs</h4>

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="input-group">
                        <span class="input-group-addon">
                          <input type="checkbox">
                        </span>
                                    <input type="text" class="form-control">
                                </div>
                                <!-- /input-group -->
                            </div>
                            <!-- /.col-lg-6 -->
                            <div class="col-lg-6">
                                <div class="input-group">
                        <span class="input-group-addon">
                          <input type="radio">
                        </span>
                                    <input type="text" class="form-control">
                                </div>
                                <!-- /input-group -->
                            </div>
                            <!-- /.col-lg-6 -->
                        </div>
                        <!-- /.row -->

                        <h4>With buttons</h4>

                        <p class="margin">Large: <code>.input-group.input-group-lg</code></p>

                        <div class="input-group input-group-lg">
                            <div class="input-group-btn">
                                <button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown">Action
                                    <span class="fa fa-caret-down"></span></button>
                                <ul class="dropdown-menu">
                                    <li><a href="#">Action</a></li>
                                    <li><a href="#">Another action</a></li>
                                    <li><a href="#">Something else here</a></li>
                                    <li class="divider"></li>
                                    <li><a href="#">Separated link</a></li>
                                </ul>
                            </div>
                            <!-- /btn-group -->
                            <input type="text" class="form-control">
                        </div>
                        <!-- /input-group -->
                        <p class="margin">Normal</p>

                        <div class="input-group">
                            <div class="input-group-btn">
                                <button type="button" class="btn btn-danger">Action</button>
                            </div>
                            <!-- /btn-group -->
                            <input type="text" class="form-control">
                        </div>
                        <!-- /input-group -->
                        <p class="margin">Small <code>.input-group.input-group-sm</code></p>

                        <div class="input-group input-group-sm">
                            <input type="text" class="form-control">
                    <span class="input-group-btn">
                      <button type="button" class="btn btn-info btn-flat">Go!</button>
                    </span>
                        </div>
                        <!-- /input-group -->
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->

            </div>
            <!--/.col (left) -->
            <!-- right column -->
            <div class="col-md-6">
                <!-- Horizontal Form -->
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">Horizontal Form</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form class="form-horizontal">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label">Email</label>

                                <div class="col-sm-10">
                                    <input type="email" class="form-control" id="inputEmail3" placeholder="Email">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputPassword3" class="col-sm-2 control-label">Password</label>

                                <div class="col-sm-10">
                                    <input type="password" class="form-control" id="inputPassword3" placeholder="Password">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox"> Remember me
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                            <button type="submit" class="btn btn-default">Cancel</button>
                            <button type="submit" class="btn btn-info pull-right">Sign in</button>
                        </div>
                        <!-- /.box-footer -->
                    </form>
                </div>
                <!-- /.box -->
                <!-- general form elements disabled -->
                <div class="box box-warning">
                    <div class="box-header with-border">
                        <h3 class="box-title">General Elements</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <form role="form">
                            <!-- text input -->
                            <div class="form-group">
                                <label>Text</label>
                                <input type="text" class="form-control" placeholder="Enter ...">
                            </div>
                            <div class="form-group">
                                <label>Text Disabled</label>
                                <input type="text" class="form-control" placeholder="Enter ..." disabled>
                            </div>

                            <!-- textarea -->
                            <div class="form-group">
                                <label>Textarea</label>
                                <textarea class="form-control" rows="3" placeholder="Enter ..."></textarea>
                            </div>
                            <div class="form-group">
                                <label>Textarea Disabled</label>
                                <textarea class="form-control" rows="3" placeholder="Enter ..." disabled></textarea>
                            </div>

                            <!-- input states -->
                            <div class="form-group has-success">
                                <label class="control-label" for="inputSuccess"><i class="fa fa-check"></i> Input with success</label>
                                <input type="text" class="form-control" id="inputSuccess" placeholder="Enter ...">
                            </div>
                            <div class="form-group has-warning">
                                <label class="control-label" for="inputWarning"><i class="fa fa-bell-o"></i> Input with
                                    warning</label>
                                <input type="text" class="form-control" id="inputWarning" placeholder="Enter ...">
                            </div>
                            <div class="form-group has-error">
                                <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> Input with
                                    error</label>
                                <input type="text" class="form-control" id="inputError" placeholder="Enter ...">
                            </div>

                            <!-- checkbox -->
                            <div class="form-group">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox">
                                        Checkbox 1
                                    </label>
                                </div>

                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox">
                                        Checkbox 2
                                    </label>
                                </div>

                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" disabled>
                                        Checkbox disabled
                                    </label>
                                </div>
                            </div>

                            <!-- radio -->
                            <div class="form-group">
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked>
                                        Option one is this and that&mdash;be sure to include why it's great
                                    </label>
                                </div>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="optionsRadios" id="optionsRadios2" value="option2">
                                        Option two can be something else and selecting it will deselect option one
                                    </label>
                                </div>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="optionsRadios" id="optionsRadios3" value="option3" disabled>
                                        Option three is disabled
                                    </label>
                                </div>
                            </div>

                            <!-- select -->
                            <div class="form-group">
                                <label>Select</label>
                                <select class="form-control">
                                    <option>option 1</option>
                                    <option>option 2</option>
                                    <option>option 3</option>
                                    <option>option 4</option>
                                    <option>option 5</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Select Disabled</label>
                                <select class="form-control" disabled>
                                    <option>option 1</option>
                                    <option>option 2</option>
                                    <option>option 3</option>
                                    <option>option 4</option>
                                    <option>option 5</option>
                                </select>
                            </div>

                            <!-- Select multiple-->
                            <div class="form-group">
                                <label>Select Multiple</label>
                                <select multiple class="form-control">
                                    <option>option 1</option>
                                    <option>option 2</option>
                                    <option>option 3</option>
                                    <option>option 4</option>
                                    <option>option 5</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Select Multiple Disabled</label>
                                <select multiple class="form-control" disabled>
                                    <option>option 1</option>
                                    <option>option 2</option>
                                    <option>option 3</option>
                                    <option>option 4</option>
                                    <option>option 5</option>
                                </select>
                            </div>

                        </form>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!--/.col (right) -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->

@endsection



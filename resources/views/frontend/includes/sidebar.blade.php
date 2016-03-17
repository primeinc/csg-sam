<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel (optional) -->
        @roles(['Administrator', 'User'])
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{!! access()->user()->picture !!}" class="img-circle" alt="User Image" />
            </div>
            <div class="pull-left info">
                <p>{!! access()->user()->name !!}</p>
                <!-- Status -->
                <a href="#"><i class="fa fa-circle text-success"></i> {{ trans('strings.frontend.general.status.online') }}</a>
            </div>
        </div>

        <!-- search form (Optional) -->
        <form action="{!! url('search') !!}" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="{{ trans('strings.frontend.general.search_placeholder') }}"/>
                  <span class="input-group-btn">
                    <button type='submit' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
                  </span>
            </div>
        </form>
        <!-- /.search form -->
        @endauth

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <!-- Optionally, you can add icons to the links -->
            <li class="{{ Active::pattern('dashboard') }}">
                <a href="{!! route('frontend.user.dashboard') !!}">
                    <i class="fa fa-dashboard"></i>
                    <span>{{ trans('menus.frontend.sidebar.dashboard') }}</span>
                </a>
            </li>

            <li class="{{ Active::pattern('samples/*') }} treeview">
                <a href="#">
                    <i class="fa fa-cube"></i>
                    <span>{{ trans('menus.frontend.samples.main') }}</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu {{ Active::pattern('samples/*', 'menu-open') }}" style="display: none; {{ Active::pattern('samples/*', 'display: block;') }}">
                    <li class="{{ Active::pattern('samples/recent') }}">
                        <a href="{!! url('samples/recent') !!}">
                            <i class="fa fa-cubes"></i>
                            {{ trans('menus.frontend.samples.recent') }}
                        </a>
                    </li>
                    <li class="{{ Active::pattern('samples/out') }}">
                        <a href="{!! url('samples/out') !!}">
                            <i class="fa fa-clock-o"></i>
                            {{ trans('menus.frontend.samples.out') }}
                        </a>
                    </li>
                    <li class="{{ Active::pattern('samples/create') }}">
                        <a href="{!! url('samples/create') !!}">
                            <i class="fa fa-plus"></i>
                            {{ trans('menus.frontend.samples.add') }}
                        </a>
                    </li>
                </ul>
            </li>

            <li class="{{ Active::pattern('dealers/*') }} treeview">
                <a href="#">
                    <i class="fa fa-group"></i>
                    <span>{{ trans('menus.frontend.dealers.main') }}</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu {{ Active::pattern('dealers*', 'menu-open') }}" style="display: none; {{ Active::pattern('dealers*', 'display: block;') }}">
                    <li class="{{ Active::pattern('dealers/list') }}">
                        <a href="{!! url('dealers/list') !!}">
                            <i class="fa fa-user"></i>
                            {{ trans('menus.frontend.dealers.dsr') }}
                        </a>
                    </li>
                    <li class="{{ Active::pattern('dealers/create') }}">
                        <a href="{!! url('dealers/create') !!}">
                            <i class="fa fa-user-plus"></i>
                            {{ trans('menus.frontend.dealers.createDsr') }}
                        </a>
                    </li>
                    <li class="{{ Active::pattern('dealerships/list') }}">
                        <a href="{!! url('dealerships/list') !!}">
                            <i class="fa fa-building"></i>
                            {{ trans('menus.frontend.dealers.dealerships') }}
                        </a>
                    </li>
                </ul>
            </li>

            <li class="{{ Active::pattern('mfrs/*') }} treeview">
                <a href="#">
                    <i class="fa fa-building"></i>
                    <span>{{ trans('menus.frontend.mfrs.main') }}</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu {{ Active::pattern('mfrs/*', 'menu-open') }}" style="display: none; {{ Active::pattern('mfrs/*', 'display: block;') }}">
                    <li class="{{ Active::pattern('mfrs/list') }}">
                        <a href="{!! url('mfrs/list') !!}">
                            <i class="fa fa-search"></i>
                            {{ trans('menus.frontend.mfrs.list') }}
                        </a>
                    </li>
                </ul>
            </li>

            @permission('view-access-management')

            <!-- Optionally, you can add icons to the links -->
            <li class="{{ Active::pattern('admin/dashboard') }}">
                <a href="{!! route('admin.dashboard') !!}">
                    <i class="fa fa-cog"></i>
                    <span>{{ trans('menus.frontend.sidebar.admin') }}</span>
                </a>
            </li>
            @endauth
        </ul><!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>

<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse">
        <ul class="nav" id="side-menu">
            <li class="sidebar-search">
                <div class="input-group custom-search-form">
                    <input type="text" class="form-control" placeholder="Search...">
                    <span class="input-group-btn">
                                <button class="btn btn-default" type="button">
                                    <i class="fa fa-search"></i>
                                </button>
                    </span>
                </div>
                <!-- /input-group -->
            </li>
            <li>
                <h3>Menu Admin</h3>
            </li>
            <li>
                <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> quản lý user<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="{!! route('getThemUser') !!}">Add user</a>
                    </li>
                    <li>
                        <a href="{!! route('danhSachUser') !!}">list user</a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>
            <li>
                <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> quản lý sản phẩm<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="{!! route('getThemProduct') !!}">Add product</a>
                    </li>
                    <li>
                        <a href="{!! route('danhSachProduct') !!}">list product</a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>
            <li>
                <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> quản lý danh mục<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="{!! route('getThemcate') !!}">Add category</a>
                    </li>
                    <li>
                        <a href="{!! route('danhSachcate') !!}">list category</a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>
            <li>
                <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> quản lý danh Màu<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="{!! route('getThemcolor') !!}">Add Color</a>
                    </li>
                    <li>
                        <a href="{!! route('danhSachColor') !!}">list Color</a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>
            <li>
                <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> quản lý danh SIZE<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="{!! route('getThemsize') !!}">Add Size</a>
                    </li>
                    <li>
                        <a href="{!! route('danhSachsize') !!}">list Size</a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>
            <li>
               <li><a href="{!! route('danhSachorder') !!}">Lịch Sử Mua Hàng</a></li>
            </li><li>
               <li><a href="{!! route('trangchu') !!}">Quay Về Trang Chủ</a></li>
            </li>
        </ul>
    </div>
    <!-- /.sidebar-collapse -->
</div>
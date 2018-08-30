
<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <!-- Title  -->
    <title>Essence - Fashion Ecommerce Template</title>
    <link href="{!! asset('vendor/bootstrap/css/bootstrap.min.css') !!}" rel="stylesheet">
    <link href="{!! asset('dist/css/sb-admin-2.css') !!}" rel="stylesheet">

    <!-- Favicon  -->
    <link rel="icon" href="{!! asset('img/core-img/favicon.ico') !!}">

    <!-- Core Style CSS -->
    <link rel="stylesheet" href="{!! asset('css/core-style.css') !!}">
    <link rel="stylesheet" href="{!! asset('css/style.css') !!}">
    <script src="{!! asset('js/jquery-3.3.1.min.js') !!}"></script>
</head>

<body>
<!-- ##### Header Area Start ##### -->
<header class="header_area">
    <div class="classy-nav-container breakpoint-off d-flex align-items-center justify-content-between">
        <!-- Classy Menu -->
        <nav class="classy-navbar" id="essenceNav">
            <!-- Logo -->
            <a class="nav-brand" href="{!! route('trangchu') !!}"><img src="img/core-img/logo.png" alt=""></a>
            <!-- Navbar Toggler -->
            <div class="classy-navbar-toggler">
                <span class="navbarToggler"><span></span><span></span><span></span></span>
            </div>
            <!-- Menu -->
            <div class="classy-menu">
                <!-- close btn -->
                <div class="classycloseIcon">
                    <div class="cross-wrap"><span class="top"></span><span class="bottom"></span></div>
                </div>
                <!-- Nav Start -->
                <div class="classynav">
                    <ul>
                        <li><a href="{!! route('blog') !!} ">Blog</a></li>
                    </ul>
                </div>
                <!-- Nav End -->
            </div>
        </nav>

        <!-- Header Meta Data -->
        <div class="header-meta d-flex clearfix justify-content-end">
            <!-- Search Area -->
            <div class="search-area">
                <form action="#" method="post">
                    <input type="search" name="search" id="headerSearch" placeholder="Type for search">
                    <button type="submit"><i class="glyphicon glyphicon-search" aria-hidden="true"></i></button>
                </form>
            </div>
            <!-- Favourite Area -->
            <!-- User Login Info -->
            @if(\Illuminate\Support\Facades\Auth::check())
                <div class="user-login-info">
                    <a style="width: 146px;" href="">{!! \Illuminate\Support\Facades\Auth::user()->name !!}</a>
                </div>
                <div class="user-login-info">
                    <form action="{!! route('logout_user') !!}" method="post">
                        @csrf
                        <input style="width: 73px;height: 31px; margin-top: 23px;" type="submit" value="Đăng xuất">
                    </form>
                </div>
            @else
                <div class="user-login-info">
                    <a href="{!! route('login') !!}">Đăng Nhập</a>
                </div>
                <div class="user-login-info">
                    <a href="{!! route('dangki') !!}">Đăng kí</a>
                </div>
        @endif
        <!-- Cart Area -->
            <div class="cart-area">
                <a href="#" id="essenceCartBtn"><img src="img/core-img/bag.svg" alt=""> <span>3</span></a>
            </div>
        </div>

    </div>
</header>
<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="login-panel panel panel-default">
                <div class="panel-heading">
                    @if(Session::has('thongbao'))
                        <div class="alert alert-danger">{!! Session::get('thongbao') !!}
                        </div>
                    @endif
                    <h3 style="text-align: center" class="panel-title">Đăng Nhập Người Dùng</h3>
                </div>
                <div class="panel-body">
                    <form role="form" action="{!! route('postlogin') !!}" method="post">
                        @csrf
                        <fieldset>
                            <div class="form-group">
                                <input class="form-control" value="{!! old('email') !!}" placeholder="E-mail" id="email" name="email" type="text" autofocus>
                                @if($errors->has('email'))
                                    <div class="text-danger">{!! $errors->first('email') !!}
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <input class="form-control" placeholder="Password" name="password" id="password" type="password" value="">
                                @if($errors->has('password'))
                                    <div class="text-danger">{!! $errors->first('password') !!}
                                    </div>
                                @endif
                            </div>
                            <div class="checkbox">
                                <label>
                                    <input name="remember" type="checkbox" value="1" >Remember Me
                                </label>
                            </div>
                            <!-- Change this to a button or input when using this as a form -->
                            <input id="btnsubmit" class="btn btn-lg btn-success btn-block" type="submit" name="submit" value="Đăng Nhập">
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@include('fonend.pages.footer')
<!-- ##### Footer Area End ##### -->

<!-- jQuery (Necessary for All JavaScript Plugins) -->
<script src="{!! asset('css/style.css') !!}"></script>



</body>

</html>
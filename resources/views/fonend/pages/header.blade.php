<!-- ##### Header Area Start ##### -->
<header class="header_area">
    <div class="classy-nav-container breakpoint-off d-flex align-items-center justify-content-between">
        <!-- Classy Menu -->
        <nav class="classy-navbar" id="essenceNav">
            <!-- Logo -->
            <a class="nav-brand" href="{!! route('trangchu') !!}">Trang chủ</a>
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
                       {{-- <li><a href="{!! route('contact') !!}">Contact</a></li>--}}
                    </ul>
                </div>
                <!-- Nav End -->
            </div>
        </nav>

        <!-- Header Meta Data -->

        <div class="header-meta d-flex clearfix justify-content-end">
            <!-- Search Area -->
            <div class="search-area">
                <form action="{!! route('timkiem') !!}" method="post">
                    @csrf
                    <input type="search" name="name" id="" placeholder="Type for search">
                    <button type="submit"><i class="glyphicon glyphicon-search" ></i></button>
                </form>
            </div>
            <!-- Favourite Area -->


            <!-- User Login Info -->

            @if(\Illuminate\Support\Facades\Auth::check())
                <div class="user-login-info">
                    <a style="width: 146px;" href=""><b style="color: red"> Hi:&nbsp;&nbsp;&nbsp;</b></>{!! \Illuminate\Support\Facades\Auth::user()->name !!}</a>
                </div>
                <div class="user-login-info">
                        <form action="{!! route('logout_user') !!}" method="post">
                            @csrf
                            <input style="width: 73px;height: 31px; margin-top: 23px;" type="submit" value="Đăng xuất">
                        </form>
                </div>
                <div class="user-login-info">
                        @if(\Illuminate\Support\Facades\Auth::user()->lever == 1)
                            <a style="width: 146px;" href="{!! route('danhSachorder') !!}"><b style="color: red">admin</b></a>
                        @elseif(\Illuminate\Support\Facades\Auth::user()->lever == 2)
                            <a style="width: 146px;" href="{!! route('danhSachorder') !!}"><b style="color: red">Supper admin</b></a>
                        @endif
                </div>
                <div class="user-login-info">
                    <a style="width: 146px;" href="{!! route('lichsu',['id'=>\Illuminate\Support\Facades\Auth::user()->id ]) !!}"><b style="color: red">Lịch Sử Mua</b></a>
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
                <a class="glyphicon glyphicon-shopping-cart" href="{!! route('checkout') !!}" id="essenceCartBtn"></a>
            </div>
        </div>

    </div>
</header>
<div class="cart-bg-overlay"></div>

<div class="right-side-cart-area">

    <!-- Cart Button -->
    <div class="cart-button">
        <a href="#" id="rightSideCart"><img src="img/core-img/bag.svg" alt=""> <span>3</span></a>
    </div>

    <div class="cart-content d-flex">

        <!-- Cart List Area -->
        <div class="cart-list">
            <!-- Single Cart Item -->
            <div class="single-cart-item">
                <a href="#" class="product-image">
                    <img src="img/product-img/product-1.jpg" class="cart-thumb" alt="">
                    <!-- Cart Item Desc -->
                    <div class="cart-item-desc">
                        <span class="product-remove"><i class="fa fa-close" aria-hidden="true"></i></span>
                        <span class="badge">Mango</span>
                        <h6>Button Through Strap Mini Dress</h6>
                        <p class="size">Size: S</p>
                        <p class="color">Color: Red</p>
                        <p class="price">$45.00</p>
                    </div>
                </a>
            </div>

            <!-- Single Cart Item -->
            <div class="single-cart-item">
                <a href="#" class="product-image">
                    <img src="img/product-img/product-2.jpg" class="cart-thumb" alt="">
                    <!-- Cart Item Desc -->
                    <div class="cart-item-desc">
                        <span class="product-remove"><i class="fa fa-close" aria-hidden="true"></i></span>
                        <span class="badge">Mango</span>
                        <h6>Button Through Strap Mini Dress</h6>
                        <p class="size">Size: S</p>
                        <p class="color">Color: Red</p>
                        <p class="price">$45.00</p>
                    </div>
                </a>
            </div>

            <!-- Single Cart Item -->
            <div class="single-cart-item">
                <a href="#" class="product-image">
                    <img src="img/product-img/product-3.jpg" class="cart-thumb" alt="">
                    <!-- Cart Item Desc -->
                    <div class="cart-item-desc">
                        <span class="product-remove"><i class="fa fa-close" aria-hidden="true"></i></span>
                        <span class="badge">Mango</span>
                        <h6>Button Through Strap Mini Dress</h6>
                        <p class="size">Size: S</p>
                        <p class="color">Color: Red</p>
                        <p class="price">$45.00</p>
                    </div>
                </a>
            </div>
        </div>

        <!-- Cart Summary -->
        <div class="cart-amount-summary">

            <h2>Summary</h2>
            <ul class="summary-table">
                <li><span>subtotal:</span> <span>$274.00</span></li>
                <li><span>delivery:</span> <span>Free</span></li>
                <li><span>discount:</span> <span>-15%</span></li>
                <li><span>total:</span> <span>$232.00</span></li>
            </ul>
            <div class="checkout-btn mt-100">
                <a href="checkout.html" class="btn essence-btn">check out</a>
            </div>
        </div>
    </div>
</div>
<!-- ##### Right Side Cart End ##### -->

<!-- ##### Breadcumb Area Start ##### -->
{{--<div class="breadcumb_area bg-img" style="background-image: url(img/bg-img/breadcumb.jpg);">
    <div class="container h-100">
        <div class="row h-100 align-items-center">
            <div class="col-12">
                <div class="page-title text-center">
                    <img src="{!! asset('css/image/banner.png') !!}" alt="">
                    <p>sdfghjkjhgf</p>
                </div>
            </div>
        </div>
    </div>
</div>--}}
<!-- ##### Header Area End ##### -->
{{--<img style="width: 100%;margin-bottom:50px" src="{!! asset('css/image/banner.png') !!}" alt="...">--}}
<div class="item container">
    <div class="row">

    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
        <!-- Indicators -->
        <ol class="carousel-indicators">
            <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
            <li data-target="#carousel-example-generic" data-slide-to="1"></li>
            <li data-target="#carousel-example-generic" data-slide-to="2"></li>
        </ol>

        <!-- Wrapper for slides -->
        <div class="carousel-inner">
            <div id="banner" class="item active">
                <img  style="margin-bottom: 56px;" src="{!! asset('css/image/banner-01-770.jpg') !!}" alt="...">
                <div class="carousel-caption">
                    ...
                </div>
            </div>
            <div id="banner1" class="item">
                <img  style="margin-bottom: 56px;" src="{!! asset('css/image/banner-san-pham.jpg') !!}"  alt="...">
                <div class="carousel-caption">
                    ...
                </div>
            </div>
            ...
        </div>

        <!-- Controls -->
        {{--<a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left"></span>
        </a>
        <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right"></span>
        </a>--}}
    </div>
</div>
</div>


@extends('fonend.master')
@section('content')
    @include('fonend.pages.sidebar')
    <div class="col-12 col-md-8 col-lg-9">
        <div class="shop_grid_product_area">
            <div class="row">
                <div class="col-12">
                    <div class="product-topbar d-flex align-items-center justify-content-between">
                        <!-- Total Products -->
                        <div class="total-products">
                            <p><span>{!! $names !!}</span> </p>
                        </div>
                        <!-- Sorting -->
                    </div>
                </div>
            </div>

            <div class="row">
                <!-- Single Product -->
                @foreach($database as $kq)
                    <div class="col-12 col-sm-6 col-lg-4">
                        <div class="single-product-wrapper">
                            <!-- Product Image -->
                            <div style="width: 300px" class="product-img">
                                <img src="{!! asset('css/image/'.$kq->image) !!}" alt="">
                                <div class="product-favourite">
                                    <a href="#" class="favme fa fa-heart"></a>
                                </div>
                            </div>
                            <div class="product-description">
                                <span>Tên Sản Phẩm</span>
                                <a href="single-product-details.html">
                                    <h6>{!! $kq->name !!}</h6>
                                </a>
                                <p class="product-price"><span class="old-price"></span> Giá Bán: {!! $kq->price !!}.VND</p>
                                <div class="hover-content">
                                    <!-- Add to Cart -->
                                    <div class="add-to-cart-btn">
                                        <a href="{!! route('productDetail',['id'=>$kq->id]) !!}" class="btn essence-btn">Add to Cart</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    </div>
@endsection
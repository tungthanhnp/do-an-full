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
                            <p><span>Tất Cả Sản Phẩm {!! $category->name !!}</span> </p>
                        </div>
                        <!-- Sorting -->
                    </div>
                </div>
            </div>

            <div class="row">

                <!-- Single Product -->
                @foreach($product as $pro)
                    <div class="col-12 col-sm-6 col-lg-4">
                        <div class="single-product-wrapper">
                            <!-- Product Image -->
                            <div style="width: 300px" class="product-img">
                                <img src="{!! asset('css/image/'.$pro->image) !!}" alt="">
                                <div class="product-favourite">
                                    <a href="#" class="favme fa fa-heart"></a>
                                </div>
                            </div>
                            <div class="product-description">
                                <span>Tên Sản Phẩm</span>
                                <a href="single-product-details.html">
                                    <h6>{!! $pro->name !!}</h6>
                                </a>
                                <p class="product-price"><span class="old-price"></span> {!! number_format($pro->price ,0,'','.') !!}&nbsp;&nbsp;VND</p>
                                <div class="hover-content">
                                    <!-- Add to Cart -->
                                    <div class="add-to-cart-btn">
                                        <a href="{!! route('productDetail',['id'=>$pro->id]) !!}" class="btn essence-btn">Add to Cart</a>
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
    {!! $product->links() !!}
@endsection
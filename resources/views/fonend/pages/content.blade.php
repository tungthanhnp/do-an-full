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
                            <b style="color: #28a745;font-size: 30px">Tất Cả Các Sản Phẩm</b>
                        </div>
                        <!-- Sorting -->
                    </div>
                </div>
            </div>

            <div class="row cate" id="cate">

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

                            <!-- Product Description -->
                            <div class="product-description">
                                <span>Tên Sản Phẩm</span>
                                <a href="single-product-details.html">
                                    <h3>{!! $pro->name !!}</h3>
                                </a>
                                <p class="product-price"><span class="old-price"></span> {!! number_format($pro->price ,0,'','.') !!} &nbsp;&nbsp;NVD</p>

                                <!-- Hover Content -->
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
                {!! $product->links() !!}
            </div>
        </div>
    </div>
    </div>

@endsection
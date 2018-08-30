@extends('fonend.master')
@section('content')
<section class="single_product_details_area d-flex align-items-center">
    <!-- Single Product Thumb -->
    <div class="single_product_thumb clearfix">
        <div class="product_thumbnail_slides ">
            <img src="{!! asset('css/image/'.$product->image) !!}" alt="">

        </div>
    </div>
    <div class="single_product_desc clearfix">
        <span>Shop</span>
        <a href="cart.html">
            <h2>Mời Bạn Xem Chi Tiết Sản Phẩm Cũng Như Lựa Chọn Thông Tin Sản Phẩm</h2>
        </a>
        <p class="product-price">Giá Sản Phẩm:&nbsp;&nbsp;&nbsp;{!! number_format($product->price ,0,'','.') !!} &nbsp;&nbsp;NVD</p>
        <!-- Form -->
        <form class="cart-form clearfix" method="post" action="{!! route('addcart',['id'=>$product->id]) !!}">
            @csrf
            <!-- Select Box -->
            <div class="form-group">
                <lable>số lượng</lable>
                <input class="form-control" style="width: 50px;" type="text" name="quantity">
                @if($errors->has('quantity'))
                    <lable class="text-danger">
                        {!! $errors->first('quantity') !!}
                    </lable>
                @endif
            </div>
            <div class="form-group">
                <lable>Size</lable>
                <select style="width: 50px;" name="size" id="productSize" class="form-control">
                    @if(!is_null($product->product_size))
                        @foreach($product->product_size as $value)
                            <option value="{!! $value->id !!}">{!! $value->name !!}</option>
                        @endforeach
                    @endif
                </select>
                <lable>Color</lable>
                <select style="width: 50px;" name="color" id="productColor" class="form-control">
                    @if(!is_null($product->product_color))
                        @foreach($product->product_color as $value)
                            <option value="{!! $value->id !!}">{!! $value->name !!}</option>
                        @endforeach
                    @endif
                </select>
            </div>
                <input type="submit" value="Mua Hàng"  class="btn essence-btn">
        </form>
    </div>
    <div>
        <h1>+</h1>
        <h1>+</h1>
        <h1 style="text-align: center;" class="">Xem Thêm Về Sản Phẩm:</h1>
        <h1>+</h1>
        <h1>+</h1>

    </div>
    <div class="item container">
        @if(!is_null($product->product_productimage))
            @foreach($product->product_productimage as $value)
                <img style="width:100%"  src="{!! asset('css/image_detail/'.$value->name) !!}" alt="">
                <div  class="clear-image"></div>
            @endforeach
        @endif
        <div class="carousel-caption">
            <h3>...</h3>
            <p>...</p>
        </div>
    </div>
</section>


@endsection



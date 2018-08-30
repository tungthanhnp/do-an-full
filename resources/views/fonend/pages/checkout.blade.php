@extends('fonend.master')
@section('content')


    <div class="breadcumb_area bg-img">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <div class="page-title text-center">
                        <h2>Đơn Hàng</h2>
                    </div>
                </div>
            </div>
            <h2 class="text-center text-danger">@if(Session::has('thongbao'))

                    {!! Session::get('thongbao') !!}
                @endif
            </h2>
        </div>

    </div>
    <!-- ##### Breadcumb Area End ##### -->

    <!-- ##### Checkout Area Start ##### -->
    <form action="{!! route('sendmai') !!}" method="post">
        @csrf
        <div class="checkout_area section-padding-80">
            <div class="container">
                <div class="row">
                        <div class=" col-md-8">
                            <div class="cart-page-heading mb-30">
                                <table class="table table-striped">
                                    <thead class="border-top">
                                    <th>stt</th>
                                    <th>Tên</th>
                                    <th>Giá Tiền</th>
                                    <th>Số Lượng</th>
                                    <th>Hình Ảnh</th>
                                    <th>Màu</th>
                                    <th>Size</th>
                                    <th>Thành Tiền</th>
                                    <th>Quyền</th>
                                    </thead>
                                    @php $i=0 @endphp
                                    @foreach($cart as $carts)
                                        @php $i++ @endphp
                                    <tbody>
                                    <td>{!! $i !!}</td>
                                    <td>{!! $carts['name'] !!}</td>
                                    <td>{!! number_format($carts['price'] ,0,'','.') !!} &nbsp;&nbsp;</td>


                                    <td>
                                        <p>{!! $carts['qty'] !!}</p>
                                        <input type="text" class="soluong" style="width: 20px;" id="attr" name="qty" value="{!! $carts['qty'] !!}">
                                    </td>
                                    <td>
                                        <img style="width: 80px" src="{!! asset('css/image/'.$carts['options']['img'] ) !!}" alt="">
                                    </td>
                                    <td>{!! $carts['options']['color'] !!}</td>
                                    <td>{!! $carts['options']['size'] !!}</td>
                                    <td id="taonhe">{!! number_format($carts['price'] * $carts['qty'] ,0,'','.') !!} &nbsp;&nbsp;</td>
                                    </td>
                                    <td>
                                        <span class="glyphicon glyphicon-refresh eidt" id="{!! $carts['rowId'] !!}"></span>
                                        <a class="glyphicon glyphicon-trash" href="{!! route('delCart',['id'=>$carts['rowId']]) !!}"></a>
                                    </td>
                                    </tbody>
                                    @endforeach
                                </table>
                               <h1>Tổng Tiền : {!! number_format($total ,0,'','.') !!} &nbsp;&nbsp; VND</h1>
                            </div>
                        </div>
                        {{--@dd($username)--}}
                        <div class=" col-md-4 ">

                            <div class="order-details-confirmation">

                                <div class="cart-page-heading">
                                </div>
                                <div class="form-group">
                                    <label for="company">Tên Khách Hàng </label>
                                    <input type="text" class="form-control" id="company" name="name"
                                           @if(isset($username))
                                                value="{!! $username->name !!}">
                                           @endif
                                            @if($errors->has('name'))
                                                <div class="text-danger">{!! $errors->first('name') !!}
                                                </div>
                                            @endif
                                </div>
                                <div class="form-group">
                                    <label for="street_address">Địa Chỉ Nhận Hàng <span>*</span></label>
                                    <input type="text" class="form-control" id="street_address" name="address"
                                           @if(isset($username))
                                             value="{!! $username->address !!}">
                                           @endif
                                            @if($errors->has('address'))
                                                <div class="text-danger">{!! $errors->first('address') !!}
                                                </div>
                                            @endif
                                </div>
                                <div class="form-group">
                                    <label for="phone_number">Điện Thoại Người Nhận <span>*</span></label>
                                    <input type="number" class="form-control" id="phone_number" min="0" name="phone"
                                           @if(isset($username))
                                             value="{!! $username->phone !!}">
                                           @endif
                                            @if($errors->has('phone'))
                                                <div class="text-danger">{!! $errors->first('phone') !!}
                                                </div>
                                            @endif
                                </div>
                                <div class="form-group">
                                    <label for="email_address">Địa Chỉ Email <span>*</span></label>
                                    <input type="email" class="form-control" id="" name="email"
                                           @if(isset($username))
                                            value="{!! $username->email !!}">
                                           @endif
                                            @if($errors->has('email'))
                                                <div class="text-danger">{!! $errors->first('email') !!}
                                                </div>
                                            @endif
                                </div>
                                <div id="accordion" role="tablist" class="mb-4">
                                    <div class="card">
                                        <div class="card">
                                        </div>
                                        <div class="card">
                                            <div class="card-header" role="tab" id="headingFour">
                                            </div>
                                            <div id="collapseFour" class="collapse show" role="tabpanel"
                                                 aria-labelledby="headingThree" data-parent="#accordion">
                                                <div class="card-body">
                                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Est cum
                                                        autem
                                                        eveniet saepe fugit, impedit magni.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="submit" class="btn essence-btn" value="Thanh Toán">
                                </div>
                            </div>
                        </div>
                </div>
            </div>

        </div>
    </form>
@endsection

@extends('fonend.master')
@section('content')
    @if(Session::has('thongbao'))
        <h2 class="text-danger">{!! Session::get('thongbao') !!}</h2>
    @endif
    <div class="container">
        <div class="col-md-12">
            <div class="page-title text-center">
                <h2 class="text-danger">Lịch Sử Mua Hàng Của Bạn</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                &nbsp;
            </div>
            <div class="col-md-12">
                &nbsp;
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <table style="text-align: center" class="table table-bordered">
                    <thead>
                    <th>stt</th>
                    <th>Tên Sản Phẩm</th>
                    <th>ảnh</th>
                    <th>Màu sắc</th>
                    <th>Kich cỡ</th>
                    <th>số lượng</th>
                    <th>giá</th>
                    <th>tổng tiền</th>
                    <th>Thời Gian</th>
                    <th>Thao Tác</th>
                    </thead>
                    @php $i=0 @endphp
                    @foreach($order as $od)
                        @php $i++ @endphp
                        <tbody>
                        <td>{!! $i !!}</td>
                        <td>{!! !is_null($od->order_product)? $od->order_product->name : ''  !!} </td>
                        @php $img= !is_null($od->order_product)? $od->order_product->image : '' @endphp
                        <td><img style="width: 70px" src="{!! asset('css/image/'.$img) !!}" alt=""></td>
                        <td>{!! $od->color !!}</td>
                        <td>{!! $od->size !!}</td>
                        <td>{!! $od->qty !!}</td>
                        <td>{!! $od->price !!}</td>
                        <td>{!! $od->total !!}</td>
                        <td>{!! $od->created_at !!}</td>
                        @if($od->status==1)
                        <td>
                            {{--<form action="{!! route('xoadonhang',['id'=>$od->id]) !!}" method="get">--}}
                                @csrf
                                <button type="submit" id="huy" val="{!! $od->id !!}" class="btn btn-primary">Hủy Đơn Hàng</button>
                            {{--</form>--}}
                        </td>
                        @elseif($od->status==2)
                            <td style="color: red">Đã Xác Nhận Đơn Hàng</td>
                        @elseif($od->status==3)
                           <td style="color: #1c7430">Đã Đóng Đơn hàng</td>
                        @endif
                        </tbody>

                    @endforeach
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                &nbsp;
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                &nbsp;
            </div>
        </div>
        <div class="col-md-12">
            <div class="page-title text-center">
                <h2 class="text-danger">Khách Hàng Lưu Ý Khi Chủ Shop Đã <span style="color: #500a6f">Xác Nhận Đơn Hàng</span>  Hoặc
                    <span style="color: #1ab7ea">Giao Hàng </span>Khách Hàng Sẽ Không Thể Hủy Đơn Hàng Được Nữa, Mong Quý Khách Hàng Lưu Ý
                </h2>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                &nbsp;
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                &nbsp;
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                &nbsp;
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                &nbsp;
            </div>
        </div>
    </div>


@endsection
@section('script')
    <script>
        $('#huy').click(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
           var id=  $(this).attr('val');
           $.ajax
           ({
               'url'  : '{!! route('xoadonhang') !!}',
               'type' : 'POST',
               'data' : ({'id' : id}),
            success:function (data) {
                   if (data == "flase")
                   {
                       location.reload();
                   }else
                   {
                       alert('bạn đã hủy đơn hàng thành công');
                       location.reload();
                   }
            }
           });

        });
    </script>
@endsection
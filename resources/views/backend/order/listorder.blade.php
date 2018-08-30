@extends('backend.index')
@section('content')
    <div id="page-wrapper">
        <div class="row">
            <div class="row">
                <div class="col-lg-12">
                    <h1 style="text-align: center" class="page-header">LIST ORDER</h1>
                </div>
            </div>
            @if(Session::has('thongbaothanhcong'))
                <div class="alert alert-success">{!! Session::get('thongbaothanhcong') !!}</div>
            @endif
            @if(Session::has('thongbao'))
                <div class="alert alert-danger">{!! Session::get('thongbao') !!}</div>
            @endif
            @if(Session::has('thongbaoAddProduct'))
                <div class="alert alert-success">{!! Session::get('thongbaoAddProduct') !!}</div>
            @endif
            @if(Session::has('baocao'))
                <div class="alert alert-success">{!! Session::get('baocao') !!}</div>
            @endif
            @if(Session::has('baocaodongdon'))
                <div class="alert alert-success">{!! Session::get('baocaodongdon') !!}</div>
            @endif
        <!-- /.col-lg-12 -->
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Stt</th>
                                    <th>Name</th>
                                    <th>email</th>
                                    <th>Tên sản Phẩm</th>
                                    <th>Hình ảnh</th>
                                    <th>Số lượng</th>
                                    <th>Giá</th>
                                    <th>color</th>
                                    <th>size</th>
                                    <th>số điện thoại</th>
                                    <th>địa chỉ</th>
                                    <th>Trạng thái</th>
                                    <th>Tổng tiền</th>
                                    <th>quyền</th>
                                    <th>Thao Tác</th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($data as $key => $value)
                                    <tr>
                                        <td>{!! ($data->total()-($data->currentPage() * $data->perPage())+$data->perPage())-$key !!}</td>
                                        <td>{!! $value->ordername !!}</td>
                                        <td>{!! $value->email !!}</td>
                                        <td>{!! !is_null($value->order_product)? $value->order_product->name : '' !!} </td>
                                        <td><img width="70px" src="{!! asset('css/image/'.$value->image) !!}" alt=""></td>
                                        <td>{!! $value->qty !!}</td>
                                        <td>{!! number_format($value->price) !!}</td>
                                        <td>{!! $value->color !!}</td>
                                        <td>{!! $value->size !!}</td>
                                        <td>{!! $value->phone !!}</td>
                                        <td>{!! $value->address !!}</td>
                                            @if($value->status ==1)
                                                <td>Đặt Hàng</td>
                                             @elseif($value->status ==2)
                                                <td>Giao Hàng</td>
                                             @elseif($value->status ==3)
                                            <td>ĐÓng Đơn</td>
                                            @endif
                                        <td>{!! number_format($value->total) !!}</td>
                                        <td><a CLASS="glyphicon glyphicon-trash" href="javascript:void(0)" onclick="deleteorder({!! $value->id !!})" ></a>
                                           @if($value->status==1)
                                              <td><a href="{!! route('xacnhandon',['id'=>$value->id]) !!}">xác nhận đơn hàng</a></td>
                                           @elseif($value->status==2)
                                              <td><a href="{!! route('xacnhandondagiao',['id'=>$value->id]) !!}">Giao Hàng</a></td>
                                           @elseif($value->status==3)
                                              <td>Đóng Đơn Hàng</td>
                                        @endif
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>
                        </div>
                        <!-- /.table-responsive -->
                    </div>
                    <!-- /.panel-body -->
                </div>
                <!-- /.panel -->
            </div>
            {!! $data->links() !!}
        </div>
    </div>
@endsection
@section('script')
    <script>
        function deleteorder(id)
        {
            check=confirm('bạn có chắc chắn muốn xóa không?');
            if (check)
            {
                window.location.href="{!! route('getXoaOrder') !!}"+'/'+id;
            }
        }

    </script>
@endsection
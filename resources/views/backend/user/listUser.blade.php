@extends('backend.index')
@section('content')
    <div id="page-wrapper">
        <div class="row">
                <div class="row">
                    <div class="col-lg-12 center-block">
                        <h1 style="text-align: center" class="page-header">LIST USER</h1>
                        @if(Session::has('thongbao'))
                            <div class="alert alert-danger text-center">
                                {!! Session::get('thongbao') !!}
                            </div>
                        @endif
                        <div class="tung"></div>
                        @if(Session::has('thongbaothanhcong'))
                            <div class="alert alert-success text-center">
                                {!! Session::get('thongbaothanhcong') !!}
                            </div>
                        @endif
                        <div style="text-align: center"  class="text-danger"><h1 id="thongbao"></h1></div>
                    </div>
                        <!-- /.col-lg-12 -->
                    </div>
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
                                            <th>avatar</th>
                                            <th>Email</th>
                                            <th>Address</th>
                                            <th>Phone</th>
                                            <th>lever</th>
                                            <th>Ngày sửa gần nhât</th>
                                            <th>Ngày tạo</th>
                                            <th>Thao Tác</th>
                                        </tr>
                                        </thead>
                                        @foreach($data as $key => $value)
                                        <tbody>
                                            <tr>
                                                <td>{!! ((($data->currentPage() * 10)-10)+1)+$key !!}</td>
                                                <td>{!! $value->name !!}</td>
                                                <td><img style="width: 50px" src="{!! asset('css/image-user/'.$value->avatar) !!}" alt=""></td>
                                                <td>{!! $value->email !!}</td>
                                                <td>{!! $value->address !!}</td>
                                                <td>{!! $value->phone !!}</td>
                                              @if($value->lever ==2)
                                                <td>Supper Admin</td>
                                              @elseif($value->lever ==1)
                                                <td>Admin</td>
                                              @else
                                                <td>User Người dùng</td>
                                              @endif
                                                <td>{!! $value->updated_at !!}</td>
                                                <td>{!! $value->created_at !!}</td>
                                                <td>
                                                    <a CLASS="glyphicon glyphicon-edit" href="javascript:void(0)" onclick="edit_user({!! $value->id !!})"> </a>
                                                    <a  href="javascript:void(0)" onclick="delete_user({!! $value->id !!})" CLASS="glyphicon glyphicon-trash" > </a>
                                                </td>
                                            </tr>
                                        </tbody>
                                        @endforeach
                                    </table>
                                </div>
                                <!-- /.table-responsive -->
                            </div>
                            <!-- /.panel-body -->
                            {!! $data->links() !!}
                     </div>
                <!-- /.panel -->
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        function delete_user(id)
        {
               check=confirm('bạn có chắc chắn xóa không?')
                if (check){
                    $.ajax({
                        url: "{!! route('postXoaUser') !!}",
                        type: "post",
                        data: {
                            id: id,
                        },
                        success: function (data) {
                            if (data =='1'){
                                alert('bạn không thể xóa user này vì user này đã từng mua hàng , nếu bạn xóa thì đồng nghĩa sẽ mất dữ liệu');
                            }else if(data=='2'){
                                alert('bạn đã xóa thành công');
                                window.location.reload();
                            }else if(data=='3'){
                                alert('bạn không thể xóa chính mình');
                            }else if(data=='4'){
                                alert('bạn không thể xóa user này vì đây ũng là user admin');
                            }else if(data=='5'){
                                alert('bạn đã xóa thành công');
                                window.location.reload();
                            }else if(data=='6'){
                                alert('bạn chỉ là admin bạn không thể xóa supper admin');
                            }else if(data=='7'){
                                alert('bạn là user admin và bạn không thể xóa được chính mình');
                            }

                        }
                    });
                }
        };


            function edit_user(id) {
                $.ajax({
                    url : "{!! route('postSuaUserajax') !!}",
                    type : "post",
                    data : {
                        id : id,
                    },
                    success : function (data){
                        if (data =='supper')
                        {
                            window.location.href="{!! route('postSuaUser') !!}"+'/'+id;
                        }else if (data=='bạn không có quyền sửa supper admin')
                        {
                            $('#thongbao').html(data);

                        }else if (data=='okie')
                        {
                            window.location.href="{!! route('postSuaUser') !!}"+'/'+id;
                        }else if (data=='Bạn không có quyền sửa users này vì người này cũng là admin')
                        {
                            $('#thongbao').html(data);
                        }else
                            window.location.href="{!! route('postSuaUser') !!}"+'/'+id;


                    }
                });

            }

    </script>
@endsection
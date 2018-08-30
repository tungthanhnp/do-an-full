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

            function delete_user(id) {
               check=confirm('bạn có chắc chắn xóa không?')
                if (check){
                   window.location.href="{!! route('getXoaUser') !!}"+'/'+id;
                }
            };


            function edit_user(id) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });


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
@extends('backend.index')
@section('content')
    <div id="page-wrapper">
        <div class="row">
            <div class="row">

                <div class="col-lg-12">
                    <h1 class="page-header">LIST COLOR</h1>
                </div>
            </div>
            @if(Session::has('thongbao'))
                <div style="text-align: center" class="alert alert-danger">{!! Session::get('thongbao') !!}</div>
            @endif
            @if(Session::has('thongbaothanhcong'))
                <div style="text-align: center" class="alert alert-success">{!! Session::get('thongbaothanhcong') !!}</div>
            @endif
            @if(Session::has('thongbaoadd'))
                <div style="text-align: center" class="alert alert-success">{!! Session::get('thongbaoadd') !!}</div>
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
                                    <th>Code</th>
                                    <th>Ngày sửa gần nhât</th>
                                    <th>Ngày tạo</th>
                                    <th>Thao Tác</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($data as $key => $value)
                                    <tr>
                                        <td>{!! ((($data->currentPage()*10)-10)+1)+$key !!}</td>
                                        <td>{!! $value -> name !!}</td>
                                        <td>{!! $value -> code !!}</td>
                                        <td>{!! $value -> updated_at !!}</td>
                                        <td>{!! $value -> created_at !!}</td>
                                        <td>
                                            <a CLASS="glyphicon glyphicon-trash" href="javascript:void(0)" onclick="deletecate({!! $value->id !!})" ></a>
                                            <a href="{!! route('getSuacolor',['id'=>$value->id]) !!}"  CLASS="glyphicon glyphicon-edit"></a>
                                        </td>
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


        function deletecate(id){
            check=confirm('bạn có chắc chắc xóa không?');
            if (check)
            {
                $.ajax({
                    url: "{!! route('postXoacolor') !!}",
                    type: "post",
                    data: {
                        id: id,
                    },
                    success: function (data) {
                        alert('xóa thành công');
                        window.location.reload();

                    }
                });
            }
        };

    </script>
    @endsection

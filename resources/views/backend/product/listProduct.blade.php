@extends('backend.index')
@section('content')
    <div id="page-wrapper">
        <div class="row">
            <div class="row">
                <div class="col-lg-12">
                    <h1 style="text-align: center" class="page-header">LIST PRODUCT</h1>
                </div>
            </div>
                @if(Session::has('thongbaothanhcong'))
                    <div class="alert alert-success">{!! Session::get('thongbaothanhcong') !!}</div>
                @endif
                @if(Session::has('thongbao'))
                    <div style="text-align: center" class="alert alert-danger">{!! Session::get('thongbao') !!}</div>
                 @endif
            @if(Session::has('thongbaoAddProduct'))
                <div class="alert alert-success">{!! Session::get('thongbaoAddProduct') !!}</div>
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
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Pice</th>
                                    <th>image</th>
                                    <th>size</th>
                                    <th>color</th>
                                    <th>category_id</th>
                                    <th>image-detail</th>
                                    <th>Ngày sửa gần nhât</th>
                                    <th>Ngày tạo</th>
                                    <th>Thao Tác</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($data as $key => $value)
                                <tr>
                                    <td>{!! ((($data->currentPage()*10)-10)+1)+$key !!}</td>
                                    <td>{!! $value->id !!}</td>
                                    <td>{!! $value->name !!}</td>
                                    <td>{!! number_format($value->price) !!}</td>
                                    <td><img style="width: 70px; height: 80px" src="{!! asset('css/image/'.$value->image) !!}" alt=""></td>
                                    <td>
                                        @if(!is_null($value->product_size))
                                            @foreach($value->product_size as $role)
                                                <p>{!! $role->name !!}</p>
                                            @endforeach
                                        @endif
                                    </td>
                                    <td>
                                        @if(!is_null($value->product_color));
                                            @foreach($value->product_color as $role)
                                                <p>{!! $role->name !!}</p>
                                            @endforeach
                                        @endif</td>
                                    <td>{!! !is_null($value->product_category)? $value->product_category->name : '' !!}</td>
                                    <td>
                                        @if(!is_null($value->product_productimage))
                                            @foreach($value->product_productimage as $role)
                                                <p><img style="width: 70px; height: 80px" src="{!! asset('css/image_detail/'.$role->name) !!}" alt=""></p>
                                            @endforeach
                                        @endif
                                    </td>
                                    <td>{!! $value->updated_at !!}</td>
                                    <td>{!! $value->created_at !!}</td>
                                    <td><a CLASS="glyphicon glyphicon-trash" href="javascript:void(0)" onclick="deleteproduct({!! $value->id !!})" ></a>
                                        <a href="{!! route('getSuaProduct',['id'=>$value->id]) !!}"  CLASS="glyphicon glyphicon-edit"></a></td>
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
        function deleteproduct(id)
        {
            check=confirm('bạn có chắc chắn muốn xóa không?');
            if (check)
            {
                window.location.href="{!! route('getXoaProduct') !!}"+'/'+id;
            }
        }

    </script>
@endsection
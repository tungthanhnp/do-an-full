@extends('backend.index')
@section('content')
    <div id="page-wrapper">

        <!-- /.row -->
        <form action="{!! route('postSuaProduct',['id'=>$data->id]) !!}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <h1>Edit PRODUCT</h1>

                                    <div class="form-group">
                                        <label for="disabledSelect">Name</label>
                                        <input class="form-control" type="text" id="name" name="name" value="{!! $data->name !!}"
                                               placeholder="Nhập tên muốn tạo">
                                        @if($errors->has('name'))
                                            <div class="text-danger">{!! $errors->first('name') !!}</div>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="disabledSelect">Price</label>
                                        <input class="form-control" type="text" id="price" name="price" value="{!! $data->price !!}"
                                               placeholder="Nhập tên giá bạn muốn thêm">
                                        @if($errors->has('price'))
                                            <div class="text-danger">{!! $errors->first('price') !!}</div>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="disabledSelect">Image</label>
                                        <input  type="file" id="images" name="images"
                                                placeholder="chọn ảnh">
                                        <img style="width: 80px;width: 70px" src="{!! asset('css/image/'.$data->image) !!}" alt="">
                                        @if($errors->has('images'))
                                            <div class="text-danger">{!! $errors->first('image') !!}</div>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="disabledSelect">Category</label>
                                        <select  id="disabledSelect" class="form-control" name="category">
                                            @if(!is_null($cates))
                                                @foreach($cates as $cate)
                                                    <option
                                                            @if($data->category_id == $cate->id )
                                                                    {!! "selected" !!}
                                                            @endif
                                                            value="{!! $cate->id !!}" >{!! $cate->name !!}</option>

                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="disabledSelect">Color</label>
                                        <select  multiple="multiple"  class="form-control" name="color[]"; >
                                            @if(!is_null($colors))
                                                @foreach($colors as $color)
                                                    <option value="{!! $color->id !!}" >{!! $color->name !!}</option>
                                                @endforeach
                                            @endif

                                        </select>
                                        @if($errors->has('color'))
                                            <div class="text-danger">{!! $errors->first('color') !!}</div>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label for="disabledSelect">Size</label>
                                        <select  multiple="multiple"  class="form-control" name="size[]"; >
                                           @if(!is_null($sizes))
                                                @foreach($sizes as $size)
                                                    <option value="{!! $size->id !!}" >{!! $size->name !!}</option>
                                                @endforeach
                                            @endif

                                        </select>
                                        @if($errors->has('size'))
                                            <div class="text-danger">{!! $errors->first('size') !!}</div>
                                        @endif
                                    </div>


                                    <button type="submit" class="btn btn-primary">EDIT</button>
                                </div>
                                <div class="col-lg-1"></div>
                                <div class="col-lg-4">

                                    <div class="form-group">
                                        <label for="disabledSelect"></label>
                                        @if(Session::has('baocao'))
                                            <div class="alert alert-danger">{!! Session::get('baocao') !!}</div>
                                        @endif
                                        @if(!is_null($data->product_productimage))
                                            @foreach($data->product_productimage as $role)
                                                @if($data->id == $role->product_id)
                                                    <img style="width: 70px; height: 80px" src="{!! asset('css/image_detail/'.$role->name) !!}" alt="">
                                                    <a CLASS="glyphicon glyphicon-trash" href="{!! route('getXoaProduct_img',['id'=>$role->id]) !!}">xoa</a>
                                                @endif
                                            @endforeach
                                        @endif
                                    </div>
                                    <h1 style="text-align: center">ADD</h1>
                                    <h1>PRODUCT-IMAGE</h1>

                                    @for($i=1;$i<8;$i++)
                                        <div class="form-group">
                                            <lable>ADD Image Product {!! $i !!}</lable>
                                            <input type="file" name="imagepro[]"  id="imagepro">
                                        </div>
                                    @endfor

                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </form>
    </div>

@endsection
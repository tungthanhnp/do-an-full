@extends('backend.index')
@section('content')
    <div id="page-wrapper">

        <!-- /.row -->
        <div class="row">
            <div class="col-lg-8">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <h1 style="text-align:center">Edit</h1>
                                <h1 style="text-align:center">COLOR</h1>
                                <form action="{!! route('postSuacolor',['id'=>$data->id]) !!}" method="post" role="form">
                                    @csrf
                                    <div class="form-group">
                                        <label for="disabledSelect">Name</label>
                                        <input class="form-control" type="text" id="name" name="name" value="{!! $data->name !!}"
                                               placeholder="Nhập tên muốn tạo">
                                        @if($errors->has('name'))
                                            <div class="text-danger">{!! $errors->first('name') !!}</div>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="disabledSelect">Code</label>
                                        <input class="form-control" type="text" id="code" name="code" value="{!! $data->code !!}"
                                               placeholder="Nhập tên muốn tạo">
                                        @if($errors->has('code'))
                                            <div class="text-danger">{!! $errors->first('code') !!}</div>
                                        @endif
                                    </div>
                                    <button type="submit" class="btn btn-primary">Sửa</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@extends('backend.index')
@section('content')
    <div id="page-wrapper">

        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <h1>ADD SIZE</h1>
                                <form action="{!! route('postThemsize') !!}" method="post" role="form">
                                    @csrf
                                    <div class="form-group">
                                        <label for="disabledSelect">Name</label>
                                        <input class="form-control" type="text" id="name" name="name" value="{!! old('name') !!}"
                                               placeholder="Nhập tên muốn tạo">
                                        @if($errors->has('name'))
                                            <div class="text-danger">{!! $errors->first('name') !!}</div>
                                        @endif
                                    </div>
                                    <button type="submit" class="btn btn-primary">Tạo mới</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
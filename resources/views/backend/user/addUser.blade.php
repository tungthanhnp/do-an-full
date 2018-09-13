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
                                <h1>ADD USERNAME</h1>
                                <form role="form" action="{!! route('postThemUser') !!}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <label for="disabledSelect">Name</label>
                                        <input class="form-control" type="text" id="name" name="name" value="{!! old('name') !!}"
                                               placeholder="Nhập tên muốn tạo">
                                    </div>
                                    @if($errors ->has('name'))
                                        <span class="text-danger">{!! $errors->first('name') !!}</span>
                                    @endif
                                    <div class="form-group">
                                        <label for="disabledSelect">Email</label>
                                        <input class="form-control" type="text" id="email" name="email" value="{!! old('email') !!}"
                                               placeholder="Nhập tên email bạn muốn thêm">
                                        @if($errors ->has('email'))
                                            <span class="text-danger">{!! $errors->first('email') !!}</span>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label for="disabledSelect">Password</label>
                                        <input class="form-control" type="password" id="password" name="password" value="{!! old('password') !!}"
                                               placeholder="Nhập tên password muốn thêm">
                                        @if($errors ->has('password'))
                                            <span class="text-danger">{!! $errors->first('password') !!}</span>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label for="disabledSelect">Nhâp lại Password</label>
                                        <input class="form-control" type="password" id="passwordold" name="passwordold" value="{!! old('passwordold') !!}"
                                               placeholder="Nhập lại password ">
                                        @if($errors ->has('passwordold'))
                                            <span class="text-danger">{!! $errors->first('passwordold') !!}</span>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label for="disabledSelect">Address</label>
                                        <input class="form-control" type="text" id="address" name="address" value="{!! old('address') !!}"
                                               placeholder="Nhập địa chỉ bạn muốn thêm">
                                        @if($errors ->has('address'))
                                            <span class="text-danger">{!! $errors->first('address') !!}</span>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label for="disabledSelect">Phone</label>
                                        <input class="form-control" type="text" id="phone" name="phone" value="{!! old('phone') !!}"
                                               placeholder="Nhập Số Điện Thoại bạn muốn thêm">
                                        @if($errors ->has('phone'))
                                            <span class="text-danger">{!! $errors->first('phone') !!}</span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="disabledSelect">Avatar</label>
                                        <input type="file" name="avatar">
                                        @if($errors->has('avatar'))
                                            <div>
                                                <span class="text-danger">{!! $errors->first('avatar') !!}</span>
                                            </div>
                                        @endif
                                    </div>
                                @if($user->lever==2)
                                    <div class="form-group">
                                        <lable>Chon Quyền</lable>
                                        <label>
                                            <input type="radio" checked value="0" name="quyen"> Người Dùng
                                            <input type="radio" value="1" name="quyen"> Admin
                                        </label>
                                    </div>
                                @endif

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
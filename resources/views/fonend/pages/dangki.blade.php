@extends('fonend.master')
@section('dangki')
    <div id="page-wrapper">

        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-6">
                                @if(Session::has('thongbaothanhcong'))
                                    <div STYLE="text-align: center ; height: 50px" class="alert alert-success">{!! Session::get('thongbaothanhcong') !!}</div>
                                @endif
                                <h1>ADD USERNAME</h1>
                                <form role="form" action="{!! route('postdangki') !!}" method="post" enctype="multipart/form-data">
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
                                        <span id="flase" class="text-danger"></span>
                                        <span id="true"  style="color:#1ab7ea;" class="success"></span>

                                        @if($errors ->has('email'))
                                            <span class="text-danger">{!! $errors->first('email') !!}</span>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label for="disabledSelect">Password</label>
                                        <input class="form-control" type="password" id="password" name="password"
                                               placeholder="Nhập tên password muốn thêm">
                                        @if($errors ->has('password'))
                                            <span class="text-danger">{!! $errors->first('password') !!}</span>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label for="disabledSelect">Nhâp lại Password</label>
                                        <input class="form-control" type="password" id="passwordold" name="passwordold"
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

                                    <button type="submit"  id="submit"  class="btn btn-primary">Tạo mới</button>
                                </form>

                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection
@section('script')
<script>
    $(document).ready(function(){
        $('#flase').hide();
        $('#true').hide();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('#email').change(function () {
            var email=$('#email').val();
            $.ajax({
                'url' : '{!! route('checkemail') !!}',
                'type': 'POST',
                'data':{'email' : email},
                success: function (data) {
                    if (data=="flase")
                    {
                        $('#flase').show();
                        $('#flase').text('Email bạn vừa nhập đã tồn tại vui lòng chọn địa chỉ email khác');
                        $('#email').css('border','red 1px solid');
                        $('#true').hide();
                        $('#submit').attr('disabled','');

                    }else
                    {
                        $('#email').removeAttr("style");
                        $('#true').show();
                        $('#true').text('Bạn có thể sử dụng địa chỉ email này');
                        $('#flase').hide();
                        $('#submit').removeAttr('disabled');

                    }

                    
                }
            });

        });
    });



</script>
@endsection
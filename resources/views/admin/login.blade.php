<!DOCTYPE html>
<html>
<head>
    <title> Đăng Nhập Hệ Thống Admin </title>
    <link href="{!! url('public/assets/Admin/css/bootstrap.css') !!}" rel="stylesheet">
    <link href="{!! url('public/assets/Admin/css/style_login.css') !!}" rel="stylesheet">
    <link href="{!! url('public/assets/Admin/css/customs.css') !!}" rel="stylesheet">
    <script type="text/javascript" src="public/assets/Admin/js/jquery-1.9.1.js"></script>
    <script type="text/javascript" src="public/assets/Admin/js/jquery.validate.js"></script>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="header-login col-md-12">
            <div class="logo col-md-5 row">
                    <div class="img-lg col-md-4 row">
                        <img src="{!! url('public/assets/Admin/images/logo.png') !!}" alt="Logo UET">
                    </div>
                    <div class="name-uet col-md-8">
                        <p>ĐẠI HỌC CÔNG NGHỆ - ĐHQG HN </p>
                        <p> University of Engineering and Technology </p>
                    </div>
                </div>
            <div class="name-login col-md-7">
                <h3 class="text-center"> HỆ THỐNG QUẢN LÝ ĐIỂM RÈN LUYỆN SINH VIÊN</h3>
            </div>
        </div>
        <div class="col-md-12">
            <div class="notice-uet col-md-7 row">
                <h5> Thông báo </h5>
                <ul>
                    <li> Không có thông báo</li>
                </ul>
            </div>
            <div class="form-login-uet col-md-5">
                <form action='postLogin' method="post" id="form_login_admin" name="form_login_admin" class="form-horizontal">
                    {!! csrf_field() !!}
                    <h4 class="text-center"> ĐĂNG NHẬP </h4>
                    <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                    <div class="form-group input_user col-md-12">
                        <label for="username" class="col-md-10"> Tên đăng nhập </label>
                        <div class="col-md-12">
                            <input type="text" name="username" id="username" class="form-control" placeholder="UserName" value="{{old('username')}}">
                        </div>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="password" class="col-md-12"> Mật khẩu </label>
                        <div class="col-md-12">
                            <input type="password" name="password" id="password" class="form-control" placeholder="Password" value="">
                        </div>
                    </div>
                    <div class="form-group col-md-12">
                        <div class="col-md-12 ">
                            <button type="submit" class="btn btn-primary pull-right"> Đăng nhập </button>
                        </div>
                    </div>
                </form>
            </div>

        </div>

        <div class="error_login">
            @if ( $errors->any() )
                <ul class="form_error">
                    <h2> Form Error * </h2>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif

            <div class="col-md-12">
                @if(Session::has('flash_message'))
                    <div class="alert alert-{!! Session::get('flash_level') !!}">
                        {!! Session::get('flash_message') !!}
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
</body>
</html>
<script type="text/javascript">
    $(document).ready(function() {
        $("#form_login_admin").validate({
            rules: {
                username: {
                    required: true,
                    rangelength: [2,50]
                },
                password: {
                    required: true,
                    rangelength: [6,50]
                },

            },
            messages: {
                username: {
                    required: "Please enter the Username",
                    rangelength: "The username is the wrong length"
                },
                password: {
                    required: "Please enter the Password",
                    rangelength: " The Password is the wrong length"
                },
            }
        });
    });
</script>

<!DOCTYPE html>
<html>
<head>
    <title> Phản Hồi  </title>
    <link href="{!! url('public/assets/Admin/css/bootstrap.css') !!}" rel="stylesheet">
    <link href="{!! url('public/assets/Admin/css/style_login.css') !!}" rel="stylesheet">
    <link href="{!! url('public/assets/Admin/css/customs.css') !!}" rel="stylesheet">
    <script type="text/javascript" src="public/assets/Admin/js/jquery-1.9.1.js"></script>
    <script type="text/javascript" src="public/assets/Admin/js/jquery.validate.js"></script>
</head>
<body>
<div class="container">
    <div class="row">


            <div class="form-group">
                <div class="col-sm-offset-4 col-sm-9">
                    <button type="submit" class="btn btn-primary"> Gửi </button>
                </div>
            </div>
        </form>
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

        });
    });
</script>

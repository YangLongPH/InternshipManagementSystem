<!DOCTYPE html>
<html>
<head>
    <meta name="csrf-token" content="{{csrf_token()}}">
    <title> @yield('title')</title>
    <link href="http://fonts.googleapis.com/css?family=Lato:300,400,700,900" >
    <link href="http://fonts.googleapis.com/css?family=Lato+Open+Sans:400,300,600,700" >;
    <link href="{!! url('public/assets/Admin/css/bootstrap.css') !!}"rel="stylesheet">
    <link href="{!! url('public/assets/Admin/css/style.css') !!}" rel="stylesheet">
    <link href="{!! url('public/assets/Admin/css/rtl.css') !!}" rel="stylesheet">
    <link href="{!! url('public/assets/Admin/css/theme.css') !!}" rel="stylesheet">
    <link href="{!! url('public/assets/Admin/css/ui.css') !!}" rel="stylesheet">
    <link href="{!! url('public/assets/Admin/css/customs.css') !!}" rel="stylesheet">

    <script type="text/javascript" src="public/assets/Admin/js/jquery-1.9.1.js"></script>
    <script type="text/javascript" src="public/assets/Admin/js/bootstrap.js"></script>
    <script type="text/javascript" src="public/assets/Admin/js/jquery.validate.js"></script>
    <script type="text/javascript" src="public/assets/Admin/js/jquery.cookie.js"></script>
    <script type="text/javascript" src="public/assets/Admin/plugins/noty/jquery.noty.packaged.min.js"></script>
    <script type="text/javascript" src="public/assets/Admin/js/main.js"></script>
</head>
<body>
@section('main-parent')
    <div class="sidebar">
        <div class="logopanel">
            <h1>
                {{--<a href="#">MVH - UET</a>--}}
            </h1>
        </div>
        <div class="sidebar-inner">
            <div class="sidebar-top big-img">
                <div class="user-image">
                    {{--@if(Auth::user()->image)--}}
                    {{--<img src="public/uploads/admin_img/{{Auth::user()->image}}" class="img-responsive img-circle" alt="friend 8">--}}
                    {{--@else--}}
                    <img src="public/assets/Admin/images/default.png" class="img-responsive img-circle" alt="friend 8">
                    {{--@endif--}}
                </div>
                <h4></h4>
                {{--{{Auth::user()->username}}--}}
                <div class="dropdown user-login">
                    <form action="searchemployee" method="get" class="searchform" id="search-results">
                        <input class="form-control" name="name" placeholder="Search employee..." type="text">
                        {!! csrf_field() !!}
                    </form>
                </div>
            </div>

            <ul class="nav nav-sidebar">

                <li class="nav-parent">
                    <a href="{{ URL::to('coVanHocTap.newimport') }}" class="test_"><i class="icon-puzzle"></i><span> import danh sách  </span> </a>
                </li>
                <li class="nav-parent">
                    <a href="{{ URL::to('coVanHocTap.listclass') }}" class="test_"><i class="icon-puzzle"></i><span> Danh Sách Sinh Viên </span> </a>
                </li>
                <li class="nav-parent">
                    <a href="{{ URL::to('coVanHocTap.vi_pham') }}" class="test_"><i class="icon-puzzle"></i><span> Danh Sách Vi Phạm </span> </a>
                </li>
                <li class="nav-parent">
                    <a href="{{ URL::to('coVanHocTap.xem_diem') }}" class="test_"><i class="icon-puzzle"></i><span> Xem Điểm </span> </a>
                </li>
                <li class="nav-parent">
                    <a href="{{ URL::to('coVanHocTap.vi_pham') }}" class="test_"><i class="icon-puzzle"></i><span>SV Vi Phạm  </span> </a>
                </li>
                <li class="nav-parent">
                    <a href="{{ URL::to('coVanHocTap.khen_thuong') }}" class="test_"><i class="icon-puzzle"></i><span>Khen Thưởng  </span> </a>
                </li>


                {{--<li class="nav-parent">--}}
                {{--<a href="{{URL::to('adstudents')}}"><i class="icon-bulb"></i><span> Thêm danh sách cán bộ lớp </span> </a>--}}
                {{--</li>--}}

            </ul>

            {{--<ul class="nav nav-sidebar">--}}
            {{--<li class=" nav-active active"><a href="javascript:void(0)"><i class="icon-home"></i><span>Department management </span></a></li>--}}
            {{--<li class="nav-parent ">--}}
            {{--<a href="{{URL::to('newdepartment')}}"><i class="icon-puzzle "></i><span class="menu_active_border" >Add department</span> </a>--}}
            {{--</li>--}}
            {{--<li class="nav-parent">--}}
            {{--<a href="{{URL::to('listdepartment')}}"><i class="icon-bulb"></i><span> List departments</span> </a>--}}
            {{--</li>--}}


            {{--</ul>--}}

            {{--<ul class="nav nav-sidebar">--}}
            {{--<li class=" nav-active active"><a href="javascript:void(0)"><i class="icon-home"></i><span>Employee management  </span></a></li>--}}
            {{--<li class="nav-parent">--}}
            {{--<a href="newemployee"><i class="icon-puzzle"></i><span>New employee</span> </a>--}}
            {{--</li>--}}
            {{--<li class="nav-parent">--}}
            {{--<a href="{{URL::to('listemployee')}}"><i class="icon-bulb"></i><span> List Employee</span> </a>--}}
            {{--</li>--}}

            {{--</ul>--}}
        </div>
    </div>

    <div class="main-content">
        <!-- BEGIN TOPBAR -->
        <div class="topbar">
            {{--<div class="header-left">--}}
            {{--<div class="topnav">--}}
            {{--<a class="menutoggle" href="#" data-toggle="sidebar-collapsed"><span class="menu__handle"><span>Menu</span></span></a>--}}
            {{--<ul class="nav nav-icons">--}}
            {{--<li><a href="#" class="toggle-sidebar-top"><span class="icon-user-following"></span></a></li>--}}
            {{--<li><a href="mailbox.html"><span class="octicon octicon-mail-read"></span></a></li>--}}
            {{--<li><a href="#"><span class="octicon octicon-flame"></span></a></li>--}}
            {{--<li><a href="builder-page.html"><span class="octicon octicon-rocket"></span></a></li>--}}
            {{--</ul>--}}
            {{--</div>--}}
            {{--</div>--}}
            <div class="header-right">
                <ul class="header-menu nav navbar-nav">
                    <li class="dropdown" id="user-header">
                        {{--<a href="#" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">--}}
                        {{--@if(Auth::user()->image)--}}
                        {{--<img src="public/uploads/admin_img/{{Auth::user()->image}}" alt="user image">--}}
                        {{--@else--}}
                        {{--<img src="public/assets/Admin/images/default.png" alt="user image">--}}
                        {{--@endif--}}

                        {{--<span class="username">Hi, {{Auth::user()->username}}</span>--}}
                        {{--</a>--}}
                    </li>
                    <li class="logout_Admin">
                        <a href="{{ URL::to('logout') }}"><i class="icon-logout"></i><span>Logout</span></a>
                    </li>
                </ul>
            </div>
            <!-- header-right -->
        </div>
        <div class="page-content page-thin ">
            <div class="col-md-12">
                {{--@if($errors->any())--}}
                {{--<div class="alert auto-hide alert-waring">--}}
                {{--something went wrong here!--}}
                {{--</div>--}}
                {{--@endif--}}
                {{--<div class="col-md-8 col-md-offset-3">--}}
                {{--@if(Session::has('flash_message'))--}}
                {{--<div class="alert auto-hide alert-{!! Session::has('flash_level')?Session::get('flash_level'):'default'--}}
                {{--!!}">--}}
                {{--{!! Session::get('flash_message') !!}--}}
                {{--</div>--}}
                {{--@endif--}}
                {{--</div>--}}
                <div class="row">
                    @yield('content')
                </div>
            </div> <!-- end .page-content-->
        </div> <!-- end .main-content-->
        {{--<footer>--}}
        {{--<div class="F_infor">--}}
        {{--<h4 class="text-center"> Developed by MVH Team!</h4>--}}
        {{--<h5 class="text-center"> Contact us: luk.mink@gmail.com </h5>--}}
        {{--<h5 class="text-center"> Phone: 0972 114 187</h5>--}}
        {{--</div>--}}
        {{--</footer>--}}
    </div>

</body>

</html>
@show
@section('script_')
    <script>
        $(document).ready(function(){
            $('.alert').delay(4000).slideUp();
        });
    </script>
@show
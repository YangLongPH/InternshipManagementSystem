@extends('layouts.admin')
@section('title',' List Admin')
@section('content')
    <style>
        .main-content {
            top: -15px;
            position: relative;
        }
        h1 {
            margin : 50px 0;
            color : #2196F3;

        }
        a {
            font-size: 18px;
        }
        .reset_diem,
        .tinh_diem {
            padding : 10px;
            border : 1px solid #2196F3;
            margin: 20px;
            -webkit-border-radius: 2px;
            -moz-border-radius: 2px;
            border-radius: 2px;
        }
        .tinh_diem {
            margin-left : 0
        }
        .aabb {
            margin-top: 40px;
        }
        .notice_ {
            margin-top: 50px;
        }
    </style>
    <div class="tinhdiem">
        <h1 class="text-center"> Quản lí điểm rèn luyện {{$current_term->note}} </h1>
        <div class="col-md-12"><a> Đã tính điểm {{$current_term->is_caculator}} lần trong học kỳ này. và reset điểm {{$current_term->is_reset}} </a></div>
        <div class="col-md-12 aabb">
            <a  href="{{URL::to('tinhdiem')}}" class="tinh_diem" > Tính điểm học kỳ này </a>
            <a  href="{{URL::to('resetpoint')}}" class="reset_diem" > reset điểm học kỳ này </a>
        </div>

        {{--<a  href="{{URL::to('checkImport')}}"> check. </a>--}}
    </div>
    <div class="col-md-12 notice_">
        <div class="col-md-12">
            @if(isset($flash_message) && isset($flash_level))
                <div class="alert auto-hide alert-{{$flash_level}}">
                    <h4 class="text-center">{{$flash_message}}</h4>
                </div>
            @endif
        </div>
        <div class="row">
            @yield('content')
        </div>
    </div> <!-- end .page-content-->
@stop
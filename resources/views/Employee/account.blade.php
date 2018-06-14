@extends('layouts.origin')
@section('title','Tài Khoản')

@section('navAccount')
                    <li class="nav-active active">
                        <a href="{{URL::to('account')}}">
                            <i class="glyphicon glyphicon-user fa-2x"></i>
                            <span style="font-size: 200%">Tài Khoản</span>
                        </a>
                    </li>
@endsection

@section('content')
	<h1 class="text-center">Thông tin tài khoản {{$sinhvien->fullname}}</h1>
    <form>
        {{csrf_field()}}
        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
        <center>
            <table  class="table table-bordered" style="width:100%;font-size:150%">
            <tr>
                <th class="col-md-5">Họ và tên</th>
                <th class="col-md-5">{{$sinhvien->fullname}}</th>
            </tr>

            <tr>
                <td >Mã số sinh viên</td>
                <td >{{$sinhvien->mssv}}</td>
            </tr>

            <tr>
                <td>Lớp</td>
                <td>{{$sinhvien->class}}</td>
            </tr>

            <tr>
                <td>Office</td>
                <td>{{$sinhvien->office}}</td>
            </tr>

            <tr>
                <td>Thư điện tử</td>
                <td>{{$sinhvien->email}}</td>
            </tr>

            <tr>
                <td>Sinh nhật</td>
                <td>{{$sinhvien->birthday}}</td>
            </tr>

            <tr>
                <td>Chức vụ</td>
                <td>{{$sinhvien->chuc_vu}}</td>
            </tr>

            <tr>
                <td>Khen Thưởng</td>
                <td>{{$sinhvien->khen_thuong}}</td>
            </tr>
        </table>
        </center>
    </form>
@endsection
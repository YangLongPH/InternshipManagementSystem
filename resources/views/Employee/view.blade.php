@extends('layouts.origin')
@section('title','Xem Danh Sách')

@section('navView')
                        <li class="nav-active active">
                            <a href="{{URL::to('view')}}">
                                <i class="glyphicon glyphicon-book fa-2x"></i>
                                <span style="font-size: 200%">Xem Danh Sách</span>
                            </a>
                        </li>
@endsection

@section('content')
    <h1> Danh sách sinh viên </h1>
	<div>
     Tổng số sinh viên : {{count($list)}}
    </div>
    <select id="DStable" name="DStable" onchange="changeTable()">
        <option>DS sv(QLSV)</option>
        <option>DS lớp(QLSV)</option>
        <option>DS cán bộ lớp, đoàn</option>
        <option>DS cố vấn học tập</option>
        <option>DS vi phạm YTSV</option>
        <option>DS vi phạm YTCD</option>
        <option>DS sv khen thưởng</option>
    </select>

    <table class="table table-bordered">
        <tr>
            <th class="col-md-3">MSSV</th>
            <th class="col-md-4">HỌ TÊN</th>
            <th class="col-md-4">LỚP</th>
            <th class="col-md-4">NGÀY SINH</th>
        </tr>
        @foreach($list as $sinhvien)
        <tr>
            <td>{{$sinhvien->mssv}}</td>
            <td>{{$sinhvien->fullname}}</td>
            <td>{{$sinhvien->class}}</td>
            <td>{{$sinhvien->birthday}}</td>
        </tr>
        @endforeach
    </table>
    <script>
    function myFunction() {
        var x = document.getElementById("DStable").value;
        // document.getElementById("demo").innerHTML = "You selected: " + x;
    }
    </script>
@endsection
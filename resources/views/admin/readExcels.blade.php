@extends('layouts.origin')
@section('title','Đọc file Excels')

@section('navExcels')
                        <li class="nav-active active">
                            <a href="{{URL::to('readExcels')}}">
                                <i class="glyphicon glyphicon-circle-arrow-up fa-2x"></i>
                                <span style="font-size: 200%">Excels</span>
                            </a>
                        </li>
@endsection

@section('content')
	
@if(isset($dcount)&&isset($chosetable))
	@if($chosetable=='students')
		<h1 style="color: blue">Đã thêm {{$dcount}} Sinh Viên vào CSDL</h1>
	@endif


	@if($chosetable=='class')
		<h1 style="color: blue">Đã thêm {{$dcount}} Lớp vào CSDL</h1>
	@endif

	@if($chosetable=='president.class')
		<h1 style="color: blue">Đã thêm {{$dcount}} Cán Bộ Lớp vào CSDL</h1>
	@endif

	@if($chosetable=='president.group')
		<h1 style="color: blue">Đã thêm {{$dcount}} Cán Bộ Đoàn vào CSDL</h1>
	@endif

	@if($chosetable=='adviser')
		<h1 style="color: blue">Đã thêm {{$dcount}} Cố Vấn Học Tập vào CSDL</h1>
	@endif

	@if($chosetable=='violate.ytsv')
		<h1 style="color: blue">Đã thêm {{$dcount}} sinh viên vi phạm Ý Thức Sinh Viên vào CSDL</h1>
	@endif

	@if($chosetable=='violate.ytcd')
		<h1 style="color: blue">Đã thêm {{$dcount}} sinh viên vi phạm Ý Thức Công Dân vào CSDL</h1>
	@endif

	@if($chosetable=='bonus')
		<h1 style="color: blue">Đã thêm {{$dcount}} sinh viên được khen thưởng vào CSDL</h1>
	@endif


	@if($chosetable=='point.average')
		<h1 style="color: blue">Đã thêm {{$dcount}} sinh viên điểm trung bình vào CSDL</h1>
	@endif

	@if($chosetable=='violate.pass')
		<h1 style="color: blue">Đã thêm {{$dcount}} sinh viên vi phạm quy chế thi vào CSDL</h1>
	@endif

	@if($chosetable=='study.science')
		<h1 style="color: blue">Đã thêm {{$dcount}} sinh viên Nghiên Cứu Khoa Học vào CSDL</h1>
	@endif

	@if($chosetable=='have.prize')
		<h1 style="color: blue">Đã thêm {{$dcount}} sinh viên Đạt giải NCKH vào CSDL</h1>
	@endif

	@if($chosetable=='join.activity')
		<h1 style="color: blue">Đã thêm {{$dcount}} sinh viên tham gia hoạt động đoàn thể vào CSDL</h1>
	@endif

	@if($chosetable=='have.praise')
		<h1 style="color: blue">Đã thêm {{$dcount}} sinh viên được khen thưởng vào CSDL</h1>
	@endif

	@if($chosetable=='violate.department')
		<h1 style="color: blue">Đã thêm {{$dcount}} sinh viên vi phạm cấp khoa vào CSDL</h1>
	@endif

	@if($chosetable=='violate.activity')
		<h1 style="color: blue">Đã thêm {{$dcount}} sinh viên vi phạm sinh hoạt lớp</h1>
	@endif
@endif

	<form action='updateDB' method="post" enctype="multipart/form-data">
	<input type="hidden" name="_token" value="{{ csrf_token() }}">
	<label>Chọn bảng</label>
	<select name="choseTable">
	<!-- phongctsv -->
	@if($user->id_role==1)
		<option value="students">Danh sách Sinh Viên mới</option>
		<option value="class">Danh sách Lớp học mới</option>
		<option value="president.class">Danh sách cán bộ Lớp</option>
		<option value="president.group">Danh sách cán bộ Đoàn</option>
		<option value="adviser">Danh sách Cố Vấn Học Tập</option>
		<option value="violate.ytsv">Danh sách vi phạm Ý Thức Sinh Viên</option>
		<option value="violate.ytcd">Danh sách vi phạm Ý thức Công Dân</option>
		<option value="bonus">Danh sách khen thưởng</option>
	@endif

	<!-- phongdaotao -->
	@if($user->username=='phongdaotao')
		<option value="point.average">Danh sách Điểm trung bình Học Kỳ</option>
		<option value="violate.pass">Danh sách Vi phạm quy chế thi</option>
	@endif
	<!-- phongkhcn -->
	@if($user->username=='phongkhcn')
		<option value="study.science">Danh sách Nghiên Cứu Khoa Học</option>
		<option value="have.prize">Danh sách Đạt Giải</option>
	@endif
	<!-- vanphongdoan -->
	@if($user->username=='vanphongdoan')
		<option value="join.activity">Danh sách SV tham gia hoạt động</option>
		<option value="have.praise">Danh sách SV khen thưởng</option>
	@endif
	<!-- vanphongkhoa -->
	@if($user->username=='vanphongkhoa')
		<option value="violate.department">Danh sách vi phạm cấp Khoa</option>
	@endif
	<!-- covanhoctap -->
	@if($user->username=='covanhoctap')
		<option value="violate.activity">Danh sách vi phạm Sinh Hoạt Lớp</option>
	@endif
	</select></br>
	<label>Chọn file tải lên</label>
	<input type="file" name="fileExcels"></br>
	<button type="submit">Import</button>
	</form>
@endsection
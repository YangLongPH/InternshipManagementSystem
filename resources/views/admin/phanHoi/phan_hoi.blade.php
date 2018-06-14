@extends('layouts.admin')
@section('title',' List Admin')
@section('content')

  <div class="newClass">
    <form action="postnewclass" method="post" enctype="multipart/form-data">
      {{csrf_field()}}
      <input type="hidden" name="_token" value="{{ csrf_token() }}" />
      <h1> Xử Lý Phản Hồi Của Sinh Viên  </h1>

      <div class="form-group">
        <label for="classname">Nội Dung Xử Lý </label>
        <input type="text" class="form-control" id="classname" name="clasname" placeholder="Tên lớp">
      </div>
      <div class="form-group">

        <button type="submit">Xác Nhận Xử Lý </button>
      </div>

    </form>


  </div>

@stop

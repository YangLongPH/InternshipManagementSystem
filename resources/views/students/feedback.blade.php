@extends('layouts.admin')
@section('title',' List Admin')
@section('content')
        <form method="post" action="send_feedback" class="col-md-12">
            {{--{{csrf_field()}}--}}
            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                <div class="form-group">
                    <label for="mssv" class="col-sm-4 control-label">Mã sinh viên</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="mssv" placeholder="Mã sinh viên" name="mssv" value="{{$mssv}}">
                    </div>
                </div>

                <div class="form-group">
                    <label for="noidung" class="col-sm-4 control-label">Nội dung</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="noidung" name="noidung" value="{{$noidung}}">
                    </div>
                </div>

                <div class="form-group">
                    <label for="diemtru" class="col-sm-4 control-label">  Điểm trừ </label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="diemtru" name="diemtru" value="{{$diemtru}}" >
                    </div>
                </div>

                <div class="form-group">
                    <label for="lydo" class="col-sm-4 control-label">Lý do</label>
                    <div class="col-sm-8">
                        <textarea class="form-control" rows="3" name="lydo" id="lydo"></textarea>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-4"></div>
                    <div class="col-sm-8">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Hủy</button>
                        <button type="submit" class="btn btn-primary send_feedback" data-dismiss="modal">Gửi phản hồi</button>
                    </div>
                </div>

            <div class="modal-footer">

            </div>

        </form>
@stop
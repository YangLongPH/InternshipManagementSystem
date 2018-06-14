@extends('layouts.admin')
@section('title',' List Admin')
@section('content')
    <style>
        #editModal {
            display: flow-root;
        }
        table.table-bordered {
            margin-top : 20px
        }
        .select_hoc_ky {
            width : 500px;
        }
        .Term-div {
            padding-top : 70px;
        }
        .col-md-8, #editModal label {
            margin-top: 20px;
        }
        .main-content {
            top: -15px;
            position: relative;
        }
    </style>
    <div class="Term-div">
        {{--<form >--}}
            {{csrf_field()}}
            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
            <div class="col-md-2 div-term">
                <h4> Chọn học kỳ </h4>
            </div>
            <select name="hoc_ky" class="form-control select_hoc_ky col-md-8" >
                @foreach($term_present as $term)
                    <option value="{{$term->id_hoc_ky}}" data="{{$term->note}}" > {{$term->note}} </option>
                @endforeach
            </select>
            <table class="table table-bordered col-md-12">
                <tr>
                    <td> STT </td>
                    <td> Mssv</td>
                    <td> Điểm  </td>
                    <td> Lý do  </td>
                    <td> Phản hồi </td>
                </tr>
                {{--*/  $dem = 1 /*--}}
                @if(isset($covan) )

                    @foreach($covan as $value)
                        <tr>
                            <td>{{$dem}}</td>
                            <td>{{$value->mssv}}</td>
                            <td class="point">{{$value->point_co_van_hoc_tap}}</td>
                            <td>{{$value->note}}</td>
                            <td>

                                    <i class="glyphicon glyphicon-pencil" id="{{$value->mssv}}" data_point="{{$value->point_co_van_hoc_tap}}" data1 = "{{$value}}" data-toggle="modal" data-target="#myModal">

                                    </i>

                            </td>
                        </tr>
                        {{--*/ $dem++ /*--}}
                    @endforeach
                @endif

                @if(isset($daotao) )
                    @foreach($daotao as $value)
                        <tr>
                            <td>{{$dem}}</td>
                            <td>{{$value->mssv}}</td>
                            <td class="point">{{$value->point_dao_tao}}</td>
                            <td>{{$value->note}}</td>
                            <td>
                                <i class="glyphicon glyphicon-pencil" id="{{$value->mssv}}"  data_point="{{$value->point_dao_tao}}"  data1 = "{{$value}}" data-toggle="modal" data-target="#myModal"></i>
                            </td>
                        </tr>
                        {{--*/ $dem++ /*--}}
                    @endforeach
                @endif

                @if(isset($ctsv) )
                    @foreach($ctsv as $value)
                        <tr>
                            <td>{{$dem}}</td>
                            <td>{{$value->mssv}}</td>
                            <td class="point">{{$value->point_cong_tac_sv}}</td>
                            <td>{{$value->note}}</td>
                            <td>
                               <i class="glyphicon glyphicon-pencil" id="{{$value->mssv}}" data_point="{{$value->point_cong_tac_sv}}" data1 = "{{$value}}" data-toggle="modal" data-target="#myModal"></i>
                            </td>
                        </tr>
                        {{--*/ $dem++ /*--}}
                    @endforeach

                @endif

                @if(isset($doan))
                    @foreach($doan as $value)
                        <tr>
                            <td>{{$dem}}</td>
                            <td>{{$value->mssv}}</td>
                            <td class="point">{{$value->point_doan}}</td>
                            <td>{{$value->note}}</td>
                            <td>
                               <i class="glyphicon glyphicon-pencil" id="{{$value->mssv}}" data_point="{{$value->point_doan}}"  data1 = "{{$value}}" data-toggle="modal" data-target="#myModal"></i>
                            </td>
                        </tr>
                        {{--*/ $dem++ /*--}}
                    @endforeach
                @endif

                @if(isset($khoa) )
                    @foreach($khoa as $value)
                        <tr>
                            <td>{{$dem}}</td>
                            <td>{{$value->mssv}}</td>
                            <td class="point">{{$value->point_khoa}}</td>
                            <td>{{$value->note}}</td>
                            <td>
                                <i class="glyphicon glyphicon-pencil" id="{{$value->mssv}}" data_point="{{$value->point_khoa}}"   data1 = "{{$value}}" data-toggle="modal" data-target="#myModal"></i>
                            </td>
                        </tr>
                        {{--*/ $dem++ /*--}}
                    @endforeach
                @endif

                @if(isset($khcn) )
                    @foreach($khcn as $value)
                        <tr>
                            <td>{{$dem}}</td>
                            <td>{{$value->mssv}}</td>
                            <td class="point">{{$value->point_khoa_hoc_cn}}</td>
                            <td>{{$value->note}}</td>
                            <td>
                                <i class="glyphicon glyphicon-pencil" id="{{$value->mssv}}"  data_point="{{$value->point_khoa_hoc_cn}}" data1 = "{{$value}}" data-toggle="modal" data-target="#myModal"></i>
                            </td>
                        </tr>
                        {{--*/ $dem++ /*--}}
                    @endforeach
                @endif

            </table>
        {{--</form>--}}
    </div>
    <!-- Modal -->
    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content" id="editModal">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Sửa thông tin sinh viên</h4>
                </div>
                <div class="modal-body">
                    <form method="post" action="send_feedback" class="col-md-12">
                        {{--{{csrf_field()}}--}}
                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                        <div class="form-group">
                            <label for="mssv" class="col-sm-4 control-label">Mã sinh viên</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="mssv" placeholder="Mã sinh viên" name="mssv" disabled>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="noidung" class="col-sm-4 control-label">Nội dung</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="noidung" name="noidung" disabled >
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="diemtru" class="col-sm-4 control-label">  Điểm </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="diemtru" name="diemtru" disabled >
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="lydo" class="col-sm-4 control-label">Lý do</label>
                            <div class="col-sm-8">
                                <textarea class="form-control" rows="3" name="lydo" id="lydo"></textarea>
                            </div>
                        </div>


                        <div class="modal-footer">
                            <div class="form-group">
                                <div class="col-md-4"></div>
                                <div class="col-sm-8">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Hủy</button>
                                    <button type="submit" class="btn btn-primary send_feedback" data-dismiss="modal">Gửi phản hồi</button>
                                </div>
                            </div>
                        </div>

                    </form>

                </div>

            </div>

        </div>
    </div>
@stop
@section('script_')
    @parent
    <script type="text/javascript">
        $(document).ready(function() {
            $('.glyphicon-pencil').click(function(){

                var data_students =  $(this).attr('data1');
                data_students = JSON.parse(data_students);
                var point =  $(this).attr('data_point');
                point = JSON.parse(point);
                var mssv = data_students.mssv;
                var noidung = data_students.note ;
                var diemtru = point;



                $('#editModal #mssv').val(mssv);
                $('#editModal #noidung').val(noidung);
                $('#editModal #diemtru').val(diemtru);

            });
            $('.chooseTerm').click(function(){
                $(this).children().prop('checked', true);
            });


            $('.send_feedback').click(function(){
                var mssv = $('#editModal #mssv').val();
                var noidung = $('#editModal #noidung').val();
                var diemtru = $('#editModal #diemtru').val();
                var lydo = $('#editModal #lydo').val();
                console.log(lydo);
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: '{{ URL::to('send_feedback') }}',
                    type: 'post',
                    dataType: 'json',
                    data : {
                        mssv : mssv,
                        noidung : noidung,
                        diemtru : diemtru,
                        lydo : lydo
                    },
                    success: function(data){
                        console.log(data);
                    }
                });
            });
        });
    </script>
@stop
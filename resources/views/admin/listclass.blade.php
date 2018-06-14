@extends('layouts.admin')
@section('title',' List Admin')
@section('content')
    <style>
        label, span.tong_sinh_vien {
            padding : 10px
        }
        .tong_sinh_vien {
            font-weight: 500;
            font-size:18px;
            color : #2196F3;
        }
        h1 {
            margin-top: 50px;
            color : #2196F3;
        }
    </style>
        <h1 class="text-center"> Danh sách sinh viên </h1>
        <div class="form-group">
            <div class="form-group col-md-12">
                <label for="fillter" class="col-md-2"> Lọc theo lớp</label>
                <div class="col-sm-6">
                    <select class="form-control choseClass">
                        {{--*/  $stt = 1 /*--}}
                        <option> Tất cả </option>
                        @foreach($list_class as $list)

                            <option>{{$list}}</option>
                            {{--*/ $stt++ /*--}}
                        @endforeach
                    </select>
                    <input type="hidden" name="_token" value="{{ csrf_token() }}" class="form-control" id="fillter" />
                </div>
            </div>
            <div class="col-md-12">
                <span class="tong_sinh_vien "> Tổng số sinh viên trong danh sách này: {{count($list_sinh_vien)}} </span>
            </div>
        </div>



            <button class="btn btn-primary pull-right" data-toggle="modal" data-target="#addNewStudents" > + Thêm Sinh viên </button>

        <div class="col-md-12">
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



        <table class="table table-bordered table-sinhvien">
            <tr>
                <th class="col-md-1"> STT </th>
                <th class="col-md-1"> MSSV </th>
                <th class="col-md-2"> Họ Têm</th>
                <th class="col-md-1"> Lớp </th>
                <th class="col-md-1"> Chức vụ </th>
                <th class="col-md-2"> Ngày Sinh</th>
                <th class="col-md-2"> email </th>
                <th class="col-md-1"> Điểm rèn luyện </th>
                <th class="col-md-1"> Actions  </th>

            </tr>
            {{--*/  $dem = 1 /*--}}
            @foreach($list_sinh_vien as $sinh_vien)
                @if($sinh_vien->mssv != 0 &&
                    $sinh_vien->mssv != 1 &&
                    $sinh_vien->mssv != 2 &&
                    $sinh_vien->mssv != 0 &&
                    $sinh_vien->mssv != 3 &&
                    $sinh_vien->mssv != 4 &&
                    $sinh_vien->mssv != 5 &&
                    $sinh_vien->mssv != 6 &&
                    $sinh_vien->id_role !=4
                )
                <tr class="{{$sinh_vien->mssv}}">
                    <td>{{$dem}}</td>
                    <td>{{$sinh_vien->mssv}}</td>
                    <td >{{$sinh_vien->fullname}} </td>
                    <td >{{$sinh_vien->class}} </td>
                    <td >{{$sinh_vien->chuc_vu}} </td>
                    <td >{{$sinh_vien->birthday}} </td>
                    <td >{{$sinh_vien->email}} </td>
                    <td> {{$sinh_vien->point}}</td>
                    <td>
                        <i class="glyphicon glyphicon-pencil" id="{{$sinh_vien->mssv}}" data1 = "{{$sinh_vien}}" data-toggle="modal" data-target="#myModal"></i>
                        <i class="glyphicon glyphicon-trash" id="{{$sinh_vien->mssv}}"></i>
                    </td>

                </tr>
                @endif
                {{--*/ $dem++ /*--}}

            @endforeach
        </table>


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
                       <form class="form-horizontal">
                           <div class="form-group">
                               <label for="mssv" class="col-sm-4 control-label">Mã sinh viên</label>
                               <div class="col-sm-8">
                                   <input type="text" class="form-control" id="mssv" placeholder="Mã sinh viên" disabled>
                               </div>
                           </div>
                           <div class="form-group">
                               <label for="name" class="col-sm-4 control-label">Họ và tên</label>
                               <div class="col-sm-8">
                                   <input type="text" class="form-control" id="name" placeholder="Họ và tên">
                               </div>
                           </div>

                           <div class="form-group">
                               <label for="Classs" class="col-sm-4 control-label">Lớp</label>
                               <div class="col-sm-8">
                                   <input type="text" class="form-control" id="Classs" placeholder="Lớp">
                               </div>
                           </div>

                           <div class="form-group">
                               <label for="position" class="col-sm-4 control-label">Chức vụ</label>
                               <div class="col-sm-8">
                                   <input type="text" class="form-control" id="position" placeholder="Chức vụ">
                               </div>
                           </div>

                           <div class="form-group">
                               <label for="birthday" class="col-sm-4 control-label">Ngày sinh</label>
                               <div class="col-sm-8">
                                   <input type="text" class="form-control" id="birthday" placeholder="Ngày sinh">
                               </div>
                           </div>

                           <div class="form-group">
                               <label for="email" class="col-sm-4 control-label">Email</label>
                               <div class="col-sm-8">
                                   <input type="text" class="form-control" id="email" placeholder="Email">
                               </div>
                           </div>

                           <div class="form-group">
                               <label for="point" class="col-sm-4 control-label">Điểm rèn luyện</label>
                               <div class="col-sm-8">
                                   <input type="text" class="form-control" id="point" placeholder="Điểm rèn luyện">
                               </div>
                           </div>



                       </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary save_change" data-dismiss="modal">Lưu lại</button>
                    </div>
                </div>

            </div>
        </div>

        {{--MODEL ADD NEW STUDENTS--}}
        <div id="addNewStudents" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content" id="newStudent">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Thêm mới sinh viên</h4>
                    </div>
                    <div class="modal-body">
                        <form class="form-horizontal">
                            <div class="form-group">
                                <label for="mssv" class="col-sm-4 control-label">Mã sinh viên</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="Newmssv" placeholder="Mã sinh viên" >
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="name" class="col-sm-4 control-label">Họ và tên</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="Newname" placeholder="Họ và tên">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="Classs" class="col-sm-4 control-label">Lớp</label>
                                <div class="col-sm-8">
                                    <select class="form-control" id="Newclass" value="Newclass">
                                        {{--*/  $stt = 1 /*--}}
                                        <option> Tất cả </option>
                                        @foreach($list_class as $list)
                                            <option>{{$list}}</option>
                                            {{--*/ $stt++ /*--}}
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="position" class="col-sm-4 control-label">Chức vụ</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="Newposition" placeholder="Chức vụ">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="birthday" class="col-sm-4 control-label">Ngày sinh</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="Newbirthday" placeholder="Ngày sinh">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="email" class="col-sm-4 control-label">Email</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="Newemail" placeholder="Email">
                                </div>
                            </div>

                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary save_new" data-dismiss="modal">Lưu lại</button>
                    </div>
                </div>

            </div>
        </div>

@stop
@section('script_')
    @parent
    <script type="text/javascript">
        $(document).ready(function() {

            $('.save_new').click(function(){
                var mssv = $('#newStudent #Newmssv').val();
                var name = $('#newStudent #Newname').val();
                var Classs = $('#newStudent #Newclass').val();
                var position = $('#newStudent #Newposition').val();
                var birthday = $('#newStudent #Newbirthday').val();
                var email =  $('#newStudent #Newemail').val();


                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: 'new_student',
                    type: 'post',
                    dataType: 'json',
                    data : {
                        name : name,
                        mssv : mssv,
                        Classs : Classs,
                        position : position,
                        birthday : birthday,
                        email : email,

                    },
                    success: function(data){
                        console.log(data);
                    }
                });

            });

            $('.save_change').click(function(){

                var mssv = $('#editModal #mssv').val();
                var name = $('#editModal #name').val();
                var Classs = $('#editModal #Classs').val();
                var position = $('#editModal #position').val();
                var birthday = $('#editModal #birthday').val();
                var email = $('#editModal #email').val();
                var point = $('#editModal #point').val();



                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: 'change_students',
                    type: 'post',
                    dataType: 'json',
                    data : {
                        name : name,
                        mssv : mssv,
                        Classs : Classs,
                        position : position,
                        birthday : birthday,
                        email : email,
                        point : point
                    },
                    success: function(data){
                        console.log(data);
                    }
                });
            })

            $('.glyphicon-pencil').click(function(){
                $id_students = this.id;
                var data_students =  $(this).attr('data1');
                data_students = JSON.parse(data_students);

                var mssv = data_students.mssv;
                var name = data_students.fullname ;
                var Classs = data_students.class;
                var position = data_students.chuc_vu;
                var birthday = data_students.birthday;
                var email = data_students.email;
                var point = data_students.point;


                $('#editModal #mssv').val(mssv);
                $('#editModal #name').val(name);
                $('#editModal #Classs').val(Classs);
                $('#editModal #position').val(position);
                $('#editModal #birthday').val(birthday);
                $('#editModal #email').val(email);
                $('#editModal #point').val(point);

            });

            $('.glyphicon-trash').click(function(){
            //    console.log(this.id);
                $id_students = this.id;

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: 'delete_student/'+$id_students,
                    type: 'post',
                    dataType: 'json',
                    success: function(data){
                        $('tr.'+data).hide(300);
                    }
                });

            });

            $('select.choseClass').on('change', function(){
                console.log('is change');
                var classname = this.value.trim();
                if(classname == 'Tất cả') {
                    classname = 'tatca';
                }
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: 'listofclass/'+classname,
                    type: 'post',
                    dataType: 'json',
                    success: function(data){

                        $('.table-sinhvien tr:gt(0)').remove();
                        var table = $('.table-sinhvien');
                        var length = 0;
                        $.map(data.list_sinh_vien, function (value, index) {
                            length++;
                            console.log(value);
                            table.append(
                                '<tr>' +
                                    '<td>' + index  + '</td>' +
                                    '<td>' + value.mssv + '</td>' +
                                    '<td>' + value.fullname + '</td>' +
                                    '<td>' + value.class + '</td>' +
                                    '<td>' + value.chuc_vu + '</td>' +
                                    '<td>' + value.birthday + '</td>' +
                                    '<td>' + value.email + '</td>' +
                                    '<td>' + value.point + '</td>' +
                                    '<td>  <i class="glyphicon glyphicon-pencil" id="' + value.mssv + '"></i>' +
                                            '<i class="glyphicon glyphicon-trash" id="' + value.mssv + '"></i>' +
                                    '</td>' +
                                '</tr>' );
                        });
                        $('.tong_sinh_vien').text('Tổng số sinh viên trong danh sách này:' +length);
                    }

                });
            });
        });
    </script>
@stop
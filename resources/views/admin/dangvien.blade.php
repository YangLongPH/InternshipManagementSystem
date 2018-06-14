@extends('layouts.admin')
@section('title',' List Admin')
@section('content')

    <h1> Danh sách Đảng Viên   </h1>
    <div>
        Lọc theo lớp
        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
        <span class="tong_sinh_vien "> Tổng số Đoàn viên trong danh sách này: {{count($list_sinh_vien)}} </span>
    </div>
    {{--<select>--}}
        {{--*/  $stt = 1 /*--}}
        {{--<option> Tất cả </option>--}}
        {{--@foreach($list_class as $list)--}}
            {{--<option>{{$list}}</option>--}}
            {{--*/ $stt++ /*--}}

        {{--@endforeach--}}
    {{--</select>--}}
    <table class="table table-bordered table-sinhvien">
        <tr>
            <th class="col-md-1"> STT </th>
            <th class="col-md-1"> MSSV </th>
            <th class="col-md-3"> Họ Têm</th>
            <th class="col-md-1"> Lớp </th>
            <th class="col-md-1"> Dang Vien  </th>


        </tr>
        {{--*/  $dem = 1 /*--}}
        {{--@foreach($list_sinh_vien as $sinh_vien)--}}


            {{--@if($sinh_vien->mssv != 1 &&--}}
                   {{--$sinh_vien->mssv != 2 &&--}}
                   {{--$sinh_vien->mssv != 3 &&--}}
                   {{--$sinh_vien->mssv != 4 &&--}}
                   {{--$sinh_vien->mssv != 5 &&--}}
                   {{--$sinh_vien->mssv != 6 &&--}}
                   {{--$sinh_vien->mssv != 7--}}
               {{--)--}}

            {{--<tr >--}}
                {{--<td>{{$dem}}</td>--}}
                {{--<td>{{$sinh_vien->mssv}}</td>--}}
                {{--<td >{{$sinh_vien->fullname}} </td>--}}
                {{--<td >{{$sinh_vien->class}} </td>--}}
                {{--<td >{{$sinh_vien->dang_vien}} </td>--}}



            {{--</tr>--}}
            {{--*/ $dem++ /*--}}

        {{--@endforeach--}}
        @foreach($list_sinh_vien as $sinh_vien )
            @if($sinh_vien->dang_vien == 'Đảng Viên'
            )
                {{--@if($sinh_vien->dang_vien!='Đảng Viên')--}}



                <tr >
                    <td>{{$dem}}</td>
                    <td>{{$sinh_vien->mssv}}</td>
                    <td >{{$sinh_vien->fullname}} </td>
                    <td >{{$sinh_vien->class}} </td>
                    <td> {{$sinh_vien->dang_vien}} </td>
                    {{--<td >{{$sinh_vien->khen_thuong}} </td>--}}
                    {{--<td >{{$sinh_vien->trung_binh}} </td>--}}
                    {{--<td >{{$sinh_vien->tich_luy}} </td>--}}
                    {{--<td >{{$sinh_vien->xep_loai}} </td>--}}
                    {{--<td >{{$sinh_vien->mon_vi_pham}} </td>--}}
                    {{--<td >{{$sinh_vien->ngay_vp}} </td>--}}
                    {{--<td >{{$sinh_vien->de_tai}} </td>--}}
                    {{--<td >{{$sinh_vien->giai_thuong}} </td>--}}
                    {{--<td >{{$sinh_vien->vi_pham_shl}} </td>--}}



                </tr>

            @endif
            {{--*/ $dem++ /*--}}

        @endforeach
    </table>

@stop
@section('script_')
    @parent
    <script type="text/javascript">
        $(document).ready(function() {
            $('select').on('change', function(){
                var classname = this.value.trim();
                if(classname == 'Tất cả') {
                    classname = 'tatca';
                }
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: 'listofclassdang/'+classname,
                    type: 'post',
                    dataType: 'json',
                    success: function(data){

                        $('.table-sinhvien tr:gt(0)').remove();
                        var table = $('.table-sinhvien');
                        var length = 0;
                        $.map(data.list_sinh_vien, function (value, index) {
                            length++;
                            table.append(
                                    '<tr>' +
                                    '<td>' + index  + '</td>' +
                                    '<td>' + value.mssv + '</td>' +
                                    '<td>' + value.fullname + '</td>' +
                                    '<td>' + value.class + '</td>' +
                                    '<td>' + value.dang_vien + '</td>' +

                                    '</tr>' );
                        });
                        $('.tong_sinh_vien').text('Tổng số sinh viên trong danh sách này:' +length);
//                        for(i = 0; i < data.list_sinh_vien.length; i++ ){
////
//                            console.log(data.list_sinh_vien[i]);
//                        }
                    }
                });
            });
        });
    </script>
@stop
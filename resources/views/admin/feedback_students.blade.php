@extends('layouts.admin')
@section('title',' List Admin')
@section('content')
    <style>
       .addBgr {
           background-color: orangered;
       }
       .addBgr-done {
           background-color: blue;
       }
        .main-content {
            top: -15px;
            position: relative;
        }
        h1 {
            margin-top: 50px;
            color : #2196F3;
        }
    </style>

    <div>
        <input type="hidden" name="_token" value="{!! csrf_token() !!}">
        <h1 class="text-center"> Phản hồi từ sinh viên</h1>
        <table class="table table-bordered">
            {{--*/  $dem = 1 /*--}}
            <tr>
                <td> STT </td>
                <td> MSSV </td>
                <td> Lớp </td>
                <td> Lý do</td>
                <td> Điểm trừ </td>
                <td> Phản hồi </td>
                <td> Đang xử lý </td>
                <td> Đã xử lý </td>
            </tr>
            @foreach($datas as $data)
                <tr class="{{$data->mssv}}">
                    <td> {{$dem}}</td>
                    <td> {{$data->mssv}} </td>
                    <td> lop </td>
                    <td> {{$data->noidung}}</td>
                    <td> {{$data->diemtru}}</td>
                    <td> {{$data->lydo}}</td>
                    <td class="chooseTerm-pending " data-feedback="{{$data->lydo}}" data-mssv="{{$data->mssv}}">
                        @if($data->action == 0 )
                            <input type="radio" name="{{$dem}}" id="inlineRadio3" checked="true">
                        @else
                            <input type="radio" name="{{$dem}}" id="inlineRadio3">
                        @endif

                    </td>
                    <td class="chooseTerm-success" data-feedback="{{$data->lydo}}" data-mssv="{{$data->mssv}}">
                        @if($data->action == 1 )
                            <input type="radio" name="{{$dem}}" id="inlineRadio3" checked="true">
                        @else
                            <input type="radio" name="{{$dem}}" id="inlineRadio3">
                        @endif
                    </td>
                </tr>
                {{--*/ $dem++ /*--}}
            @endforeach
        </table>
    </div>
@stop

@section('script_')
    @parent
    <script type="text/javascript">
        $(document).ready(function() {
            $('.chooseTerm-pending').click(function () {
                var mssv = $(this).attr('data-mssv');
                var lydo = $(this).attr('data-feedback');

                $(this).children().prop('checked', true);
              //  $('tr.'+mssv).removeClass('addBgr-done');
            //    $(this).addClass('addBgr');

                console.log($(this).attr('data-feedback'));

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: 'pending_feedback',
                    type: 'post',
                    dataType: 'json',
                    data : {
                        mssv : mssv,
                        lydo : lydo
                    },
                    success: function(data){
                        console.log(data);
                    }
                });

            })
            $('.chooseTerm-success').click(function () {
                var mssv = $(this).attr('data-mssv');
                var lydo = $(this).attr('data-feedback');

                $(this).children().prop('checked', true);
           //     $('tr.'+mssv).removeClass('addBgr');
           //     $(this).addClass('addBgr-done');


                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: 'done_feedback',
                    type: 'post',
                    dataType: 'json',
                    data : {
                        mssv : mssv,
                        lydo : lydo
                    },
                    success: function(data){
                        console.log(data);
                    }
                });

            })
        });
    </script>
@stop
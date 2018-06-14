
@extends('layouts.admin')
@section('title',' List Admin')
@section('content')
    <style>
        .glyphicon-trash,
        td.chooseTerm {
            cursor: pointer;
        }
        span.glyphicon:hover {
            background-color: #175fd3;
            color: white
        }
        td.chooseTerm input.choose {
            margin : 0px auto;
            display: flex;
        }
        h1 {
            margin-top: 50px;
            color : #2196F3;

        }
        select.select_term {
            width : 300px;
            margin : 20px 0;
            border : 1px solid #2196F3;
        }
        .input_new_term {
            width: 300px;
            background-color: white;
            border : 1px solid #2196F3;
        }
        button.btn {
            width: 300px;
            margin-bottom: 50px;
        }
    </style>
    <h1 class="text-center"> Thêm học kỳ mới </h1>
    <form action="postnewterm" method="post" class="col-md-12">
        {!! csrf_field() !!}
        <input type="hidden" name="_token" value="{!! csrf_token() !!}">
        {{--
          - kỳ 1 có mã là 10 + năm học
          - kỳ phụ 1 có mã là 11 + năm học
          - kỳ 2 có mã là 20 + năm học
          - kỳ phụ 2 có mã là 21 + năm học
          - kỳ hè có mã là 31 + năm học
        --}}
        <div class="col-md-12">
            <input type="text" placeholder="Tên học kỳ : 2XXX 2XXX" name="ten_hoc_ky" class="form-control input_new_term">
        </div>
        <div class="col-md-12">
            <select name="hoc_ky" class="form-control select_term">
                <option value="10">Học kỳ 1</option>
                <option value="11">Học kỳ phụ kỳ 1</option>
                <option value="20">Học kỳ 2</option>
                <option value="21">Học kỳ phụ kỳ 2</option>
                <option value="31">Học kỳ hè</option>
            </select>
        </div>
        <div class="col-md-12">
            <button type="submit" class="btn btn-primary"> Thêm mới </button>
        </div>

    </form>
    <div class="listTerm col-md-12">
        <table class="table table-bordered col-md-10">
            <tr>
                <th class="col-md-2"> STT</th>
                <th class="col-md-4"> Tên Học Kỳ</th>
                <th class="col-md-2"> Mã học kỳ </th>
                <th class="col-md-2"> Học kỳ hiện tại </th>
                <th class="col-md-2"> Sửa/xóa</th>
            </tr>
            {{--*/  $dem = 1 /*--}}
            @foreach($listTerm as $terms)
                <tr class="{{$terms->id_hoc_ky}}">
                    <td> {{$dem}} </td>
                    <td> {{$terms->note}}</td>
                    <td> {{$terms->id_hoc_ky}}</td>
                    <td class="chooseTerm">
                        @if($terms->term_present == 1)
                            <input type="radio" name="optionsTerm" id="{{$terms->id_hoc_ky}}" class="choose" checked="checked">
                        @else
                            <input type="radio" name="optionsTerm" id="{{$terms->id_hoc_ky}}" class="choose" >
                        @endif
                    </td>
                    <td class="actions">
                        <i class="glyphicon glyphicon-pencil"></i>
                        <i class="glyphicon glyphicon-trash" id="{{$terms->id_hoc_ky}}"></i>
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
            $('.glyphicon-trash').click(function(){
              //  console.log($(this));
                if (confirm('Are you sure you want to add a new group?')) {
                    var id = $(this).attr('id');
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: 'delete_term/'+id,
                        type: 'post',
                        dataType: 'json',
                        success: function(data){
                            $('tr.'+id).remove();
                        }
                    });
                }
            });
            $('.chooseTerm').click(function () {
                $(this).children().prop('checked', true);
                var id =  $(this).children().attr('id');
                console.log('id' , id);
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: 'change_present_term/'+id,
                    type: 'post',
                    dataType: 'json',
                    success: function(data){
                         console.log(data);
                    }
                });
            })
        });
    </script>
@stop
@extends('layouts.admin')
@section('title',' List Admin')
@section('content')
    <style>
        .main-content {
            top: -15px;
            position: relative;
        }
    </style>
    <form>
        <table class="table table-bordered">
            <tr>
                <th class="col-md-1"> STT </th>
                <th class="col-md-3"> Học kỳ </th>
                <th class="col-md-3"> Điểm rèn luyện </th>
                <th class="col-md-2"> Xếp loại </th>
                <th class="col-md-2"> Chi tiết </th>
            </tr>
            <tr>
                {{--*/  $dem = 1 /*--}}
                @foreach($students as $student)
                    <td>{{ $dem }}</td>
                    @foreach($hocky as $term)
                        @if($student->id_hoc_ky == $term->id_hoc_ky)
                                <td> {{$term->note}}</td>
                        @endif
                    @endforeach
                    <td> {{$student->point_total}}</td>
                    <td> {{$student->xeploai}} </td>
                    <td>
                        <a  href="{{URL::to('sv_detail/'.$student->id_hoc_ky)}}"><i class="glyphicon glyphicon-list"> </i> </a>
                    </td>
                    {{--*/ $dem++ /*--}}
                @endforeach
            </tr>
        </table>
    </form>
@stop
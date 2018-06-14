@extends('layouts.origin')
@section('title','Phản Hồi')

@section('navReport')
                    <li class="nav-active active">
                        <a href="{{URL::to('report')}}">
                            <i class="glyphicon glyphicon-send fa-2x"></i>
                            <span style="font-size: 200%">Phản hồi</span>
                        </a>
                    </li>
@endsection

@section('content')
	<p>{{$user->id_role}}</p>
	<p>{{$user->mssv}}</p>
@endsection
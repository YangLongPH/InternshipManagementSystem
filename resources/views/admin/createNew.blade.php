@extends('layouts.origin')
@section('title','Tạo Mới')

@section('navCreateNew')
                        <li class="nav-active active">
                            <a href="{{URL::to('createNew')}}">
                                <i class="glyphicon glyphicon-grain fa-2x"></i>
                                <span style="font-size: 200%">Tạo Mới</span>
                            </a>
                        </li>
@endsection

@section('content')
	<p>Create New</p>
@endsection
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use App\Models\Sinh_Vien;
use Excel,Input,File;
use Hash;
use DB;

class ViewController extends Controller
{
    public function view(Request $request){
    	return view('Employee.view')->with([
    		'user' => $request->session()->get('user'),
    		'sinhvien' => $request->session()->get('sinhvien'),
    		'list' => Sinh_Vien::all()
    		]);
    }
}

/*

 *
 */
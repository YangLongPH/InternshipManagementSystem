<?php
/**
 * Created by PhpStorm.
 * User: lv2x
 * Date: 20/03/2017
 * Time: 20:36
 */

namespace App\Http\Controllers;

use App\Models\Co_Van_Hoc_Tap;
use App\Models\Feedback;
use App\Models\P_Cong_Tac_SV;
use App\Models\P_Dao_Tao;
use App\Models\P_Doan;
use App\Models\P_Khoa;
use App\Models\P_Khoa_Hoc_CN;
use App\Models\Points;
use App\Models\Sinh_Vien;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Models\User_Point;
use Illuminate\Support\Facades\DB;
use App\Models\Form_Diem;
use App\Models\Hoc_Ky;


use Illuminate\Support\Facades\Input;


class StudentsControler extends Controller {
    public function ViewUser(Request $request) {
        $data = Form_Diem::all();
        $user= $request->session()->get('user');
        $sinhvien = $request->session()->get('sinhvien');
        return View('Employee.indexStudents')->With([
            'data' => $data,
            'user' => $user,
            'sinhvien' => $sinhvien
        ]);
    }

    public function account(Request $request){
        $user= $request->session()->get('user');
        $sinhvien = $request->session()->get('sinhvien');
        return View('Employee.account')->With([
            'user' => $user,
            'sinhvien' => $sinhvien
        ]);
    }

    public function report(Request $request){
        $user= $request->session()->get('user');
        $sinhvien = $request->session()->get('sinhvien');
        
        return view('Employee.report')->with([
            'user' => $user,
            'sinhvien' => $sinhvien
            ]);
    }

    

    public function getMauDiem () {
        $ad_us = User::find(Auth::user()->id);

        $data = User_Point::all();
        $size = count($data);

        $dataStudents = null;
        for($i = 0; $i < $size; $i++){
            if($data[$i]['mssv'] == $ad_us->mssv){
                $dataStudents = $data[$i];
                break;
            }
        }

        return view ('Employee.mau_diem')->with(['sum_point' => $ad_us->diem_ren_luyen]);
    }

    public function sv_detail ($id) {
        $term_present = Hoc_Ky::all();

        $ma_hk = Hoc_Ky::where('id_hoc_ky','=',  $id)->get();
        $id_hk = $ma_hk[0]->id_hoc_ky;
        $data = Points::where('mssv','=',  Auth::user()->mssv)->get();

        $data_covan = Co_Van_Hoc_Tap::where('mssv', '=', Auth::user()->mssv)->get();
        $data_daotao = P_Dao_Tao::where('mssv', '=', Auth::user()->mssv)->get();
        $data_ctsv = P_Cong_Tac_SV::where('mssv', '=', Auth::user()->mssv)->get();
        $data_doan = P_Doan::where('mssv', '=', Auth::user()->mssv)->get();
        $data_khoa = P_Khoa::where('mssv', '=', Auth::user()->mssv)->get();
        $data_khcn = P_Khoa_Hoc_CN::where('mssv', '=', Auth::user()->mssv)->get();
        $dataTerm = Form_Diem::where('ma_hk','=',  $id_hk)->get();

//
//        echo $data_covan;
//        echo $data_daotao;
//        echo $data_ctsv;
//        echo $data_doan;
//        echo $data_khoa;
//        echo $data_khcn;
//
//


        //  echo $data;
        return View('students.diem')->with([
            'term_present' => $term_present ,
            'covan'=>$data_covan,
            'daotao'=>$data_daotao,
            'ctsv'=>$data_ctsv,
            'doan'=>$data_doan,
            'khoa'=>$data_khoa,
            'khcn'=>$data_khcn,
            'terms'=>$dataTerm
        ]);
    //    return View('students.diem');
    }

    public function delete_student ($id) {

        if(Auth::user()->username == 'admin1' || Auth::user()->username == 'phongctsv' ){
            $id_students = Sinh_Vien::find($id);
            $id_students->delete();

            return $id;
        }
    }

    public function change_students (Request $request) {

        $mssv = Input::Get('mssv');
        $name = Input::Get('name');
        $Classs = Input::Get('Classs');
        $position = Input::Get('position');
        $birthday = Input::Get('birthday');
        $email = Input::Get('email');
        $point = Input::Get('point');

        $students = Sinh_Vien::find($mssv);
        $students::updateOrCreate(
            [ 'mssv'=>$mssv, ],
            [
                'fullname'=> $name,
                'class' => $Classs,
                'email' => $email,
                'chuc_vu' => $position
            ]
        );

        if($point != 0) {
            $std = Points::where('mssv' , '=' , $mssv)->get();
            $std[0]->point_total = $point;
            $std[0]->save();
        }

        return $point;
    }

    public function new_student () {
        $mssv = Input::Get('mssv');
        $name = Input::Get('name');
        $Classs = Input::Get('Classs');
        $position = Input::Get('position');
        $birthday = Input::Get('birthday');
        $email = Input::Get('email');

        $student = new Sinh_Vien();
        $student->mssv = $mssv;
        $student->fullname = $name;
        $student->class = $Classs;
        $student->office = 'Sinh Viên';
        $student->email = $email;
        $student->chuc_vu = $position;
        $student->birthday = $birthday;
        $student->save();

    }

    public function fbd ($mssv, $noidung, $diemtru) {

        return View('students.feedback')->with([
            'mssv' => $mssv,
            'noidung' =>$noidung,
            'diemtru'=>$diemtru
        ]);
    }

    public function send_feedback (Request $request) {

        $mssv = $request->mssv;
        $noidung = $request->noidung;
        $diemtru = $request->diemtru;
        $lop = Sinh_Vien::where('mssv', '=', $mssv)->get();

        $lydo = $request->lydo;

        $student = new Feedback();
        $student->mssv = $mssv;
        $student->classes = $lop[0]->class;
        $student->noidung = $noidung;
        $student->diemtru = $diemtru;
        $student->lydo = $lydo;

        $student->save();

        return ( $lydo );
    }
    public function pending_feedback (Request $request) {
        $mssv = Input::Get('mssv');
        $lydo = Input::Get('lydo');

        $feedback = Feedback::where([
            ['mssv','=', $mssv ],
            ['lydo', '=', $lydo]
        ])->get();
        $feedback[0]->action = 0;
        $feedback[0]->save();

        return $feedback[0];
    }
    public function done_feedback (Request $request) {
        $mssv = Input::Get('mssv');
        $lydo = Input::Get('lydo');

        $feedback = Feedback::where([
            ['mssv','=', $mssv ],
            ['lydo', '=', $lydo]
        ])->get();
        $feedback[0]->action = 1;
        $feedback[0]->save();

        return $feedback[0];
    }

}
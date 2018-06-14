<?php
/**
 * Created by PhpStorm.
 * User: lv2x
 * Date: 12/03/2017
 * Time: 20:32
 */
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\User;
use Illuminate\Support\Facades\Mail;
use Excel,Input,File;
use Illuminate\Support\Collection;
use Illuminate\Http\Response;
use DB;


use App\Models\Form_Diem;
use App\Models\Sinh_Vien;
use App\Models\Points;
use App\Models\Co_Van_Hoc_Tap;
use App\Models\Hoc_Ky;
use App\Models\P_Cong_Tac_SV;
use App\Models\P_Dao_Tao;
use App\Models\P_Doan;
use App\Models\P_Khoa_Hoc_CN;
use App\Models\P_Khoa;


class PhongKHCNController extends Controller  {


    // import danh sách

    public function newimport(){
        return View('admin.phongkhcn.newimport');
    }


//  danh sach sinh vien

    public function listclass() {
        $sinhvien = Sinh_Vien::all();
        $nghien_cuu = P_Khoa_Hoc_CN::all();
        $listClass = [];
        for($i = 0; $i < count($sinhvien); $i++){
            $sinhvien[$i]->point = 0;
            for($j = 0; $j < count($nghien_cuu)-1 ; $j++) {
                if($nghien_cuu[$j]->mssv == $sinhvien[$i]->mssv){
                    $sinhvien[$i]->note = $nghien_cuu[$j]->note;
                    $sinhvien[$i]->giai_thuong = $nghien_cuu[$j]->giai_thuong;
                }
            }
            $listClass[$i] = $sinhvien[$i]->class;
        }
        $listClass = array_unique($listClass);

        return View('admin.phongkhcn.listclass')->with([
            'list_sinh_vien' =>$sinhvien,
            'list_diem_ren_luyen' =>$nghien_cuu,
            'list_class' =>$listClass
        ]);
    }


    // danh sách vi pham

    public function giai_thuong() {
        $sinhvien = P_Khoa_Hoc_CN::all();
        $diem = Points::all();
        $listClass = [];
        for($i = 0; $i < count($sinhvien); $i++){
            $sinhvien[$i]->point = 0;
            for($j = 0; $j < count($diem)-1 ; $j++) {
                if($diem[$j]->mssv == $sinhvien[$i]->mssv){
                    $sinhvien[$i]->point = $diem[$j]->point_total;
                }
            }
            $listClass[$i] = $sinhvien[$i]->class;
        }
        $listClass = array_unique($listClass);

        return View('admin.phongkhcn.giai_thuong')->with([
            'list_sinh_vien' =>$sinhvien,
            'list_diem_ren_luyen' =>$diem,
            'list_class' =>$listClass
        ]);
    }

    



}
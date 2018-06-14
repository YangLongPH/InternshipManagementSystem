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


class VPDoanController extends Controller  {




 


    // demo new
    public function demo() {
        $sinhvien = P_Doan::all();
        $dang_vien = Points::all();
        $listClass = [];
        for($i = 0; $i < count($sinhvien); $i++){
            $sinhvien[$i]->point = 0;
            for($j = 0; $j < count($dang_vien)-1 ; $j++) {
                if($dang_vien[$j]->mssv == $sinhvien[$i]->mssv){
                    $sinhvien[$i]->point = $dang_vien[$j]->xeploai;
                }
            }
            $listClass[$i] = $sinhvien[$i]->class;
        }
        $listClass = array_unique($listClass);

        return View('admin.doanvien')->with([
            'list_sinh_vien' =>$sinhvien,
           // 'list_diem_ren_luyen' =>$diem,
            'list_class' =>$listClass
        ]);
    }

    //  ds dang vien

    public function dangvien() {

        $sinhvien = Sinh_Vien::all();

        $dang_vien = P_Doan::all();
        $listClass = [];
        for($i = 0; $i < count($sinhvien); $i++){
            for($j = 0; $j < count($dang_vien)-1 ; $j++) {
                if($dang_vien[$j]->mssv == $sinhvien[$i]->mssv){
                    $sinhvien[$i]->dang_vien = $dang_vien[$j]->dang_vien;
                }


            }
            $listClass[$i] = $sinhvien[$i]->dang_vien;
        }


        $listClass = array_unique($listClass);



        return View('admin.dangvien')->with([
            'list_sinh_vien' =>$sinhvien,
            'list_diem_ren_luyen' =>$dang_vien,
            'list_class' =>$listClass
        ]);


    }

    // hoat dong doan

    public function hoat_dong_doan() {
        $sinhvien = Sinh_Vien::all();
        $diem = P_Doan::all();
        $listClass = [];
        for($i = 0; $i < count($sinhvien); $i++){
            $sinhvien[$i]->point = 0;
            for($j = 0; $j < count($diem)-1 ; $j++) {
                if($diem[$j]->mssv != $sinhvien[$i]->mssv){
                    $sinhvien[$i]->point = $diem[$j]->point_total;
                }
            }
        //    $listClass[$i] = $sinhvien[$i]->class;
        }
        $listClass = array_unique($listClass);

        return View('admin.hoat_dong_doan')->with([
            'list_sinh_vien' =>$sinhvien,
            'list_diem_ren_luyen' =>$diem,
            'list_class' =>$listClass
        ]);
    }
    public function khen_thuong() {
        $sinhvien = Sinh_Vien::all();
        $diem = P_Doan::all();
        $listClass = [];
        for($i = 0; $i < count($sinhvien); $i++){
          //  $sinhvien[$i]->point = 0;

            for($j = 0; $j < count($diem)-1 ; $j++) {
                if($diem[$j]->mssv == $sinhvien[$i]->mssv){
                    $sinhvien[$i]->khen_thuong_doan = $diem[$j]->khen_thuong_doan;

                }
            }
            $listClass[$i] = $sinhvien[$i]->class;
        }
        $listClass = array_unique($listClass);

        return View('admin.doanVien.khen_thuong')->with([
            'list_sinh_vien' =>$sinhvien,
            'list_diem_ren_luyen' =>$diem,
            'list_class' =>$listClass
        ]);
    }
    public function vi_pham() {
        $sinhvien = Sinh_Vien::all();
        $vi_pham = P_Doan::all();
        $listClass = [];
        for($i = 0; $i < count($sinhvien); $i++){

            for($j = 0; $j < count($vi_pham)-1 ; $j++) {
                if($vi_pham[$j]->mssv == $sinhvien[$i]->mssv){
                    $sinhvien[$i]->vi_pham_doan = $vi_pham[$j]->vi_pham_doan;
                }
            }

        }
        $listClass = array_unique($listClass);

        return View('admin.doanVien.vi_pham')->with([
            'list_sinh_vien' =>$sinhvien,
            'list_diem_ren_luyen' =>$vi_pham,
            'list_class' =>$listClass
        ]);
    }


    public function newclass(){
        return View('admin.doanVien.newClass');
    }




}
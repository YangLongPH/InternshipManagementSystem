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


class DaoTaoController extends Controller  {


    // import danh sách

    public function newimport(){
        return View('admin.phongDaoTao.newimport');
    }


//  danh sach sinh vien

    public function listclass() {
        $sinhvien = P_Dao_Tao::all();
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

        return View('admin.phongDaoTao.listclass')->with([
            'list_sinh_vien' =>$sinhvien,
            'list_diem_ren_luyen' =>$diem,
            'list_class' =>$listClass
        ]);
    }


    // danh sách vi pham

    public function vi_pham_quyche() {
        $sinhvien = Sinh_Vien::all();
        $vi_pham_quyche = P_Dao_Tao::all();
        $listClass = [];
        for($i = 0; $i < count($sinhvien); $i++){
            $sinhvien[$i]->point = 0;
            for($j = 0; $j < count($vi_pham_quyche)-1 ; $j++) {
                if($vi_pham_quyche[$j]->mssv == $sinhvien[$i]->mssv){
                    $sinhvien[$i]->mon_vi_pham = $vi_pham_quyche[$j]->mon_vi_pham;
                    $sinhvien[$i]->ngay_vp = $vi_pham_quyche[$j]->ngay_vp;

                }
            }
            $listClass[$i] = $sinhvien[$i]->class;
        }
        $listClass = array_unique($listClass);

        return View('admin.phongDaoTao.vi_pham_quyche')->with([
            'list_sinh_vien' =>$sinhvien,
            'list_diem_ren_luyen' =>$vi_pham_quyche,
            'list_class' =>$listClass
        ]);
    }

    public function xem_diem() {
        $sinhvien = Sinh_Vien::all();
        $diem = P_Dao_Tao::all();
        $listClass = [];
        for($i = 0; $i < count($sinhvien); $i++){
            $sinhvien[$i]->point = 0;
            for($j = 0; $j < count($diem)-1 ; $j++) {
                if($diem[$j]->mssv == $sinhvien[$i]->mssv){
                    $sinhvien[$i]->trung_binh = $diem[$j]->trung_binh;
                    $sinhvien[$i]->tich_luy = $diem[$j]->tich_luy;
                    $sinhvien[$i]->xep_loai = $diem[$j]->xep_loai;


                }
            }
            $listClass[$i] = $sinhvien[$i]->class;
        }
        $listClass = array_unique($listClass);

        return View('admin.phongDaoTao.xem_diem')->with([
            'list_sinh_vien' =>$sinhvien,
            'list_diem_ren_luyen' =>$diem,
            'list_class' =>$listClass
        ]);
    }
    public function canh_bao_hv() {
        $sinhvien = Sinh_Vien::all();
        $canh_bao = P_Dao_Tao::all();
        $listClass = [];
        for($i = 0; $i < count($sinhvien); $i++){
            $sinhvien[$i]->point = 0;
            for($j = 0; $j < count($canh_bao)-1 ; $j++) {
                if($canh_bao[$j]->mssv == $sinhvien[$i]->mssv){
                    $sinhvien[$i]->canh_bao_hv = $canh_bao[$j]->canh_bao_hv;
                }
            }
            $listClass[$i] = $sinhvien[$i]->class;
        }
        $listClass = array_unique($listClass);

        return View('admin.phongDaoTao.canh_bao_hv')->with([
            'list_sinh_vien' =>$sinhvien,
            'list_diem_ren_luyen' =>$canh_bao,
            'list_class' =>$listClass
        ]);
    }

    // xem diem

    public function diem_hoc_tap() {
        $sinhvien = Sinh_Vien::all();
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

        return View('admin.phongDaoTao.diem_hoc_tap')->with([
            'list_sinh_vien' =>$sinhvien,
            'list_diem_ren_luyen' =>$diem,
            'list_class' =>$listClass
        ]);
    }

  

}
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


class vanphongkhoa extends Controller  {






    // import danh sách

    public function newimport(){
        return View('admin.vanPhongKhoa.newimport');
    }


//  danh sach sinh vien

    public function listclass() {
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

        return View('admin.vanPhongKhoa.listclass')->with([
            'list_sinh_vien' =>$sinhvien,
            'list_diem_ren_luyen' =>$diem,
            'list_class' =>$listClass
        ]);
    }
// van phong khoa  xem diem hoc tap  va xem diem ren luyen

    public function xem_diem() {
        $sinhvien = Sinh_Vien::all();
        $diem = Points::all();
        $diem_hoc_tap = P_Dao_Tao::all();
        $listClass = [];
        for($i = 0; $i < count($sinhvien); $i++){
            $sinhvien[$i]->point = 0;
            for($j = 0; $j < count($diem)-1 ; $j++) {
                if($diem[$j]->mssv == $sinhvien[$i]->mssv){
                    $sinhvien[$i]->point = $diem[$j]->point_total;
                    //$sinhvien[$i]->point = $diem_hoc_tap[$j]->point_total;
                }
            }
            $listClass[$i] = $sinhvien[$i]->class;
        }
        for($i = 0; $i < count($diem_hoc_tap); $i++){
            $diem_hoc_tap[$i]->point = 0;
            for($j = 0; $j < count($diem)-1 ; $j++) {
                if($diem[$j]->mssv == $diem_hoc_tap[$i]->mssv){
                    $diem_hoc_tap[$i]->point = $diem[$j]->point_total;
                    //$sinhvien[$i]->point = $diem_hoc_tap[$j]->point_total;
                }
            }
            $listClass[$i] = $diem_hoc_tap[$i]->class;
        }

        $listClass = array_unique($listClass);

        return View('admin.vanPhongKhoa.xem_diem')->with([
            'list_sinh_vien' =>$sinhvien,
            // 'list_sinh_vien' =>$diem_hoc_tap,
            'list_diem_ren_luyen' =>$diem,
            'list_class' =>$listClass
        ]);
    }

    // danh sách vi pham

    public function giai_thuong() {
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

        return View('admin.vanPhongKhoa.khen_thuong')->with([
            'list_sinh_vien' =>$sinhvien,
            'list_diem_ren_luyen' =>$diem,
            'list_class' =>$listClass
        ]);
    }
    
    
    // xem danh sach  vi pham  cua  khoa
    public function vi_pham() {
        // $sinhvien = Sinh_Vien::all();
        $sinhvien = DB::table('sinh_vien')
        ->join('p_khoa','sinh_vien.mssv','=','p_khoa.mssv')
        ->select('sinh_vien.*','p_khoa.vi_pham_sh_khoa')
        ->get();
        $diem = Points::all();
        $vi_pham_khoa = P_Khoa::all();
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
        for($i = 0; $i < count($vi_pham_khoa); $i++){
            $vi_pham_khoa[$i]->point = 0;
            for($j = 0; $j < count($diem)-1 ; $j++) {
                if($diem[$j]->mssv == $vi_pham_khoa[$i]->mssv){
                    $vi_pham_khoa[$i]->point = $diem[$j]->point_total;
                }
            }
            $listClass[$i] = $vi_pham_khoa[$i]->class;
        }
        $listClass = array_unique($listClass);

        return View('admin.vanPhongKhoa.vi_pham')->with([
            'list_sinh_vien' =>$sinhvien,
            // 'list_sinh_vien' =>$vi_pham_khoa,
            'list_diem_ren_luyen' =>$diem,
            'list_class' =>$listClass
        ]);
    }






}
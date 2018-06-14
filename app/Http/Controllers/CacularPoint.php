<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Models\Co_Van_Hoc_Tap;
use App\Models\Hoc_Ky;
use App\Models\P_Cong_Tac_SV;
use App\Models\P_Dao_Tao;
use App\Models\P_Doan;
use App\Models\P_Khoa_Hoc_CN;
use App\Models\P_Khoa;
use App\Models\Points;
use App\Models\Sinh_Vien;
use App\Models\Form_Diem;
use App\Http\Controllers\DB;

class CacularPoint extends Controller
{
    public $defaultPoint = 100;

    public function CaculPoint ($subPoint) {

        return 0;
    }
    public function tinhdiem ()
    {

        $current_term = Hoc_Ky::where('term_present', '=', '1')->get();
        // echo ($current_term[0]->id_hoc_ky);
        $currentPoint = Points::where('id_hoc_ky', '=', $current_term[0]->id_hoc_ky)->get();
        // echo $currentPoint;
        $sum = 0;
        $data_covan = Co_Van_Hoc_Tap::all();
        $data_daotao = P_Dao_Tao::all();
        $data_ctsv = P_Cong_Tac_SV::all();
        $data_doan = P_Doan::all();
        $data_khoa = P_Khoa::all();
        $data_khcn = P_Khoa_Hoc_CN::all();
        $dataTerm = Form_Diem::all();

            if ($current_term[0]->is_caculator ==  $current_term[0]->is_reset ) {
                for ($i = 0; $i < count($currentPoint); $i++) {


                    $total_point =

                        $currentPoint[$i]->point_total +
                        $currentPoint[$i]->point_co_van_hoc_tap +
                        $currentPoint[$i]->point_cong_tac_sv +
                        $currentPoint[$i]->point_dao_tao +
                        $currentPoint[$i]->point_doan +
                        $currentPoint[$i]->point_khoa_hoc_cn +
                        $currentPoint[$i]->point_khoa;

                    $currentPoint[$i]->point_total = $total_point;
                    $currentPoint[$i]->xeploai = $this->xeploai($total_point);

                    $currentPoint[$i]->save();
                }
                $current_term[0]->is_caculator = $current_term[0]->is_caculator + 1;
                $current_term[0]->save();



                return Redirect()->route('listdiem');
            } else {
                echo "Bạn phải reset lại điểm rèn luyện trước khi tính lại điểm";
            }
//        }
//        else {
//            $current_term = Hoc_Ky::where('term_present', '=', '1')->get();
//            $currentPoint = Points::where('id_hoc_ky', '=', $current_term[0]->id_hoc_ky)->get();
//
//            return View ('admin.tinhdiem')->with([
//                'flash_message' =>'Các phòng chưa nhập đủ danh sách',
//                'flash_level'=>'danger',
//                'current_term'=>$current_term[0],
//            ]);
//        }


    }
// < 50 kem 50-64 trung binh 65 - 79 kha, 80-89 tot, 90 xuat sac

    public function xeploai ($total) {
        if($total <= 50) {
            return "kém";
        } else if($total > 50 && $total < 65) {
            return "trung bình";
        } else if($total >64 && $total < 80) {
            return "khá";
        } else if($total >= 80 && $total < 90 ) {
            return "tốt";
        } else if($total >= 90) {
            return "xuất sắc";
        }
    }

    public function listdiem () {
        $current_term = Hoc_Ky::where('term_present', '=', '1')->get();
        $currentPoint = Points::where('id_hoc_ky', '=', $current_term[0]->id_hoc_ky)->get();
        return View('admin.tinhdiem')->with([
            'current_term'=>$current_term[0],

        ]);

    }
    public function resetpoint () {
        $current_term = Hoc_Ky::where('term_present', '=', '1')->get();
        $currentPoint = Points::where('id_hoc_ky', '=', $current_term[0]->id_hoc_ky)->get();
        for($i = 0; $i < count($currentPoint); $i++) {
            $currentPoint[$i]->point_total = 70;
            $currentPoint[$i]->save();
        }
        $current_term[0]->is_reset = $current_term[0]->is_reset + 1;
        $current_term[0]->save();
        return Redirect()->route('listdiem');
    }

    public function checkImport(){




    }
}

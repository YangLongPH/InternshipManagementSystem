<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Auth;

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


class PhongCtsvController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function listOfForm(Request $request, $id)
    {
        if(Auth::user()->username == 'admin1' || Auth::user()->username == 'phongctsv') {
            $data = Form_Diem::where('ma_hk','=',  $id)->get();
            $term_present = Hoc_Ky::where('id_hoc_ky','=',  $id)->get();
            $term_present = $term_present[0]->note ;


            return ['data'=>$data,'name'=>$term_present];
        }
    }


}

<?php
/**
 * Created by PhpStorm.
 * User: lv2x
 * Date: 12/03/2017
 * Time: 20:32
 */
namespace App\Http\Controllers;
use App\Models\Feedback;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
//use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Auth;
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
use App\Http\Controllers\Hash;

class AdminControler extends Controller {

    public $use_ = null;
    public $isErr = false;
    public function getLogin() {
        return view('admin.login');
    }

    public function postLogin(Request $request){
        if (Auth::attempt([ 'username' => $request->username, 'password' => $request->password,'id_role'=>2 ]) ||
            Auth::attempt([ 'username' => $request->username, 'password' => $request->password,'id_role'=>4 ]) ||
            Auth::attempt([ 'username' => $request->username, 'password' => $request->password,'id_role'=>3 ]) ) {
            $this->use_ = new User();
            return redirect()->route('newclass');

        } else if (Auth::attempt([ 'username' => $request->username, 'password' => $request->password,'id_role'=>1 ])) {
            $this->use_ = new User();

            return redirect()->route('ViewUser');
        }

        else {
            return redirect()->route('login')->with(
                ['flash_level' => 'danger', 'flash_message' => 'login error, Please check your name or password and try again']
            )->withInput();
        }
    }
    public function listUser(){
        return view('admin.adminManager');
    }
    public function ViewUser() {
        $mssv = Auth::user()->mssv;
        $point = Points::where('mssv', '=', $mssv)->get();
        $hocky = Hoc_Ky::all();
        return view('students.statistical')->with([
            'students'=>$point,
            'hocky'=>$hocky
        ]);
    }


    public function getLogout() {
        Auth::logout(); // logout user
        return Redirect()->route('login'); //redirect back to login
    }
    public function sendmail (Request $request) {

    }
    public function updatePoint (Request $request, $id, $chu_de) {
      //  $form_diem = Form_Diem::all();
        $ma_hk = Hoc_Ky::where('term_present','=',  '1')->get();
        $id_hk = $ma_hk[0]->id_hoc_ky;
        $form_diem = Form_Diem::where('ma_hk','=',  $id_hk)->get();

        $Form = new Form_Diem();
        switch ($chu_de){
            case 'tong_hoc_tap' :
               $Form::updateOrCreate( [ 'id'=> $form_diem[0]->id], [ 'tong_hoc_tap'=> $id, ] );
                break;
            case 'tru_hoc_luc_yeu' :
               $Form::updateOrCreate( [ 'id'=> $form_diem[0]->id], [ 'tru_hoc_luc_yeu'=> $id, ]  );
                break;
            case 'tru_canh_bao_hoc_vu' :
               $Form::updateOrCreate( [ 'id'=> $form_diem[0]->id], [ 'tru_canh_bao_hoc_vu'=> $id, ] );
                break;
            case 'tru_khong_du_tin_chi' :
               $Form::updateOrCreate( [ 'id'=> $form_diem[0]->id], [ 'tru_khong_du_tin_chi'=> $id, ] );
                break;
            case 'tru_ngien_cuu_kh' :
               $Form::updateOrCreate( [ 'id'=> $form_diem[0]->id], [ 'tru_ngien_cuu_kh'=> $id, ] );
                break;
            case 'tru_khong_thi' :
               $Form::updateOrCreate( [ 'id'=> $form_diem[0]->id], [ 'tru_khong_thi'=> $id, ] );
                break;
            case 'tru_khien_trach_thi' :
               $Form::updateOrCreate( [ 'id'=> $form_diem[0]->id], [ 'tru_khien_trach_thi'=> $id, ] );
                break;
            case 'tru_canh_cao_thi' :
               $Form::updateOrCreate( [ 'id'=> $form_diem[0]->id], [ 'tru_canh_cao_thi'=> $id, ] );
                break;
            case 'tru_dinh_chi_thi' :
               $Form::updateOrCreate( [ 'id'=> $form_diem[0]->id], [ 'tru_dinh_chi_thi'=> $id, ] );
                break;
            case 'tong_chap_hanh' :
               $Form::updateOrCreate( [ 'id'=> $form_diem[0]->id], [ 'tong_chap_hanh'=> $id, ] );
                break;
            case 'tru_nop_hoc_phi' :
               $Form::updateOrCreate( [ 'id'=> $form_diem[0]->id], [ 'tru_nop_hoc_phi'=> $id, ] );
                break;
            case 'tru_dang_ky_hoc_qua_han' :
                $Form::tru_dang_ky_hoc_qua_han( [ 'ma_hk'=> 1, ], [ 'tru_dang_ky_hoc_qua_han'=> $id, ] );
                break;
            case 'tru_khong_di_trieu_tap' :
               $Form::updateOrCreate( [ 'id'=> $form_diem[0]->id], [ 'tru_khong_di_trieu_tap'=> $id, ] );
                break;
            case 'tru_tra_qua_han_ho_so' :
               $Form::updateOrCreate( [ 'id'=> $form_diem[0]->id], [ 'tru_tra_qua_han_ho_so'=> $id, ] );
                break;
            case 'tru_khong_tham_gia_bao_hiem' :
               $Form::updateOrCreate( [ 'id'=> $form_diem[0]->id], [ 'tru_khong_tham_gia_bao_hiem'=> $id, ] );
                break;
            case 'tru_vi_pham_cu_tru' :
               $Form::updateOrCreate( [ 'id'=> $form_diem[0]->id], [ 'tru_vi_pham_cu_tru'=> $id, ] );
                break;
            case 'tru_phe_binh' :
               $Form::updateOrCreate( [ 'id'=> $form_diem[0]->id], [ 'tru_phe_binh'=> $id, ] );
                break;
            case 'tru_khien_trach' :
               $Form::updateOrCreate( [ 'id'=> $form_diem[0]->id], [ 'tru_khien_trach'=> $id, ] );
                break;
            case 'tru_canh_cao' :
               $Form::updateOrCreate( [ 'id'=> $form_diem[0]->id], [ 'tru_canh_cao'=> $id, ] );
                break;
            case 'tong_tham_gia' :
               $Form::updateOrCreate( [ 'id'=> $form_diem[0]->id], [ 'tong_tham_gia'=> $id, ] );
                break;
            case 'cong_tham_gia_truong' :
               $Form::updateOrCreate( [ 'id'=> $form_diem[0]->id], [ 'cong_tham_gia_truong'=> $id, ] );
                break;
            case 'cong_tham_gia_ngoai' :
               $Form::updateOrCreate( [ 'id'=> $form_diem[0]->id], [ 'cong_tham_gia_ngoai'=> $id, ] );
                break;
            case 'tru_khong_tham_gia' :
               $Form::updateOrCreate( [ 'id'=> $form_diem[0]->id], [ 'tru_khong_tham_gia'=> $id, ] );
                break;
            case 'tong_pham_chat' :
               $Form::updateOrCreate( [ 'id'=> $form_diem[0]->id], [ 'tong_pham_chat'=> $id, ] );
                break;
            case 'tru_khong_chap_hanh' :
               $Form::updateOrCreate( [ 'id'=> $form_diem[0]->id], [ 'tru_khong_chap_hanh'=> $id, ] );
                break;
            case 'tru_khong_tinh_than' :
               $Form::updateOrCreate( [ 'id'=> $form_diem[0]->id], [ 'tru_khong_tinh_than'=> $id, ] );
                break;
            case 'tong_cong_tac' :
               $Form::updateOrCreate( [ 'id'=> $form_diem[0]->id], [ 'tong_cong_tac'=> $id, ] );
                break;
            case 'cong_giu_chuc_vu' :
               $Form::updateOrCreate( [ 'id'=> $form_diem[0]->id], [ 'cong_giu_chuc_vu'=> $id, ] );
                break;
            case 'cong_hoc_luc' :
               $Form::updateOrCreate( [ 'id'=> $form_diem[0]->id], [ 'cong_hoc_luc'=> $id, ] );
                break;
            case 'cong_tham_gia_thi_chuyen_mon' :
               $Form::updateOrCreate( [ 'id'=> $form_diem[0]->id], [ 'cong_tham_gia_thi_chuyen_mon'=> $id, ] );
                break;
            case 'cong_nckh' :
               $Form::updateOrCreate( [ 'id'=> $form_diem[0]->id], [ 'cong_nckh'=> $id, ] );
                break;
            case 'cong_dat_giai' :
               $Form::updateOrCreate( [ 'id'=> $form_diem[0]->id], [ 'cong_dat_giai'=> $id, ] );
                break;
            case 'cong_ket_nap_dang' :
               $Form::updateOrCreate( [ 'id'=> $form_diem[0]->id], [ 'cong_ket_nap_dang'=> $id, ] );
                break;

        }
        return  [$form_diem[0]->id, $id_hk];
    }
    public function formdiem () {
        if(Auth::user()->username == 'admin1' || Auth::user()->username == 'phongctsv') {

            $term_present = Hoc_Ky::all();

            $ma_hk = Hoc_Ky::where('term_present','=',  '1')->get();
            $id_hk = $ma_hk[0]->id_hoc_ky;
            $data = Form_Diem::where('ma_hk','=',  $id_hk)->get();


            return View('Employee.mau_diem')->With([
                'term_present' => $term_present,
                'tong_hoc_tap' => $data[0]->tong_hoc_tap,
                'tru_hoc_luc_yeu' => $data[0]->tru_hoc_luc_yeu,
                'tru_canh_bao_hoc_vu' => $data[0]->tru_canh_bao_hoc_vu,
                'tru_khong_du_tin_chi' => $data[0]->tru_khong_du_tin_chi,
                'tru_ngien_cuu_kh' => $data[0]->tru_ngien_cuu_kh,
                'tru_khong_thi' => $data[0]->tru_khong_thi,

                'tru_khien_trach_thi' => $data[0]->tru_khien_trach_thi,
                'tru_canh_cao_thi' => $data[0]->tru_canh_cao_thi,
                'tru_dinh_chi_thi' => $data[0]->tru_dinh_chi_thi,

                // 2. ý thức và kết quả chấp hành nội quy,quy chế trong nhà trường
                'tong_chap_hanh' => $data[0]->tong_chap_hanh,
                'tru_nop_hoc_phi' => $data[0]->tru_nop_hoc_phi,
                'tru_dang_ky_hoc_qua_han' => $data[0]->tru_dang_ky_hoc_qua_han,
                'tru_khong_di_trieu_tap' => $data[0]->tru_khong_di_trieu_tap,
                'tru_tra_qua_han_ho_so' => $data[0]->tru_tra_qua_han_ho_so,
                'tru_khong_tham_gia_bao_hiem' => $data[0]->tru_khong_tham_gia_bao_hiem,
                'tru_vi_pham_cu_tru' => $data[0]->tru_vi_pham_cu_tru,

                'tru_phe_binh' => $data[0]->tru_phe_binh,
                'tru_khien_trach' => $data[0]->tru_khien_trach,
                'tru_canh_cao' => $data[0]->tru_canh_cao,

                // 3. ý thức và kết quả tham gia hoạt động chínht trị xã hội văn hoá, văn nghệ...
                'tong_tham_gia' => $data[0]->tong_tham_gia,
                'cong_tham_gia_truong' => $data[0]->cong_tham_gia_truong,
                'cong_tham_gia_ngoai' => $data[0]->cong_tham_gia_ngoai,
                'tru_khong_tham_gia' => $data[0]->tru_khong_tham_gia,

                // 4. phẩm chất công dân và quan hệ cộng đồng
                'tong_pham_chat' => $data[0]->tong_pham_chat,
                'tru_khong_chap_hanh' => $data[0]->tru_khong_chap_hanh,
                'tru_khong_tinh_than' => $data[0]->tru_khong_tinh_than,

                //5.  ý thức và kết quả tham gia công tác phụ trách lớp, đoàn thể...
                'tong_cong_tac' => $data[0]->tong_cong_tac,
                'cong_giu_chuc_vu' => $data[0]->cong_giu_chuc_vu,
                'cong_hoc_luc' => $data[0]->cong_hoc_luc,
                'cong_tham_gia_thi_chuyen_mon' => $data[0]->cong_tham_gia_thi_chuyen_mon,
                'cong_nckh' => $data[0]->cong_nckh,
                'cong_dat_giai' => $data[0]->cong_dat_giai,
                'cong_ket_nap_dang' => $data[0]->cong_ket_nap_dang,
            ]);
        }
        else {

        }
    }
    public function newclass(){
        return View('admin.newclass');
    }

    public function stripUnicode($str){
        if(!$str) return false;

        $unicode = array(
            'a'=>'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ',
            'd'=>'đ|Đ',
            'e'=>'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ',
            'i'=>'í|ì|ỉ|ĩ|ị',
            'o'=>'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ',
            'u'=>'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự',
            'y'=>'ý|ỳ|ỷ|ỹ|ỵ',
        );
        foreach($unicode as $nonUnicode=>$uni) $str = preg_replace("/($uni)/i",$nonUnicode,$str);
        $str = strtolower($str);
        $str = str_replace(" ", "", $str);
        return $str;
    }

    public function postnewclass (Request $request) {

        $classname = $request->clasname;
        $sinh_vien= new Sinh_Vien();
        if($request->type_file == 'list_class'){

            Excel::load($request->fileExcels, function($reader){
                $results = $reader->all();


                $Point = new Points();
                $form_diem = Form_Diem::all();
                $hocky = Hoc_Ky::where('term_present','=',  '1')->get();
                $point_base = $form_diem[0]->tong_hoc_tap + $form_diem[0]->tong_chap_hanh + $form_diem[0]->tong_pham_chat;

                foreach ($results as $key=>$value) {
                    if( isset($value->mssv)){

                        if($value != null && $value->id != null) {
                            $exitStudent = 0;
                            $exitStudent = Sinh_Vien::find($value->mssv);

                            if($exitStudent) {

                                $this->isErr = true;
                                break;
                            } else {
                                $sinh_vien_new = new Sinh_Vien();
                                $sinh_vien_new->mssv = $value->mssv;
                                $sinh_vien_new->fullname = $value->name;
                                $sinh_vien_new->email = $this->stripUnicode($value->name) . '@vnu.edu.vn';
                                $sinh_vien_new->office = 'Sinh Viên';
                                $sinh_vien_new->birthday = $value->birthday;
                                $sinh_vien_new->class = $value->class;

                                $sinh_vien_new->save();


                                $Point::updateOrCreate(
                                    [
                                        'mssv'=>$value->mssv
                                    ],
                                    [
                                        'id_hoc_ky' => $hocky[0]->id_hoc_ky,
                                        'point_total' => $point_base
                                    ]
                                );

                                // Tạo luôn tài khoản sinh viên mới
                                $newUser = new User();
                                $newUser->username = $value->mssv;
                                $newUser->mssv = $value->mssv;
                                $newUser->password = \Hash::make($value->mssv);
                                $newUser->id_role = 3;
                                $newUser->email = $this->stripUnicode($value->name) . '@vnu.edu.vn';

                                $newUser->save();
                            }
                        }


                    }
                    else {
                        break;
                    }

                }
            });
            $sinhvien = Sinh_Vien::all();
            $user = User::all();
            $diem = Points::all();
            $listClass = [];
            for($i = 0; $i < count($sinhvien); $i++){
                $sinhvien[$i]->point = 0;
                for($j = 0; $j < count($diem)-1 ; $j++) {
                    if($diem[$j]->mssv == $sinhvien[$i]->mssv){
                        $sinhvien[$i]->point = $diem[$j]->point_total;
                    }
                }
                for($k = 0; $k < count($user)-1 ; $k++) {
                    if($sinhvien[$i]->mssv == $user[$k]->mssv){
                        $sinhvien[$i]->id_role = $user[$k]->id_role;
                    }
                }
                if( $sinhvien[$i]->mssv != 0 &&
                    $sinhvien[$i]->mssv != 1 &&
                    $sinhvien[$i]->mssv != 2 &&
                    $sinhvien[$i]->mssv != 3 &&
                    $sinhvien[$i]->mssv != 4 &&
                    $sinhvien[$i]->mssv != 5 &&
                    $sinhvien[$i]->mssv != 6 &&
                    $sinhvien[$i]->mssv != 7
                ){
                    $listClass[$i] = $sinhvien[$i]->class;

                }

            }
            $listClass = array_unique($listClass);

            if($this->isErr) {
                return View('admin.listclass')->with([
                    'list_sinh_vien' =>$sinhvien,
                    'list_diem_ren_luyen' =>$diem,
                    'list_class' =>$listClass,
                    'flash_message'=>'Có Lỗi xảy ra, vui lòng kiểm tra lại',
                    'flash_level' =>'danger'
                ]);
            } else {
                return View('admin.listclass')->with([
                    'list_sinh_vien' =>$sinhvien,
                    'list_diem_ren_luyen' =>$diem,
                    'list_class' =>$listClass,
                    'flash_message'=>'Thêm mới thành công',
                    'flash_level' =>'success'
                ]);
            }


        }
        else if($request->type_file == 'list_ad_class') {

            Excel::load($request->fileExcels, function($reader){
                $results = $reader->all();
                foreach ($results as $key=>$value) {
                    $tmp = Sinh_Vien::find($value->mssv);
                    if($tmp) {

                        $ctsv = new P_Cong_Tac_SV();
                        $form_diem = Form_Diem::all();
                        $diem_cong = $form_diem[0]->cong_giu_chuc_vu;

                        $ctsv::updateOrCreate(
                            [ 'mssv'=> $value->mssv, ],
                            [
                                'point_cong_tac_sv'=> $diem_cong,
                                'mssv'=> $value->mssv,
                                'note' => $value-> office,
                            ]
                        );

                        $sinhvien = new Sinh_Vien();
                        $sinhvien::updateOrCreate(  [ 'mssv'=> $value->mssv, ], [ 'chuc_vu'=> $value->office, ] );

                        $id = $value->mssv;
                        $newPoint = Points::where('mssv','=',  $id)->get();
                        if($newPoint) { // nếu tìm thấy mã số sinh viên, thì tìm xem có mã học kỳ không
                            $term = Hoc_Ky::where('term_present','=',  '1')->get();
                            if($term[0]->id_hoc_ky == $newPoint[0]->id_hoc_ky) { // nếu có thì update. đm

                                $Point = new Points();
                                $Point::updateOrCreate(
                                    [ 'mssv'=> $value->mssv, ],
                                    [
                                        'point_cong_tac_sv'=> $diem_cong,
                                    ]
                                );
                            } else { // nếu méo có, đm

                                $Point = new Points();
                                $Point->mssv = $value->mssv;
                                $Point->id_hoc_ky = $term[0]->id_hoc_ky;
                                $Point->point_cong_tac_sv = $diem_cong;

                                $Point->save();
                            }
                        }
                    }
                }
            });


            $sinhvien = Sinh_Vien::all();
            $user = User::all();
            $diem = Points::all();
            $listClass = [];
            for($i = 0; $i < count($sinhvien); $i++){
                $sinhvien[$i]->point = 0;
                for($j = 0; $j < count($diem)-1 ; $j++) {
                    if($diem[$j]->mssv == $sinhvien[$i]->mssv){
                        $sinhvien[$i]->point = $diem[$j]->point_total;
                    }
                }
                for($k = 0; $k < count($user)-1 ; $k++) {
                    if($sinhvien[$i]->mssv == $user[$k]->mssv){
                        $sinhvien[$i]->id_role = $user[$k]->id_role;
                    }
                }
                if( $sinhvien[$i]->mssv != 0 &&
                    $sinhvien[$i]->mssv != 1 &&
                    $sinhvien[$i]->mssv != 2 &&
                    $sinhvien[$i]->mssv != 3 &&
                    $sinhvien[$i]->mssv != 4 &&
                    $sinhvien[$i]->mssv != 5 &&
                    $sinhvien[$i]->mssv != 6 &&
                    $sinhvien[$i]->mssv != 7
                ){
                    $listClass[$i] = $sinhvien[$i]->class;

                }

            }
            $listClass = array_unique($listClass);

            if($this->isErr) {
                return View('admin.listclass')->with([
                    'list_sinh_vien' =>$sinhvien,
                    'list_diem_ren_luyen' =>$diem,
                    'list_class' =>$listClass,
                    'flash_message'=>'Có Lỗi xảy ra, vui lòng kiểm tra lại',
                    'flash_level' =>'danger'
                ]);
            } else {
                return View('admin.listclass')->with([
                    'list_sinh_vien' =>$sinhvien,
                    'list_diem_ren_luyen' =>$diem,
                    'list_class' =>$listClass,
                    'flash_message'=>'Thêm mới thành công',
                    'flash_level' =>'success'
                ]);
            }

        }
           // nghien cuu khoa hoc
    else if($request->type_file == 'list_nghien_cuu_khoa_hoc') {

            Excel::load($request->fileExcels, function($reader){
                $results = $reader->all();

                foreach ($results as $key=>$value) {
                    $p_khoa_hoc_cn = new P_Khoa_Hoc_CN();
                    $form_diem = Form_Diem::all();
                    $diem_cong = $form_diem[0]->cong_nckh;
                    //   $Note  = "de tai: " + $value->de_tai + "giai thuong: " + $value->giai_thuong;
                    echo $value->note;
                    $p_khoa_hoc_cn::updateOrCreate(
                        [ 'mssv'=> $value->mssv, ],
                        [
                            'point_khoa_hoc_cn'=> $diem_cong,

                            'note' => $value->note,

                        ]
                    );

                    $id = $value->mssv;
                    $newPoint = Points::where('mssv','=',  $id)->get();
                    if($newPoint) { // nếu tìm thấy mã số sinh viên, thì tìm xem có mã học kỳ không
                        $term = Hoc_Ky::where('term_present','=',  '1')->get();
                        if($term[0]->id_hoc_ky == $newPoint[0]->id_hoc_ky) { // nếu có thì update. đm

                            $Point = new Points();
                            $Point::updateOrCreate(
                                [ 'mssv'=> $value->mssv, ],
                                [
                                    'point_khoa_hoc_cn'=> $diem_cong,
                                ]
                            );
                        } else { // nếu méo có, đm

                            $Point = new Points();
                            $Point->mssv = $value->mssv;
                            $Point->id_hoc_ky = $term[0]->id_hoc_ky;
                            $Point->point_khoa_hoc_cn = $diem_cong;

                            $Point->save();
                        }
                    }
                }
            });
        return redirect()->route('phongkhcn.listclass');
        }

        // khen thuong

        else if($request->type_file == 'list_ad_class_khen_thuong') {

            Excel::load($request->fileExcels, function($reader){
                $results = $reader->all();
                foreach ($results as $key=>$value) {
                    $tmp = Sinh_Vien::find($value->mssv);
                    if($tmp ) {

                        $ctsv = new P_Cong_Tac_SV();
                        $form_diem = Form_Diem::all();
                        $diem_cong = $form_diem[0]->cong_giu_chuc_vu;

                        $ctsv::updateOrCreate(
                            [ 'mssv'=> $value->mssv, ],
                            [
                                'point_cong_tac_sv'=> $diem_cong,
                                'mssv'=> $value->mssv,
                                'khen_thuong' => $value->khen_thuong,
                            ]
                        );

                        $sinhvien = new Sinh_Vien();
                        $sinhvien::updateOrCreate(  [ 'mssv'=> $value->mssv, ], [ 'khen_thuong'=> $value->khen_thuong, ] );
                    }
                }
            });

            $sinhvien = Sinh_Vien::all();
            $user = User::all();
            $diem = Points::all();
            $listClass = [];
            for($i = 0; $i < count($sinhvien); $i++){
                $sinhvien[$i]->point = 0;
                for($j = 0; $j < count($diem)-1 ; $j++) {
                    if($diem[$j]->mssv == $sinhvien[$i]->mssv){
                        $sinhvien[$i]->point = $diem[$j]->point_total;
                    }
                }
                for($k = 0; $k < count($user)-1 ; $k++) {
                    if($sinhvien[$i]->mssv == $user[$k]->mssv){
                        $sinhvien[$i]->id_role = $user[$k]->id_role;
                    }
                }
                if( $sinhvien[$i]->mssv != 0 &&
                    $sinhvien[$i]->mssv != 1 &&
                    $sinhvien[$i]->mssv != 2 &&
                    $sinhvien[$i]->mssv != 3 &&
                    $sinhvien[$i]->mssv != 4 &&
                    $sinhvien[$i]->mssv != 5 &&
                    $sinhvien[$i]->mssv != 6 &&
                    $sinhvien[$i]->mssv != 7
                ){
                    $listClass[$i] = $sinhvien[$i]->class;

                }

            }
            $listClass = array_unique($listClass);

            if($this->isErr) {
                return View('admin.listclass')->with([
                    'list_sinh_vien' =>$sinhvien,
                    'list_diem_ren_luyen' =>$diem,
                    'list_class' =>$listClass,
                    'flash_message'=>'Có Lỗi xảy ra, vui lòng kiểm tra lại',
                    'flash_level' =>'danger'
                ]);
            } else {
                return View('admin.listclass')->with([
                    'list_sinh_vien' =>$sinhvien,
                    'list_diem_ren_luyen' =>$diem,
                    'list_class' =>$listClass,
                    'flash_message'=>'Thêm mới thành công',
                    'flash_level' =>'success'
                ]);
            }
        }





        // bang diem

        else if($request->type_file == 'list_ad_class_bang_diem') {
//        if(Auth::user()->username == 'congtacsinhvien')
            Excel::load($request->fileExcels, function($reader){
                $results = $reader->all();
                foreach ($results as $key=>$value) {
//                    $tmp = Sinh_Vien::find($value->mssv);
//                    if($tmp ) {

                    $p_dao_tao = new P_Dao_Tao();
                    $form_diem = Form_Diem::all();
                    $diem_cong = $form_diem[0]->cong_hoc_luc;

                    $p_dao_tao::updateOrCreate(
                        [ 'mssv'=> $value->mssv, ],
                        [
                            'point_dao_tao'=> $diem_cong,
                            //  'mssv'=> $value->mssv,
                            'trung_binh' => $value-> trung_binh,
                            'tich_luy' => $value-> tich_luy,
                            'xep_loai' => $value-> xep_loai,

                        ]
                    );

                    $id = $value->mssv;
                    $newPoint = Points::where('mssv','=',  $id)->get();
                    if($newPoint) { // nếu tìm thấy mã số sinh viên, thì tìm xem có mã học kỳ không
                        $term = Hoc_Ky::where('term_present','=',  '1')->get();
                        if($term[0]->id_hoc_ky == $newPoint[0]->id_hoc_ky) { // nếu có thì update. đm

                            $Point = new Points();
                            $Point::updateOrCreate(
                                [ 'mssv'=> $value->mssv, ],
                                [
                                    'point_dao_tao'=> $diem_cong,

                                ]
                            );
                        } else { // nếu méo có, đm

                            $Point = new Points();
                            $Point->mssv = $value->mssv;
                            $Point->id_hoc_ky = $term[0]->id_hoc_ky;
                            $Point->point_dao_tao = $diem_cong;
                            $Point->point_total = 70;
                            $Point->save();
                        }
                    }
                }
                //            }
            });

            $sinhvien = Sinh_Vien::all();
            $user = User::all();
            $diem = Points::all();
            $listClass = [];
            for($i = 0; $i < count($sinhvien); $i++){
                $sinhvien[$i]->point = 0;
                for($j = 0; $j < count($diem)-1 ; $j++) {
                    if($diem[$j]->mssv == $sinhvien[$i]->mssv){
                        $sinhvien[$i]->point = $diem[$j]->point_total;
                    }
                }
                for($k = 0; $k < count($user)-1 ; $k++) {
                    if($sinhvien[$i]->mssv == $user[$k]->mssv){
                        $sinhvien[$i]->id_role = $user[$k]->id_role;
                    }
                }
                if( $sinhvien[$i]->mssv != 0 &&
                    $sinhvien[$i]->mssv != 1 &&
                    $sinhvien[$i]->mssv != 2 &&
                    $sinhvien[$i]->mssv != 3 &&
                    $sinhvien[$i]->mssv != 4 &&
                    $sinhvien[$i]->mssv != 5 &&
                    $sinhvien[$i]->mssv != 6 &&
                    $sinhvien[$i]->mssv != 7
                ){
                    $listClass[$i] = $sinhvien[$i]->class;

                }

            }
            $listClass = array_unique($listClass);

            if($this->isErr) {
                return View('admin.listclass')->with([
                    'list_sinh_vien' =>$sinhvien,
                    'list_diem_ren_luyen' =>$diem,
                    'list_class' =>$listClass,
                    'flash_message'=>'Có Lỗi xảy ra, vui lòng kiểm tra lại',
                    'flash_level' =>'danger'
                ]);
            } else {
                return View('admin.listclass')->with([
                    'list_sinh_vien' =>$sinhvien,
                    'list_diem_ren_luyen' =>$diem,
                    'list_class' =>$listClass,
                    'flash_message'=>'Thêm mới thành công',
                    'flash_level' =>'success'
                ]);
            }
        }


        // canh bao hoc vu
        else if($request->type_file == 'list_ad_canh_bao_hv') {
//        if(Auth::user()->username == 'congtacsinhvien')
            Excel::load($request->fileExcels, function($reader){
                $results = $reader->all();
                foreach ($results as $key=>$value) {
//                    $tmp = Sinh_Vien::find($value->mssv);
//                    if($tmp ) {

                    $p_dao_tao = new P_Dao_Tao();
                    $form_diem = Form_Diem::all();
                    $tru_diem = $form_diem[0]->tru_canh_cao;

                    $p_dao_tao::updateOrCreate(
                        [ 'mssv'=> $value->mssv, ],
                        [
                            'point_dao_tao'=> $tru_diem,
                            //'mssv'=> $value->mssv,
                            'canh_bao_hv' => $value-> canh_bao_hv,


                        ]
                    );

                    $id = $value->mssv;
                    $newPoint = Points::where('mssv','=',  $id)->get();
                    if($newPoint) { // nếu tìm thấy mã số sinh viên, thì tìm xem có mã học kỳ không
                        $term = Hoc_Ky::where('term_present','=',  '1')->get();
                        if($term[0]->id_hoc_ky == $newPoint[0]->id_hoc_ky) { // nếu có thì update. đm

                            $Point = new Points();
                            $Point::updateOrCreate(
                                [ 'mssv'=> $value->mssv, ],
                                [
                                    'point_dao_tao'=> $tru_diem,
                                ]
                            );
                        } else { // nếu méo có, đm

                            $Point = new Points();
                            $Point->mssv = $value->mssv;
                            $Point->id_hoc_ky = $term[0]->id_hoc_ky;
                            $Point->point_dao_tao = $tru_diem;
                            $Point->point_total = 70;
                            $Point->save();
                        }
                    }

                }

            });

            $sinhvien = Sinh_Vien::all();
            $user = User::all();
            $diem = Points::all();
            $listClass = [];
            for($i = 0; $i < count($sinhvien); $i++){
                $sinhvien[$i]->point = 0;
                for($j = 0; $j < count($diem)-1 ; $j++) {
                    if($diem[$j]->mssv == $sinhvien[$i]->mssv){
                        $sinhvien[$i]->point = $diem[$j]->point_total;
                    }
                }
                for($k = 0; $k < count($user)-1 ; $k++) {
                    if($sinhvien[$i]->mssv == $user[$k]->mssv){
                        $sinhvien[$i]->id_role = $user[$k]->id_role;
                    }
                }
                if( $sinhvien[$i]->mssv != 0 &&
                    $sinhvien[$i]->mssv != 1 &&
                    $sinhvien[$i]->mssv != 2 &&
                    $sinhvien[$i]->mssv != 3 &&
                    $sinhvien[$i]->mssv != 4 &&
                    $sinhvien[$i]->mssv != 5 &&
                    $sinhvien[$i]->mssv != 6 &&
                    $sinhvien[$i]->mssv != 7
                ){
                    $listClass[$i] = $sinhvien[$i]->class;

                }

            }
            $listClass = array_unique($listClass);

            if($this->isErr) {
                return View('admin.listclass')->with([
                    'list_sinh_vien' =>$sinhvien,
                    'list_diem_ren_luyen' =>$diem,
                    'list_class' =>$listClass,
                    'flash_message'=>'Có Lỗi xảy ra, vui lòng kiểm tra lại',
                    'flash_level' =>'danger'
                ]);
            } else {
                return View('admin.listclass')->with([
                    'list_sinh_vien' =>$sinhvien,
                    'list_diem_ren_luyen' =>$diem,
                    'list_class' =>$listClass,
                    'flash_message'=>'Thêm mới thành công',
                    'flash_level' =>'success'
                ]);
            }
        }


        // hoat dong doan
        else if($request->type_file == 'list_ad_class_tham_gia_hoatdong') {

            Excel::load($request->fileExcels, function($reader){
                $results = $reader->all();
                foreach ($results as $key=>$value) {
                    //  $tmp = Sinh_Vien::find($value->mssv);
                    //  if($tmp ) {

                    $p_Doan = new P_Doan();
                    $form_diem = Form_Diem::all();
                    $cong_diem = $form_diem[0]->cong_tham_gia_truong;

                    $p_Doan::updateOrCreate(
                        [ 'mssv'=> $value->mssv, ],
                        [
                            'point_doan'=> $cong_diem,
                            //     'mssv'=> $value->mssv,
                            'tham_gia' => $value-> tham_gia,



                        ]
                    );

                    $id = $value->mssv;
                    $newPoint = Points::where('mssv','=',  $id)->get();
                    if($newPoint) { // nếu tìm thấy mã số sinh viên, thì tìm xem có mã học kỳ không
                        $term = Hoc_Ky::where('term_present','=',  '1')->get();
                        if($term[0]->id_hoc_ky == $newPoint[0]->id_hoc_ky) { // nếu có thì update. đm

                            $Point = new Points();
                            $Point::updateOrCreate(
                                [ 'mssv'=> $value->mssv, ],
                                [
                                    'point_doan'=> $cong_diem,
                                ]
                            );
                        } else { // nếu méo có, đm

                            $Point = new Points();
                            $Point->mssv = $value->mssv;
                            $Point->id_hoc_ky = $term[0]->id_hoc_ky;


                            $Point->point_total = 70;

                            $Point->point_doan = $cong_diem;


                            $Point->save();
                        }
                    }

                }
            });

            $sinhvien = Sinh_Vien::all();
            $user = User::all();
            $diem = Points::all();
            $listClass = [];
            for($i = 0; $i < count($sinhvien); $i++){
                $sinhvien[$i]->point = 0;
                for($j = 0; $j < count($diem)-1 ; $j++) {
                    if($diem[$j]->mssv == $sinhvien[$i]->mssv){
                        $sinhvien[$i]->point = $diem[$j]->point_total;
                    }
                }
                for($k = 0; $k < count($user)-1 ; $k++) {
                    if($sinhvien[$i]->mssv == $user[$k]->mssv){
                        $sinhvien[$i]->id_role = $user[$k]->id_role;
                    }
                }
                if( $sinhvien[$i]->mssv != 0 &&
                    $sinhvien[$i]->mssv != 1 &&
                    $sinhvien[$i]->mssv != 2 &&
                    $sinhvien[$i]->mssv != 3 &&
                    $sinhvien[$i]->mssv != 4 &&
                    $sinhvien[$i]->mssv != 5 &&
                    $sinhvien[$i]->mssv != 6 &&
                    $sinhvien[$i]->mssv != 7
                ){
                    $listClass[$i] = $sinhvien[$i]->class;

                }

            }
            $listClass = array_unique($listClass);

            if($this->isErr) {
                return View('admin.listclass')->with([
                    'list_sinh_vien' =>$sinhvien,
                    'list_diem_ren_luyen' =>$diem,
                    'list_class' =>$listClass,
                    'flash_message'=>'Có Lỗi xảy ra, vui lòng kiểm tra lại',
                    'flash_level' =>'danger'
                ]);
            } else {
                return View('admin.listclass')->with([
                    'list_sinh_vien' =>$sinhvien,
                    'list_diem_ren_luyen' =>$diem,
                    'list_class' =>$listClass,
                    'flash_message'=>'Thêm mới thành công',
                    'flash_level' =>'success'
                ]);
            }
        }

        //khen_thuong_doan

        else if($request->type_file == 'list_ad_khen_thuong_doan') {

            Excel::load($request->fileExcels, function($reader){
                $results = $reader->all();
                foreach ($results as $key=>$value) {
                    //  $tmp = Sinh_Vien::find($value->mssv);
                    //  if($tmp ) {

                    $p_Doan = new P_Doan();
                    $form_diem = Form_Diem::all();
                    $cong_diem = $form_diem[0]->cong_tham_gia_truong;

                    $p_Doan::updateOrCreate(
                        [ 'mssv'=> $value->mssv, ],
                        [
                            'point_doan'=> $cong_diem,
                            //     'mssv'=> $value->mssv,
                            'khen_thuong_doan' => $value-> khen_thuong_doan,



                        ]
                    );

                    $id = $value->mssv;
                    $newPoint = Points::where('mssv','=',  $id)->get();
                    if($newPoint) { // nếu tìm thấy mã số sinh viên, thì tìm xem có mã học kỳ không
                        $term = Hoc_Ky::where('term_present','=',  '1')->get();
                        if($term[0]->id_hoc_ky == $newPoint[0]->id_hoc_ky) { // nếu có thì update. đm

                            $Point = new Points();
                            $Point::updateOrCreate(
                                [ 'mssv'=> $value->mssv, ],

                                [
                                    'point_doan'=> $cong_diem,
                                    'khen_thuong_doan'=> $cong_diem,
                                ]
                            );
                        } else { // nếu méo có, đm

                            $Point = new Points();
                            $Point->mssv = $value->mssv;
                            $Point->id_hoc_ky = $term[0]->id_hoc_ky;

                            $Point->khen_thuong_doan = $cong_diem;
                            $Point->point_total = 70;

                            $Point->point_doan = $cong_diem;

                            $Point->save();
                        }
                    }

                }
            });

            $sinhvien = Sinh_Vien::all();
            $user = User::all();
            $diem = Points::all();
            $listClass = [];
            for($i = 0; $i < count($sinhvien); $i++){
                $sinhvien[$i]->point = 0;
                for($j = 0; $j < count($diem)-1 ; $j++) {
                    if($diem[$j]->mssv == $sinhvien[$i]->mssv){
                        $sinhvien[$i]->point = $diem[$j]->point_total;
                    }
                }
                for($k = 0; $k < count($user)-1 ; $k++) {
                    if($sinhvien[$i]->mssv == $user[$k]->mssv){
                        $sinhvien[$i]->id_role = $user[$k]->id_role;
                    }
                }
                if( $sinhvien[$i]->mssv != 0 &&
                    $sinhvien[$i]->mssv != 1 &&
                    $sinhvien[$i]->mssv != 2 &&
                    $sinhvien[$i]->mssv != 3 &&
                    $sinhvien[$i]->mssv != 4 &&
                    $sinhvien[$i]->mssv != 5 &&
                    $sinhvien[$i]->mssv != 6 &&
                    $sinhvien[$i]->mssv != 7
                ){
                    $listClass[$i] = $sinhvien[$i]->class;

                }

            }
            $listClass = array_unique($listClass);

            if($this->isErr) {
                return View('admin.listclass')->with([
                    'list_sinh_vien' =>$sinhvien,
                    'list_diem_ren_luyen' =>$diem,
                    'list_class' =>$listClass,
                    'flash_message'=>'Có Lỗi xảy ra, vui lòng kiểm tra lại',
                    'flash_level' =>'danger'
                ]);
            } else {
                return View('admin.listclass')->with([
                    'list_sinh_vien' =>$sinhvien,
                    'list_diem_ren_luyen' =>$diem,
                    'list_class' =>$listClass,
                    'flash_message'=>'Thêm mới thành công',
                    'flash_level' =>'success'
                ]);
            }
        }


        // dang vien
        else if($request->type_file == 'list_ad_dang_vien') {

            Excel::load($request->fileExcels, function($reader){
                $results = $reader->all();
                foreach ($results as $key=>$value) {
                    //  $tmp = Sinh_Vien::find($value->mssv);
                    //  if($tmp ) {

                    $p_Doan = new P_Doan();
                    $form_diem = Form_Diem::all();
                    $cong_diem = $form_diem[0]->cong_ket_nap_dang;

                    $p_Doan::updateOrCreate(
                        [ 'mssv'=> $value->mssv, ],
                        [
                            'point_doan'=> $cong_diem,
                            //     'mssv'=> $value->mssv,
                            'dang_vien' => $value-> dang_vien,



                        ]
                    );

                    $id = $value->mssv;
                    $newPoint = Points::where('mssv','=',  $id)->get();
                    if($newPoint) { // nếu tìm thấy mã số sinh viên, thì tìm xem có mã học kỳ không
                        $term = Hoc_Ky::where('term_present','=',  '1')->get();
                        if($term[0]->id_hoc_ky == $newPoint[0]->id_hoc_ky) { // nếu có thì update. đm

                            $Point = new Points();
                            $Point::updateOrCreate(
                                [ 'mssv'=> $value->mssv, ],

                                [
                                    'point_doan'=> $cong_diem,
                                    'dang_vien'=> $cong_diem,
                                ]
                            );
                        } else { // nếu méo có, đm

                            $Point = new Points();
                            $Point->mssv = $value->mssv;
                            $Point->id_hoc_ky = $term[0]->id_hoc_ky;
                            $Point->point_doan = $cong_diem;

                            $Point->save();
                        }
                    }

                }
            });

            $sinhvien = Sinh_Vien::all();
            $user = User::all();
            $diem = Points::all();
            $listClass = [];
            for($i = 0; $i < count($sinhvien); $i++){
                $sinhvien[$i]->point = 0;
                for($j = 0; $j < count($diem)-1 ; $j++) {
                    if($diem[$j]->mssv == $sinhvien[$i]->mssv){
                        $sinhvien[$i]->point = $diem[$j]->point_total;
                    }
                }
                for($k = 0; $k < count($user)-1 ; $k++) {
                    if($sinhvien[$i]->mssv == $user[$k]->mssv){
                        $sinhvien[$i]->id_role = $user[$k]->id_role;
                    }
                }
                if( $sinhvien[$i]->mssv != 0 &&
                    $sinhvien[$i]->mssv != 1 &&
                    $sinhvien[$i]->mssv != 2 &&
                    $sinhvien[$i]->mssv != 3 &&
                    $sinhvien[$i]->mssv != 4 &&
                    $sinhvien[$i]->mssv != 5 &&
                    $sinhvien[$i]->mssv != 6 &&
                    $sinhvien[$i]->mssv != 7
                ){
                    $listClass[$i] = $sinhvien[$i]->class;

                }

            }
            $listClass = array_unique($listClass);

            if($this->isErr) {
                return View('admin.listclass')->with([
                    'list_sinh_vien' =>$sinhvien,
                    'list_diem_ren_luyen' =>$diem,
                    'list_class' =>$listClass,
                    'flash_message'=>'Có Lỗi xảy ra, vui lòng kiểm tra lại',
                    'flash_level' =>'danger'
                ]);
            } else {
                return View('admin.listclass')->with([
                    'list_sinh_vien' =>$sinhvien,
                    'list_diem_ren_luyen' =>$diem,
                    'list_class' =>$listClass,
                    'flash_message'=>'Thêm mới thành công',
                    'flash_level' =>'success'
                ]);
            }
        }

        // sv vi pham sh doan

        else if($request->type_file == 'list_ad_vi_pham_doan') {

            Excel::load($request->fileExcels, function($reader){
                $results = $reader->all();
                foreach ($results as $key=>$value) {
                    //  $tmp = Sinh_Vien::find($value->mssv);
                    //  if($tmp ) {

                    $p_doan = new P_Doan();
                    $form_diem = Form_Diem::all();
                    $tru_diem = $form_diem[0]->tru_khong_tham_gia;

                    $p_doan::updateOrCreate(
                        [ 'mssv'=> $value->mssv, ],
                        [
                            'point_doan'=> $tru_diem,
                            //     'mssv'=> $value->mssv,
                            'vi_pham_doan' => $value-> vi_pham_doan,



                        ]
                    );

                    $id = $value->mssv;
                    $newPoint = Points::where('mssv','=',  $id)->get();
                    if($newPoint) { // nếu tìm thấy mã số sinh viên, thì tìm xem có mã học kỳ không
                        $term = Hoc_Ky::where('term_present','=',  '1')->get();
                        if($term[0]->id_hoc_ky == $newPoint[0]->id_hoc_ky) { // nếu có thì update. đm

                            $Point = new Points();
                            $Point::updateOrCreate(
                                [ 'mssv'=> $value->mssv, ],
                                [
                                    'point_doan'=> $tru_diem,
                                ]
                            );
                        } else { // nếu méo có, đm

                            $Point = new Points();
                            $Point->mssv = $value->mssv;
                            $Point->id_hoc_ky = $term[0]->id_hoc_ky;
                            $Point->point_doan = $tru_diem;

                            $Point->save();
                        }
                    }

                }
            });

            $sinhvien = Sinh_Vien::all();
            $user = User::all();
            $diem = Points::all();
            $listClass = [];
            for($i = 0; $i < count($sinhvien); $i++){
                $sinhvien[$i]->point = 0;
                for($j = 0; $j < count($diem)-1 ; $j++) {
                    if($diem[$j]->mssv == $sinhvien[$i]->mssv){
                        $sinhvien[$i]->point = $diem[$j]->point_total;
                    }
                }
                for($k = 0; $k < count($user)-1 ; $k++) {
                    if($sinhvien[$i]->mssv == $user[$k]->mssv){
                        $sinhvien[$i]->id_role = $user[$k]->id_role;
                    }
                }
                if( $sinhvien[$i]->mssv != 0 &&
                    $sinhvien[$i]->mssv != 1 &&
                    $sinhvien[$i]->mssv != 2 &&
                    $sinhvien[$i]->mssv != 3 &&
                    $sinhvien[$i]->mssv != 4 &&
                    $sinhvien[$i]->mssv != 5 &&
                    $sinhvien[$i]->mssv != 6 &&
                    $sinhvien[$i]->mssv != 7
                ){
                    $listClass[$i] = $sinhvien[$i]->class;

                }

            }
            $listClass = array_unique($listClass);

            if($this->isErr) {
                return View('admin.listclass')->with([
                    'list_sinh_vien' =>$sinhvien,
                    'list_diem_ren_luyen' =>$diem,
                    'list_class' =>$listClass,
                    'flash_message'=>'Có Lỗi xảy ra, vui lòng kiểm tra lại',
                    'flash_level' =>'danger'
                ]);
            } else {
                return View('admin.listclass')->with([
                    'list_sinh_vien' =>$sinhvien,
                    'list_diem_ren_luyen' =>$diem,
                    'list_class' =>$listClass,
                    'flash_message'=>'Thêm mới thành công',
                    'flash_level' =>'success'
                ]);
            }
        }

        // co van hoc tap update sinh vien  vi pham sh cua  lop
        else if($request->type_file == 'danh_sach_sh_lop') {

            Excel::load($request->fileExcels, function($reader){
                $results = $reader->all();
                foreach ($results as $key=>$value) {
                    //  $tmp = Sinh_Vien::find($value->mssv);
                    //  if($tmp ) {

                    $p_co_van = new Co_Van_Hoc_Tap();
                    $form_diem = Form_Diem::all();
                    $tru_diem = $form_diem[0]->tru_khong_tham_gia;

                    $p_co_van::updateOrCreate(
                        [ 'mssv'=> $value->mssv, ],
                        [
                            'point_co_van_hoc_tap'=> $tru_diem,
                            //     'mssv'=> $value->mssv,
                            'note' => $value-> vi_pham_shl,



                        ]
                    );

                    $id = $value->mssv;
                    $newPoint = Points::where('mssv','=',  $id)->get();
                    if($newPoint) { // nếu tìm thấy mã số sinh viên, thì tìm xem có mã học kỳ không
                        $term = Hoc_Ky::where('term_present','=',  '1')->get();
                        if($term[0]->id_hoc_ky == $newPoint[0]->id_hoc_ky) { // nếu có thì update. đm

                            $Point = new Points();
                            $Point::updateOrCreate(
                                [ 'mssv'=> $value->mssv, ],
                                [
                                    'point_co_van_hoc_tap'=> $tru_diem,
                                ]
                            );
                        } else { // nếu méo có, đm

                            $Point = new Points();
                            $Point->mssv = $value->mssv;
                            $Point->id_hoc_ky = $term[0]->id_hoc_ky;
                            $Point->point_co_van_hoc_tap = $tru_diem;

                            $Point->save();
                        }
                    }

                }
            });

            $sinhvien = Sinh_Vien::all();
            $user = User::all();
            $diem = Points::all();
            $listClass = [];
            for($i = 0; $i < count($sinhvien); $i++){
                $sinhvien[$i]->point = 0;
                for($j = 0; $j < count($diem)-1 ; $j++) {
                    if($diem[$j]->mssv == $sinhvien[$i]->mssv){
                        $sinhvien[$i]->point = $diem[$j]->point_total;
                    }
                }
                for($k = 0; $k < count($user)-1 ; $k++) {
                    if($sinhvien[$i]->mssv == $user[$k]->mssv){
                        $sinhvien[$i]->id_role = $user[$k]->id_role;
                    }
                }
                if( $sinhvien[$i]->mssv != 0 &&
                    $sinhvien[$i]->mssv != 1 &&
                    $sinhvien[$i]->mssv != 2 &&
                    $sinhvien[$i]->mssv != 3 &&
                    $sinhvien[$i]->mssv != 4 &&
                    $sinhvien[$i]->mssv != 5 &&
                    $sinhvien[$i]->mssv != 6 &&
                    $sinhvien[$i]->mssv != 7
                ){
                    $listClass[$i] = $sinhvien[$i]->class;

                }

            }
            $listClass = array_unique($listClass);

            if($this->isErr) {
                return View('admin.listclass')->with([
                    'list_sinh_vien' =>$sinhvien,
                    'list_diem_ren_luyen' =>$diem,
                    'list_class' =>$listClass,
                    'flash_message'=>'Có Lỗi xảy ra, vui lòng kiểm tra lại',
                    'flash_level' =>'danger'
                ]);
            } else {
                return View('admin.listclass')->with([
                    'list_sinh_vien' =>$sinhvien,
                    'list_diem_ren_luyen' =>$diem,
                    'list_class' =>$listClass,
                    'flash_message'=>'Thêm mới thành công',
                    'flash_level' =>'success'
                ]);
            }
        }


        // vi pham quy che thi

        else if($request->type_file == 'list_vi_pham_quyche_thi') {

            Excel::load($request->fileExcels, function($reader){
                $results = $reader->all();
                foreach ($results as $key=>$value) {
                    //  $tmp = Sinh_Vien::find($value->mssv);
                    //  if($tmp ) {

                    $p_dao_tao = new P_Dao_Tao();
                    $form_diem = Form_Diem::all();
                    $tru_diem = $form_diem[0]->tru_khien_trach_thi;

                    $p_dao_tao::updateOrCreate(
                        [ 'mssv'=> $value->mssv, ],
                        [
                            'point_dao_tao'=> $tru_diem,
                            //     'mssv'=> $value->mssv,
                            'mon_vi_pham' => $value-> mon_vi_pham,
                            'ngay_vp' => $value-> ngay_vp,


                        ]
                    );

                    $id = $value->mssv;
                    $newPoint = Points::where('mssv','=',  $id)->get();
                    if($newPoint) { // nếu tìm thấy mã số sinh viên, thì tìm xem có mã học kỳ không
                        $term = Hoc_Ky::where('term_present','=',  '1')->get();
                        if($term[0]->id_hoc_ky == $newPoint[0]->id_hoc_ky) { // nếu có thì update. đm

                            $Point = new Points();
                            $Point::updateOrCreate(
                                [ 'mssv'=> $value->mssv, ],
                                [
                                    'point_cong_tac_sv'=> $tru_diem,
                                ]
                            );
                        } else { // nếu méo có, đm

                            $Point = new Points();
                            $Point->mssv = $value->mssv;
                            $Point->id_hoc_ky = $term[0]->id_hoc_ky;
                            $Point->point_cong_tac_sv = $tru_diem;
                            $Point->point_total = 70;
                            $Point->save();
                        }
                    }

                }
            });

            $sinhvien = Sinh_Vien::all();
            $user = User::all();
            $diem = Points::all();
            $listClass = [];
            for($i = 0; $i < count($sinhvien); $i++){
                $sinhvien[$i]->point = 0;
                for($j = 0; $j < count($diem)-1 ; $j++) {
                    if($diem[$j]->mssv == $sinhvien[$i]->mssv){
                        $sinhvien[$i]->point = $diem[$j]->point_total;
                    }
                }
                for($k = 0; $k < count($user)-1 ; $k++) {
                    if($sinhvien[$i]->mssv == $user[$k]->mssv){
                        $sinhvien[$i]->id_role = $user[$k]->id_role;
                    }
                }
                if( $sinhvien[$i]->mssv != 0 &&
                    $sinhvien[$i]->mssv != 1 &&
                    $sinhvien[$i]->mssv != 2 &&
                    $sinhvien[$i]->mssv != 3 &&
                    $sinhvien[$i]->mssv != 4 &&
                    $sinhvien[$i]->mssv != 5 &&
                    $sinhvien[$i]->mssv != 6 &&
                    $sinhvien[$i]->mssv != 7
                ){
                    $listClass[$i] = $sinhvien[$i]->class;

                }

            }
            $listClass = array_unique($listClass);

            if($this->isErr) {
                return View('admin.listclass')->with([
                    'list_sinh_vien' =>$sinhvien,
                    'list_diem_ren_luyen' =>$diem,
                    'list_class' =>$listClass,
                    'flash_message'=>'Có Lỗi xảy ra, vui lòng kiểm tra lại',
                    'flash_level' =>'danger'
                ]);
            } else {
                return View('admin.listclass')->with([
                    'list_sinh_vien' =>$sinhvien,
                    'list_diem_ren_luyen' =>$diem,
                    'list_class' =>$listClass,
                    'flash_message'=>'Thêm mới thành công',
                    'flash_level' =>'success'
                ]);
            }
        }

        // danh sach sinh vien nop hoc phi cham

        else if($request->type_file == 'list_ad_class_nop_cham_hoc_phi') {

            Excel::load($request->fileExcels, function($reader){
                $results = $reader->all();
                foreach ($results as $key=>$value) {
                    //  $tmp = Sinh_Vien::find($value->mssv);
                    //  if($tmp ) {

                    $p_cong_tac_sinh_vien = new P_Cong_Tac_SV();
                    $form_diem = Form_Diem::all();
                    $tru_diem = $form_diem[0]->tru_nop_hoc_phi;

                    $p_cong_tac_sinh_vien::updateOrCreate(
                        [ 'mssv'=> $value->mssv, ],
                        [
                            'point_cong_tac_sv'=> $tru_diem,
                            //     'mssv'=> $value->mssv,
                            'note' => $value-> nop_cham,


                        ]
                    );

                    $id = $value->mssv;
                    $newPoint = Points::where('mssv','=',  $id)->get();
                    if($newPoint) { // nếu tìm thấy mã số sinh viên, thì tìm xem có mã học kỳ không
                        $term = Hoc_Ky::where('term_present','=',  '1')->get();
                        if($term[0]->id_hoc_ky == $newPoint[0]->id_hoc_ky) { // nếu có thì update. đm

                            $Point = new Points();
                            $Point::updateOrCreate(
                                [ 'mssv'=> $value->mssv, ],
                                [
                                    'point_cong_tac_sv'=> $tru_diem,
                                ]
                            );
                        } else { // nếu méo có, đm

                            $Point = new Points();
                            $Point->mssv = $value->mssv;
                            $Point->id_hoc_ky = $term[0]->id_hoc_ky;
                            $Point->point_cong_tac_sv = $tru_diem;

                            $Point->save();
                        }
                    }

                }
            });

            $sinhvien = Sinh_Vien::all();
            $user = User::all();
            $diem = Points::all();
            $listClass = [];
            for($i = 0; $i < count($sinhvien); $i++){
                $sinhvien[$i]->point = 0;
                for($j = 0; $j < count($diem)-1 ; $j++) {
                    if($diem[$j]->mssv == $sinhvien[$i]->mssv){
                        $sinhvien[$i]->point = $diem[$j]->point_total;
                    }
                }
                for($k = 0; $k < count($user)-1 ; $k++) {
                    if($sinhvien[$i]->mssv == $user[$k]->mssv){
                        $sinhvien[$i]->id_role = $user[$k]->id_role;
                    }
                }
                if( $sinhvien[$i]->mssv != 0 &&
                    $sinhvien[$i]->mssv != 1 &&
                    $sinhvien[$i]->mssv != 2 &&
                    $sinhvien[$i]->mssv != 3 &&
                    $sinhvien[$i]->mssv != 4 &&
                    $sinhvien[$i]->mssv != 5 &&
                    $sinhvien[$i]->mssv != 6 &&
                    $sinhvien[$i]->mssv != 7
                ){
                    $listClass[$i] = $sinhvien[$i]->class;

                }

            }
            $listClass = array_unique($listClass);

            if($this->isErr) {
                return View('admin.listclass')->with([
                    'list_sinh_vien' =>$sinhvien,
                    'list_diem_ren_luyen' =>$diem,
                    'list_class' =>$listClass,
                    'flash_message'=>'Có Lỗi xảy ra, vui lòng kiểm tra lại',
                    'flash_level' =>'danger'
                ]);
            } else {
                return View('admin.listclass')->with([
                    'list_sinh_vien' =>$sinhvien,
                    'list_diem_ren_luyen' =>$diem,
                    'list_class' =>$listClass,
                    'flash_message'=>'Thêm mới thành công',
                    'flash_level' =>'success'
                ]);
            }
        }

// sinh vien vi pham sh  cap khoa

        else if($request->type_file == 'list_ad_class_vi_pham_khoa') {

            Excel::load($request->fileExcels, function($reader){
                $results = $reader->all();
                foreach ($results as $key=>$value) {
                    $p_khoa = new P_Khoa();
                    $form_diem = Form_Diem::all();
                    $tru_diem = $form_diem[0]->tru_phe_binh;

                    $p_khoa::updateOrCreate(
                        [ 'mssv'=> $value->mssv, ],
                        [
                            'point_khoa'=> $tru_diem,
                            //     'mssv'=> $value->mssv,
                            'vi_pham_sh_khoa' => $value-> vi_pham_sh_khoa,

                        ]
                    );

                    $id = $value->mssv;
                    $newPoint = Points::where('mssv','=',  $id)->get();
                    if($newPoint) { // nếu tìm thấy mã số sinh viên, thì tìm xem có mã học kỳ không
                        $term = Hoc_Ky::where('term_present','=',  '1')->get();
                        if($term[0]->id_hoc_ky == $newPoint[0]->id_hoc_ky) { // nếu có thì update. đm

                            $Point = new Points();
                            $Point::updateOrCreate(
                                [ 'mssv'=> $value->mssv, ],
                                [
                                    'vi_pham_sh_khoa'=> $tru_diem,
                                ]
                            );
                        } else { // nếu méo có, đm

                            $Point = new Points();
                            $Point->mssv = $value->mssv;
                            $Point->id_hoc_ky = $term[0]->id_hoc_ky;
                            $Point->vi_pham_sh_khoa = $tru_diem;
                            $Point->point_total = 70;
                            $Point->save();
                        }
                    }

                }
            });

            $sinhvien = Sinh_Vien::all();
            $user = User::all();
            $diem = Points::all();
            $listClass = [];
            for($i = 0; $i < count($sinhvien); $i++){
                $sinhvien[$i]->point = 0;
                for($j = 0; $j < count($diem)-1 ; $j++) {
                    if($diem[$j]->mssv == $sinhvien[$i]->mssv){
                        $sinhvien[$i]->point = $diem[$j]->point_total;
                    }
                }
                for($k = 0; $k < count($user)-1 ; $k++) {
                    if($sinhvien[$i]->mssv == $user[$k]->mssv){
                        $sinhvien[$i]->id_role = $user[$k]->id_role;
                    }
                }
                if( $sinhvien[$i]->mssv != 0 &&
                    $sinhvien[$i]->mssv != 1 &&
                    $sinhvien[$i]->mssv != 2 &&
                    $sinhvien[$i]->mssv != 3 &&
                    $sinhvien[$i]->mssv != 4 &&
                    $sinhvien[$i]->mssv != 5 &&
                    $sinhvien[$i]->mssv != 6 &&
                    $sinhvien[$i]->mssv != 7
                ){
                    $listClass[$i] = $sinhvien[$i]->class;

                }

            }
            $listClass = array_unique($listClass);

            if($this->isErr) {
                return View('admin.listclass')->with([
                    'list_sinh_vien' =>$sinhvien,
                    'list_diem_ren_luyen' =>$diem,
                    'list_class' =>$listClass,
                    'flash_message'=>'Có Lỗi xảy ra, vui lòng kiểm tra lại',
                    'flash_level' =>'danger'
                ]);
            } else {
                return View('admin.listclass')->with([
                    'list_sinh_vien' =>$sinhvien,
                    'list_diem_ren_luyen' =>$diem,
                    'list_class' =>$listClass,
                    'flash_message'=>'Thêm mới thành công',
                    'flash_level' =>'success'
                ]);
            }
        }

        // danh sach can bo lop
        else if($request->type_file == 'danh_sach_sh_lop') {

            Excel::load($request->fileExcels, function($reader){
                $results = $reader->all();


                foreach ($results as $key=>$value) {


                    $covan = new Co_Van_Hoc_Tap();
                    $form_diem = Form_Diem::all();
                    $tru_diem = $form_diem[0]->tru_khong_tham_gia;

                    $covan::updateOrCreate(
                        [ 'mssv'=> $value->mssv, ],
                        [
                            'point_co_van_hoc_tap'=> $tru_diem,
                        ]
                    );
                   /*
                    * lay ra ma sinh vien va id hoc ky.
                    * neu ton tai mssv va id hoc ky thi update.
                    *
                    * neu ton tai mssv nhung khong ton tai id hoc ky hoac khong ton tai ca 2 thi create thi create
                    */

                    $id = $value->mssv;
                    $newPoint = Points::where('mssv','=',  $id)->get();
                    if($newPoint) { // nếu tìm thấy mã số sinh viên, thì tìm xem có mã học kỳ không
                        $term = Hoc_Ky::where('term_present','=',  '1')->get();

                        if($term[0]->id_hoc_ky == $newPoint[0]->id_hoc_ky) { // nếu có thì update. đm

                            $Point = new Points();
                            $Point::updateOrCreate(
                                [ 'mssv'=> $value->mssv, ],
                                [
                                    'point_co_van_hoc_tap'=> $tru_diem,
                                ]
                            );
                        } else { // nếu méo có, đm

                            $Point = new Points();
                            $Point->mssv = $value->mssv;
                            $Point->id_hoc_ky = $term[0]->id_hoc_ky;
                            $Point->point_co_van_hoc_tap = $tru_diem;
                            $Point->point_total = 70;
                            $Point->save();
                        }
                    }
                }
            });

            $sinhvien = Sinh_Vien::all();
            $user = User::all();
            $diem = Points::all();
            $listClass = [];
            for($i = 0; $i < count($sinhvien); $i++){
                $sinhvien[$i]->point = 0;
                for($j = 0; $j < count($diem)-1 ; $j++) {
                    if($diem[$j]->mssv == $sinhvien[$i]->mssv){
                        $sinhvien[$i]->point = $diem[$j]->point_total;
                    }
                }
                for($k = 0; $k < count($user)-1 ; $k++) {
                    if($sinhvien[$i]->mssv == $user[$k]->mssv){
                        $sinhvien[$i]->id_role = $user[$k]->id_role;
                    }
                }
                if( $sinhvien[$i]->mssv != 0 &&
                    $sinhvien[$i]->mssv != 1 &&
                    $sinhvien[$i]->mssv != 2 &&
                    $sinhvien[$i]->mssv != 3 &&
                    $sinhvien[$i]->mssv != 4 &&
                    $sinhvien[$i]->mssv != 5 &&
                    $sinhvien[$i]->mssv != 6 &&
                    $sinhvien[$i]->mssv != 7
                ){
                    $listClass[$i] = $sinhvien[$i]->class;

                }

            }
            $listClass = array_unique($listClass);

            if($this->isErr) {
                return View('admin.listclass')->with([
                    'list_sinh_vien' =>$sinhvien,
                    'list_diem_ren_luyen' =>$diem,
                    'list_class' =>$listClass,
                    'flash_message'=>'Có Lỗi xảy ra, vui lòng kiểm tra lại',
                    'flash_level' =>'danger'
                ]);
            } else {
                return View('admin.listclass')->with([
                    'list_sinh_vien' =>$sinhvien,
                    'list_diem_ren_luyen' =>$diem,
                    'list_class' =>$listClass,
                    'flash_message'=>'Thêm mới thành công',
                    'flash_level' =>'success'
                ]);
            }
        }

//        $sinhvien = Sinh_Vien::all();
//        $diem = Points::all();
//        $listClass = [];
//        for($i = 0; $i < count($sinhvien); $i++){
//            $sinhvien[$i]->point = 0;
//            for($j = 0; $j < count($diem)-1 ; $j++) {
//                if($diem[$j]->mssv == $sinhvien[$i]->mssv){
//                    $sinhvien[$i]->point = $diem[$j]->point_total;
//                }
//            }
//
//            if( $sinhvien[$i]->mssv != 0 &&
//                $sinhvien[$i]->mssv != 1 &&
//                $sinhvien[$i]->mssv != 2 &&
//                $sinhvien[$i]->mssv != 3 &&
//                $sinhvien[$i]->mssv != 4 &&
//                $sinhvien[$i]->mssv != 5 &&
//                $sinhvien[$i]->mssv != 6 &&
//                $sinhvien[$i]->mssv != 7
//            ){
//                $listClass[$i] = $sinhvien[$i]->class;
//
//            }
//
//        }
//        $listClass = array_unique($listClass);
//
//        if($this->isErr) {
//            return View('admin.listclass')->with([
//                'list_sinh_vien' =>$sinhvien,
//                'list_diem_ren_luyen' =>$diem,
//                'list_class' =>$listClass,
//                'flash_message'=>'Có Lỗi xảy ra, vui lòng kiểm tra lại',
//                'flash_level' =>'danger'
//            ]);
//        } else {
//            return View('admin.listclass')->with([
//                'list_sinh_vien' =>$sinhvien,
//                'list_diem_ren_luyen' =>$diem,
//                'list_class' =>$listClass,
//                'flash_message'=>'Thêm mới thành công',
//                'flash_level' =>'success'
//            ]);
//        }

    }


    public function listclass() {
        $sinhvien = Sinh_Vien::all();
        $user = User::all();
        $diem = Points::all();
        $listClass = [];
        for($i = 0; $i < count($sinhvien); $i++){
            $sinhvien[$i]->point = 0;
            for($j = 0; $j < count($diem)-1 ; $j++) {
                if($diem[$j]->mssv == $sinhvien[$i]->mssv){
                    $sinhvien[$i]->point = $diem[$j]->point_total;
                }
            }
            for($k = 0; $k < count($user)-1 ; $k++) {
                if($sinhvien[$i]->mssv == $user[$k]->mssv){
                    $sinhvien[$i]->id_role = $user[$k]->id_role;
                }
            }
            if( $sinhvien[$i]->mssv != 0 &&
                $sinhvien[$i]->mssv != 1 &&
                $sinhvien[$i]->mssv != 2 &&
                $sinhvien[$i]->mssv != 3 &&
                $sinhvien[$i]->mssv != 4 &&
                $sinhvien[$i]->mssv != 5 &&
                $sinhvien[$i]->mssv != 6 &&
                $sinhvien[$i]->mssv != 7
            ){
                $listClass[$i] = $sinhvien[$i]->class;

            }

        }
        $listClass = array_unique($listClass);
        return View('admin.listclass')->with([
            'list_sinh_vien' =>$sinhvien,
            'list_diem_ren_luyen' =>$diem,
            'list_class' =>$listClass,

        ]);
    }

    public function list_sinh_vien() {
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

        return View('admin.done_import')->with([
            'list_sinh_vien' =>$sinhvien,
            'list_diem_ren_luyen' =>$diem,
            'list_class' =>$listClass
        ]);
    }


    // danh sach doan vien

    public function listDoanVien() {
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

        return View('admin.doanVien.listDoanVien')->with([
            'list_sinh_vien' =>$sinhvien,
            'list_diem_ren_luyen' =>$diem,
            'list_class' =>$listClass
        ]);
    }

    // demo new
    public function demo() {
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

        return View('admin.doanvien')->with([
            'list_sinh_vien' =>$sinhvien,
            'list_diem_ren_luyen' =>$diem,
            'list_class' =>$listClass
        ]);
    }

    // co van hoc tap

    public function listCoVanHocTap() {
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

        return View('admin.coVanHocTap.listCoVanHocTap')->with([
            'list_sinh_vien' =>$sinhvien,
            'list_diem_ren_luyen' =>$diem,
            'list_class' =>$listClass
        ]);
    }

    public function khenThuong() {
        $sinhvien = Sinh_Vien::all();
        $diem = Points::all();
        $listClass = [];
        for($i = 0; $i < count($sinhvien); $i++){
//            $sinhvien[$i]->point = 0;
//            for($j = 0; $j < count($diem)-1 ; $j++) {
//                if($diem[$j]->mssv == $sinhvien[$i]->mssv){
//                    $sinhvien[$i]->point = $diem[$j]->point_total;
//                }
//            }
            $listClass[$i] = $sinhvien[$i]->class;
        }
        $listClass = array_unique($listClass);

        return View('admin.khenThuong.khen_thuong')->with([
            'list_sinh_vien' =>$sinhvien,
            'list_diem_ren_luyen' =>$diem,
            'list_class' =>$listClass
        ]);
    }


    public function phanhoi(){
        return view('admin.phanHoi.phan_hoi');
    }

    public function listofclass ($class) {
        $sinhvien = Sinh_Vien::all();
        $diem = Points::all();
        $listClass = [];
        $listSinhVienLop = [];

        if($class == 'tatca') {
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

            return [
                'list_sinh_vien' =>$sinhvien,
                'list_diem_ren_luyen' =>$diem,
                'list_class' =>$listClass
            ];
        }
        else {
            for($i = 0; $i < count($sinhvien); $i++){
                if($sinhvien[$i]->class == $class){
                    $listSinhVienLop[$i] = $sinhvien[$i];
                    $listSinhVienLop[$i]->point = 0;
                    for($j = 0; $j < count($diem)-1 ; $j++) {
                        if($diem[$j]->mssv == $listSinhVienLop[$i]->mssv){
                            $listSinhVienLop[$i]->point = $diem[$j]->point_total;
                        }
                    }
                    $listClass[$i] = $sinhvien[$i]->class;
                }

            }
            $listSinhVienLop = array_unique($listSinhVienLop);
            return [
                'list_sinh_vien' =>$listSinhVienLop,
                'list_diem_ren_luyen' =>$diem,
                'list_class' =>$listClass
            ];
        }

    }
    public  function newterm () {
        $term = Hoc_Ky::all();

        return View('admin.themhocky')->with([
            'listTerm' =>$term,
        ]);

       // return View('admin.themhocky');
    }
    public function postnewterm (Request $request)
    {
        $namhoc = $request->ten_hoc_ky;
        $tmp = str_replace(' ', '', $namhoc);
        $hoc_ky = '';
        $name = '';
        switch ($request->hoc_ky) {
            case '10' :
                $name = "Học kỳ 1" . $request->ten_hoc_ky;
                $hoc_ky = "10" . str_replace(' ', '', $namhoc);
                break;

            case '11' :
                $name = 'Học kỳ 1 phụ ' . $request->ten_hoc_ky;
                $hoc_ky = '11' . str_replace(' ', '', $namhoc);
                break;

            case '20' :
                $name = 'Học kỳ 2 ' . $request->ten_hoc_ky;
                $hoc_ky = '20' . str_replace(' ', '', $namhoc);
                break;

            case '21' :
                $name = 'Học kỳ 2 phụ ' . $request->ten_hoc_ky;
                $hoc_ky = '21' . str_replace(' ', '', $namhoc);
                break;

            case '31' :
                $name = 'Học kỳ hè ' . $request->ten_hoc_ky;
                $hoc_ky = '31' . str_replace(' ', '', $namhoc);
                break;
        }
        $note = $name;
        $new_hoc_ky = new Hoc_Ky();
        $new_form_diem = new Form_Diem();

        $present_term = Hoc_Ky::where('term_present', '=', '1')->get();

        $form_diem = Form_Diem::where('ma_hk', '=', $present_term[0]->id_hoc_ky)->get();

        $new_form_diem->ma_hk = $hoc_ky;
        if ($form_diem) {
            $new_form_diem->tong_hoc_tap = $form_diem[0]->tong_hoc_tap;
            $new_form_diem->tru_hoc_luc_yeu = $form_diem[0]->tru_hoc_luc_yeu;
            $new_form_diem->tru_canh_bao_hoc_vu = $form_diem[0]->tru_canh_bao_hoc_vu;
            $new_form_diem->tru_khong_du_tin_chi = $form_diem[0]->tru_khong_du_tin_chi;
            $new_form_diem->tru_ngien_cuu_kh = $form_diem[0]->tru_ngien_cuu_kh;
            $new_form_diem->tru_khong_thi = $form_diem[0]->tru_khong_thi;

            $new_form_diem->tru_khien_trach_thi = $form_diem[0]->tru_khien_trach_thi;
            $new_form_diem->tru_canh_cao_thi = $form_diem[0]->tru_canh_cao_thi;
            $new_form_diem->tru_dinh_chi_thi = $form_diem[0]->tru_dinh_chi_thi;

            // 2. ý thức và kết quả chấp hành nội quy,quy chế trong nhà trường
            $new_form_diem->tong_chap_hanh = $form_diem[0]->tong_chap_hanh;
            $new_form_diem->tru_nop_hoc_phi = $form_diem[0]->tru_nop_hoc_phi;
            $new_form_diem->tru_dang_ky_hoc_qua_han = $form_diem[0]->tru_dang_ky_hoc_qua_han;
            $new_form_diem->tru_khong_di_trieu_tap = $form_diem[0]->tru_khong_di_trieu_tap;
            $new_form_diem->tru_tra_qua_han_ho_so = $form_diem[0]->tru_tra_qua_han_ho_so;
            $new_form_diem->tru_khong_tham_gia_bao_hiem = $form_diem[0]->tru_khong_tham_gia_bao_hiem;
            $new_form_diem->tru_vi_pham_cu_tru = $form_diem[0]->tru_vi_pham_cu_tru;

            $new_form_diem->tru_phe_binh = $form_diem[0]->tru_phe_binh;
            $new_form_diem->tru_khien_trach = $form_diem[0]->tru_khien_trach;
            $new_form_diem->tru_canh_cao = $form_diem[0]->tru_canh_cao;

            //         3. ý thức và kết quả tham gia hoạt động chínht trị xã hội văn hoá, văn nghệ...
            $new_form_diem->tong_tham_gia = $form_diem[0]->tong_tham_gia;
            $new_form_diem->cong_tham_gia_truong = $form_diem[0]->cong_tham_gia_truong;
            $new_form_diem->cong_tham_gia_ngoai = $form_diem[0]->cong_tham_gia_ngoai;
            $new_form_diem->tru_khong_tham_gia = $form_diem[0]->tru_khong_tham_gia;

            // 4. phẩm chất công dân và quan hệ cộng đồng
            $new_form_diem->tong_pham_chat = $form_diem[0]->tong_pham_chat;
            $new_form_diem->tru_khong_chap_hanh = $form_diem[0]->tru_khong_chap_hanh;
            $new_form_diem->tru_khong_tinh_than = $form_diem[0]->tru_khong_tinh_than;

            //5.  ý thức và kết quả tham gia công tác phụ trách lớp, đoàn thể...
            $new_form_diem->tong_cong_tac = $form_diem[0]->tong_cong_tac;
            $new_form_diem->cong_giu_chuc_vu = $form_diem[0]->cong_giu_chuc_vu;
            $new_form_diem->cong_hoc_luc = $form_diem[0]->cong_hoc_luc;
            $new_form_diem->cong_tham_gia_thi_chuyen_mon = $form_diem[0]->cong_tham_gia_thi_chuyen_mon;
            $new_form_diem->cong_nckh = $form_diem[0]->cong_nckh;
            $new_form_diem->cong_dat_giai = $form_diem[0]->cong_dat_giai;
            $new_form_diem->cong_ket_nap_dang = $form_diem[0]->cong_ket_nap_dang;

            $new_form_diem->save();
        }
        $new_hoc_ky::updateOrCreate(
            [ 'id_hoc_ky'=> $hoc_ky ],
            [
                'note' => $note,
                'is_caculator'=>0
            ]
        );

        return  redirect()->route('newterm');
    }
    public function change_present_term (Request $request, $id){
        $id_term = $id;
        if(Auth::user()->username == 'admin1' || Auth::user()->username == 'phongctsv' ){
            $remove_Present_term = Hoc_Ky::where('term_present','=',  '1')->get();
            foreach ($remove_Present_term as $item){

                $itemChange = Hoc_Ky::find($item->id_hoc_ky);
                $itemChange->term_present = 0;
                $itemChange->save();
            }
            $changeTerm = Hoc_Ky::find($id);
            $changeTerm->term_present = 1;
            $changeTerm->save();
            return $remove_Present_term;
        }

    }
    public function delete_term (Request $request, $id) {
        if(Auth::user()->username == 'admin1' || Auth::user()->username == 'phongctsv' ){
            $id_delete = Hoc_Ky::find($id);
            $id_delete->delete();
            return $id_delete;
        }
    }
    public function feedback_students () {
        $feedback = Feedback::all();
        return View('admin.feedback_students')->with([
            'datas'=>$feedback
        ]);
    }

}
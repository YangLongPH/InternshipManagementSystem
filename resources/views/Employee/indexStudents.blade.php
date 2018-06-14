@extends('layouts.origin')
@section('title','Home')

@section('navHome')
                    <li class="nav-active active">
                        <a href="{{URL::to('home')}}">
                            <i class="glyphicon glyphicon-home fa-2x"></i>
                            <span style="font-size: 200%">Trang Chủ</span>
                        </a>
                    </li>
@endsection



@section('content')
    <h1 class="text-center">Điểm rèn luyện của {{$sinhvien->fullname}}</h1>
    <form>
        {{csrf_field()}}
        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
        <table class="table table-bordered">
            <tr>
                <th class="col-md-9"> Nội dung đánh giá </th>
                <th class="col-md-1"> Điểm cộng/trừ </th>
            </tr>
            <tr>
                <td  class="col-md-9"> <strong> 1. Ý thức học tập </strong> </td>
                <td  class="col-md-1"></td>
            </tr>
            <tr>
                <td> 1.1 Điểm chuẩn </td>
                <td class="td_hoc_tap">
                     {{$data[0]->tong_hoc_tap}}
                </td>
                
            </tr>
            <tr>
                <td> 1.2 Trừ điểm </td>
                <td > </td>
            </tr>
            <tr>
                <td >- Học lực yếu</td>
                <td class="tru_hoc_luc_yeu">{{$data[0]->tru_hoc_luc_yeu}} </td>
            </tr>
            <tr>
                <td> - Bị cảnh báo học vụ </td>
                <td class="tru_canh_bao_hoc_vu">{{$data[0]->tru_canh_bao_hoc_vu}} </td>
            </tr>
            <tr>
                <td> - Đăng ký không đủ số tín chỉ theo Quy định </td>
                <td class="tru_khong_du_tin_chi">{{$data[0]->tru_khong_du_tin_chi}} </td>
            </tr>
            <tr>
                <td>- Không tham gia NCKH theo Quy định (đối với sinh viên NVCL)</td>
                <td class="tru_ngien_cuu_kh">{{$data[0]->tru_ngien_cuu_kh}} </td>
            </tr>
            <tr>
                <td>- Bị cấm thi hoặc bỏ thi cuối kỳ không có lý do (……lần x 2đ/lần)</td>
                <td class="tru_khong_thi">{{$data[0]->tru_khong_thi}} </td>
            </tr>
            <tr>
                <td ><strong > Cộng  </strong></td>
                <td > </td>
            </tr>
            <tr>
                <td>- Kỷ luật thi ( Đình chỉ,  Cảnh cáo,  Khiển trách)</td>
                <td > </td>
            </tr>
            <tr>
                <td><strong>Điểm kết luận của 1. [0, 30]</strong></td>
                <td > </td>
            </tr>
            <tr>
                <td><strong>2. Ý thức và kết quả chấp hành nội quy, quy chế trong nhà trường</strong></td>
                <td > </td>
            </tr>
            <tr>
                <td>- 2.1 Điểm chuẩn  </td>
                <td class="tong_chap_hanh"> {{$data[0]->tong_chap_hanh}}</td>
            </tr>
            <tr>
                <td>2.2. Trừ điểm</td>
                <td > </td>
            </tr>
            <tr>
                <td>- Nộp hoặc nhận không đúng một khoản kinh phí (…… lần x 5đ/lần)  </td>
                <td class="tru_nop_hoc_phi"> {{$data[0]->tru_nop_hoc_phi}}</td>
            </tr>
            <tr>
                <td>- Đăng ký học quá hạn (nếu được chấp nhận -2đ)</td>
                <td class="tru_dang_ky_hoc_qua_han">{{$data[0]->tru_dang_ky_hoc_qua_han}} </td>
            </tr>
            <tr>
                <td>- Không thực hiện theo Giấy triệu tập (…… lần x 5đ/lần)</td>
                <td class="tru_khong_di_trieu_tap">{{$data[0]->tru_khong_di_trieu_tap}} </td>
            </tr>
            <tr>
                <td>- Trả quá hạn giấy tờ/hồ sơ đã được phép mượn (…… lần x 5đ/lần)</td>
                <td class="tru_tra_qua_han_ho_so">{{$data[0]->tru_tra_qua_han_ho_so}} </td>
            </tr>
            <tr>
                <td>- Không tham gia Bảo hiểm Y tế </td>
                <td class="tru_khong_tham_gia_bao_hiem">{{$data[0]->tru_khong_tham_gia_bao_hiem}} </td>
            </tr>
            <tr>
                <td>- Vi phạm quy định nơi cư trú (…… lần x 10đ/lần)</td>
                <td class="tru_vi_pham_cu_tru">{{$data[0]->tru_vi_pham_cu_tru}} </td>
            </tr>
            <tr>
                <td><strong>Cộng</strong></td>
                <td > </td>
            </tr>
            <tr>
                <td>Có quyết định kỷ luật ( Cảnh cáo, Khiển trách,  Phê bình)</td>
                <td > </td>
            </tr>
            <tr>
                <td><strong>Điểm kết luận của 2. [0, 25]</strong></td>
                <td > </td>
            </tr>
            <tr>
                <td><strong>3. Ý thức và kết quả tham gia hoạt động chính trị - xã hội, văn hoá, văn nghệ, thể thao, phòng chống các tệ nạn xã hội</strong></td>
                <td > </td>
            </tr>
            <tr>
                <td>3.1. Điểm chuẩn</td>
                <td class="tong_tham_gia">{{$data[0]->tong_tham_gia}}</td>
            </tr>
            <tr>
                <td>3.2. Cộng điểm</td>
                <td > </td>
            </tr>
            <tr>
                <td>- Tham gia đầy đủ các hoạt động của chi đoàn và tham gia đầy đủ các buổi sinh hoạt chính trị theo triệu tập (nếu có) của Nhà trường: +10đ</td>
                <td class="cong_tham_gia_truong">{{$data[0]->cong_tham_gia_truong}} </td>
            </tr>

            <tr>
                <td>- Tham gia (có giấy xác nhận) các hoạt động văn nghệ, thể thao, câu lạc bộ, hoạt động tình nguyện….(…… lần x 2đ/lần)</td>
                <td class="cong_tham_gia_ngoai"> {{$data[0]->cong_tham_gia_ngoai}} </td>
            </tr>
            <tr>
                <td>3.3. Trừ điểm</td>
                <td > </td>
            </tr>
            <tr>
                <td>- Không tham gia Sinh hoạt chính trị theo Quy định (…..buổi x2đ/buổi)</td>
                <td class="tru_khong_tham_gia">{{$data[0]->tru_khong_tham_gia}} </td>
            </tr>
            <tr>
                <td><strong>Điểm kết luận của 3. [0, 20]</strong></td>
                <td > </td>
            </tr>
            <tr>
                <td> <strong>4. Về phẩm chất công dân và quan hệ với cộng đồng</strong></td>
                <td > </td>
            </tr>
            <tr>
                <td>4.1. Điểm chuẩn</td>
                <td class="tong_pham_chat"> {{$data[0]->tong_pham_chat}} </td>
            </tr>
            <tr>
                <td>4.2. Trừ điểm</td>
                <td > </td>
            </tr>
            <tr>
                <td>- Có Thông báo bằng văn bản về việc không chấp hành các chủ trương của Đảng, chính sách pháp luật của Nhà nước, vi phạm an ninh chính trị, trật tự an toàn xã hội, an toàn giao thông, (…… lần x 5đ/lần)</td>
                <td class="tru_khong_chap_hanh">{{$data[0]->tru_khong_chap_hanh}} </td>
            </tr>
            <tr>
                <td>- Không có tinh thần giúp đỡ bạn bè, không thể hiện tinh thần đoàn kết tập thể (…… lần x 5đ/lần)</td>
                <td class="tru_khong_tinh_than">{{$data[0]->tru_khong_tinh_than}} </td>
            </tr>
            <tr>
                <td><strong>Điểm kết luận của 4. [0, 15]</strong></td>
                <td > </td>
            </tr>
            <tr>
                <td> <strong>5. Ý thức và kết quả tham gia công tác phụ trách lớp, các đoàn thể, tổ chức trong nhà trường hoặc đạt được thành tích đặc biệt trong học tập, rèn luyện của học sinh, sinh viên</strong></td>
                <td > </td>
            </tr>
            <tr>
                <td>5.1. Điểm chuẩn</td>
                <td class="tong_cong_tac">{{$data[0]->tong_cong_tac}} </td>
            </tr>
            <tr>
                <td>5.2. Cộng điểm</td>
                <td > </td>
            </tr>
            <tr>
                <td>- Giữ các chức vụ trong các tổ chức chính quyền, đoàn thể và được đánh giá hoàn thành tốt nhiệm vụ: +10đ</td>
                <td class="cong_giu_chuc_vu"> {{$data[0]->cong_giu_chuc_vu}}</td>
            </tr>
            <tr>
                <td>- Đạt thành tích cao trong học tập và NCKH</td>
                <td > </td>
            </tr>
            <tr>
                <td>+ Học lực (Xuất sắc, Giỏi): +10đ</td>
                <td class="cong_hoc_luc">{{$data[0]->cong_hoc_luc}} </td>
            </tr>
            <tr>
                <td>+ Tham gia các cuộc thi chuyên môn như Procon, Olympic, An toàn thông tin…: +5đ/lần</td>
                <td class="cong_tham_gia_thi_chuyen_mon">{{$data[0]->cong_tham_gia_thi_chuyen_mon}} </td>
            </tr>
            <tr>
                <td>+ Tham gia NCKH (không phải là SV NVCL): +5đ, </td>
                <td class="cong_nckh">{{$data[0]->cong_nckh}} </td>
            </tr>
            <tr>
                <td>    + Đạt giải NCKH các cấp hoặc có báo cáo tại Hội nghị NCKH/bài báo đăng trên các tạp chí trong và ngoài nước: +5đ.</td>
                <td class="cong_dat_giai">{{$data[0]->cong_dat_giai}} </td>
            </tr>
            <tr>
                <td>- Được kết nạp Đảng: +10đ</td>
                <td class="cong_ket_nap_dang"> {{$data[0]->cong_ket_nap_dang}}</td>
            </tr>
            <tr>
                <td><strong>Điểm kết luận của 5. [0, 10]</strong></td>
                <td > </td>
            </tr>
            <tr>
                <td><strong>Tổng cộng (1.+2.+3.+4.+5.) [0, 100]</strong></td>
                <td > </td>
            </tr>

            <tr>
                <td>Xếp loại</td>
                <td > </td>
            </tr>
        </table>
    </form>
@endsection
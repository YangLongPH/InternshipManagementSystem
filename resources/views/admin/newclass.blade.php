@extends('layouts.admin')
@section('title',' List Admin')
@section('content')
    <style>
        .main-content {
            top: -15px;
            position: relative;
        }
        .newClass {
            margin-top : 50px;
        }
        .form-newclass{
            position: absolute;
            margin: 0px auto;
            margin-top: 30px;
        }
        .form_ {

            margin-top: 50px;
        }
        .select_type {
            width : 400px;
            margin-bottom: 50px;
        }
        p, h1 {
            color : #2196F3;
        }
        #getEx {
            width: 300px;

        }
    </style>
    <div class="newClass">
        <form action="postnewclass" method="post" enctype="multipart/form-data" class="form-newclass col-md-12">
            {{csrf_field()}}
            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
            <h1 class="text-center"> Thêm mới danh sách </h1>
            <div class="form_">
                <div class="col-md-3">
                    <p>Chọn loại danh sách tải lên</p>
                </div>
                <select name="type_file" class="form-control select_type col-md-5">

                    @if(Auth::user()->username == 'admin1'|| Auth::user()->username == 'phongctsv'))
                    <option selected value="list_class" > Danh sách lớp</option>

                    <option value="list_ad_class"> Danh sách cán bộ lớp</option>
                    <option value="list_ad_vi_pham_ytcn"> Danh Sách Sinh viên vi phạm ý thức công dân </option>
                    <option value="list_ad_class_khen_thuong"> Khen Thưởng </option>
                    <option value="list_ad_class_nop_cham_hoc_phi"> Danh sách Nộp Chậm Học Phí </option>
                    @endif

                    @if(Auth::user()->username == 'vanphongdoan'))


                    <option value="list_ad_class_tham_gia_hoatdong"> SV tham gia cac hd </option>
                    <option value="list_ad_khen_thuong_doan"> SV khen thuong doan </option>
                    <option value="list_ad_dang_vien"> Danh Sach Dang Vien </option>
                    <option value="list_ad_vi_pham_doan"> Vi Pham SV Doan </option>

                    @endif
                    @if(Auth::user()->username == 'vanphongkhoa'))


                    <option value="list_ad_class_vi_pham_khoa"> SV Vi Phạm cấp khoa </option>

                    @endif

                    @if(Auth::user()->username == 'phongkhcn'))

                    <option value="list_nghien_cuu_khoa_hoc"> Nghiên Cứu Khoa Học </option>

                    @endif


                    @if(Auth::user()->username == 'phongdaotao'))
                    <option value="list_ad_class_bang_diem"> Kết Quả Học Tập </option>
                    <option value="list_vi_pham_quyche_thi"> Vi Phạm Quy Chế Thi </option>
                    <option value="list_ad_canh_bao_hv"> Cảnh Báo Học Vụ </option>
                    @endif
                    @if(Auth::user()->id_role == 4))
                    <option value="danh_sach_sh_lop"> SV Không tham gia sinh hoạt lớp </option>
                    @endif



                </select>
                <div class="form-group col-md-12">
                    <label for="getEx">Thêm danh sách sinh viên Excel</label>
                    <input type="file" name="fileExcels" id="getEx" class="form-control import"></br>
                    <button type="submit" class="btn btn-primary">Thêm</button>
                </div>
            </div>
        </form>


    </div>

@stop
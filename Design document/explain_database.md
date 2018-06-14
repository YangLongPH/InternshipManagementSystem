**Database student**

#table:users //lưu trữ thông tin tài khoản đăng nhập
  -username: tên đăng nhập
  -password: mật khẩu đăng nhập
  -id_role: phân loại tài khoản
  -mssv: mã số sinh viên
#table:sinh_vien //lưu trữ thông tin cá nhân sinh viên
  -mssv: mã số sinh viên
  -fullname: tên đầy đủ
  -class: lớp học
  -office: công việc
  -email: thư điện tử
  -birthday: sinh nhật
#table:points //lưu trữ điểm của từng sinh viên
  -id_point:mã số điểm, mỗi sinh viên có thể có nhiều điểm trong nhiều học kỳ nên cần point_id
  -mssv: mã số sinh viên
  -id_hk:mã số học kỳ
  -point_total: tổng điểm
  //dưới đây là các điểm thành phần
  -point_khoa_hoc_cn
  -point_cong_tac_sv
  -point_dao_tao
  -point_doan
  -point_khoa
  -point_co_van_hoc_tap
#table:hoc_ky //lưu trữ thông tin các học kỳ
  -id_hk:mã số học kỳ
  -note:chú thích
#table:roles //lưu trữ các loại tài khoản đăng nhập khác nhau
  -id_role: mã số loại tài khoản
  -note: chú thích
#table:p_khoa_hoc_cn //văn phòng khoa học công nghệ
  -id_...
  -point_...
  -mssv
  -note
#table:p_cong_tac_sv //văn phòng công tác sinh viên
  -như trên
#table:p_dao_tao //văn phòng đào tạo
  -như trên
#table:p_doan //văn phòng đoàn
  -như trên
#table:p_khoa //văn phòng khoa
  -như trên
#table:co_van_hoc_tap // cố vấn học tập
  -như trên

*git*
  -git clean --force :xoa het nhung file moi tao
  -git checkout -- <file>:khoi phuc file da chon ve trang thai luc dau
  -git checkout -- . :khoi phuc tat ca file
  -xoa bo hoan toan thay doi lay ban moi nhat tu ma nguon server:
    git fetch origin
    git reset --hard origin/master

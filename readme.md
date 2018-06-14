# Students manager



**Students manager** là một ứng dụng web phất triển trên  framework  ```laravel 5.4```. đây là một ứng dụng giúp cho việc chấm điểm rèn luyện của sinh viên đơn giản và hiệu quả hơn.

## thông tin

- môn:  ```Dự Án```   
  
- giảng viên hướng dẫn: ``` PGS. TS. Phạm Ngọc Hùng```   
- trường: ```ĐH Công Nghệ - ĐHQGHN```
- học kỳ: ```Kỳ 2 năm học 2016 - 2017```

## Nhóm phát triển

danh sách thành viên :

| stt   |    thành viên     | lớp     | vai trò   | ghi chú       |
|:-----:|:----------------: |-------- |---------  |-------------  |
| 1     | Nguyễn Như Vương  | K58-CC  | DEV       |-------------  |
| 2     | Lô Thanh Tùng     | K58-CC  | DEV       |-------------  |
| 2     | Đặng Danh Phương  | K58-CC  | DEV       |-------------  |
| 2     | Nguyễn Thanh Tùng | K58-CC  | DEV       |-------------  |

## các chức năng

   
## mô tả hệ thống

hệ thống xây dựng trên mô hình MVC , dựa theo kiến trúc của framework ```laravel 5.4```. ngoài ra còn sử dụng một số middleware như validate, authenticate để thực hiện các yêu cầu tiền  xứ lý và xác thực người dùng.

## Yêu cầu phi chức năng

#### 1. giao diện

- sử dụng bootstrap và jquery.
-  giao diện sáng, thân thiện.

#### 2. Bảo mật

- mật khẩu người dùng được mã hóa
- các tác vụ yêu cầu xác thực, được các  thực  phiên đăng nhập trước khi  thực hiện 

#### 3. data validate

- tất cả data gửi lên đều phải qua  modul validate  để kiểm tra 

#### 5. REST API

- bên cạnh nhưng api trả về view thông thường hệ thống được thiết kế thêm một số chức năng theo cơ chế ***REST*** để tăng hiệu năng và trải nghiêm người dùng. mọi api trả về json đểu thiết kết để trả về cùng một cấu trúc kết qủa gồm ```status```: tráng thái kết qủa, ```message```: thông báo kèm theo và ```data```: nội dung kết qủa.

#### 4. xứ lý ngoại lệ 

- hệ thống thêm chức năng trả về thông báo lỗi dưới dạng json text.

##  Hướng Dẫn:
#### 1. cài đặt
 - clone repo về thư mục gốc của apache (có thể là www hoặc htdocs) bằng lệnh:  
 ```
git clone https://github.com/minhvuonguet/studentsManager.git
```

- để tải các dependencies chạy lệnh: 
    - trên linux và macos:
    ```sudo composer install```
    - trên windows:
    ```composer install```

- trên linux và macos bạn phải cấp quền ghi cho các thư mục:    
```Storage```, ```resources``` , ```public/uploads/profile_img```, ```public/uploads/admin_img``` ,và ```bootstrap```

- tạo cơ sở dữ liệu (csld) mới tên là "students".

- chỉnh sửa lại cấu hình trong file "config/database.php":
  + 'host' => env('DB_HOST', '127.0.0.1'),   
  + 'port': cổng mysql   
  + 'database': tên csld vừa tạo (students). 
  + 'username': username của bạn trên CSDL (default là root) 
  + 'password': password của bạn trên CSDL (default là '' )  

- khởi tại csql bằng lệnh: ```php artisan migrate```
- tại dữ liệu mẫu bằng lệnh: ```php artisan db:seed```

- trên trình duyệt gõ đường dẫn: ```localhost/Employee-Director```

- Update csdl bằng cách:

vào phpmyadmin ->

server:127.0.0.1 ->

sql ->

```DROP DATABASE students;```

```CREATE DATABASE students;```

```-> GO```

```php artisan migrate```

```php artisan db:seed```

  
#### 2. đăng nhập 
tài khoản admin mặc định: ***admin1***  
mát khẩu admin mặc định: ***admin1*** 

demo tài khoản phòng CTSV: *** phongctsv***
mật khẩu: ***phongctsv***

demo tài khoản văn phòng khoa: *** vanphongkhoa***
mật khẩu: ***vanphongkhoa***

demo tài khoản phòng CTSV: *** vanphongdoan***
mật khẩu: ***vanphongdoan***

demo tài khoản Sinh Viên: *** students1 ***
mật khẩu: ***students1***

## licence

đây vẫn là một sản phẩm đang trong qúa trình phát triển, một số chức năng vẫn còn thiếu sót, với mục đích phi lợi nhuận và phi thương mại mọi cá nhân tổ chức đều có toàn quền sử dụng mã nguồn này cho mục đích học tập và nghên cứu.

chúng tôi không chịu trách nhiệm cho bất cứ thiệt hại nào liên quan đến sản phầm này cho mọi mục đích ngoài học tập nghiên cứu.

## liên hệ

mọi thắc mắc, góp ý xin gửi về theo địa chỉ minhvuonguet@gmail.com  
hoặc đặt câu hỏi trong phần github issues.

chúng tôi rất sẵn lòng giải đáp.


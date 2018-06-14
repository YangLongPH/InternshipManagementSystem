<?php

use Illuminate\Database\Seeder;
use App\Models\Lecturer;
class LecturersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Lecturer::create([
            'fullname'=>'Le Dinh Thanh',
            'office'=>'Giảng viên',
            'address'=>'Dai hoc cong nghe',
            'birthday'=>'1983',
            'phonenumber'=>'0987 257 504 ',
            'email'=>'thanhld@vnu.edu.vn',
            'hobby'=>'Web,ORIGAMI'
        ]);
    }
}

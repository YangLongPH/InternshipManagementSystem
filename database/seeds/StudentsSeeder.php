<?php

use Illuminate\Database\Seeder;
use App\Models\Student;
class StudentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	Students::create([
            'mssv'=>13000000,
            'fullname'=>'Student1',
            'address'=>'Ha Noi',
            'birthday'=>'1-1-1',
            'phonenumber'=>'08888888888',
            'email'=>'student1@gmail.com',
            'hobby'=>'book,game',
            'major'=>'cntt',
            'class'=>'K58CC'
        ]);
        Students::create([
            'mssv'=>13020553,
            'fullname'=>'Dang Danh Phuong',
            'address'=>'Lang Phu Do',
            'birthday'=>'31-1-1995',
            'phonenumber'=>'01649371678',
            'email'=>'yanglong.ph@gmail.com',
            'hobby'=>'book,game',
            'major'=>'cntt',
            'class'=>'K58CC'
        ]);
    }
}

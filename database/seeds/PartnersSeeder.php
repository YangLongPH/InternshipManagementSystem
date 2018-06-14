<?php

use Illuminate\Database\Seeder;
use App\Models\Partner;
class PartnersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Partner::create([
            'fullname'=>'VNG',
            'company'=>'VNG',
            'office'=>'Tuyen dung',
            'address'=>'Ha noi',
            'birthday'=>'1990',
            'phonenumber'=>'01699259999',
            'email'=>'VNG@gmail.com',
            'hobby'=>'game'
        ]);

        Partner::create([
            'fullname'=>'Ms. Liên',
            'company'=>'Framgia'
            'office'=>'Tuyen dung',
            'address'=>'Ha noi',
            'birthday'=>'1990',
            'phonenumber'=>'086.886.1056',
            'email'=>'hr_team@framgia.com',
            'hobby'=>'game'
        ]);

        Partner::create([
            'fullname'=>'Ms. Nguyệt',
            'company'=>'GAMELOFT'
            'office'=>'Tuyen dung',
            'address'=>'Ha noi',
            'birthday'=>'1990',
            'phonenumber'=>'0243 543 0415',
            'email'=>'recruitment.hn@gameloft.com',
            'hobby'=>'game'
        ]);

        Partner::create([
            'fullname'=>'Nguyễn Thị Vân',
            'company'=>'VCCorp'
            'office'=>'Tuyen dung',
            'address'=>'Ha noi',
            'birthday'=>'1990',
            'phonenumber'=>'0168.993.6461',
            'email'=>'hr@vccorp.vn',
            'hobby'=>'game'
        ]);

        Partner::create([
            'fullname'=>'Tran Thi Quynh Mai',
            'office'=>'tuyen dung'
        ]);
    }
}

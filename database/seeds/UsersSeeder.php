<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'username'=>'admin',
            'password'=>Hash::make('123456789'),
            'email'=>'Administartor@gmail.com',
            'id_lecturer' => 0,
            'avatar' => 0,
            'id_role'=>1
        ]);

        User::create([
            'username'=>'lecturer1',
            'password'=>Hash::make('123456789'),
            'email'=>'lecturer1@gmail.com',
            'id_lecturer' => 1,
            'avatar' => 1,
            'id_role'=>2
        ]);

        User::create([
            'username'=>'partner1',
            'password'=>Hash::make('123456789'),
            'email'=>'partner1@gmail.com',
            'id_partner' => 1,
            'avatar' => 2,
            'id_role'=>3
        ]);

        User::create([
            'username'=>'student1',
            'password'=>Hash::make('123456789'),
            'email'=>'student1@gmail.com',
            'mssv' => 13000000,
            'avatar' => 3,
            'id_role'=>4
        ]);
    }
}

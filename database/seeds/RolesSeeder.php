<?php

use Illuminate\Database\Seeder;
use App\Models\Role;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            'name'=>'admin',
            'note'=>'Cap do 1'
        ]);
        Role::create([
            'name'=>'lecturer',
            'note'=>'Cap do 2'
        ]);
        Role::create([
            'name'=>'partner',
            'note'=>'Cap do 3'
        ]);
        Role::create([
            'name'=>'student',
            'note'=>'Cap do 4'
        ]);
    }
}

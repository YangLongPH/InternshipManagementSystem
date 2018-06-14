<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        $this->call(StudentsSeeder::class);
        $this->call(LecturersSeeder::class);
        $this->call(PartnersSeeder::class);
        $this->call(RolesSeeder::class);
        $this->call(UsersSeeder::class);
        $this->call(SemestersSeeder::class);
        $this->call(DialogsSeeder::class);
        $this->call(InternshipsSeeder::class);
        $this->call(InternsSeeder::class);
        Model::reguard();
    }
}

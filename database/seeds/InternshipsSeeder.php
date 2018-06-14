<?php

use Illuminate\Database\Seeder;
use App\Models\Internship;
class InternshipsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Internship::create([
            'dateline'=>'30-6-2018',
            'describe'=>'Thong bao tuyen dung VNG'
        ]);
    }
}

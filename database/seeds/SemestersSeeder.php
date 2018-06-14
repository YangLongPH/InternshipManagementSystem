<?php

use Illuminate\Database\Seeder;
use App\Models\Semester;
class SemestersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Semester::create([
            'year'=>'2017-2018',
            'hk'=>1,
            'note'=>'Học kỳ 1 năm học 2017-2018'
        ]);

        Semester::create([
            'year'=>'2017-2018',
            'hk'=>2,
            'note'=>'Học kỳ 2 năm học 2017-2018'
        ]);

        Semester::create([
            'year'=>'2017-2018',
            'hk'=>3,
            'note'=>'Học kỳ hè năm học 2017-2018'
        ]);

        Semester::create([
            'year'=>'2018-2019',
            'hk'=>1,
            'note'=>'Học kỳ 1 năm học 2018-2019'
        ]);

        Semester::create([
            'year'=>'2018-2019',
            'hk'=>2,
            'note'=>'Học kỳ 2 năm học 2018-2019'
        ]);

        Semester::create([
            'year'=>'2018-2019',
            'hk'=>3,
            'note'=>'Học kỳ hè năm học 2018-2019'
        ]);
    }
}

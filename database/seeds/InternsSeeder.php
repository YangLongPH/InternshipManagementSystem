<?php

use Illuminate\Database\Seeder;
use App\Models\Intern;
class InternsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Intern::create([
            'id_partner'=>1,
            'id_lecturer'=>1
        ]);
    }
}

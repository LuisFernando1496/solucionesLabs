<?php

use Illuminate\Database\Seeder;
use App\Box;

class BoxSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Box::create([
            'number'=>'1',
            'branch_office_id'=>1,
        ]);

    }
}

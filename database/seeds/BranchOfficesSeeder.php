<?php

use Illuminate\Database\Seeder;
use App\BranchOffice;
class BranchOfficesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        BranchOffice::create([
            'name'=>'Oficina Cancún',
            'address_id'=>1,
        ]);

    }
}

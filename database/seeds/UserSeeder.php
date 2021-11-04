<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'ADMIN',
            'last_name' => 'INUSUAL',
            'curp' => \Str::random(10),
            'rfc'=> \Str::random(10),
            'phone' => '9612343086',
            'email' => 'admin@gmail.com',
            'password' => 'Pass1234',
            'status' => 1,
            'address_id'=>1,
            'branch_office_id'=> 1,
            'rol_id'=>1,
        ]);


    }
}

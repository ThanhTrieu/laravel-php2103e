<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->insert([
            'username' => 'trieunt',
            'password' => '123456789',
            'email' => 'trieunt@gmail.com',
            'phone' => '075091304',
            'address' => 'Ha Noi',
            'birthday' => date('Y-m-d'),
            'avatar' => null,
            'description' => null,
            'status' => 1,
            'gender' => 0,
            'last_login' => null,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => null
        ]);
    }
}

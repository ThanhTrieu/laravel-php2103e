<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            'name' => 'admin',
            'display_name' => 'Supper admin',
            'description' => 'admin - quan tri vien',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => null
        ]);
    }
}

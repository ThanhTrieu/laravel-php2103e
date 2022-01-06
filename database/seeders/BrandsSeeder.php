<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BrandsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 1; $i < 10; $i++) {
            DB::table('brands')->insert([
                'name' => 'Thuong hieu - ' . $i,
                'slug' => 'thuong-hieu-'.$i,
                'logo' => 'test-'.$i.'.png',
                'status' => 1,
                'description' => null,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => null
            ]);
        }
    }
}

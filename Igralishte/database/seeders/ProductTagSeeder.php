<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProductTagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('brand_tags')->insert([
            ['name' => 'vintage'],
            ['name' => 'new'],
            ['name' => 'Luxury'],
        ]);
    }
}

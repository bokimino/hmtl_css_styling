<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AccessorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('accessories')->insert([
            ['name' => 'Accessory 1'],
            ['name' => 'Accessory 2'],
            ['name' => 'Accessory 3'],
        ]);
    }
}

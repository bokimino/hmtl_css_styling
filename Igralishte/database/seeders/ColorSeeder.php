<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ColorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    { 
        $colors = [
            ['name' => 'Red', 'hex' => '#FF835E'],
            ['name' => 'Orange', 'hex' => '#FBC26C'],
            ['name' => 'Yellow', 'hex' => '#FCFF81'],
            ['name' => 'Green', 'hex' => '#B9E5A4'],
            ['name' => 'Blue', 'hex' => '#75D7F0'],
            ['name' => 'Pink', 'hex' => '#FFDBDB'],
            ['name' => 'Purple', 'hex' => '#EA97FF'],
            ['name' => 'Gray', 'hex' => '#D9D9D9'],
            ['name' => 'White', 'hex' => '#FFFFFF'],
            ['name' => 'Black', 'hex' => '#232221'],

        ];

        DB::table('colors')->insert($colors);
    }
}

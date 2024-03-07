<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $categoryId = 1;
        $tagId = 1;

        DB::table('brands')->insert([
            ['name' => 'Brand 1', 'is_active' => true, 'description' => 'Description 1', 'brand_category_id' => $categoryId, 'brand_tag_id' => $tagId],
            ['name' => 'Brand 2', 'is_active' => true, 'description' => 'Description 2', 'brand_category_id' => $categoryId, 'brand_tag_id' => $tagId],
        ]);
    }
}

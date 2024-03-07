<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BrandImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $brandIds = [1, 2, 3]; 
        foreach ($brandIds as $brandId) {
            
            DB::table('brand_images')->insert([
                ['brand_id' => $brandId, 'image_path' => 'path/to/image1.jpg'],
                ['brand_id' => $brandId, 'image_path' => 'path/to/image2.jpg'],
            ]);
        }
    }
}

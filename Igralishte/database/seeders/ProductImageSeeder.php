<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProductImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $productIds = [1, 2, 3];

        foreach ($productIds as $productId) {
            DB::table('product_images')->insert([
                ['product_id' => $productId, 'image' => 'path/to/image1.jpg'],
                ['product_id' => $productId, 'image' => 'path/to/image2.jpg'],
            ]);
        }
    }
}

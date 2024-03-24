<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('products')->insert([
            [
                'name' => 'Product 1',
                'description' => 'Description of Product 1',
                'price' => 100.00,
                'is_active' => true,
                'size_description' => 'Size description of Product 1',
                'material' => 'Material of Product 1',
                'maintenance' => 'Maintenance of Product 1',
                'color_id' => 1,
                'size_id' => 1,
                'product_category_id' => 1,
                'brand_id' => 1,

            ],
            [
                'name' => 'Product 2',
                'description' => 'Description of Product 2',
                'price' => 150.00,
                'is_active' => true,
                'size_description' => 'Size description of Product 2',
                'material' => 'Material of Product 2',
                'maintenance' => 'Maintenance of Product 2',
                'color_id' => 2,
                'size_id' => 2,
                'product_category_id' => 2,
                'brand_id' => 2,
            ],
            [
                'name' => 'Product 3',
                'description' => 'Description of Product 3',
                'price' => 200.00,
                'is_active' => true,
                'size_description' => 'Size description of Product 3',
                'material' => 'Material of Product 3',
                'maintenance' => 'Maintenance of Product 3',
                'color_id' => 3,
                'size_id' => 3,
                'product_category_id' => 3,
                'brand_id' => 3,
            ],
        ]);
    }
}

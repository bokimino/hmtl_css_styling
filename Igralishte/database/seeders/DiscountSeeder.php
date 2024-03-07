<?php

namespace Database\Seeders;

use App\Models\Discount;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DiscountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $discounts = [
            [
                'code' => 'DISCOUNT10',
                'discount' => 10,
                'is_active' => true,
                'discount_category_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        
        DB::table('discounts')->insert($discounts);
    
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('products')->insert([
                // 'code_purchase'=> 'B001',
                'code_product' => 'P001',
                // 'transaction_date' => now(),
                'product_name' => 'Sample Product 1',
                'type_id' => 1,
                'unit_id' => 1,
                // 'supplier_id' => 1,
                'brand' => 'Sample Brand',
                'selling_price' => 5000.00,
                'buying_price' => 3000.00,
                'stock' => 100,
                // 'total_amount' => 300000.00,
                'created_at' => now(),
                'updated_at' => now(),
        ]);
        DB::table('products')->insert([
            // 'code_purchase'=> 'B002',
            'code_product' => 'P002',
            // 'transaction_date' => now(),
            'product_name' => 'Sample Product 2',
            'type_id' => 2,
            'unit_id' => 2,
            // 'supplier_id' => 2,
            'brand' => 'Sample Brand 2',
            // 'selling_price' => 0,
            'buying_price' => 2000.00,
            'stock' => 100,
            // 'total_amount' => 200000.00,
            'created_at' => now(),
            'updated_at' => now(),
    ]);
    }
}

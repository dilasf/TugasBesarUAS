<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PurchaseTransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // DB::table('purchase_transactions')->insert([
        //     'code_purchase'=> 'B000',
        //     'code_product' => 'P002',
        //     'transaction_date' => now(),
        //     'product_name' => 'Sample Product 2',
        //     'type_id' => 2,
        //     'unit_id' => 2,
        //     'supplier_id' => 2,
        //     'brand' => 'Sample Brand 2',
        //     // 'selling_price' => 0,
        //     'buying_price' => 30.00,
        //     'total_amount' => 80.00,
        //     'stock' => 100,
        //     'created_at' => now(),
        //     'updated_at' => now(),
    // ]);
     }
}

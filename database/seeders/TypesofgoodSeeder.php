<?php

namespace Database\Seeders;

use App\Models\Typesofgood;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TypesofgoodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Typesofgood::insert([
            [
                'id' => '1',
                'name' => 'Makanan/Minuman',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => '2',
                'name' => 'Kebutuhan Rumah Tangga',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => '3',
                'name' => 'Produk Kesehatan/Kecantikan',
                'created_at' => now(),
                'updated_at' => now()
            ],

            [
                'id' => '4',
                'name' => 'Bahan Kering/Bumbu',
                'created_at' => now(),
                'updated_at' => now()
            ],

            [
                'id' => '5',
                'name' => 'Produk Kebersihan dan Perawatan Rumah',
                'created_at' => now(),
                'updated_at' => now()
            ],

            [
                'id' => '6',
                'name' => 'Alat Tulis',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }

}

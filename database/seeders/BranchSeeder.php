<?php

namespace Database\Seeders;

use App\Models\Branch;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BranchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Branch::insert([
            [
                 'id' => '1',
                'name' => 'Cabang A',
                'location' => 'Lokasi A',
            ],
            [
                'id' => '2',
                'name' => 'Cabang B',
                'location' => 'Lokasi B',
            ],
            [
                'id' => '3',
                'name' => 'Cabang C',
                'location' => 'Lokasi C',
            ],
            [
                'id' => '4',
                'name' => 'Cabang D',
                'location' => 'Lokasi D',
            ],
            [
                'id' => '5',
                'name' => 'Cabang E',
                'location' => 'Lokasi E',
            ],
        ]);
    }
}

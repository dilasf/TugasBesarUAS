<?php

namespace Database\Seeders;

use App\Models\Position;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Position::insert([
            [
                 'id' => '1',
                'name' => 'Owner',
            ],
            [
                'id' => '2',
                'name' => 'Manager',

            ],
            [
                'id' => '3',
                'name' => 'Supervisor',

            ],
            [
                'id' => '4',
                'name' => 'Chasier',

            ],
            [
                'id' => '5',
                'name' => 'Warehouse Staff',
            ],
        ]);
    }
}

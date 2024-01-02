<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([

            TypesofgoodSeeder::class,
            UnitSeeder::class,
            SupplierSeeder ::class,
            BranchSeeder::class,
            PositionSeeder::class,
            PaymentSeeder::class,
            PaymentStatusSeeder::class,
            ProductSeeder::class,
            SupervisorSeeder::class,
            RolesChasierSeeder ::class,
            RolesWarehouseStaffSeeder::class,
            RolesManagerSeeder::class,
        ]);
    }
}

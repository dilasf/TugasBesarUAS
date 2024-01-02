<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class RolesManagerSeeder extends Seeder
{
    public function run()
    {
        try {
            $roleManager = Role::firstOrCreate(['name' => 'Manager']);
            $permissionStockGoods = Permission::create(['name' => 'access Stock of goods']);
            $permissionTargetSales = Permission::create(['name' => 'access Target Sales']);
            $permissionFeedback = Permission::create(['name' => 'access Feedback']);
            $permissionTransactionHistory = Permission::create(['name' => 'access Transaction History']);

            $roleManager->givePermissionTo([$permissionStockGoods]);
            $roleManager->givePermissionTo([$permissionTargetSales]);
            $roleManager->givePermissionTo([$permissionFeedback]);
            $roleManager->givePermissionTo([$permissionTransactionHistory]);

            $userManager = User::create([
                'name' => 'Manager',
                'email' => 'manager@gmail.com',
                'position_id' => 2,
                'branch_id' => 1,
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            $userManager->assignRole($roleManager);
            $userManager->givePermissionTo([$permissionStockGoods->name]);
            $userManager->givePermissionTo([$permissionTargetSales->name]);
            $userManager->givePermissionTo([$permissionFeedback->name]);
            $userManager->givePermissionTo([$permissionTransactionHistory->name]);
            
            echo "Seeder executed successfully.";
        } catch (\Exception $e) {
            echo "Seeder error: " . $e->getMessage();
        }
    }
}

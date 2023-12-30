<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class RolesWarehouseStaffSeeder extends Seeder
{
    public function run()
    {
        $roleWarehouseStaff = Role::create(['name' => 'Warehouse Staff']);
        $permissionProduct = Permission::create(['name' => 'access product']);
        $permissionSuppliers = Permission::create(['name' => 'access suppliers']);
        $permissionPurchaseHistory = Permission::create(['name' => 'access purchase history']);

        $roleWarehouseStaff->givePermissionTo([
            $permissionProduct,
            $permissionSuppliers,
            $permissionPurchaseHistory
        ]);

        $userStaff = User::create([
            'name' => 'Staff',
            'email' => 'staff@gmail.com',
            'position_id' => 5,
            'branch_id' => 1,
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $userStaff2 = User::create([
            'name' => 'Staff 2',
            'email' => 'staff2@gmail.com',
            'position_id' => 5,
            'branch_id' => 2,
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);


                $userStaff->assignRole($roleWarehouseStaff);
                $userStaff->givePermissionTo([
                    $permissionProduct->name,
                    $permissionSuppliers->name,
                    $permissionPurchaseHistory->name
                ]);

                $userStaff2->assignRole($roleWarehouseStaff);
                $userStaff2->givePermissionTo([
                $permissionProduct->name,
                $permissionSuppliers->name,
                $permissionPurchaseHistory->name
                ]);
    }
}

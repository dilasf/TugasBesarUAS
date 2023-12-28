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

        $user = User::create([
            'name' => 'Staff',
            'email' => 'staff@gmail.com',
            'position' => 'warehouse_staff',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $user = User::create([
            'name' => 'aku',
            'email' => 'aku@gmail.com',
            'position' => 'warehouse_staff',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $user->assignRole($roleWarehouseStaff);
        $user->givePermissionTo([
            $permissionProduct->name,
            $permissionSuppliers->name,
            $permissionPurchaseHistory->name
        ]);
    }
}

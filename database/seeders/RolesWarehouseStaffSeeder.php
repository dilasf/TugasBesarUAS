<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RolesWarehouseStaffSeeder extends Seeder
{
    public function run()
    {
        $permissions = ['access product', 'access suppliers', 'access purchase history'];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }
        $roleWarehouseStaff = Role::firstOrCreate(['name' => 'Warehouse Staff']);
    
        $roleWarehouseStaff->givePermissionTo('access product');
        $roleWarehouseStaff->givePermissionTo('access suppliers');
        $roleWarehouseStaff->givePermissionTo('access purchase history');
        
        $userStaff = User::firstOrCreate([
            'name' => 'Staff',
            'email' => 'staff@gmail.com',
            'position_id' => 5,
            'branch_id' => 1,
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
        ]);

        $userStaff2 = User::firstOrCreate([
            'name' => 'Staff 2',
            'email' => 'staff2@gmail.com',
            'position_id' => 5,
            'branch_id' => 2,
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
        ]);

        $userStaff->assignRole($roleWarehouseStaff);
        $userStaff->givePermissionTo([
            'access product',
            'access suppliers',
            'access purchase history',
        ]);
    
        $userStaff2->assignRole($roleWarehouseStaff);
        $userStaff2->givePermissionTo([
            'access product',
            'access suppliers',
            'access purchase history',
        ]);
    }
}

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
        $permissions = ['access product', 'access suppliers', 'access purchase history', 'acces Report Record Transactions'];

        foreach ($permissions as $permissionName) {
            Permission::firstOrCreate(['name' => $permissionName]);
        }

        $roleWarehouseStaff = Role::firstOrCreate(['name' => 'Warehouse Staff']);

        $userStaff = User::firstOrCreate([
            'name' => 'Staff A',
            'email' => 'staffA@gmail.com',
            'position_id' => 5,
            'branch_id' => 1,
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
        ]);
        $userStaff->assignRole($roleWarehouseStaff);
        $permissionsToSync = Permission::whereIn('name', $permissions)->pluck('id')->toArray();
        $userStaff->permissions()->sync($permissionsToSync);

        $userStaff2 = User::firstOrCreate([
            'name' => 'Staff B',
            'email' => 'staffB@gmail.com',
            'position_id' => 5,
            'branch_id' => 2,
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
        ]);
        $userStaff2->assignRole($roleWarehouseStaff);
        $permissionsToSync = Permission::whereIn('name', $permissions)->pluck('id')->toArray();
        $userStaff2->permissions()->sync($permissionsToSync);


        $userStaff3 = User::firstOrCreate([
            'name' => 'Staff C',
            'email' => 'staffC@gmail.com',
            'position_id' => 5,
            'branch_id' => 3,
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
        ]);
        $userStaff3->assignRole($roleWarehouseStaff);
        $permissionsToSync = Permission::whereIn('name', $permissions)->pluck('id')->toArray();
        $userStaff3->permissions()->sync($permissionsToSync);

        $userStaff4 = User::firstOrCreate([
            'name' => 'Staff D',
            'email' => 'staffD@gmail.com',
            'position_id' => 5,
            'branch_id' => 4,
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
        ]);
        $userStaff4->assignRole($roleWarehouseStaff);
        $permissionsToSync = Permission::whereIn('name', $permissions)->pluck('id')->toArray();
        $userStaff4->permissions()->sync($permissionsToSync);

        $userStaff5 = User::firstOrCreate([
            'name' => 'Staff E',
            'email' => 'staffE@gmail.com',
            'position_id' => 5,
            'branch_id' => 5,
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
        ]);
        $userStaff5->assignRole($roleWarehouseStaff);
        $permissionsToSync = Permission::whereIn('name', $permissions)->pluck('id')->toArray();
        $userStaff5->permissions()->sync($permissionsToSync);
    }
}

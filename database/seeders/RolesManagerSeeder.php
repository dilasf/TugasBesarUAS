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
        $permissions = [
            'access Stock of goods', 'access Sales Targets', 'access Feedback',
            'access Report Sales Transaction', 'access Report Purchase Transactions',
            'access Employees', 'access Supplier', 'access Discount'
        ];

        foreach ($permissions as $permissionName) {
            Permission::firstOrCreate(['name' => $permissionName]);
        }

        $roleManager = Role::firstOrCreate(['name' => 'Manager']);

        $userManager1 = User::firstOrCreate([
                'name' => 'Manager A',
                'email' => 'managerA@gmail.com',
                'position_id' => 2,
                'branch_id' => 1,
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            $userManager1->assignRole($roleManager);
            $permissionsToSync = Permission::whereIn('name', $permissions)->pluck('id')->toArray();
            $userManager1->permissions()->sync($permissionsToSync);

            $userManager2 = User::firstOrCreate([
                'name' => 'Manager B',
                'email' => 'managerB@gmail.com',
                'position_id' => 2,
                'branch_id' => 2,
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            $userManager2->assignRole($roleManager);
            $permissionsToSync = Permission::whereIn('name', $permissions)->pluck('id')->toArray();
            $userManager2->permissions()->sync($permissionsToSync);

            $userManager3 = User::firstOrCreate([
                'name' => 'Manager C',
                'email' => 'managerC@gmail.com',
                'position_id' => 2,
                'branch_id' => 3,
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            $userManager3->assignRole($roleManager);
            $permissionsToSync = Permission::whereIn('name', $permissions)->pluck('id')->toArray();
            $userManager3->permissions()->sync($permissionsToSync);

            $userManager4 = User::firstOrCreate([
                'name' => 'Manager D',
                'email' => 'managerD@gmail.com',
                'position_id' => 2,
                'branch_id' => 4,
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            $userManager4->assignRole($roleManager);
            $permissionsToSync = Permission::whereIn('name', $permissions)->pluck('id')->toArray();
            $userManager4->permissions()->sync($permissionsToSync);

            $userManager5 = User::firstOrCreate([
                'name' => 'Manager E',
                'email' => 'managerE@gmail.com',
                'position_id' => 2,
                'branch_id' => 5,
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            $userManager5->assignRole($roleManager);
            $permissionsToSync = Permission::whereIn('name', $permissions)->pluck('id')->toArray();
            $userManager5->permissions()->sync($permissionsToSync);


        }
}

<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class RolesSupervisorSeeder extends Seeder
{
    public function run()
{
        $permissions = ['access Stock of goods', 'access Report Sales Transaction', 'access Report Purchase Transactions', 'access Employees', 'access Supplier', 'access Discount'];

        foreach ($permissions as $permissionName) {
            Permission::firstOrCreate(['name' => $permissionName]);
        }

        $roleSupervisor = Role::firstOrCreate(['name' => 'Supervisor']);

        $supervisor = User::create([
            'name' => 'Supervisor A',
            'email' => 'supervisorA@gmail.com',
            'position_id' => 3,
            'branch_id' => 1,
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $supervisor->assignRole($roleSupervisor);
        $permissionsToSync = Permission::whereIn('name', $permissions)->pluck('id')->toArray();
        $supervisor->permissions()->sync($permissionsToSync);

        $supervisor2 = User::create([
            'name' => 'Supervisor B',
            'email' => 'supervisorB@gmail.com',
            'position_id' => 3,
            'branch_id' => 2,
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $supervisor2->assignRole($roleSupervisor);
        $permissionsToSync = Permission::whereIn('name', $permissions)->pluck('id')->toArray();
        $supervisor2->permissions()->sync($permissionsToSync);

        $supervisor3 = User::create([
            'name' => 'Supervisor C',
            'email' => 'supervisorC@gmail.com',
            'position_id' => 3,
            'branch_id' => 3,
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $supervisor3->assignRole($roleSupervisor);
        $permissionsToSync = Permission::whereIn('name', $permissions)->pluck('id')->toArray();
        $supervisor3->permissions()->sync($permissionsToSync);

        $supervisor4 = User::create([
            'name' => 'Supervisor D',
            'email' => 'supervisorD@gmail.com',
            'position_id' => 3,
            'branch_id' => 4,
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $supervisor4->assignRole($roleSupervisor);
        $permissionsToSync = Permission::whereIn('name', $permissions)->pluck('id')->toArray();
        $supervisor4->permissions()->sync($permissionsToSync);

        $supervisor5 = User::create([
            'name' => 'Supervisor E',
            'email' => 'supervisorE@gmail.com',
            'position_id' => 3,
            'branch_id' => 5,
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $supervisor5->assignRole($roleSupervisor);
        $permissionsToSync = Permission::whereIn('name', $permissions)->pluck('id')->toArray();
        $supervisor5->permissions()->sync($permissionsToSync);

}

}

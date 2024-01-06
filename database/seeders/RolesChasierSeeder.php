<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class RolesChasierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {

        $permissions = ['access Product', 'access Transaction', 'access Discount', 'access Report Record Transactions', 'access Sale History'];

        foreach ($permissions as $permissionName) {
            Permission::firstOrCreate(['name' => $permissionName]);
        }

        $roleCashier = Role::firstOrCreate(['name' => 'Cashier']);

        $userCashier = User::create([
            'name' => 'Kasir A',
            'email' => 'kasirA@gmail.com',
            'position_id' => 4,
            'branch_id' => 1,
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $userCashier->assignRole($roleCashier);
        $permissionsToSync = Permission::whereIn('name', $permissions)->pluck('id')->toArray();
        $userCashier->permissions()->sync($permissionsToSync);

        $userCashier2 = User::create([
            'name' => 'Kasir B',
            'email' => 'kasirB@gmail.com',
            'position_id' => 4,
            'branch_id' => 2,
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $userCashier2->assignRole($roleCashier);
        $permissionsToSync = Permission::whereIn('name', $permissions)->pluck('id')->toArray();
        $userCashier2->permissions()->sync($permissionsToSync);

        $userCashier3 = User::create([
            'name' => 'Kasir C',
            'email' => 'kasirC@gmail.com',
            'position_id' => 4,
            'branch_id' => 3,
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $userCashier3->assignRole($roleCashier);
        $permissionsToSync = Permission::whereIn('name', $permissions)->pluck('id')->toArray();
        $userCashier3->permissions()->sync($permissionsToSync);

        $userCashier4 = User::create([
            'name' => 'Kasir D',
            'email' => 'kasirD@gmail.com',
            'position_id' => 4,
            'branch_id' => 4,
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $userCashier4->assignRole($roleCashier);
        $permissionsToSync = Permission::whereIn('name', $permissions)->pluck('id')->toArray();
        $userCashier4->permissions()->sync($permissionsToSync);

        $userCashier5 = User::create([
            'name' => 'Kasir E',
            'email' => 'kasirE@gmail.com',
            'position_id' => 4,
            'branch_id' => 5,
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $userCashier5->assignRole($roleCashier);
        $permissionsToSync = Permission::whereIn('name', $permissions)->pluck('id')->toArray();
        $userCashier5->permissions()->sync($permissionsToSync);
    }
}

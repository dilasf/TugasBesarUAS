<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class RoleOwnerSeeder extends Seeder
{
    public function run()
    {
        $permissions = ['access Employee', 'access Stock Product', 'access Feedback', 'access Sales Targets', 'access Report Sales Transaction', 'access Report Purchase Transactions','access Supplier', 'access Discount'];

        foreach ($permissions as $permissionName) {
            Permission::firstOrCreate(['name' => $permissionName]);
        }

        $roleOwner = Role::firstOrCreate(['name' => 'Owner']);

        $roleOwner->givePermissionTo('access Employee');
        $roleOwner->givePermissionTo('access Stock Product');
        $roleOwner->givePermissionTo('access Feedback');
        $roleOwner->givePermissionTo('access Sales Targets');
        $roleOwner->givePermissionTo('access Report Sales Transaction');
        $roleOwner->givePermissionTo('access Report Purchase Transactions');

        $userOwner = User::firstOrCreate([
            'name' => 'Owner',
            'email' => 'owner@gmail.com',
            'position_id' => 1,
            'branch_id' => null,
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
        ]);


        $userOwner->assignRole($roleOwner);
        $permissionsToSync = Permission::whereIn('name', $permissions)->pluck('id')->toArray();
        $userOwner->permissions()->sync($permissionsToSync);

    }
}

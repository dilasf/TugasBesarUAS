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
        $permissions = ['access Target Sales', 'access Transaction History'];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }
    
        // Memberikan izin kepada peran "Warehouse Staff"
        $roleOwner = Role::firstOrCreate(['name' => 'Owner']);
    
        $roleOwner->givePermissionTo('access Target Sales');
        $roleOwner->givePermissionTo('access Transaction History');
        
        $userOwner = User::firstOrCreate([
            'name' => 'Owner',
            'email' => 'owner@gmail.com',
            'position_id' => 5,
            'branch_id' => 1,
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
        ]);

        $userOwner->assignRole($roleOwner);
        $userOwner->givePermissionTo([
            'access Target Sales',
            'access Transaction History',
        ]);
    }
}

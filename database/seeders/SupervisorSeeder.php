<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class SupervisorSeeder extends Seeder
{
    public function run()
{
    $existingRole = Role::where('name', 'Supervisor')->first();

    if (!$existingRole) {
        $roleSupervisor = Role::create(['name' => 'Supervisor']);
        $permissionStockGoods = Permission::create(['name' => 'access Stock of goods']);
        $permissionTransactionHistory = Permission::create(['name' => 'access Transaction History']);
        $roleSupervisor->givePermissionTo([
            $permissionStockGoods,
            $permissionTransactionHistory,
        ]);
        $supervisor = User::create([
            'name' => 'Supervisor',
            'email' => 'supervisor@gmail.com',
            // 'position_name'=> 'Supervisor',
            'position_id' => 3,
            'branch_id' => 1,
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $supervisor->assignRole($roleSupervisor);
        $supervisor->givePermissionTo([
            $permissionStockGoods->name,
            $permissionTransactionHistory->name,
        ]);
    } else {
    }
}

}

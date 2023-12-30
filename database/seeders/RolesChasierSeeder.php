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

        $roleCashier = Role::create(['name' => 'Cashier']);
        $permissionTransaction = Permission::create(['name' => 'access transaction']);
        $permissionDiscount = Permission::create(['name' => 'access discount']);
        $permissionDailyReport = Permission::create(['name' => 'access daily report']);

        $roleCashier->givePermissionTo([
            $permissionTransaction,
            $permissionDiscount,
            $permissionDailyReport
        ]);

        $userCashier = User::create([
            'name' => 'Kasir',
            'email' => 'kasir@gmail.com',
            'position_id' => 4,
            'branch_id' => 1,
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $userCashier2 = User::create([
            'name' => 'Kasir 2',
            'email' => 'kasir2@gmail.com',
            'position_id' => 4,
            'branch_id' => 2,
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $userCashier->assignRole($roleCashier);
        $userCashier->givePermissionTo([
            $permissionTransaction->name,
            $permissionDiscount->name,
            $permissionDailyReport->name
        ]);

        $userCashier2->assignRole($roleCashier);
        $userCashier2->givePermissionTo([
            $permissionTransaction->name,
            $permissionDiscount->name,
            $permissionDailyReport->name
        ]);
    }
}

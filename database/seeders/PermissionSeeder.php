<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::create(['name' => 'dashboard.index', 'guard_name' => 'web']);

        Permission::create(['name' => 'master.categories.index', 'guard_name' => 'web']);
        Permission::create(['name' => 'master.categories.create', 'guard_name' => 'web']);
        Permission::create(['name' => 'master.categories.edit', 'guard_name' => 'web']);
        Permission::create(['name' => 'master.categories.delete', 'guard_name' => 'web']);

        Permission::create(['name' => 'master.brands.index', 'guard_name' => 'web']);
        Permission::create(['name' => 'master.brands.create', 'guard_name' => 'web']);
        Permission::create(['name' => 'master.brands.edit', 'guard_name' => 'web']);
        Permission::create(['name' => 'master.brands.delete', 'guard_name' => 'web']);

        Permission::create(['name' => 'master.products.index', 'guard_name' => 'web']);
        Permission::create(['name' => 'master.products.create', 'guard_name' => 'web']);
        Permission::create(['name' => 'master.products.edit', 'guard_name' => 'web']);
        Permission::create(['name' => 'master.products.delete', 'guard_name' => 'web']);

        Permission::create(['name' => 'transactions.invoices.index', 'guard_name' => 'web']);

        Permission::create(['name' => 'report.sales.index', 'guard_name' => 'web']);

        Permission::create(['name' => 'setting.users.index', 'guard_name' => 'web']);
        Permission::create(['name' => 'setting.users.create', 'guard_name' => 'web']);
        Permission::create(['name' => 'setting.users.edit', 'guard_name' => 'web']);
        Permission::create(['name' => 'setting.users.delete', 'guard_name' => 'web']);

        Permission::create(['name' => 'setting.permissions.index', 'guard_name' => 'web']);

        Permission::create(['name' => 'setting.roles.index', 'guard_name' => 'web']);
        Permission::create(['name' => 'setting.roles.create', 'guard_name' => 'web']);
        Permission::create(['name' => 'setting.roles.edit', 'guard_name' => 'web']);
    }
}

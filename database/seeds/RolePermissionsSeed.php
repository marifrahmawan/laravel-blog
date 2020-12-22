<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionsSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::create(['name' => 'publish articles']);
        Permission::create(['name' => 'edit articles']);
        Permission::create(['name' => 'delete articles']);
        Permission::create(['name' => 'delete users']);

        $role1 = Role::create([
            'name' => 'super-admin',
            'guard_name' => 'web'
        ]);

        $role1->givePermissionTo('publish articles');
        $role1->givePermissionTo('edit articles');
        $role1->givePermissionTo('delete articles');
        $role1->givePermissionTo('delete users');

        $role2 = Role::create([
            'name' => 'admin',
            'guard_name' => 'web'
        ]);

        $role2->givePermissionTo('publish articles');
        $role2->givePermissionTo('edit articles');
        $role2->givePermissionTo('delete articles');

        $role3 = Role::create([
            'name' => 'user',
            'guard_name' => 'web'
        ]);

        $role3->givePermissionTo('publish articles');
        $role3->givePermissionTo('edit articles');
        $role3->givePermissionTo('delete articles');
    }
}

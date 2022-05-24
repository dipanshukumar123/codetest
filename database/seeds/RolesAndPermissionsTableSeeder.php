<?php

use App\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RolesAndPermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $arrayOfPermissionNames = [
            // Roles
            'role-list',
            'role-create',
            'role-edit',
            'role-delete',
            // Permissions
            'permission-list',
            'permission-create',
            'permission-edit',
            'permission-delete',
        ];
        $permissions = collect($arrayOfPermissionNames)->map(function ($permission) {
            return ['name' => $permission, 'guard_name' => 'web'];
        });
        Permission::insert($permissions->toArray());

        $role = Role::create(['name' => 'Super Admin']);
        $user = User::find(1);
        $user->assignRole([$role->id]);

        $role = Role::create(['name' => 'Admin']);
        $permissions = Permission::pluck('id', 'id')->all();
        $role->syncPermissions($permissions);
        $user = User::find(2);
        $user->assignRole([$role->id]);


    }
}

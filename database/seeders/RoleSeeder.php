<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $superAdmin = Role::create(['name' => 'super_admin']);
        Role::create(['name' => 'admin']);
        Role::create(['name' => 'employee']);
        Role::create(['name' => 'user']);

        $permissions = [

            [
                'group_name' => 'Dashboard',
                'permissions' => [
                    'dashboard.view',
                ]
            ],
            [
                'group_name' => 'Settings',
                'permissions' => [
                    'settings.manage',
                ]
            ],
            [
                'group_name' => 'Roles',
                'permissions' => [
                    'roles.manage',
                    'roles.list',
                    'roles.view',
                    'roles.create',
                    'roles.update',
                    'roles.delete',
                ]
            ],
            [
                'group_name' => 'Permissions',
                'permissions' => [
                    'permission.manage',
                    'permission.list',
                    'permission.view',
                    'permission.update',
                    'permission.delete',
                    'permission.create',

                ]
            ],





        ];

        for ($i = 0;$i<count($permissions);$i++){
            $permissions_group = $permissions[$i]['group_name'];
            for ($j = 0;$j<count($permissions[$i]['permissions']);$j++){
                //Admin guard Permisson
                $super_permission =  Permission::create(['name'=>$permissions[$i]['permissions'][$j],'group_name'=>$permissions_group]);
                $superAdmin->givePermissionTo($super_permission);
                $super_permission->assignRole($superAdmin);

            }

        }
    }
}

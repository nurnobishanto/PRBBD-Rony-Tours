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
                    'settings.general',
                ]
            ],
            [
                'group_name' => 'Admins',
                'permissions' => [
                    'admins.manage',
                    'admin.list',
                    'admin.view',
                    'admin.create',
                    'admin.update',
                    'admin.delete',
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
            [
                'group_name' => 'Deposits',
                'permissions' => [
                    'deposits.manage',
                    'deposit.accept',
                    'deposit.reject',
                ]
            ],
            [
                'group_name' => 'Commands',
                'permissions' => [
                    'commands.manage',
                    'command.cache_clear',
                    'command.route_clear',
                    'command.optimize',
                    'command.migrate',
                    'command.migrate_fresh',
                    'command.migrate_fresh_seed',
                ]
            ],
            [
                'group_name' => 'Sliders',
                'permissions' => [
                    'sliders.manage',
                    'slider.list',
                    'slider.view',
                    'slider.update',
                    'slider.delete',
                    'slider.create',

                ]
            ],
            [
                'group_name' => 'Orders',
                'permissions' => [
                    'orders.manage',
                    'order.list',
                    'order.view',
                ]
            ],
            [
                'group_name' => 'Pages',
                'permissions' => [
                    'pages.manage',
                    'page.list',
                    'page.view',
                    'page.update',
                    'page.delete',
                    'page.create',

                ]
            ],
            [
                'group_name' => 'Passengers',
                'permissions' => [
                    'passengers.manage',
                    'passenger.list',
                    'passenger.view',
                    'passenger.update',
                    'passenger.delete',
                    'passenger.create',

                ]
            ],
            [
                'group_name' => 'Subscribers',
                'permissions' => [
                    'subscribers.manage',
                    'subscriber.delete',
                ]
            ],
            [
                'group_name' => 'Bank',
                'permissions' => [
                    'bank.manage',
                    'bank.list',
                    'bank.view',
                    'bank.update',
                    'bank.delete',
                    'bank.create',

                ]
            ],
            [
                'group_name' => 'Departments',
                'permissions' => [
                    'departments.manage',
                    'department.list',
                    'department.view',
                    'department.update',
                    'department.delete',
                    'department.create',

                ]
            ],
            [
                'group_name' => 'Supports',
                'permissions' => [
                    'supports.manage',
                    'support.list',
                    'support.view',
                    'support.update',
                    'support.delete',
                    'support.create',

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

<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $user = User::factory()->create([
            'first_name' => 'UserTeste'
        ]);

        $role = Role::create([
            'name' => 'admin',
            'label' => 'Admin'
        ]);

        $permission = Permission::create([
            'name' => 'view-user-configuration',
            'label' => 'View user configuration'
        ]);

        $user->roles()->attach($role);
        $role->permissions()->attach($permission);
    }
}

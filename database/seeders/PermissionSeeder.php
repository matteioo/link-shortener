<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class PermissionSeeder extends Seeder
{
    /**
     * Create the initial roles and permissions.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // Create permissions
        // Link related permissions
        Permission::create(['name' => 'show own links']);
        Permission::create(['name' => 'show all links']);
        Permission::create(['name' => 'show own advanced link details']);
        Permission::create(['name' => 'show all advanced link details']);
        Permission::create(['name' => 'create advanced links']);

        // User related permissions

        // Create roles and assign existing permissions
        $userRole = Role::create(['name' => 'user']);
        $userRole->givePermissionTo('show own links');
        $userRole->givePermissionTo('show own advanced link details');
        $userRole->givePermissionTo('create advanced links');

        $adminRole = Role::create(['name' => 'admin']);
        $adminRole->givePermissionTo('show all links');
        $adminRole->givePermissionTo('show all advanced link details');

        // Create demo users
        $user = User::factory()->create([
            'name' => 'User',
            'email' => 'user@email.com',
        ]);
        $user->assignRole($userRole);

        $user = User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@email.com',
        ]);
        $user->assignRole($adminRole);
        $user->assignRole($userRole);
    }
}

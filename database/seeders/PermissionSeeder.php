<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Spatie\Permission\PermissionRegistrar;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(PermissionRegistrar $permissions)
    {
        $permissions->forgetCachedPermissions();
        $this->createPermissions();
        $this->createRoles();
    }

    private function createPermissions(): void
    {
        foreach (Permission::getConstants() as $name) {
            Permission::create(['name' => $name]);
        }
    }

    private function createRoles(): void
    {
        foreach (Role::getConstants() as $name) {
            Role::create(['name' => $name]);
        }
    }
}

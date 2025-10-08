<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
        //Assign All Permissions Here
        $permissions = [
            'admin.dashboard',
            'admin.user-list',
            'admin.add-user',
            'admin.edit-user',
            'admin.update-user',
            'admin.delete-user',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission,'guard_name'=>'admin']);
        }
    }
}

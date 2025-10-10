<?php

namespace Database\Seeders;

use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // // Reset cached roles and permissions
		app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

		// Assign Super Admin Role
		$admin = Admin::where('id', 1)->first();
		$admin->assignRole('Admin');
		
		$adminRole = Role::findByName('Admin', 'admin');
		$adminRole->givePermissionTo(Permission::all());
	
		
    }
}

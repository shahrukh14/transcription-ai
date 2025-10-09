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
		$superAdmin = Admin::where('id', 1)->first();
		$superAdmin->assignRole('Super Admin');
		
		$superAdminRole = Role::findByName('Super Admin', 'admin');
		$superAdminRole->givePermissionTo(Permission::all());
		
		// Assign Admin Role
		$adminPermissions = [
			'admin.dashboard',
			'admin.user-list',
			'admin.add-user',
			'admin.edit-user',
			'admin.update-user',
			'admin.delete-user',
			'admin.logout'
		];
		
		$admin = Admin::where('id', 2)->first();
		$admin->assignRole('Admin');
		
		$adminRole = Role::findByName('Admin', 'admin');
		$adminRole->givePermissionTo($adminPermissions);
		
    }
}

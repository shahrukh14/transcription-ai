<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Route;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
        // All Route Permissions 
        $routes = Route::getRoutes();
        foreach($routes as $route){
            $routeName = $route->getName();
            $action = $route->getAction();
            // Get the prefix from the route action
            $routeGroup = isset($action['prefix']) ? $action['prefix'] : null;

            if($routeName){
                Permission::firstOrCreate([
                    'name' => $routeName,
                    'guard_name' => 'admin',
                    'group' => $routeGroup
                ]);
            }
        }
    }
}

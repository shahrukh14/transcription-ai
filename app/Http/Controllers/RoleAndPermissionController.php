<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Permission;


class RoleAndPermissionController extends Controller
{
    public function addPermissionForm()
    {
        return view('admin.permission.add-permission');
    }
    public function addPermission(Request $request)
    {
        Permission::create([
            'name' => 'admin' . '.' . $request->permission,
            'guard_name' => 'admin'
        ]);
        alert()->success('Success', 'Permission Added Successfully');
        return redirect()->back();
    }
    public function roleList()
    {
        $rolesDetails = Role::paginate(10);
        return view('admin.role.list', compact('rolesDetails'));
    }
    public function addRoleForm(Request $request)
    {
        return view('admin.role.add_role_form');
    }
    public function changeRoleStatus(Request $request)
    {
        if (isset($request->role_status)) {
            Role::where('id', $request->role_id)->update([
                'status' => $request->role_status,
            ]);
        }else {
            Role::where('id', $request->role_id)->update([
                'status' => config('constant.status.inactive'),
            ]);
        }
        alert()->success('Success', 'Role Status Changed Successfully');
        return redirect()->back();
    }
    public function addRole(Request $request)
    {
        $request->validate([
            'role_name' => 'required|unique:roles,name',
        ]);
        Role::create([
            'name' => $request->role_name,
            'guard_name' => 'admin',
            'created_by' => auth()->user()->id,
        ]);
        alert()->success('Success', 'Role Added Successfully');
        return to_route('admin.roles');
    }

    public function assignPermissionForm(Request $request){

        // get the Route names and add to permisions table
        $routes = Route::getRoutes();
        

        foreach ($routes as $route) {
            $routeName = $route->getName();
            $action = $route->getAction();
            // Get the prefix from the route action
            $routeGroup = isset($action['prefix']) ? $action['prefix'] : null;

            if ($routeName) {
                Permission::firstOrCreate([
                    'name' => $routeName,
                    'guard_name' => 'admin',
                    'group' => $routeGroup,
                ]);
            }
        }

        //Assign All Permissions To Admin
        $Admin = Role::findByName('Admin');
        $Admin->givePermissionTo(Permission::all());

        $role = Role::findByName($request->role_name);
        $roleName = $request->role_name;
        $assignedPermissions = $role->permissions->pluck('id')->toArray();
        $permissions = Permission::orderBy('id', 'ASC')->get()->groupBy('group');
        return view('admin.permission.assign-permissions', compact('permissions', 'assignedPermissions', 'roleName'));
    }

    function assignPermissions(Request $request)
    {
        $role = Role::findByName($request->role_name);
        $role->syncPermissions($request->permissions);
        return redirect()->back();
    }
}

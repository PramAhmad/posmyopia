<?php

namespace App\Http\Controllers;

use App\DataTables\RoleDataTable;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index(RoleDataTable $datatable)
    {
        return $datatable->render('role.index');
    }

    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3|max:100|unique:roles,name'
        ]);

        Role::create($request->all());

        return response()->json(['success' => true, 'message' => 'Role created successfully', '_token' => csrf_token()]);
    }

    public function edit($id)
    {
        $role = Role::find($id);

        if (!$role) {
            return response()->json(['success' => false, 'message' => 'Role not found'], 404);
        }

        return response()->json(['success' => true, 'data' => $role, '_token' => csrf_token()]);
    }

    public function update(Request $request, $id) {
        $role = Role::find($id);

        if (!$role) {
            return response()->json(['success' => false, 'message' => 'Role not found'], 404);
        }
        
        $request->validate([
            'name' => 'required|min:3|max:100|unique:roles,name,' . $id
        ]);

        $role->update($request->all());

        return response()->json(['success' => true, 'data' => $role, 'message' => 'Role updated successfully', '_token' => csrf_token()]);
    }

    public function destroy($id)
    {
        $role = Role::find($id);

        if (!$role) {
            return response()->json(['success' => false, 'message' => 'Role not found'], 404);
        }

        $role->delete();

        return response()->json(['message' => 'Role deleted successfully']);
    }

    public function permission($id)
    {
        $role = Role::findOrFail($id);

        $modules = [
            [
                'name' => 'Role',
                'permission' => [
                    [
                        'name' => 'view role',
                        'checked' => $role->hasPermissionTo('view role')
                    ],
                    [
                        'name' => 'create role',
                        'checked' => $role->hasPermissionTo('create role')
                    ],
                    [
                        'name' => 'edit role',
                        'checked' => $role->hasPermissionTo('edit role')
                    ],
                    [
                        'name' => 'delete role',
                        'checked' => $role->hasPermissionTo('delete role')
                    ]
                ]
            ],
            [
                'name' => 'User',
                'permission' => [
                    [
                        'name' => 'view user',
                        'checked' => $role->hasPermissionTo('view user')
                    ],
                    [
                        'name' => 'create user',
                        'checked' => $role->hasPermissionTo('create user')
                    ],
                    [
                        'name' => 'edit user',
                        'checked' => $role->hasPermissionTo('edit user')
                    ],
                    [
                        'name' => 'delete user',
                        'checked' => $role->hasPermissionTo('delete user')
                    ]
                ]
            ]
        ];

        return view('role.permission', compact('role', 'modules'));
    }

    public function updatePermission(Request $request, $id)
    {
        $role = Role::find($id);

        if (!$role) {
            return response()->json(['success' => false, 'message' => 'Role not found'], 404);
        }

        $role->syncPermissions($request->permission);

        return redirect(route('role.permission', $id))->with('success', 'Permission updated successfully');
    }
}
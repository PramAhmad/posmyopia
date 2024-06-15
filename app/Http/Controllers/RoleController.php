<?php

namespace App\Http\Controllers;

use App\DataTables\RoleDataTable;
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
            'name' => 'required|min:3|max:100'
        ]);

        $role = Role::create($request->all());

        return response()->json(['success' => true, 'data' => $role, '_token' => csrf_token()]);
    }

    public function edit($id)
    {
        $role = Role::find($id);

        if (!$role) {
            return response()->json(['message' => 'Role not found'], 404);
        }

        return response()->json(['success' => true, 'data' => $role, '_token' => csrf_token()]);
    }

    public function update(Request $request, $id) {
        $role = Role::find($id);

        if (!$role) {
            return response()->json(['message' => 'Role not found'], 404);
        }
        
        $request->validate([
            'name' => 'required|min:3|max:100'
        ]);

        $role->update($request->all());

        return response()->json(['success' => true, 'data' => $role, 'message' => 'Role updated successfully', '_token' => csrf_token()]);
    }

    public function destroy($id)
    {
        $role = Role::find($id);

        if (!$role) {
            return response()->json(['message' => 'Role not found'], 404);
        }

        $role->delete();

        return response()->json(['message' => 'Role deleted successfully']);
    }
}

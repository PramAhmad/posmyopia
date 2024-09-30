<?php

namespace App\Http\Controllers;

use App\DataTables\UserDataTable;
use App\Models\Toko;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index(UserDataTable $datatable)
    {
        $roles = Role::all();
        if(auth()->user()->hasRole('superadmin')){
            $toko = Toko::all();
        }else{
            $toko = [];
        }
        return $datatable->render('user.index', compact('roles','toko'));
    }

    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3|max:100',
            'email' => 'required|email|min:5|max:255|unique:users,email',
            'toko_id' => 'required|exists:tokos,id',
            'password' => 'required|confirmed|min:6',
            'role' =>'required'
        ],[
            'toko_id.required' => 'Toko wajib diisi',
            'toko_id.exists' => 'Toko tidak ditemukan',
            'role.required' => 'Role wajib diisi',
            'password.required' => 'Password wajib diisi',
            'password.confirmed' => 'Password tidak sama',
            'password.min' => 'Password minimal 6 karakter',
            'name.required' => 'Nama wajib diisi',
            'name.min' => 'Nama minimal 3 karakter',
            'name.max' => 'Nama maksimal 100 karakter',
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Email tidak valid',
            'email.min' => 'Email minimal 5 karakter',
            'email.max' => 'Email maksimal 255 karakter',
            'email.unique' => 'Email sudah terdaftar'

        ]);

        $user = User::create($request->all());

        $user->assignRole($request->role);

        return response()->json(['success' => true, 'message' => 'User created successfully', '_token' => csrf_token()]);
    }

    public function edit($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['success' => false, 'message' => 'User not found'], 404);
        }

        $user->role = $user->getRoleNames()[0];

        return response()->json(['success' => true, 'data' => $user, '_token' => csrf_token()]);
    }

    public function update(Request $request, $id)
    {
        
        $request->validate([
            'name' => 'required|min:3|max:100',
            'email' => 'required|email|min:5|max:255|unique:users,email',
            'toko_id' => 'required|exists:tokos,id',
            'password' => 'required|confirmed|min:6',
            'role' =>'required'
        ],[
            'toko_id.required' => 'Toko wajib diisi',
            'toko_id.exists' => 'Toko tidak ditemukan',
            'role.required' => 'Role wajib diisi',
            'password.required' => 'Password wajib diisi',
            'password.confirmed' => 'Password tidak sama',
            'password.min' => 'Password minimal 6 karakter',
            'name.required' => 'Nama wajib diisi',
            'name.min' => 'Nama minimal 3 karakter',
            'name.max' => 'Nama maksimal 100 karakter',
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Email tidak valid',
            'email.min' => 'Email minimal 5 karakter',
            'email.max' => 'Email maksimal 255 karakter',
            'email.unique' => 'Email sudah terdaftar'

        ]);

        $user = User::find($id);

        if (!$user) {
            return response()->json(['success' => false, 'message' => 'User not found'], 404);
        }

        $update = $request->all();

        if ($request->password) {
            $request->merge(['password' => Hash::make($request->password)]);
            $update = $request->all();
        } else {
            unset($request->password);
            $update = $request->except(['password']);
        }

        $user->update($update);

        $user->syncRoles([$request->role]);

        return response()->json(['success' => true, 'message' => 'User update successfully', 'data' => $user, '_token' => csrf_token()]);
    }

    public function destroy($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['success' => true, 'message' => 'User not found'], 404);
        }

        $user->delete();

        return response()->json(['success' => true, 'data' => $user,'message' => 'User deleted successfully', '_token' => csrf_token()]);
    }
}

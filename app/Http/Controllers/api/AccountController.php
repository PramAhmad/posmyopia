<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Toko;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AccountController extends Controller
{
    public function apiAccount(Request $request) : object  {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8',
            'logo' => 'required|string',
            'nama_toko' => 'required|string',
            'domisili' => 'required|string',
            'alamat_usaha' => 'required|string',
            'nohp' => 'required|min:11|max:16',

            
        ],[
            'name.required' => 'Name wajib di isi',
            'email.required' => 'Email wajib di isi',
            'email.email' => 'Email tidak valid',
            'email.unique' => 'Email sudah terdaftar',
            'password.required' => 'Password wajib di isi',
            'password.min' => 'Password minimal 8 karakter',
            'logo.required' => 'Logo wajib di isi',
            'nama_toko.required' => 'Nama Toko wajib di isi',
            'domisili.required' => 'Domisili wajib di isi',
            'alamat_usaha.required' => 'Alamat Usaha wajib di isi',
            'nohp.required' => 'No HP wajib di isi',
            'nohp.min' => 'No HP minimal 11 karakter',
            'nohp.max' => 'No HP maksimal 16 karakter',
            
        ]);
        try {
            $user = $request->only('name', 'email', 'password');
            $toko = $request->only('logo', 'nama_toko', 'domisili', 'alamat_usaha', 'nohp');
            $toko = Toko::create($toko);
            $user['toko_id'] = $toko->id;
            $user['password'] = Hash::make($user['password']);
            $user = User::create(attributes: $user);
            
            $user->assignRole('admin');
    
            return response()->json([
                'message' => 'User created successfully',
                'data' => $user
            ], 201);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Gagal Menambahkan User di POS',
                'data' => $th->getMessage()
            ], 400);
        }
    }

}

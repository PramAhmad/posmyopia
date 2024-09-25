<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'Administrator',
            'email' => 'admin@mail.test',
            'password' => Hash::make('12345678'),
            
        ]);

        $user->assignRole('superadmin');

        $admin = User::create([
            'name' => 'Admin',
    'email' => 'admin@mail.com',
            'password' => Hash::make('12345678'),
            'toko_id' => 4
        ]);

        $admin->assignRole('admin');
    }
}

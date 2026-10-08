<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Super Admin Yayasan',
            'email' => 'superadmin@arrofii.or.id',
            'password' => Hash::make('password123'),
            'is_super_admin' => true,
        ]);

        User::create([
            'name' => 'Admin Lapangan',
            'email' => 'admin@arrofii.or.id',
            'password' => Hash::make('password123'),
            'is_super_admin' => false,
        ]);
    }
}
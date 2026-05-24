<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@alumni.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
            'status' => 'approved',
            'student_id' => 'ADMIN001',
        ]);
    }
}
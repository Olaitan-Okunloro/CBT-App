<?php
// database/seeders/AdminUserSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Super Admin',
            'email' => 'admin@cbtpro.com',
            'password' => Hash::make('password123'),
            'phone' => '08012345678',
            'role' => 'admin',
            'exam_type' => 'GENERAL',
            'is_active' => true,
        ]);
        
        $this->command->info('Admin user created successfully!');
        $this->command->info('Email: admin@cbtpro.com');
        $this->command->info('Password: password123');
    }
}
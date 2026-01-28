<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    public function run(): void
    {
         
        
        // Create admin user
        $admin = User::firstOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make('12345678'),
            ]
        );
        
        // Assign admin role
        $admin->assignRole('admin');
        
        // Create test user
        $user = User::firstOrCreate(
            ['email' => 'user@gmail.com'],
            [
                'name' => 'Test User',
                'password' => Hash::make('12345678'),
            ]
        );
        
        $user->assignRole('user');
        
        // Create vendor user
        $vendor = User::firstOrCreate(
            ['email' => 'vendor@gmail.com'],
            [
                'name' => 'Test Vendor',
                'password' => Hash::make('12345678'),
            ]
        );
        
        $vendor->assignRole('vendor');
    }
}
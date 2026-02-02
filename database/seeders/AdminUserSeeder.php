<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        $adminRole = Role::where('name', 'admin')->first();
        $superAdminRole = Role::where('name', 'super_admin')->first();

        // Create Super Admin
        User::create([
            'name' => 'Super Administrator',
            'email' => 'superadmin@rental.com',
            'phone' => '+251911000000',
            'password' => Hash::make('password123'),
            'role_id' => $superAdminRole->id,
            'status' => 'active',
            'preferred_language' => 'en',
            'email_verified_at' => now(),
            'kyc_status' => 'verified',
            'kyc_verified_at' => now(),
            'verification_level' => 3,
            'can_book' => true,
            'can_purchase' => true,
        ]);

        // Create Admin
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@rental.com',
            'phone' => '+251911000001',
            'password' => Hash::make('password123'),
            'role_id' => $adminRole->id,
            'status' => 'active',
            'preferred_language' => 'en',
            'email_verified_at' => now(),
            'kyc_status' => 'verified',
            'kyc_verified_at' => now(),
            'verification_level' => 3,
            'can_book' => true,
            'can_purchase' => true,
        ]);

        // Create Test Customer (unverified KYC)
        $customerRole = Role::where('name', 'customer')->first();
        User::create([
            'name' => 'Test Customer',
            'email' => 'customer@test.com',
            'phone' => '+251911000002',
            'password' => Hash::make('password123'),
            'role_id' => $customerRole->id,
            'status' => 'active',
            'preferred_language' => 'en',
            'email_verified_at' => now(),
            'kyc_status' => 'unverified',
            'verification_level' => 1,
            'can_book' => false,
            'can_purchase' => false,
        ]);
    }
}
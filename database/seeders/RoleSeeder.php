<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        $roles = [
            [
                'name' => 'customer',
                'display_name' => 'Customer',
                'description' => 'Regular customer who can rent and buy vehicles',
                'permissions' => [
                    'view_vehicles',
                    'create_booking',
                    'create_purchase',
                    'view_own_bookings',
                    'view_own_purchases',
                    'cancel_own_booking',
                    'submit_payment',
                    'contact_support'
                ]
            ],
            [
                'name' => 'admin',
                'display_name' => 'Administrator',
                'description' => 'System administrator with full access',
                'permissions' => [
                    'manage_users',
                    'manage_vehicles',
                    'manage_bookings',
                    'manage_purchases',
                    'verify_payments',
                    'view_reports',
                    'manage_contact_messages',
                    'view_audit_logs'
                ]
            ],
            [
                'name' => 'super_admin',
                'display_name' => 'Super Administrator',
                'description' => 'Super administrator with all permissions',
                'permissions' => [
                    'manage_users',
                    'manage_vehicles',
                    'manage_bookings',
                    'manage_purchases',
                    'verify_payments',
                    'view_reports',
                    'manage_contact_messages',
                    'view_audit_logs',
                    'manage_roles',
                    'system_settings'
                ]
            ]
        ];

        foreach ($roles as $role) {
            Role::create($role);
        }
    }
}
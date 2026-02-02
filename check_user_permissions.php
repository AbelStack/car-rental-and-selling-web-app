<?php

require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

echo "👤 Checking User Booking Permissions...\n\n";

try {
    $users = \App\Models\User::all();
    
    foreach ($users as $user) {
        echo "User {$user->id} ({$user->name}):\n";
        echo "  - KYC Status: {$user->kyc_status}\n";
        echo "  - KYC Verified: " . ($user->isKycVerified() ? 'Yes' : 'No') . "\n";
        echo "  - Can Book: " . ($user->can_book ? 'Yes' : 'No') . "\n";
        echo "  - Can Book Vehicles: " . ($user->canBookVehicles() ? 'Yes' : 'No') . "\n";
        echo "  - Role: {$user->role}\n";
        echo "\n";
    }
    
    // Check if there are any users who can book
    $canBookUsers = $users->filter(function($user) {
        return $user->canBookVehicles();
    });
    
    echo "Summary:\n";
    echo "- Total users: " . $users->count() . "\n";
    echo "- Users who can book: " . $canBookUsers->count() . "\n";
    
    if ($canBookUsers->count() === 0) {
        echo "\n❌ No users can book vehicles!\n";
        echo "To fix this, you need to:\n";
        echo "1. Set user KYC status to 'verified'\n";
        echo "2. Set can_book field to true\n";
        echo "3. Set kyc_verified_at timestamp\n";
        
        // Show how to fix for user ID 1
        echo "\nTo fix for user ID 1, run:\n";
        echo "UPDATE users SET kyc_status='verified', can_book=1, can_purchase=1, kyc_verified_at=NOW() WHERE id=1;\n";
    } else {
        echo "\n✅ Some users can book vehicles\n";
    }
    
} catch (Exception $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
}
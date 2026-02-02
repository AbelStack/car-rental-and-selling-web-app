<?php

require_once 'vendor/autoload.php';

// Load Laravel application
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\User;
use App\Models\Booking;
use Illuminate\Support\Facades\DB;

echo "🔧 Fixing Booking Permissions and Cleaning Test Data...\n\n";

DB::beginTransaction();

try {
    // 1. Ensure all KYC verified users can book
    echo "1️⃣ UPDATING USER PERMISSIONS:\n";
    
    $verifiedUsers = User::where('kyc_status', 'verified')->get();
    
    foreach ($verifiedUsers as $user) {
        $updated = false;
        
        if (!$user->can_book) {
            $user->can_book = true;
            $updated = true;
        }
        
        if (!$user->can_purchase) {
            $user->can_purchase = true;
            $updated = true;
        }
        
        if ($updated) {
            $user->save();
            echo "   ✅ Updated permissions for {$user->name}\n";
        } else {
            echo "   ✓ {$user->name} already has correct permissions\n";
        }
    }
    
    // 2. Clean up test bookings
    echo "\n2️⃣ CLEANING TEST BOOKINGS:\n";
    
    $testBookings = Booking::where('special_requests', 'LIKE', '%test%')
                          ->orWhere('special_requests', 'LIKE', '%Test%')
                          ->get();
    
    if ($testBookings->count() > 0) {
        foreach ($testBookings as $booking) {
            echo "   🗑️ Removing test booking {$booking->booking_reference}\n";
            $booking->delete();
        }
    } else {
        echo "   ✓ No test bookings found\n";
    }
    
    // 3. Update user statistics
    echo "\n3️⃣ FINAL STATISTICS:\n";
    
    $totalUsers = User::count();
    $verifiedUsers = User::where('kyc_status', 'verified')->count();
    $canBookUsers = User::where('can_book', true)->count();
    $canPurchaseUsers = User::where('can_purchase', true)->count();
    
    echo "   - Total users: {$totalUsers}\n";
    echo "   - KYC verified users: {$verifiedUsers}\n";
    echo "   - Users who can book: {$canBookUsers}\n";
    echo "   - Users who can purchase: {$canPurchaseUsers}\n";
    
    // 4. Check for any remaining issues
    echo "\n4️⃣ CHECKING FOR ISSUES:\n";
    
    $problematicUsers = User::where('kyc_status', 'verified')
                           ->where(function($query) {
                               $query->where('can_book', false)
                                     ->orWhere('can_purchase', false);
                           })
                           ->get();
    
    if ($problematicUsers->count() > 0) {
        echo "   ❌ Found users with verification but no permissions:\n";
        foreach ($problematicUsers as $user) {
            echo "     - {$user->name} (ID: {$user->id})\n";
        }
    } else {
        echo "   ✅ All verified users have proper permissions\n";
    }
    
    DB::commit();
    echo "\n✅ All fixes applied successfully!\n";
    
    // 5. Provide user guidance
    echo "\n📋 USER GUIDANCE:\n";
    echo "If users still cannot book vehicles, they should:\n";
    echo "1. Ensure they are logged in\n";
    echo "2. Complete KYC verification if not already done\n";
    echo "3. Select valid pickup and return dates\n";
    echo "4. Choose an available vehicle\n";
    echo "5. Fill all required form fields\n";
    echo "6. Check browser console for JavaScript errors\n";
    echo "7. Try refreshing the page and clearing browser cache\n";
    
} catch (\Exception $e) {
    DB::rollback();
    echo "\n❌ Error during fix process:\n";
    echo "   Error: " . $e->getMessage() . "\n";
    echo "   File: " . $e->getFile() . ":" . $e->getLine() . "\n";
    exit(1);
}
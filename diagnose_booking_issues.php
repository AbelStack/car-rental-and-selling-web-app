<?php

require_once 'vendor/autoload.php';

// Load Laravel application
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\User;
use App\Models\Vehicle;
use App\Models\Booking;
use Illuminate\Support\Facades\Route;

echo "🔍 Comprehensive Booking System Diagnosis...\n\n";

// 1. Check Routes
echo "1️⃣ CHECKING ROUTES:\n";
$bookingRoutes = collect(Route::getRoutes())->filter(function ($route) {
    return str_contains($route->getName() ?? '', 'booking') || 
           str_contains($route->uri(), 'book');
});

foreach ($bookingRoutes as $route) {
    echo "   ✅ {$route->methods()[0]} {$route->uri()} -> {$route->getName()}\n";
}

// 2. Check Users and Permissions
echo "\n2️⃣ CHECKING USER PERMISSIONS:\n";
$users = User::with('role')->get();
$canBookCount = 0;
$verifiedCount = 0;

foreach ($users as $user) {
    $canBook = $user->canBookVehicles();
    $isVerified = $user->isKycVerified();
    
    if ($canBook) $canBookCount++;
    if ($isVerified) $verifiedCount++;
    
    echo "   User {$user->id} ({$user->name}):\n";
    echo "     - KYC Status: {$user->kyc_status}\n";
    echo "     - Can Book: " . ($user->can_book ? 'Yes' : 'No') . "\n";
    echo "     - KYC Verified: " . ($isVerified ? 'Yes' : 'No') . "\n";
    echo "     - Can Book Vehicles: " . ($canBook ? 'Yes' : 'No') . "\n";
    echo "     - Role: {$user->role->display_name}\n\n";
}

echo "   Summary: {$canBookCount} users can book, {$verifiedCount} users are KYC verified\n";

// 3. Check Vehicles
echo "\n3️⃣ CHECKING VEHICLES:\n";
$totalVehicles = Vehicle::count();
$rentalVehicles = Vehicle::where('available_for_rent', true)->count();
$availableRentals = Vehicle::where('available_for_rent', true)
                          ->where('status', 'available')
                          ->count();

echo "   - Total vehicles: {$totalVehicles}\n";
echo "   - Available for rent: {$rentalVehicles}\n";
echo "   - Currently available for rental: {$availableRentals}\n";

if ($availableRentals > 0) {
    $sampleVehicle = Vehicle::where('available_for_rent', true)
                           ->where('status', 'available')
                           ->first();
    echo "   - Sample vehicle: {$sampleVehicle->full_name} (\${$sampleVehicle->rental_price_per_day}/day)\n";
}

// 4. Check Recent Bookings
echo "\n4️⃣ CHECKING RECENT BOOKINGS:\n";
$recentBookings = Booking::with(['user', 'vehicle'])
                        ->orderBy('created_at', 'desc')
                        ->limit(5)
                        ->get();

if ($recentBookings->count() > 0) {
    foreach ($recentBookings as $booking) {
        echo "   - Booking {$booking->id} ({$booking->booking_reference}):\n";
        echo "     User: {$booking->user->name}\n";
        echo "     Vehicle: {$booking->vehicle->full_name}\n";
        echo "     Status: {$booking->status}\n";
        echo "     Created: {$booking->created_at->format('Y-m-d H:i:s')}\n";
        echo "     Amount: \${$booking->total_amount}\n\n";
    }
} else {
    echo "   - No bookings found\n";
}

// 5. Check Database Constraints
echo "\n5️⃣ CHECKING DATABASE CONSTRAINTS:\n";
try {
    $bookingsTable = DB::select("DESCRIBE bookings");
    echo "   ✅ Bookings table structure is accessible\n";
    
    $requiredFields = [
        'user_id', 'vehicle_id', 'pickup_date', 'return_date', 
        'total_days', 'driving_option', 'pickup_location', 
        'return_location', 'daily_rate', 'subtotal', 'tax_amount', 
        'total_amount', 'status'
    ];
    
    $tableFields = collect($bookingsTable)->pluck('Field')->toArray();
    
    foreach ($requiredFields as $field) {
        if (in_array($field, $tableFields)) {
            echo "   ✅ Field '{$field}' exists\n";
        } else {
            echo "   ❌ Field '{$field}' missing\n";
        }
    }
    
} catch (\Exception $e) {
    echo "   ❌ Database error: " . $e->getMessage() . "\n";
}

// 6. Test Booking Creation Process
echo "\n6️⃣ TESTING BOOKING CREATION:\n";
try {
    $testUser = User::where('kyc_status', 'verified')
                   ->where('can_book', true)
                   ->first();
    
    $testVehicle = Vehicle::where('available_for_rent', true)
                         ->where('status', 'available')
                         ->first();
    
    if ($testUser && $testVehicle) {
        echo "   ✅ Test user and vehicle available\n";
        echo "   ✅ User can book: " . ($testUser->canBookVehicles() ? 'Yes' : 'No') . "\n";
        echo "   ✅ Vehicle available: " . ($testVehicle->isAvailableForRent() ? 'Yes' : 'No') . "\n";
        
        // Test date availability
        $pickupDate = now()->addDays(1)->format('Y-m-d');
        $returnDate = now()->addDays(3)->format('Y-m-d');
        
        $isAvailable = $testVehicle->isAvailableForDates($pickupDate, $returnDate);
        echo "   ✅ Vehicle available for test dates: " . ($isAvailable ? 'Yes' : 'No') . "\n";
        
    } else {
        echo "   ❌ No suitable test user or vehicle found\n";
        if (!$testUser) echo "     - No verified users who can book\n";
        if (!$testVehicle) echo "     - No available rental vehicles\n";
    }
    
} catch (\Exception $e) {
    echo "   ❌ Error in booking test: " . $e->getMessage() . "\n";
}

// 7. Check Common Issues
echo "\n7️⃣ CHECKING COMMON ISSUES:\n";

// Check if middleware is working
echo "   - Auth middleware: ";
try {
    $middleware = app('router')->getMiddleware();
    echo isset($middleware['auth']) ? "✅ Registered" : "❌ Missing";
} catch (\Exception $e) {
    echo "❌ Error checking middleware";
}
echo "\n";

// Check if sessions are working
echo "   - Session configuration: ";
try {
    $sessionDriver = config('session.driver');
    echo "✅ Driver: {$sessionDriver}\n";
} catch (\Exception $e) {
    echo "❌ Session config error\n";
}

// Check CSRF protection
echo "   - CSRF protection: ";
try {
    $csrfToken = csrf_token();
    echo strlen($csrfToken) > 0 ? "✅ Working" : "❌ Not working";
} catch (\Exception $e) {
    echo "❌ CSRF error";
}
echo "\n";

echo "\n✅ Diagnosis completed!\n";

// Summary and recommendations
echo "\n📋 SUMMARY & RECOMMENDATIONS:\n";

if ($canBookCount === 0) {
    echo "❌ CRITICAL: No users can book vehicles\n";
    echo "   → Check KYC verification and user permissions\n";
}

if ($availableRentals === 0) {
    echo "❌ CRITICAL: No vehicles available for rental\n";
    echo "   → Check vehicle availability settings\n";
}

if ($canBookCount > 0 && $availableRentals > 0) {
    echo "✅ GOOD: System has users who can book and vehicles available\n";
    echo "   → Booking system should be functional\n";
    echo "   → If users report issues, check:\n";
    echo "     - Browser JavaScript errors\n";
    echo "     - Form validation messages\n";
    echo "     - Network connectivity\n";
    echo "     - Server error logs\n";
}
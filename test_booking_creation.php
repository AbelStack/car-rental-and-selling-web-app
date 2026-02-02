<?php

require_once 'vendor/autoload.php';

// Load Laravel application
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\User;
use App\Models\Vehicle;
use App\Models\Booking;
use App\Services\DiscountService;
use Illuminate\Support\Facades\DB;

echo "🧪 Testing Booking Creation Process...\n\n";

try {
    // Find a verified user who can book
    $user = User::where('kyc_status', 'verified')
                ->where('can_book', true)
                ->first();
    
    if (!$user) {
        echo "❌ No verified users found who can book\n";
        exit(1);
    }
    
    echo "✅ Found verified user: {$user->name} (ID: {$user->id})\n";
    
    // Find an available rental vehicle
    $vehicle = Vehicle::where('available_for_rent', true)
                     ->where('status', 'available')
                     ->first();
    
    if (!$vehicle) {
        echo "❌ No available rental vehicles found\n";
        exit(1);
    }
    
    echo "✅ Found available vehicle: {$vehicle->full_name} (ID: {$vehicle->id})\n";
    
    // Test booking data
    $bookingData = [
        'pickup_date' => now()->addDays(1)->format('Y-m-d'),
        'return_date' => now()->addDays(3)->format('Y-m-d'),
        'driving_option' => 'self_drive',
        'pickup_location' => 'Test Pickup Location',
        'return_location' => 'Test Return Location',
        'special_requests' => 'Test booking creation',
    ];
    
    echo "📅 Booking dates: {$bookingData['pickup_date']} to {$bookingData['return_date']}\n";
    
    // Calculate pricing
    $pickupDate = \Carbon\Carbon::parse($bookingData['pickup_date']);
    $returnDate = \Carbon\Carbon::parse($bookingData['return_date']);
    $totalDays = $pickupDate->diffInDays($returnDate) + 1;
    
    $dailyRate = $vehicle->rental_price_per_day;
    $driverCost = $bookingData['driving_option'] === 'with_driver' ? ($vehicle->driver_cost_per_day ?? 0) : 0;
    $subtotal = ($dailyRate * $totalDays) + ($driverCost * $totalDays);
    
    echo "💰 Pricing calculation:\n";
    echo "   - Daily rate: \${$dailyRate}\n";
    echo "   - Total days: {$totalDays}\n";
    echo "   - Driver cost: \${$driverCost}\n";
    echo "   - Subtotal: \${$subtotal}\n";
    
    // Test discount service
    $discountService = new DiscountService();
    $discountData = $discountService->calculateDiscount(
        'rental',
        $subtotal,
        $bookingData['pickup_date'],
        $bookingData['return_date']
    );
    
    echo "🎯 Discount calculation:\n";
    echo "   - Has discount: " . ($discountData['has_discount'] ? 'Yes' : 'No') . "\n";
    echo "   - Discount amount: \${$discountData['discount_amount']}\n";
    echo "   - Final amount: \${$discountData['final_amount']}\n";
    
    $taxAmount = $discountData['final_amount'] * 0.15;
    $totalAmount = $discountData['final_amount'] + $taxAmount;
    
    echo "   - Tax (15%): \${$taxAmount}\n";
    echo "   - Total amount: \${$totalAmount}\n\n";
    
    // Test booking creation
    DB::beginTransaction();
    
    $booking = Booking::create([
        'user_id' => $user->id,
        'vehicle_id' => $vehicle->id,
        'pickup_date' => $bookingData['pickup_date'],
        'return_date' => $bookingData['return_date'],
        'total_days' => $totalDays,
        'driving_option' => $bookingData['driving_option'],
        'pickup_location' => $bookingData['pickup_location'],
        'return_location' => $bookingData['return_location'],
        'daily_rate' => $dailyRate,
        'driver_cost' => $driverCost,
        'subtotal' => $subtotal,
        'tax_amount' => $taxAmount,
        'total_amount' => $totalAmount,
        'special_requests' => $bookingData['special_requests'],
        'status' => 'pending_payment',
        // Discount fields
        'discount_id' => $discountData['has_discount'] ? $discountData['discount']->id : null,
        'discount_type' => $discountData['has_discount'] ? $discountData['discount']->type : null,
        'discount_percentage' => $discountData['has_discount'] ? $discountData['discount']->percentage : null,
        'discount_amount' => $discountData['discount_amount'],
        'original_total' => $discountData['original_amount'],
        'discount_reason' => $discountData['discount_reason'],
    ]);
    
    echo "✅ Booking created successfully!\n";
    echo "   - Booking ID: {$booking->id}\n";
    echo "   - Reference: {$booking->booking_reference}\n";
    echo "   - Status: {$booking->status}\n";
    echo "   - Total Amount: \${$booking->total_amount}\n";
    
    // Rollback to avoid cluttering the database
    DB::rollback();
    echo "\n🔄 Transaction rolled back (test mode)\n";
    
    echo "\n✅ Booking creation test completed successfully!\n";
    
} catch (\Exception $e) {
    DB::rollback();
    echo "\n❌ Error during booking creation test:\n";
    echo "   Error: " . $e->getMessage() . "\n";
    echo "   File: " . $e->getFile() . ":" . $e->getLine() . "\n";
    
    if ($e->getPrevious()) {
        echo "   Previous: " . $e->getPrevious()->getMessage() . "\n";
    }
    
    exit(1);
}
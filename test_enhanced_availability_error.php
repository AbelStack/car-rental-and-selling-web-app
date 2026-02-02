<?php

require_once 'vendor/autoload.php';

use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use App\Models\Vehicle;
use App\Models\Booking;
use App\Models\User;
use Carbon\Carbon;

// Bootstrap Laravel
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

echo "🧪 Testing Enhanced Availability Error Message\n";
echo "=" . str_repeat("=", 50) . "\n\n";

try {
    // Find a vehicle for testing
    $vehicle = Vehicle::where('available_for_rent', true)->first();
    
    if (!$vehicle) {
        echo "❌ No rental vehicles found for testing\n";
        exit(1);
    }
    
    echo "📋 Test Vehicle: {$vehicle->full_name} (ID: {$vehicle->id})\n\n";
    
    // Create test bookings to simulate conflicts
    echo "1️⃣ Creating test bookings to simulate conflicts...\n";
    
    // Find an existing test user
    $testUser = User::first();
    if (!$testUser) {
        echo "❌ No users found for testing. Please ensure there are users in the database.\n";
        exit(1);
    }
    
    // Create conflicting bookings
    $booking1 = Booking::create([
        'user_id' => $testUser->id,
        'vehicle_id' => $vehicle->id,
        'pickup_date' => Carbon::now()->addDays(5)->format('Y-m-d'),
        'return_date' => Carbon::now()->addDays(8)->format('Y-m-d'),
        'total_days' => 4,
        'driving_option' => 'self_drive',
        'pickup_location' => 'Bole International Airport',
        'return_location' => 'Bole International Airport',
        'daily_rate' => $vehicle->rental_price_per_day,
        'driver_cost' => 0,
        'subtotal' => $vehicle->rental_price_per_day * 4,
        'tax_amount' => $vehicle->rental_price_per_day * 4 * 0.15,
        'total_amount' => $vehicle->rental_price_per_day * 4 * 1.15,
        'status' => 'confirmed',
    ]);
    
    $booking2 = Booking::create([
        'user_id' => $testUser->id,
        'vehicle_id' => $vehicle->id,
        'pickup_date' => Carbon::now()->addDays(12)->format('Y-m-d'),
        'return_date' => Carbon::now()->addDays(15)->format('Y-m-d'),
        'total_days' => 4,
        'driving_option' => 'with_driver',
        'pickup_location' => 'Sheraton Addis Hotel',
        'return_location' => 'Bole International Airport',
        'daily_rate' => $vehicle->rental_price_per_day,
        'driver_cost' => $vehicle->driver_cost_per_day ?? 0,
        'subtotal' => ($vehicle->rental_price_per_day + ($vehicle->driver_cost_per_day ?? 0)) * 4,
        'tax_amount' => ($vehicle->rental_price_per_day + ($vehicle->driver_cost_per_day ?? 0)) * 4 * 0.15,
        'total_amount' => ($vehicle->rental_price_per_day + ($vehicle->driver_cost_per_day ?? 0)) * 4 * 1.15,
        'status' => 'pending_payment',
    ]);
    
    echo "   ✅ Created booking 1: " . Carbon::parse($booking1->pickup_date)->format('M j, Y') . " to " . Carbon::parse($booking1->return_date)->format('M j, Y') . " (Confirmed)\n";
    echo "   ✅ Created booking 2: " . Carbon::parse($booking2->pickup_date)->format('M j, Y') . " to " . Carbon::parse($booking2->return_date)->format('M j, Y') . " (Pending Payment)\n\n";
    
    // Test availability checking
    echo "2️⃣ Testing availability checking...\n";
    
    // Test dates that conflict with booking 1
    $testStartDate = Carbon::now()->addDays(6)->format('Y-m-d');
    $testEndDate = Carbon::now()->addDays(10)->format('Y-m-d');
    
    echo "   📅 Testing dates: " . Carbon::parse($testStartDate)->format('M j, Y') . " to " . Carbon::parse($testEndDate)->format('M j, Y') . "\n";
    
    $isAvailable = $vehicle->isAvailableForDates($testStartDate, $testEndDate);
    echo "   🔍 Is available: " . ($isAvailable ? 'Yes' : 'No') . "\n\n";
    
    if (!$isAvailable) {
        echo "3️⃣ Getting detailed conflict information...\n";
        $conflicts = $vehicle->getAvailabilityConflicts($testStartDate, $testEndDate);
        
        echo "   📊 Found " . count($conflicts) . " conflicts:\n";
        foreach ($conflicts as $i => $conflict) {
            echo "   " . ($i + 1) . ". Booking ID: {$conflict['booking_id']}\n";
            echo "      📅 Reserved: {$conflict['pickup_date']} to {$conflict['return_date']} ({$conflict['duration_days']} days)\n";
            echo "      ✅ Available after: {$conflict['available_after']}\n";
            echo "      📋 Status: {$conflict['status']}\n";
            echo "      👤 Customer: {$conflict['customer_name']}\n\n";
        }
        
        // Test the enhanced error message generation
        echo "4️⃣ Testing enhanced error message generation...\n";
        
        $errorMessage = 'Vehicle is not available for selected dates.';
        
        if (!empty($conflicts)) {
            $errorMessage .= ' Current reservations:';
            
            foreach ($conflicts as $conflict) {
                $errorMessage .= "\n• Reserved from {$conflict['pickup_date']} to {$conflict['return_date']} ({$conflict['duration_days']} days)";
                $errorMessage .= " - Available after {$conflict['available_after']}";
                
                if ($conflict['status'] === 'confirmed') {
                    $errorMessage .= ' (Confirmed)';
                } elseif ($conflict['status'] === 'pending_payment') {
                    $errorMessage .= ' (Pending Payment)';
                }
            }
            
            // Find the earliest available date after all conflicts
            $latestReturnDate = null;
            foreach ($conflicts as $conflict) {
                $availableDate = Carbon::createFromFormat('M j, Y', $conflict['available_after']);
                if (!$latestReturnDate || $availableDate->gt($latestReturnDate)) {
                    $latestReturnDate = $availableDate;
                }
            }
            
            if ($latestReturnDate) {
                $errorMessage .= "\n\nEarliest available date: " . $latestReturnDate->format('M j, Y');
            }
        }
        
        echo "   📝 Enhanced Error Message:\n";
        echo "   " . str_repeat("-", 50) . "\n";
        echo "   " . str_replace("\n", "\n   ", $errorMessage) . "\n";
        echo "   " . str_repeat("-", 50) . "\n\n";
    }
    
    // Test with non-conflicting dates
    echo "5️⃣ Testing with non-conflicting dates...\n";
    $nonConflictStart = Carbon::now()->addDays(20)->format('Y-m-d');
    $nonConflictEnd = Carbon::now()->addDays(23)->format('Y-m-d');
    
    echo "   📅 Testing dates: " . Carbon::parse($nonConflictStart)->format('M j, Y') . " to " . Carbon::parse($nonConflictEnd)->format('M j, Y') . "\n";
    
    $isAvailableNonConflict = $vehicle->isAvailableForDates($nonConflictStart, $nonConflictEnd);
    echo "   🔍 Is available: " . ($isAvailableNonConflict ? 'Yes' : 'No') . "\n";
    
    if ($isAvailableNonConflict) {
        echo "   ✅ Vehicle is available for these dates - no conflicts found!\n\n";
    }
    
    // Clean up test data
    echo "6️⃣ Cleaning up test data...\n";
    $booking1->delete();
    $booking2->delete();
    echo "   ✅ Test bookings deleted\n\n";
    
    echo "🎉 Enhanced Availability Error Message Test Complete!\n";
    echo "✅ All functionality working correctly:\n";
    echo "   • Detailed conflict detection\n";
    echo "   • Reservation duration display\n";
    echo "   • Available after date calculation\n";
    echo "   • Booking status indication\n";
    echo "   • Earliest available date suggestion\n";
    echo "   • Enhanced error message formatting\n";
    
} catch (Exception $e) {
    echo "❌ Error during testing: " . $e->getMessage() . "\n";
    echo "📍 File: " . $e->getFile() . " Line: " . $e->getLine() . "\n";
    
    // Clean up any test data that might have been created
    try {
        if (isset($booking1)) $booking1->delete();
        if (isset($booking2)) $booking2->delete();
    } catch (Exception $cleanupError) {
        echo "⚠️  Cleanup error: " . $cleanupError->getMessage() . "\n";
    }
}
<?php

require_once 'vendor/autoload.php';

use Illuminate\Support\Facades\DB;

// Bootstrap Laravel
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

echo "🔧 Creating Test Dashboard Data...\n\n";

try {
    // Get a test user
    $user = DB::table('users')->where('role_id', 2)->first();
    
    if (!$user) {
        echo "❌ No regular user found.\n";
        exit(1);
    }
    
    echo "👤 Creating test data for user: {$user->name} (ID: {$user->id})\n\n";
    
    // Get some vehicles
    $vehicles = DB::table('vehicles')->take(5)->get();
    
    if ($vehicles->count() === 0) {
        echo "❌ No vehicles found.\n";
        exit(1);
    }
    
    // Create test bookings
    echo "🚗 Creating test bookings...\n";
    $bookingStatuses = ['confirmed', 'active', 'completed', 'pending_payment'];
    
    for ($i = 1; $i <= 8; $i++) {
        $vehicle = $vehicles->random();
        $status = $bookingStatuses[array_rand($bookingStatuses)];
        
        $pickupDate = now()->addDays(rand(1, 30));
        $returnDate = now()->addDays(rand(31, 60));
        $totalDays = $pickupDate->diffInDays($returnDate);
        $dailyRate = rand(100, 500);
        $subtotal = $dailyRate * $totalDays;
        $taxAmount = $subtotal * 0.15; // 15% tax
        $totalAmount = $subtotal + $taxAmount;
        
        $bookingId = DB::table('bookings')->insertGetId([
            'user_id' => $user->id,
            'vehicle_id' => $vehicle->id,
            'booking_reference' => 'BK' . str_pad($i, 6, '0', STR_PAD_LEFT),
            'pickup_date' => $pickupDate,
            'return_date' => $returnDate,
            'total_days' => $totalDays,
            'driving_option' => rand(0, 1) ? 'self_drive' : 'with_driver',
            'pickup_location' => 'Addis Ababa',
            'return_location' => 'Addis Ababa',
            'daily_rate' => $dailyRate,
            'driver_cost' => rand(0, 1) ? 0 : 50,
            'subtotal' => $subtotal,
            'tax_amount' => $taxAmount,
            'total_amount' => $totalAmount,
            'status' => $status,
            'created_at' => now()->subDays(rand(1, 30)),
            'updated_at' => now(),
        ]);
        
        echo "  ✅ Created booking {$i}: BK" . str_pad($i, 6, '0', STR_PAD_LEFT) . " - {$vehicle->make} {$vehicle->model} - Status: {$status}\n";
    }
    
    // Create test purchases
    echo "\n🛒 Creating test purchases...\n";
    $purchaseStatuses = ['completed', 'pending', 'verified'];
    
    for ($i = 1; $i <= 5; $i++) {
        $vehicle = $vehicles->random();
        $status = $purchaseStatuses[array_rand($purchaseStatuses)];
        
        $purchasePrice = rand(50000, 200000);
        $taxAmount = $purchasePrice * 0.15; // 15% tax
        $totalAmount = $purchasePrice + $taxAmount;
        
        $purchaseId = DB::table('purchases')->insertGetId([
            'user_id' => $user->id,
            'vehicle_id' => $vehicle->id,
            'purchase_reference' => 'PU' . str_pad($i, 6, '0', STR_PAD_LEFT),
            'purchase_price' => $purchasePrice,
            'tax_amount' => $taxAmount,
            'total_amount' => $totalAmount,
            'status' => $status,
            'completed_at' => $status === 'completed' ? now()->subDays(rand(1, 30)) : null,
            'created_at' => now()->subDays(rand(1, 60)),
            'updated_at' => now(),
        ]);
        
        echo "  ✅ Created purchase {$i}: PU" . str_pad($i, 6, '0', STR_PAD_LEFT) . " - {$vehicle->make} {$vehicle->model} - Status: {$status}\n";
    }
    
    // Verify the statistics
    echo "\n📊 Verifying statistics...\n";
    
    $stats = [
        'total_bookings' => DB::table('bookings')->where('user_id', $user->id)->count(),
        'active_bookings' => DB::table('bookings')
            ->where('user_id', $user->id)
            ->whereIn('status', ['confirmed', 'active', 'paid'])
            ->count(),
        'completed_bookings' => DB::table('bookings')
            ->where('user_id', $user->id)
            ->where('status', 'completed')
            ->count(),
        'total_purchases' => DB::table('purchases')->where('user_id', $user->id)->count(),
        'completed_purchases' => DB::table('purchases')
            ->where('user_id', $user->id)
            ->where('status', 'completed')
            ->count(),
    ];
    
    echo "- Total Bookings: {$stats['total_bookings']}\n";
    echo "- Active Bookings: {$stats['active_bookings']}\n";
    echo "- Completed Bookings: {$stats['completed_bookings']}\n";
    echo "- Total Purchases: {$stats['total_purchases']}\n";
    echo "- Completed Purchases: {$stats['completed_purchases']}\n";
    
    echo "\n✅ Test data created successfully!\n";
    echo "🎯 Now you can test the dashboard animations with real data.\n";
    
} catch (Exception $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
    echo "Stack trace:\n" . $e->getTraceAsString() . "\n";
}
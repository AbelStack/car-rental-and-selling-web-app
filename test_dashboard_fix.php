<?php

require_once 'vendor/autoload.php';

// Bootstrap Laravel
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

// Create a request
$request = Illuminate\Http\Request::capture();
$response = $kernel->handle($request);

// Set up database connection
$app->make('db');

echo "=== DASHBOARD FIX TEST ===\n\n";

try {
    // Get a user with data
    $user = DB::table('users')->first();
    echo "Testing with user: {$user->name} (ID: {$user->id})\n";
    
    // Test bookings with proper image loading
    echo "\n=== TESTING BOOKINGS ===\n";
    $bookings = DB::table('bookings')
        ->join('vehicles', 'bookings.vehicle_id', '=', 'vehicles.id')
        ->leftJoin('vehicle_images', function($join) {
            $join->on('vehicles.id', '=', 'vehicle_images.vehicle_id')
                 ->where('vehicle_images.is_primary', '=', 1);
        })
        ->where('bookings.user_id', $user->id)
        ->select(
            'bookings.*',
            'vehicles.make',
            'vehicles.model',
            'vehicles.year',
            'vehicle_images.image_path as primary_image'
        )
        ->get();
    
    echo "Found " . $bookings->count() . " bookings\n";
    foreach ($bookings->take(3) as $booking) {
        echo "- {$booking->year} {$booking->make} {$booking->model}\n";
        echo "  Status: {$booking->status}\n";
        echo "  Reference: {$booking->booking_reference}\n";
        echo "  Image: " . ($booking->primary_image ? "✅ {$booking->primary_image}" : "❌ No image") . "\n";
        echo "\n";
    }
    
    // Test purchases with proper image loading
    echo "=== TESTING PURCHASES ===\n";
    $purchases = DB::table('purchases')
        ->join('vehicles', 'purchases.vehicle_id', '=', 'vehicles.id')
        ->leftJoin('vehicle_images', function($join) {
            $join->on('vehicles.id', '=', 'vehicle_images.vehicle_id')
                 ->where('vehicle_images.is_primary', '=', 1);
        })
        ->where('purchases.user_id', $user->id)
        ->select(
            'purchases.*',
            'vehicles.make',
            'vehicles.model',
            'vehicles.year',
            'vehicle_images.image_path as primary_image'
        )
        ->get();
    
    echo "Found " . $purchases->count() . " purchases\n";
    foreach ($purchases->take(3) as $purchase) {
        echo "- {$purchase->year} {$purchase->make} {$purchase->model}\n";
        echo "  Status: {$purchase->status}\n";
        echo "  Reference: {$purchase->purchase_reference}\n";
        echo "  Image: " . ($purchase->primary_image ? "✅ {$purchase->primary_image}" : "❌ No image") . "\n";
        echo "\n";
    }
    
    // Test statistics
    echo "=== TESTING STATISTICS ===\n";
    $stats = [
        'total_bookings' => DB::table('bookings')->where('user_id', $user->id)->count(),
        'active_bookings' => DB::table('bookings')->where('user_id', $user->id)->whereIn('status', ['confirmed', 'active', 'paid'])->count(),
        'total_purchases' => DB::table('purchases')->where('user_id', $user->id)->count(),
        'completed_purchases' => DB::table('purchases')->where('user_id', $user->id)->where('status', 'completed')->count(),
    ];
    
    foreach ($stats as $key => $value) {
        echo "- " . ucfirst(str_replace('_', ' ', $key)) . ": $value\n";
    }
    
    echo "\n✅ Dashboard data should now display correctly!\n";
    
} catch (Exception $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
    echo "Stack trace:\n" . $e->getTraceAsString() . "\n";
}

echo "\n=== TEST COMPLETE ===\n";
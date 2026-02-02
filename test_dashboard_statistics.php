<?php

require_once 'vendor/autoload.php';

use Illuminate\Support\Facades\DB;

// Bootstrap Laravel
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

echo "🔍 Testing Dashboard Statistics...\n\n";

try {
    // Get a test user
    $user = DB::table('users')->where('role_id', 2)->first(); // Regular user
    
    if (!$user) {
        echo "❌ No regular user found. Creating test user...\n";
        
        $userId = DB::table('users')->insertGetId([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'phone' => '+251911000000',
            'password' => bcrypt('password'),
            'role_id' => 2,
            'status' => 'active',
            'kyc_status' => 'verified',
            'kyc_verified_at' => now(),
            'can_book' => true,
            'can_purchase' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        
        $user = DB::table('users')->find($userId);
        echo "✅ Test user created with ID: {$userId}\n";
    }
    
    echo "👤 Testing with user: {$user->name} (ID: {$user->id})\n\n";
    
    // Test statistics calculation
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
    
    echo "📊 Statistics Results:\n";
    echo "- Total Bookings: {$stats['total_bookings']}\n";
    echo "- Active Bookings: {$stats['active_bookings']}\n";
    echo "- Completed Bookings: {$stats['completed_bookings']}\n";
    echo "- Total Purchases: {$stats['total_purchases']}\n";
    echo "- Completed Purchases: {$stats['completed_purchases']}\n\n";
    
    // Test recent bookings
    $bookings = DB::table('bookings')
        ->join('vehicles', 'bookings.vehicle_id', '=', 'vehicles.id')
        ->where('bookings.user_id', $user->id)
        ->select('bookings.*', 'vehicles.make', 'vehicles.model', 'vehicles.year')
        ->orderBy('bookings.created_at', 'desc')
        ->take(5)
        ->get();
    
    echo "🚗 Recent Bookings ({$bookings->count()}):\n";
    foreach ($bookings as $booking) {
        echo "- {$booking->booking_reference}: {$booking->make} {$booking->model} {$booking->year} - Status: {$booking->status}\n";
    }
    
    // Test recent purchases
    $purchases = DB::table('purchases')
        ->join('vehicles', 'purchases.vehicle_id', '=', 'vehicles.id')
        ->where('purchases.user_id', $user->id)
        ->select('purchases.*', 'vehicles.make', 'vehicles.model', 'vehicles.year')
        ->orderBy('purchases.created_at', 'desc')
        ->take(5)
        ->get();
    
    echo "\n🛒 Recent Purchases ({$purchases->count()}):\n";
    foreach ($purchases as $purchase) {
        echo "- {$purchase->purchase_reference}: {$purchase->make} {$purchase->model} {$purchase->year} - Status: {$purchase->status}\n";
    }
    
    echo "\n✅ Dashboard statistics test completed successfully!\n";
    
    // Test if there are any vehicles available
    $vehicleCount = DB::table('vehicles')->count();
    echo "\n📈 Additional Info:\n";
    echo "- Total vehicles in system: {$vehicleCount}\n";
    
    if ($vehicleCount === 0) {
        echo "⚠️  Warning: No vehicles found. This might affect dashboard functionality.\n";
    }
    
} catch (Exception $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
    echo "Stack trace:\n" . $e->getTraceAsString() . "\n";
}
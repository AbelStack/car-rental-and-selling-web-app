<?php

require_once 'vendor/autoload.php';

use Illuminate\Support\Facades\DB;

// Bootstrap Laravel
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

echo "🛒 Adding Test Purchases...\n\n";

try {
    // Get a test user
    $user = DB::table('users')->where('role_id', 2)->first();
    $vehicles = DB::table('vehicles')->take(5)->get();
    
    // Create test purchases with unique references
    $purchaseStatuses = ['completed', 'pending', 'verified'];
    
    for ($i = 1; $i <= 5; $i++) {
        $vehicle = $vehicles->random();
        $status = $purchaseStatuses[array_rand($purchaseStatuses)];
        
        $purchasePrice = rand(50000, 200000);
        $taxAmount = $purchasePrice * 0.15; // 15% tax
        $totalAmount = $purchasePrice + $taxAmount;
        
        // Generate unique reference
        $reference = 'PU' . str_pad(time() + $i, 8, '0', STR_PAD_LEFT);
        
        $purchaseId = DB::table('purchases')->insertGetId([
            'user_id' => $user->id,
            'vehicle_id' => $vehicle->id,
            'purchase_reference' => $reference,
            'purchase_price' => $purchasePrice,
            'tax_amount' => $taxAmount,
            'total_amount' => $totalAmount,
            'status' => $status,
            'completed_at' => $status === 'completed' ? now()->subDays(rand(1, 30)) : null,
            'created_at' => now()->subDays(rand(1, 60)),
            'updated_at' => now(),
        ]);
        
        echo "  ✅ Created purchase {$i}: {$reference} - {$vehicle->make} {$vehicle->model} - Status: {$status}\n";
    }
    
    echo "\n✅ Test purchases created successfully!\n";
    
} catch (Exception $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
}
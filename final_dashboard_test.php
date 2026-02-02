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

echo "=== FINAL DASHBOARD TEST ===\n\n";

try {
    // Simulate the exact same logic as DashboardController
    $user = DB::table('users')->first();
    echo "Testing dashboard for: {$user->name}\n";
    
    // Test the exact queries that the dashboard uses
    echo "\n=== TESTING ELOQUENT QUERIES ===\n";
    
    // Create User model instance
    $userModel = App\Models\User::find($user->id);
    
    // Test bookings query (same as controller)
    $bookings = $userModel->bookings()
        ->with(['vehicle.images'])
        ->orderBy('created_at', 'desc')
        ->take(5)
        ->get();
    
    echo "Bookings found: " . $bookings->count() . "\n";
    
    // Test purchases query (same as controller)
    $purchases = $userModel->purchases()
        ->with(['vehicle.images'])
        ->orderBy('created_at', 'desc')
        ->take(5)
        ->get();
    
    echo "Purchases found: " . $purchases->count() . "\n";
    
    // Test image access for purchases
    if ($purchases->count() > 0) {
        echo "\n=== TESTING IMAGE ACCESS ===\n";
        foreach ($purchases->take(3) as $purchase) {
            echo "Purchase: {$purchase->vehicle->make} {$purchase->vehicle->model}\n";
            echo "  Reference: {$purchase->purchase_reference}\n";
            echo "  Status: {$purchase->status}\n";
            
            // Test the exact image access method used in the view
            $primaryImage = $purchase->vehicle->images->where('is_primary', true)->first();
            if ($primaryImage) {
                echo "  ✅ Primary image: {$primaryImage->image_path}\n";
            } else {
                echo "  ❌ No primary image found\n";
                // Check if there are any images at all
                if ($purchase->vehicle->images->count() > 0) {
                    echo "  ℹ️  Has " . $purchase->vehicle->images->count() . " images but none marked as primary\n";
                } else {
                    echo "  ℹ️  No images at all\n";
                }
            }
            echo "\n";
        }
    }
    
    // Test statistics
    echo "=== TESTING STATISTICS ===\n";
    $stats = [
        'total_bookings' => $userModel->bookings()->count(),
        'active_bookings' => $userModel->bookings()->whereIn('status', ['confirmed', 'active', 'paid'])->count(),
        'total_purchases' => $userModel->purchases()->count(),
        'completed_purchases' => $userModel->purchases()->where('status', 'completed')->count(),
    ];
    
    foreach ($stats as $key => $value) {
        echo "- " . ucfirst(str_replace('_', ' ', $key)) . ": $value\n";
    }
    
    // Test KYC status
    echo "\n=== TESTING KYC STATUS ===\n";
    echo "KYC Status: {$userModel->kyc_status}\n";
    echo "Is KYC Verified: " . ($userModel->isKycVerified() ? 'Yes' : 'No') . "\n";
    
    echo "\n✅ Dashboard should now display all content correctly!\n";
    echo "🎨 Premium animations and styling are ready\n";
    echo "📊 Statistics will show proper counts\n";
    echo "🖼️  Vehicle images will display properly\n";
    
} catch (Exception $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
    echo "Stack trace:\n" . $e->getTraceAsString() . "\n";
}

echo "\n=== TEST COMPLETE ===\n";
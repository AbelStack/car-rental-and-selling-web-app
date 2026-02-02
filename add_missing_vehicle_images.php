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

echo "=== ADDING MISSING VEHICLE IMAGES ===\n\n";

try {
    // Define specific images for the missing vehicles
    $vehicleImages = [
        6 => [ // Toyota Land Cruiser
            'image_path' => 'https://images.unsplash.com/photo-1544636331-e26879cd4d9b?w=800&q=80',
            'alt_text' => '2020 Toyota Land Cruiser - Premium SUV'
        ],
        7 => [ // Honda Civic
            'image_path' => 'https://images.unsplash.com/photo-1606664515524-ed2f786a0bd6?w=800&q=80',
            'alt_text' => 'Honda Civic - Reliable Sedan'
        ],
        8 => [ // Nissan Patrol
            'image_path' => 'https://images.unsplash.com/photo-1581540222194-0def2dda95b8?w=800&q=80',
            'alt_text' => 'Nissan Patrol - Powerful SUV'
        ]
    ];
    
    foreach ($vehicleImages as $vehicleId => $imageData) {
        // Check if vehicle exists
        $vehicle = DB::table('vehicles')->where('id', $vehicleId)->first();
        if (!$vehicle) {
            echo "❌ Vehicle ID $vehicleId not found\n";
            continue;
        }
        
        // Check if image already exists
        $existingImage = DB::table('vehicle_images')->where('vehicle_id', $vehicleId)->first();
        if ($existingImage) {
            echo "ℹ️  Vehicle {$vehicle->make} {$vehicle->model} already has images\n";
            continue;
        }
        
        // Add the image
        DB::table('vehicle_images')->insert([
            'vehicle_id' => $vehicleId,
            'image_path' => $imageData['image_path'],
            'alt_text' => $imageData['alt_text'],
            'is_primary' => 1,
            'sort_order' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        
        echo "✅ Added image for {$vehicle->make} {$vehicle->model}\n";
        echo "   Image: {$imageData['image_path']}\n";
    }
    
    // Verify the fix
    echo "\n=== VERIFICATION ===\n";
    $user = DB::table('users')->first();
    $purchasesWithImages = DB::table('purchases')
        ->join('vehicles', 'purchases.vehicle_id', '=', 'vehicles.id')
        ->leftJoin('vehicle_images', function($join) {
            $join->on('vehicles.id', '=', 'vehicle_images.vehicle_id')
                 ->where('vehicle_images.is_primary', '=', 1);
        })
        ->where('purchases.user_id', $user->id)
        ->select(
            'purchases.purchase_reference',
            'vehicles.make',
            'vehicles.model',
            'vehicle_images.image_path'
        )
        ->get();
    
    echo "User purchases with images:\n";
    foreach ($purchasesWithImages as $purchase) {
        echo "- {$purchase->make} {$purchase->model} ({$purchase->purchase_reference})\n";
        echo "  Image: " . ($purchase->image_path ? "✅ Available" : "❌ Missing") . "\n";
    }
    
} catch (Exception $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
}

echo "\n=== COMPLETE ===\n";
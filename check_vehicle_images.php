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

echo "=== VEHICLE IMAGES CHECK ===\n\n";

try {
    // Check vehicle_images table
    $imageCount = DB::table('vehicle_images')->count();
    echo "Total vehicle images: $imageCount\n";
    
    if ($imageCount > 0) {
        echo "\nSample vehicle images:\n";
        $images = DB::table('vehicle_images')
            ->join('vehicles', 'vehicle_images.vehicle_id', '=', 'vehicles.id')
            ->select('vehicle_images.*', 'vehicles.make', 'vehicles.model')
            ->take(5)
            ->get();
        
        foreach ($images as $image) {
            echo "- Vehicle: {$image->make} {$image->model}\n";
            echo "  Image: {$image->image_path}\n";
            echo "  Primary: " . ($image->is_primary ? 'Yes' : 'No') . "\n";
            echo "\n";
        }
        
        // Check how many vehicles have primary images
        $vehiclesWithPrimary = DB::table('vehicles')
            ->join('vehicle_images', 'vehicles.id', '=', 'vehicle_images.vehicle_id')
            ->where('vehicle_images.is_primary', 1)
            ->count();
        
        echo "Vehicles with primary images: $vehiclesWithPrimary\n";
        
        // Check vehicles without primary images
        $vehiclesWithoutPrimary = DB::table('vehicles')
            ->leftJoin('vehicle_images', function($join) {
                $join->on('vehicles.id', '=', 'vehicle_images.vehicle_id')
                     ->where('vehicle_images.is_primary', '=', 1);
            })
            ->whereNull('vehicle_images.id')
            ->select('vehicles.id', 'vehicles.make', 'vehicles.model')
            ->get();
        
        echo "Vehicles without primary images: " . $vehiclesWithoutPrimary->count() . "\n";
        
        if ($vehiclesWithoutPrimary->count() > 0) {
            echo "\nVehicles missing primary images:\n";
            foreach ($vehiclesWithoutPrimary->take(5) as $vehicle) {
                echo "- ID {$vehicle->id}: {$vehicle->make} {$vehicle->model}\n";
                
                // Check if this vehicle has any images at all
                $hasImages = DB::table('vehicle_images')->where('vehicle_id', $vehicle->id)->exists();
                if ($hasImages) {
                    echo "  (Has images but no primary set)\n";
                    // Set first image as primary
                    $firstImage = DB::table('vehicle_images')->where('vehicle_id', $vehicle->id)->first();
                    if ($firstImage) {
                        DB::table('vehicle_images')
                            ->where('id', $firstImage->id)
                            ->update(['is_primary' => 1]);
                        echo "  ✅ Set first image as primary\n";
                    }
                } else {
                    echo "  (No images at all)\n";
                }
            }
        }
        
    } else {
        echo "❌ No vehicle images found in database\n";
        echo "This explains why dashboard images are not displaying\n";
        
        // Let's add some sample images for testing
        echo "\n=== ADDING SAMPLE IMAGES ===\n";
        
        $vehicles = DB::table('vehicles')->take(5)->get();
        foreach ($vehicles as $vehicle) {
            // Add a sample image URL for each vehicle
            $imageUrl = "https://images.unsplash.com/photo-1549924231-f129b911e442?w=400&h=300&fit=crop";
            
            DB::table('vehicle_images')->insert([
                'vehicle_id' => $vehicle->id,
                'image_path' => $imageUrl,
                'alt_text' => "{$vehicle->make} {$vehicle->model}",
                'is_primary' => 1,
                'sort_order' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            
            echo "✅ Added sample image for {$vehicle->make} {$vehicle->model}\n";
        }
    }
    
} catch (Exception $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
}

echo "\n=== CHECK COMPLETE ===\n";
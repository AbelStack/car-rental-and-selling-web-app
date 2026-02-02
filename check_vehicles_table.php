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

echo "=== VEHICLES TABLE STRUCTURE ===\n\n";

try {
    // Get table structure
    $columns = DB::select('DESCRIBE vehicles');
    
    echo "Columns in vehicles table:\n";
    foreach ($columns as $column) {
        echo "- {$column->Field} ({$column->Type})\n";
    }
    
    echo "\n=== SAMPLE VEHICLE DATA ===\n";
    $vehicle = DB::table('vehicles')->first();
    if ($vehicle) {
        echo "Sample vehicle data:\n";
        foreach ((array)$vehicle as $key => $value) {
            echo "- $key: " . (is_string($value) ? substr($value, 0, 50) : $value) . "\n";
        }
    } else {
        echo "No vehicles found in database\n";
    }
    
} catch (Exception $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
}

echo "\n=== CHECK COMPLETE ===\n";
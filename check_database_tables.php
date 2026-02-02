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

echo "=== DATABASE TABLES ===\n\n";

try {
    // Get all tables
    $tables = DB::select('SHOW TABLES');
    $databaseName = DB::connection()->getDatabaseName();
    
    echo "Tables in database '$databaseName':\n";
    foreach ($tables as $table) {
        $tableName = $table->{"Tables_in_$databaseName"};
        echo "- $tableName\n";
    }
    
    // Check if vehicle_images table exists
    $imagesTables = array_filter($tables, function($table) use ($databaseName) {
        $tableName = $table->{"Tables_in_$databaseName"};
        return strpos($tableName, 'image') !== false;
    });
    
    if (!empty($imagesTables)) {
        echo "\n=== IMAGE-RELATED TABLES ===\n";
        foreach ($imagesTables as $table) {
            $tableName = $table->{"Tables_in_$databaseName"};
            echo "\nTable: $tableName\n";
            $columns = DB::select("DESCRIBE $tableName");
            foreach ($columns as $column) {
                echo "  - {$column->Field} ({$column->Type})\n";
            }
        }
    }
    
} catch (Exception $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
}

echo "\n=== CHECK COMPLETE ===\n";
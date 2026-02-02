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

echo "=== DASHBOARD DISPLAY DEBUG ===\n\n";

try {
    // Test database connection
    $pdo = DB::connection()->getPdo();
    echo "✅ Database connection: OK\n";
    
    // Check if we have any users
    $userCount = DB::table('users')->count();
    echo "📊 Total users in database: $userCount\n";
    
    if ($userCount > 0) {
        // Get first user for testing
        $user = DB::table('users')->first();
        echo "👤 Test user: {$user->name} (ID: {$user->id})\n";
        
        // Check bookings for this user
        $bookingsCount = DB::table('bookings')->where('user_id', $user->id)->count();
        echo "📅 User bookings: $bookingsCount\n";
        
        if ($bookingsCount > 0) {
            $bookings = DB::table('bookings')
                ->join('vehicles', 'bookings.vehicle_id', '=', 'vehicles.id')
                ->where('bookings.user_id', $user->id)
                ->select('bookings.*', 'vehicles.make', 'vehicles.model', 'vehicles.primary_image')
                ->get();
            
            echo "📋 Recent bookings:\n";
            foreach ($bookings->take(3) as $booking) {
                echo "  - {$booking->make} {$booking->model} (Status: {$booking->status})\n";
                echo "    Reference: {$booking->booking_reference}\n";
                echo "    Image: " . ($booking->primary_image ? "✅ Available" : "❌ Missing") . "\n";
            }
        }
        
        // Check purchases for this user
        $purchasesCount = DB::table('purchases')->where('user_id', $user->id)->count();
        echo "🛒 User purchases: $purchasesCount\n";
        
        if ($purchasesCount > 0) {
            $purchases = DB::table('purchases')
                ->join('vehicles', 'purchases.vehicle_id', '=', 'vehicles.id')
                ->where('purchases.user_id', $user->id)
                ->select('purchases.*', 'vehicles.make', 'vehicles.model', 'vehicles.primary_image')
                ->get();
            
            echo "🛍️ Recent purchases:\n";
            foreach ($purchases->take(3) as $purchase) {
                echo "  - {$purchase->make} {$purchase->model} (Status: {$purchase->status})\n";
                echo "    Reference: {$purchase->purchase_reference}\n";
                echo "    Image: " . ($purchase->primary_image ? "✅ Available" : "❌ Missing") . "\n";
            }
        }
        
        // Check KYC status
        echo "🔐 KYC Status: {$user->kyc_status}\n";
        echo "✅ KYC Verified: " . ($user->kyc_status === 'verified' ? 'Yes' : 'No') . "\n";
        
    } else {
        echo "❌ No users found in database\n";
    }
    
    // Check if dashboard route exists
    echo "\n=== ROUTE TESTING ===\n";
    $routes = Route::getRoutes();
    $dashboardRouteExists = false;
    
    foreach ($routes as $route) {
        if ($route->getName() === 'dashboard') {
            $dashboardRouteExists = true;
            echo "✅ Dashboard route exists: " . $route->uri() . "\n";
            break;
        }
    }
    
    if (!$dashboardRouteExists) {
        echo "❌ Dashboard route not found\n";
    }
    
    // Check if dashboard view exists
    echo "\n=== VIEW TESTING ===\n";
    $dashboardViewPath = resource_path('views/dashboard/index.blade.php');
    if (file_exists($dashboardViewPath)) {
        echo "✅ Dashboard view exists\n";
        $viewSize = filesize($dashboardViewPath);
        echo "📄 View file size: " . number_format($viewSize) . " bytes\n";
        
        // Check for potential issues in the view
        $viewContent = file_get_contents($dashboardViewPath);
        
        // Check for common issues
        if (strpos($viewContent, '@extends') === false) {
            echo "⚠️  Warning: No @extends directive found\n";
        }
        
        if (strpos($viewContent, '$stats') === false) {
            echo "⚠️  Warning: $stats variable not used in view\n";
        }
        
        if (strpos($viewContent, '$bookings') === false) {
            echo "⚠️  Warning: $bookings variable not used in view\n";
        }
        
        if (strpos($viewContent, '$purchases') === false) {
            echo "⚠️  Warning: $purchases variable not used in view\n";
        }
        
        // Check for syntax errors
        $syntaxErrors = [];
        if (substr_count($viewContent, '{{') !== substr_count($viewContent, '}}')) {
            $syntaxErrors[] = "Mismatched blade syntax {{ }}";
        }
        
        if (substr_count($viewContent, '{!!') !== substr_count($viewContent, '!!}')) {
            $syntaxErrors[] = "Mismatched blade syntax {!! !!}";
        }
        
        if (!empty($syntaxErrors)) {
            echo "❌ Potential syntax errors:\n";
            foreach ($syntaxErrors as $error) {
                echo "  - $error\n";
            }
        } else {
            echo "✅ No obvious syntax errors found\n";
        }
        
    } else {
        echo "❌ Dashboard view file not found\n";
    }
    
} catch (Exception $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
    echo "Stack trace:\n" . $e->getTraceAsString() . "\n";
}

echo "\n=== DEBUG COMPLETE ===\n";
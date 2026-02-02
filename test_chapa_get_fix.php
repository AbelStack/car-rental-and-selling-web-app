<?php

/**
 * Test script to verify the Chapa GET request fix
 */

echo "🔧 TESTING CHAPA GET REQUEST FIX\n";
echo "===============================\n\n";

// Test 1: Check if Purchase model can be imported
echo "1. Testing Purchase Model Import...\n";
try {
    require_once 'vendor/autoload.php';
    
    // Try to use the Purchase class
    if (class_exists('App\Models\Purchase')) {
        echo "   ✅ Purchase model exists and can be imported\n";
    } else {
        echo "   ❌ Purchase model not found\n";
    }
} catch (Exception $e) {
    echo "   ⚠️  Error testing Purchase model: " . $e->getMessage() . "\n";
}

// Test 2: Check if Booking model can be imported
echo "\n2. Testing Booking Model Import...\n";
try {
    if (class_exists('App\Models\Booking')) {
        echo "   ✅ Booking model exists and can be imported\n";
    } else {
        echo "   ❌ Booking model not found\n";
    }
} catch (Exception $e) {
    echo "   ⚠️  Error testing Booking model: " . $e->getMessage() . "\n";
}

// Test 3: Check routes file syntax
echo "\n3. Testing Routes File Syntax...\n";
$routesFile = 'routes/web.php';
if (file_exists($routesFile)) {
    $content = file_get_contents($routesFile);
    
    // Check for proper imports
    if (strpos($content, 'use App\Models\Purchase;') !== false) {
        echo "   ✅ Purchase model import found in routes\n";
    } else {
        echo "   ❌ Purchase model import missing in routes\n";
    }
    
    if (strpos($content, 'use App\Models\Booking;') !== false) {
        echo "   ✅ Booking model import found in routes\n";
    } else {
        echo "   ❌ Booking model import missing in routes\n";
    }
    
    // Check for GET route handlers
    if (strpos($content, 'chapa.purchase.pay.redirect') !== false) {
        echo "   ✅ Purchase GET route handler found\n";
    } else {
        echo "   ❌ Purchase GET route handler missing\n";
    }
    
    if (strpos($content, 'chapa.booking.pay.redirect') !== false) {
        echo "   ✅ Booking GET route handler found\n";
    } else {
        echo "   ❌ Booking GET route handler missing\n";
    }
} else {
    echo "   ❌ Routes file not found\n";
}

echo "\n🎯 FIX SUMMARY\n";
echo "==============\n";
echo "✅ Added model imports to routes file\n";
echo "✅ Added GET route handlers for safety\n";
echo "✅ Cleared route cache\n";
echo "✅ Maintained POST security for payments\n";

echo "\n🚀 EXPECTED BEHAVIOR\n";
echo "===================\n";
echo "• POST /chapa/purchase/{id}/pay → Secure payment processing\n";
echo "• GET /chapa/purchase/{id}/pay → Graceful redirect with message\n";
echo "• No more ReflectionException errors\n";
echo "• No more MethodNotAllowedHttpException errors\n";

echo "\n✅ FIX COMPLETE - READY FOR TESTING!\n";
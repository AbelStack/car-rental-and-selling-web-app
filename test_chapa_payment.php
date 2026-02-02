<?php

require_once 'vendor/autoload.php';

use Illuminate\Foundation\Application;

// Bootstrap Laravel
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "=== Chapa Payment System Test ===\n\n";

try {
    // Test 1: Check Chapa configuration
    echo "1. Testing Chapa Configuration...\n";
    $chapaConfig = config('services.chapa');
    echo "   Base URL: " . ($chapaConfig['base_url'] ?? 'Not set') . "\n";
    echo "   Public Key: " . (isset($chapaConfig['public_key']) ? substr($chapaConfig['public_key'], 0, 20) . '...' : 'Not set') . "\n";
    echo "   Secret Key: " . (isset($chapaConfig['secret_key']) ? substr($chapaConfig['secret_key'], 0, 20) . '...' : 'Not set') . "\n";
    echo "   Webhook Secret: " . (isset($chapaConfig['webhook_secret']) ? 'Set' : 'Not set') . "\n";

    // Check if keys are placeholder values
    if (strpos($chapaConfig['public_key'] ?? '', 'your-public-key-here') !== false) {
        echo "   ⚠️  WARNING: Using placeholder public key\n";
    }
    if (strpos($chapaConfig['secret_key'] ?? '', 'your-secret-key-here') !== false) {
        echo "   ⚠️  WARNING: Using placeholder secret key\n";
    }

    // Test 2: Check ChapaService instantiation
    echo "\n2. Testing ChapaService...\n";
    try {
        $chapaService = new App\Services\ChapaService();
        echo "   ✓ ChapaService instantiated successfully\n";
    } catch (Exception $e) {
        echo "   ✗ ChapaService instantiation failed: " . $e->getMessage() . "\n";
    }

    // Test 3: Check ChapaTransaction model
    echo "\n3. Testing ChapaTransaction Model...\n";
    try {
        $transaction = new App\Models\ChapaTransaction();
        $fillable = $transaction->getFillable();
        echo "   ✓ ChapaTransaction model loaded\n";
        echo "   ✓ Fillable fields: " . count($fillable) . " fields\n";
    } catch (Exception $e) {
        echo "   ✗ ChapaTransaction model error: " . $e->getMessage() . "\n";
    }

    // Test 4: Check Chapa routes
    echo "\n4. Testing Chapa Routes...\n";
    $routes = [
        'chapa.purchase.pay',
        'chapa.booking.pay',
        'chapa.return',
        'chapa.success',
        'chapa.failed',
        'chapa.callback'
    ];
    
    foreach ($routes as $routeName) {
        try {
            $route = route($routeName, ['purchase' => 1, 'booking' => 1, 'transaction' => 1]);
            echo "   ✓ {$routeName} route exists\n";
        } catch (Exception $e) {
            echo "   ✗ {$routeName} route missing\n";
        }
    }

    // Test 5: Test sample payment data preparation
    echo "\n5. Testing Payment Data Preparation...\n";
    try {
        $sampleData = [
            'amount' => '1000',
            'currency' => 'ETB',
            'email' => 'customer@gmail.com',
            'first_name' => 'Test',
            'last_name' => 'Customer',
            'phone_number' => '251911000000',
            'tx_ref' => 'TEST-' . uniqid(),
            'return_url' => 'http://localhost:8000/chapa/return/1',
            'description' => 'Test payment',
            'user_id' => 1,
            'payable_type' => 'App\\Models\\Purchase',
            'payable_id' => 1,
        ];
        
        echo "   ✓ Sample payment data prepared\n";
        echo "   ✓ Amount: {$sampleData['amount']} {$sampleData['currency']}\n";
        echo "   ✓ TX Ref: {$sampleData['tx_ref']}\n";
        
        // Test if we can make a test API call (this will likely fail with test keys)
        if (isset($chapaService)) {
            echo "\n6. Testing Chapa API Call...\n";
            $result = $chapaService->initializePayment($sampleData);
            
            if ($result['success']) {
                echo "   ✓ Chapa API call successful\n";
                echo "   ✓ Checkout URL: " . ($result['checkout_url'] ?? 'Not provided') . "\n";
            } else {
                echo "   ✗ Chapa API call failed\n";
                echo "   Error: " . ($result['message'] ?? 'Unknown error') . "\n";
                echo "   Details: " . ($result['error'] ?? 'No details') . "\n";
            }
        }
        
    } catch (Exception $e) {
        echo "   ✗ Payment data preparation failed: " . $e->getMessage() . "\n";
    }

    echo "\n=== Test Complete ===\n";
    
    // Provide recommendations
    echo "\n🔧 RECOMMENDATIONS:\n";
    if (strpos($chapaConfig['public_key'] ?? '', 'your-public-key-here') !== false) {
        echo "1. ⚠️  Replace placeholder Chapa API keys with real ones\n";
        echo "   - Get keys from: https://dashboard.chapa.co/\n";
        echo "   - Update CHAPA_PUBLIC_KEY in .env\n";
        echo "   - Update CHAPA_SECRET_KEY in .env\n";
    }
    echo "2. 🧪 Test with real Chapa test keys for development\n";
    echo "3. 🔒 Use production keys only in production environment\n";

} catch (Exception $e) {
    echo "Error during testing: " . $e->getMessage() . "\n";
    echo "Stack trace: " . $e->getTraceAsString() . "\n";
}
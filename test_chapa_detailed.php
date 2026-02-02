<?php

require_once 'vendor/autoload.php';

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Http;

// Bootstrap Laravel
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "=== Detailed Chapa Payment Test ===\n\n";

try {
    // Test 1: Check configuration
    echo "1. Configuration Check:\n";
    $baseUrl = config('services.chapa.base_url');
    $publicKey = config('services.chapa.public_key');
    $secretKey = config('services.chapa.secret_key');
    
    echo "   Base URL: {$baseUrl}\n";
    echo "   Public Key: " . substr($publicKey, 0, 25) . "...\n";
    echo "   Secret Key: " . substr($secretKey, 0, 25) . "...\n";
    
    // Test 2: Direct API call
    echo "\n2. Direct Chapa API Test:\n";
    
    $payload = [
        'amount' => '100',
        'currency' => 'ETB',
        'email' => 'john.doe@gmail.com',
        'first_name' => 'John',
        'last_name' => 'Doe',
        'phone_number' => '251911000000',
        'tx_ref' => 'TEST-' . uniqid(),
        'callback_url' => 'http://localhost:8000/chapa/callback',
        'return_url' => 'http://localhost:8000/chapa/return/1',
        'description' => 'Test payment for vehicle rental'
    ];
    
    echo "   Payload prepared:\n";
    echo "   - Amount: {$payload['amount']} {$payload['currency']}\n";
    echo "   - Email: {$payload['email']}\n";
    echo "   - TX Ref: {$payload['tx_ref']}\n";
    
    $response = Http::withHeaders([
        'Authorization' => 'Bearer ' . $secretKey,
        'Content-Type' => 'application/json',
    ])->post($baseUrl . '/transaction/initialize', $payload);
    
    echo "\n   API Response:\n";
    echo "   - Status Code: " . $response->status() . "\n";
    echo "   - Success: " . ($response->successful() ? 'Yes' : 'No') . "\n";
    
    if ($response->successful()) {
        $responseData = $response->json();
        echo "   - Response Status: " . ($responseData['status'] ?? 'Unknown') . "\n";
        
        if (isset($responseData['data']['checkout_url'])) {
            echo "   ✓ Checkout URL received: " . $responseData['data']['checkout_url'] . "\n";
        }
        
        echo "   - Full Response: " . json_encode($responseData, JSON_PRETTY_PRINT) . "\n";
    } else {
        $errorData = $response->json();
        echo "   ✗ API Error:\n";
        echo "   - Error: " . json_encode($errorData, JSON_PRETTY_PRINT) . "\n";
    }
    
    // Test 3: ChapaService test
    echo "\n3. ChapaService Test:\n";
    try {
        $chapaService = new App\Services\ChapaService();
        
        $serviceData = [
            'amount' => '100',
            'currency' => 'ETB',
            'email' => 'john.doe@gmail.com',
            'first_name' => 'John',
            'last_name' => 'Doe',
            'phone_number' => '251911000000',
            'tx_ref' => 'TEST-' . uniqid(),
            'return_url' => 'http://localhost:8000/chapa/return/1',
            'description' => 'Test payment via service',
            'user_id' => 1,
            'payable_type' => 'App\\Models\\Purchase',
            'payable_id' => 1,
        ];
        
        $result = $chapaService->initializePayment($serviceData);
        
        if ($result['success']) {
            echo "   ✓ ChapaService call successful\n";
            echo "   ✓ Checkout URL: " . ($result['checkout_url'] ?? 'Not provided') . "\n";
        } else {
            echo "   ✗ ChapaService call failed\n";
            echo "   - Message: " . ($result['message'] ?? 'Unknown error') . "\n";
            echo "   - Error: " . ($result['error'] ?? 'No details') . "\n";
        }
        
    } catch (Exception $e) {
        echo "   ✗ ChapaService exception: " . $e->getMessage() . "\n";
        echo "   - File: " . $e->getFile() . ":" . $e->getLine() . "\n";
    }
    
} catch (Exception $e) {
    echo "Fatal error: " . $e->getMessage() . "\n";
    echo "File: " . $e->getFile() . ":" . $e->getLine() . "\n";
    echo "Trace: " . $e->getTraceAsString() . "\n";
}

echo "\n=== Test Complete ===\n";
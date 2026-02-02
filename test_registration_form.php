<?php

require_once 'vendor/autoload.php';

// Load Laravel application
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Http\Controllers\Auth\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

echo "🧪 Testing Registration Form Submission...\n\n";

try {
    // Test with invalid data to trigger errors
    echo "1️⃣ TESTING FORM WITH VALIDATION ERRORS:\n";
    
    $invalidData = [
        'name' => '', // Required field empty
        'email' => 'invalid-email', // Invalid email format
        'phone' => '', // Required field empty
        'password' => '123', // Too weak
        'password_confirmation' => '456', // Doesn't match
        'preferred_language' => 'invalid', // Invalid option
    ];
    
    // Create request
    $request = Request::create('/register', 'POST', $invalidData);
    $request->setLaravelSession(app('session'));
    
    // Create controller
    $controller = new AuthController();
    
    echo "   Submitting form with invalid data...\n";
    
    // Call the register method
    $response = $controller->register($request);
    
    echo "   ✅ Controller method executed\n";
    echo "   - Response type: " . get_class($response) . "\n";
    
    if (method_exists($response, 'getTargetUrl')) {
        echo "   - Redirect URL: " . $response->getTargetUrl() . "\n";
    }
    
    // Check session for errors
    $session = $request->getSession();
    if ($session->has('errors')) {
        echo "   ✅ Errors stored in session\n";
        $errors = $session->get('errors');
        echo "   - Error count: " . $errors->count() . "\n";
        
        echo "   - Errors by field:\n";
        foreach ($errors->messages() as $field => $fieldErrors) {
            echo "     {$field}: " . implode(', ', $fieldErrors) . "\n";
        }
    } else {
        echo "   ❌ No errors found in session\n";
    }
    
    // Check if old input is preserved
    if ($session->hasOldInput()) {
        echo "   ✅ Old input preserved in session\n";
        $oldInput = $session->getOldInput();
        echo "   - Old input fields: " . implode(', ', array_keys($oldInput)) . "\n";
    } else {
        echo "   ❌ Old input not preserved\n";
    }
    
    // Test 2: Valid registration
    echo "\n2️⃣ TESTING VALID REGISTRATION:\n";
    
    $validData = [
        'name' => 'Test User Registration',
        'email' => 'testuser' . time() . '@example.com', // Unique email
        'phone' => '+251911' . rand(100000, 999999), // Unique phone
        'password' => 'TestPass123',
        'password_confirmation' => 'TestPass123',
        'preferred_language' => 'en',
    ];
    
    echo "   Registration data:\n";
    foreach ($validData as $key => $value) {
        if ($key !== 'password' && $key !== 'password_confirmation') {
            echo "     {$key}: {$value}\n";
        } else {
            echo "     {$key}: [hidden]\n";
        }
    }
    
    // Create new request and session
    $validRequest = Request::create('/register', 'POST', $validData);
    $validRequest->setLaravelSession(app('session.store')->driver());
    
    echo "\n   Submitting valid registration...\n";
    
    $validResponse = $controller->register($validRequest);
    
    echo "   ✅ Registration processed\n";
    echo "   - Response type: " . get_class($validResponse) . "\n";
    
    if (method_exists($validResponse, 'getTargetUrl')) {
        echo "   - Redirect URL: " . $validResponse->getTargetUrl() . "\n";
    }
    
    // Check if user was created
    $createdUser = \App\Models\User::where('email', $validData['email'])->first();
    if ($createdUser) {
        echo "   ✅ User created successfully\n";
        echo "   - User ID: {$createdUser->id}\n";
        echo "   - User Name: {$createdUser->name}\n";
        echo "   - User Status: {$createdUser->status}\n";
        echo "   - KYC Status: {$createdUser->kyc_status}\n";
        
        // Clean up test user
        $createdUser->delete();
        echo "   🗑️ Test user cleaned up\n";
    } else {
        echo "   ❌ User was not created\n";
    }
    
    echo "\n✅ Registration form testing completed!\n";
    
} catch (\Illuminate\Validation\ValidationException $e) {
    echo "\n✅ Validation exception caught (expected for invalid data)\n";
    echo "   Validation errors:\n";
    foreach ($e->errors() as $field => $errors) {
        echo "     {$field}: " . implode(', ', $errors) . "\n";
    }
} catch (\Exception $e) {
    echo "\n❌ Unexpected error during registration testing:\n";
    echo "   Error: " . $e->getMessage() . "\n";
    echo "   File: " . $e->getFile() . ":" . $e->getLine() . "\n";
    
    if ($e->getPrevious()) {
        echo "   Previous: " . $e->getPrevious()->getMessage() . "\n";
    }
    
    exit(1);
}
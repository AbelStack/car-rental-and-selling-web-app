<?php

require_once 'vendor/autoload.php';

// Load Laravel application
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Http\Controllers\Auth\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

echo "🧪 Testing Registration Error Handling...\n\n";

try {
    // Test 1: Empty form submission
    echo "1️⃣ TESTING EMPTY FORM SUBMISSION:\n";
    
    $emptyData = [];
    $request = Request::create('/register', 'POST', $emptyData);
    
    $validator = Validator::make($emptyData, [
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'phone' => 'required|string|max:20|unique:users',
        'password' => ['required', 'confirmed', \Illuminate\Validation\Rules\Password::min(8)->mixedCase()->numbers()],
        'preferred_language' => 'required|in:en,am',
    ]);
    
    if ($validator->fails()) {
        echo "   ✅ Validation failed as expected\n";
        echo "   Errors found:\n";
        foreach ($validator->errors()->all() as $error) {
            echo "     - {$error}\n";
        }
    } else {
        echo "   ❌ Validation should have failed\n";
    }
    
    // Test 2: Invalid email format
    echo "\n2️⃣ TESTING INVALID EMAIL FORMAT:\n";
    
    $invalidEmailData = [
        'name' => 'Test User',
        'email' => 'invalid-email',
        'phone' => '+251911234567',
        'password' => 'TestPass123',
        'password_confirmation' => 'TestPass123',
        'preferred_language' => 'en',
    ];
    
    $validator = Validator::make($invalidEmailData, [
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'phone' => 'required|string|max:20|unique:users',
        'password' => ['required', 'confirmed', \Illuminate\Validation\Rules\Password::min(8)->mixedCase()->numbers()],
        'preferred_language' => 'required|in:en,am',
    ]);
    
    if ($validator->fails()) {
        echo "   ✅ Email validation failed as expected\n";
        echo "   Email errors:\n";
        foreach ($validator->errors()->get('email') as $error) {
            echo "     - {$error}\n";
        }
    } else {
        echo "   ❌ Email validation should have failed\n";
    }
    
    // Test 3: Weak password
    echo "\n3️⃣ TESTING WEAK PASSWORD:\n";
    
    $weakPasswordData = [
        'name' => 'Test User',
        'email' => 'test@example.com',
        'phone' => '+251911234567',
        'password' => '123',
        'password_confirmation' => '123',
        'preferred_language' => 'en',
    ];
    
    $validator = Validator::make($weakPasswordData, [
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'phone' => 'required|string|max:20|unique:users',
        'password' => ['required', 'confirmed', \Illuminate\Validation\Rules\Password::min(8)->mixedCase()->numbers()],
        'preferred_language' => 'required|in:en,am',
    ]);
    
    if ($validator->fails()) {
        echo "   ✅ Password validation failed as expected\n";
        echo "   Password errors:\n";
        foreach ($validator->errors()->get('password') as $error) {
            echo "     - {$error}\n";
        }
    } else {
        echo "   ❌ Password validation should have failed\n";
    }
    
    // Test 4: Password mismatch
    echo "\n4️⃣ TESTING PASSWORD MISMATCH:\n";
    
    $mismatchPasswordData = [
        'name' => 'Test User',
        'email' => 'test@example.com',
        'phone' => '+251911234567',
        'password' => 'TestPass123',
        'password_confirmation' => 'DifferentPass123',
        'preferred_language' => 'en',
    ];
    
    $validator = Validator::make($mismatchPasswordData, [
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'phone' => 'required|string|max:20|unique:users',
        'password' => ['required', 'confirmed', \Illuminate\Validation\Rules\Password::min(8)->mixedCase()->numbers()],
        'preferred_language' => 'required|in:en,am',
    ]);
    
    if ($validator->fails()) {
        echo "   ✅ Password confirmation failed as expected\n";
        echo "   Password confirmation errors:\n";
        foreach ($validator->errors()->get('password') as $error) {
            echo "     - {$error}\n";
        }
    } else {
        echo "   ❌ Password confirmation should have failed\n";
    }
    
    // Test 5: Duplicate email (simulate existing user)
    echo "\n5️⃣ TESTING DUPLICATE EMAIL:\n";
    
    // Check if there are existing users
    $existingUser = \App\Models\User::first();
    if ($existingUser) {
        $duplicateEmailData = [
            'name' => 'Test User',
            'email' => $existingUser->email,
            'phone' => '+251911234567',
            'password' => 'TestPass123',
            'password_confirmation' => 'TestPass123',
            'preferred_language' => 'en',
        ];
        
        $validator = Validator::make($duplicateEmailData, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'required|string|max:20|unique:users',
            'password' => ['required', 'confirmed', \Illuminate\Validation\Rules\Password::min(8)->mixedCase()->numbers()],
            'preferred_language' => 'required|in:en,am',
        ]);
        
        if ($validator->fails()) {
            echo "   ✅ Duplicate email validation failed as expected\n";
            echo "   Email uniqueness errors:\n";
            foreach ($validator->errors()->get('email') as $error) {
                echo "     - {$error}\n";
            }
        } else {
            echo "   ❌ Duplicate email validation should have failed\n";
        }
    } else {
        echo "   ⚠️ No existing users to test duplicate email\n";
    }
    
    // Test 6: Check error message structure
    echo "\n6️⃣ CHECKING ERROR MESSAGE STRUCTURE:\n";
    
    $validator = Validator::make([], [
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'phone' => 'required|string|max:20|unique:users',
        'password' => ['required', 'confirmed', \Illuminate\Validation\Rules\Password::min(8)->mixedCase()->numbers()],
        'preferred_language' => 'required|in:en,am',
    ]);
    
    if ($validator->fails()) {
        echo "   Error bag structure:\n";
        $errors = $validator->errors();
        
        echo "   - Has errors: " . ($errors->any() ? 'Yes' : 'No') . "\n";
        echo "   - Error count: " . $errors->count() . "\n";
        echo "   - Fields with errors: " . implode(', ', array_keys($errors->messages())) . "\n";
        
        echo "\n   Individual field errors:\n";
        foreach ($errors->messages() as $field => $fieldErrors) {
            echo "     {$field}:\n";
            foreach ($fieldErrors as $error) {
                echo "       - {$error}\n";
            }
        }
    }
    
    echo "\n✅ Registration error testing completed!\n";
    
    // Test 7: Check if session flash messages work
    echo "\n7️⃣ TESTING SESSION FLASH MESSAGES:\n";
    
    // Simulate a session with errors
    $session = app('session');
    $session->flash('errors', $validator->errors());
    
    if ($session->has('errors')) {
        echo "   ✅ Session can store error messages\n";
        $sessionErrors = $session->get('errors');
        echo "   - Session error count: " . $sessionErrors->count() . "\n";
    } else {
        echo "   ❌ Session cannot store error messages\n";
    }
    
} catch (\Exception $e) {
    echo "\n❌ Error during registration testing:\n";
    echo "   Error: " . $e->getMessage() . "\n";
    echo "   File: " . $e->getFile() . ":" . $e->getLine() . "\n";
    
    if ($e->getPrevious()) {
        echo "   Previous: " . $e->getPrevious()->getMessage() . "\n";
    }
    
    exit(1);
}
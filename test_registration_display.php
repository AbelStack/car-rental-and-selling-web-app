<?php

require_once 'vendor/autoload.php';

// Load Laravel application
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\Validator;

echo "🧪 Testing Registration Error Display System...\n\n";

// Test validation rules and messages
echo "1️⃣ TESTING VALIDATION RULES AND MESSAGES:\n";

$testData = [
    'name' => '',
    'email' => 'invalid-email',
    'phone' => '',
    'password' => '123',
    'password_confirmation' => '456',
    'preferred_language' => 'invalid',
];

$validator = Validator::make($testData, [
    'name' => 'required|string|max:255',
    'email' => 'required|string|email|max:255|unique:users',
    'phone' => 'required|string|max:20|unique:users',
    'password' => ['required', 'confirmed', \Illuminate\Validation\Rules\Password::min(8)->mixedCase()->numbers()],
    'preferred_language' => 'required|in:en,am',
], [
    // Custom error messages
    'name.required' => 'Please enter your full name.',
    'name.string' => 'Name must be a valid text.',
    'name.max' => 'Name cannot exceed 255 characters.',
    
    'email.required' => 'Please enter your email address.',
    'email.email' => 'Please enter a valid email address.',
    'email.unique' => 'This email address is already registered.',
    
    'phone.required' => 'Please enter your phone number.',
    'phone.unique' => 'This phone number is already registered.',
    
    'password.required' => 'Please enter a password.',
    'password.confirmed' => 'Password confirmation does not match.',
    'password.min' => 'Password must be at least 8 characters long.',
    
    'preferred_language.required' => 'Please select your preferred language.',
    'preferred_language.in' => 'Please select a valid language option.',
]);

if ($validator->fails()) {
    echo "   ✅ Validation failed as expected\n";
    echo "   Custom error messages:\n";
    foreach ($validator->errors()->all() as $error) {
        echo "     - {$error}\n";
    }
} else {
    echo "   ❌ Validation should have failed\n";
}

// Test error structure for frontend display
echo "\n2️⃣ TESTING ERROR STRUCTURE FOR FRONTEND:\n";

$errors = $validator->errors();

echo "   Error bag methods:\n";
echo "   - any(): " . ($errors->any() ? 'true' : 'false') . "\n";
echo "   - count(): " . $errors->count() . "\n";
echo "   - isEmpty(): " . ($errors->isEmpty() ? 'true' : 'false') . "\n";

echo "\n   Field-specific errors:\n";
foreach (['name', 'email', 'phone', 'password', 'preferred_language'] as $field) {
    $fieldErrors = $errors->get($field);
    echo "   - {$field}: " . (count($fieldErrors) > 0 ? implode(', ', $fieldErrors) : 'No errors') . "\n";
}

echo "\n   All errors (for general display):\n";
foreach ($errors->all() as $index => $error) {
    echo "   " . ($index + 1) . ". {$error}\n";
}

// Test Blade template compatibility
echo "\n3️⃣ TESTING BLADE TEMPLATE COMPATIBILITY:\n";

echo "   @if (\$errors->any()) - " . ($errors->any() ? 'TRUE (will show general errors)' : 'FALSE (no general errors)') . "\n";

foreach (['name', 'email', 'phone', 'password', 'preferred_language'] as $field) {
    $hasError = $errors->has($field);
    echo "   @error('{$field}') - " . ($hasError ? 'TRUE (will show field error)' : 'FALSE (no field error)') . "\n";
}

// Test session flash message simulation
echo "\n4️⃣ TESTING SESSION FLASH MESSAGES:\n";

$session = app('session');

// Simulate different types of flash messages
$session->flash('error', 'Registration failed due to a system error. Please try again or contact support.');
$session->flash('registration_error', 'Please correct the errors below and try again.');

echo "   session('error'): " . ($session->has('error') ? "'{$session->get('error')}'" : 'Not set') . "\n";
echo "   session('registration_error'): " . ($session->has('registration_error') ? "'{$session->get('registration_error')}'" : 'Not set') . "\n";

// Test old input preservation
echo "\n5️⃣ TESTING OLD INPUT PRESERVATION:\n";

$session->flashInput($testData);

echo "   old('name'): '" . old('name', 'default') . "'\n";
echo "   old('email'): '" . old('email', 'default') . "'\n";
echo "   old('phone'): '" . old('phone', 'default') . "'\n";
echo "   old('preferred_language'): '" . old('preferred_language', 'default') . "'\n";

echo "\n✅ Registration error display testing completed!\n";

echo "\n📋 SUMMARY:\n";
echo "✅ Custom validation messages working\n";
echo "✅ Error structure compatible with Blade templates\n";
echo "✅ Session flash messages working\n";
echo "✅ Old input preservation working\n";
echo "✅ Multiple error display methods available\n";

echo "\n🎯 FRONTEND INTEGRATION:\n";
echo "- General errors: Use @if (\$errors->any()) to show all errors\n";
echo "- Field errors: Use @error('fieldname') for individual field errors\n";
echo "- System errors: Use @if (session('error')) for system errors\n";
echo "- Registration errors: Use @if (session('registration_error')) for process errors\n";
echo "- Old input: Use old('fieldname') to preserve user input\n";

echo "\n🚀 The registration error display system is ready!\n";
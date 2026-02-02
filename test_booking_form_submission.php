<?php

require_once 'vendor/autoload.php';

// Load Laravel application
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\User;
use App\Models\Vehicle;
use App\Http\Controllers\BookingController;
use App\Services\DiscountService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

echo "🧪 Testing Booking Form Submission...\n\n";

try {
    // Find a verified user who can book
    $user = User::where('kyc_status', 'verified')
                ->where('can_book', true)
                ->first();
    
    if (!$user) {
        echo "❌ No verified users found who can book\n";
        exit(1);
    }
    
    echo "✅ Found verified user: {$user->name} (ID: {$user->id})\n";
    
    // Find an available rental vehicle
    $vehicle = Vehicle::where('available_for_rent', true)
                     ->where('status', 'available')
                     ->first();
    
    if (!$vehicle) {
        echo "❌ No available rental vehicles found\n";
        exit(1);
    }
    
    echo "✅ Found available vehicle: {$vehicle->full_name} (ID: {$vehicle->id})\n";
    
    // Simulate user authentication
    Auth::login($user);
    echo "✅ User authenticated\n";
    
    // Create a mock request with form data
    $formData = [
        'pickup_date' => now()->addDays(1)->format('Y-m-d'),
        'return_date' => now()->addDays(3)->format('Y-m-d'),
        'driving_option' => 'self_drive',
        'pickup_location' => 'Test Pickup Location',
        'return_location' => 'Test Return Location',
        'special_requests' => 'Test form submission',
    ];
    
    echo "📋 Form data:\n";
    foreach ($formData as $key => $value) {
        echo "   - {$key}: {$value}\n";
    }
    
    // Create request object
    $request = Request::create('/bookings/' . $vehicle->id, 'POST', $formData);
    $request->setUserResolver(function () use ($user) {
        return $user;
    });
    
    // Test controller method
    $controller = new BookingController(new DiscountService());
    
    echo "\n🎯 Testing controller store method...\n";
    
    $response = $controller->store($request, $vehicle);
    
    echo "✅ Controller method executed successfully!\n";
    echo "   - Response type: " . get_class($response) . "\n";
    
    if (method_exists($response, 'getTargetUrl')) {
        echo "   - Redirect URL: " . $response->getTargetUrl() . "\n";
    }
    
    if (method_exists($response, 'getSession') && $response->getSession()) {
        $session = $response->getSession();
        if ($session->has('success')) {
            echo "   - Success message: " . $session->get('success') . "\n";
        }
        if ($session->has('error')) {
            echo "   - Error message: " . $session->get('error') . "\n";
        }
    }
    
    echo "\n✅ Form submission test completed successfully!\n";
    
} catch (\Illuminate\Validation\ValidationException $e) {
    echo "\n❌ Validation error:\n";
    foreach ($e->errors() as $field => $errors) {
        echo "   - {$field}: " . implode(', ', $errors) . "\n";
    }
} catch (\Exception $e) {
    echo "\n❌ Error during form submission test:\n";
    echo "   Error: " . $e->getMessage() . "\n";
    echo "   File: " . $e->getFile() . ":" . $e->getLine() . "\n";
    
    if ($e->getPrevious()) {
        echo "   Previous: " . $e->getPrevious()->getMessage() . "\n";
    }
    
    exit(1);
}
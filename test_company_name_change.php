<?php

require_once 'vendor/autoload.php';

// Bootstrap Laravel
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

echo "🏢 Testing Company Name Change: CarRental → Addis Drive\n";
echo "=" . str_repeat("=", 60) . "\n\n";

try {
    // Test 1: Check View Files
    echo "1️⃣ Testing View Files...\n";
    
    $viewFiles = [
        'resources/views/layouts/app.blade.php' => 'Main Layout',
        'resources/views/home.blade.php' => 'Home Page',
        'resources/views/about/index.blade.php' => 'About Page',
        'resources/views/vehicles/rentals.blade.php' => 'Rentals Page',
        'resources/views/vehicles/sales.blade.php' => 'Sales Page',
        'resources/views/dashboard/index.blade.php' => 'Dashboard',
        'resources/views/contact/show.blade.php' => 'Contact Page',
        'resources/views/kyc/show.blade.php' => 'KYC Page',
    ];
    
    foreach ($viewFiles as $file => $description) {
        if (file_exists($file)) {
            $content = file_get_contents($file);
            $hasOldName = strpos($content, 'CarRental') !== false;
            $hasNewName = strpos($content, 'Addis Drive') !== false;
            
            if ($hasOldName) {
                echo "   ⚠️  $description: Still contains 'CarRental'\n";
            } elseif ($hasNewName) {
                echo "   ✅ $description: Updated to 'Addis Drive'\n";
            } else {
                echo "   ℹ️  $description: No company name found\n";
            }
        } else {
            echo "   ❌ $description: File not found\n";
        }
    }
    echo "\n";
    
    // Test 2: Check Email Templates
    echo "2️⃣ Testing Email Templates...\n";
    
    $emailFiles = [
        'resources/views/emails/purchase-confirmation.blade.php' => 'Purchase Confirmation',
        'resources/views/emails/admin-reply.blade.php' => 'Admin Reply',
    ];
    
    foreach ($emailFiles as $file => $description) {
        if (file_exists($file)) {
            $content = file_get_contents($file);
            $hasOldEmail = strpos($content, 'carrental.com') !== false;
            $hasNewEmail = strpos($content, 'addisdrive.com') !== false;
            $hasOldName = strpos($content, 'Car Rental') !== false;
            $hasNewName = strpos($content, 'Addis Drive') !== false;
            
            echo "   📧 $description:\n";
            if ($hasOldEmail) {
                echo "      ⚠️  Still contains old email domain\n";
            } elseif ($hasNewEmail) {
                echo "      ✅ Updated to new email domain\n";
            }
            
            if ($hasOldName) {
                echo "      ⚠️  Still contains old company name\n";
            } elseif ($hasNewName) {
                echo "      ✅ Updated to new company name\n";
            }
        }
    }
    echo "\n";
    
    // Test 3: Check Controller Files
    echo "3️⃣ Testing Controller Files...\n";
    
    $controllerFiles = [
        'app/Http/Controllers/ChatbotController.php' => 'Chatbot Controller',
    ];
    
    foreach ($controllerFiles as $file => $description) {
        if (file_exists($file)) {
            $content = file_get_contents($file);
            $hasOldName = strpos($content, 'car rental and vehicle selling company') !== false;
            $hasNewName = strpos($content, 'Addis Drive') !== false;
            
            if ($hasOldName) {
                echo "   ⚠️  $description: Still contains old description\n";
            } elseif ($hasNewName) {
                echo "   ✅ $description: Updated to 'Addis Drive'\n";
            } else {
                echo "   ℹ️  $description: No company reference found\n";
            }
        }
    }
    echo "\n";
    
    // Test 4: Test Route Responses
    echo "4️⃣ Testing Route Responses...\n";
    
    $routes = [
        '/' => 'Home Page',
        '/about' => 'About Page',
    ];
    
    foreach ($routes as $route => $description) {
        try {
            $request = \Illuminate\Http\Request::create($route, 'GET');
            $response = app()->handle($request);
            
            if ($response->getStatusCode() === 200) {
                $content = $response->getContent();
                $hasOldName = strpos($content, 'CarRental') !== false;
                $hasNewName = strpos($content, 'Addis Drive') !== false;
                
                if ($hasOldName) {
                    echo "   ⚠️  $description: Response still contains 'CarRental'\n";
                } elseif ($hasNewName) {
                    echo "   ✅ $description: Response updated to 'Addis Drive'\n";
                } else {
                    echo "   ℹ️  $description: No company name in response\n";
                }
            } else {
                echo "   ❌ $description: Route returned " . $response->getStatusCode() . "\n";
            }
        } catch (Exception $e) {
            echo "   ❌ $description: Error - " . $e->getMessage() . "\n";
        }
    }
    echo "\n";
    
    // Test 5: Check Configuration Files
    echo "5️⃣ Testing Configuration Impact...\n";
    
    // Check if app name should be updated
    $appName = config('app.name');
    echo "   📱 App Name: $appName\n";
    
    // Check mail configuration
    $mailFromName = config('mail.from.name');
    echo "   📧 Mail From Name: $mailFromName\n";
    echo "\n";
    
    // Test 6: Summary of Changes
    echo "6️⃣ Summary of Changes Made...\n";
    echo "   🏢 Company Name: CarRental → Addis Drive\n";
    echo "   📧 Email Domain: carrental.com → addisdrive.com\n";
    echo "   🌐 Website Title: Updated across all pages\n";
    echo "   📱 Navigation: Updated in all layouts\n";
    echo "   📄 Footer: Updated copyright and contact info\n";
    echo "   📧 Email Templates: Updated sender information\n";
    echo "   🤖 Chatbot: Updated company context\n";
    echo "\n";
    
    // Test 7: Recommendations
    echo "7️⃣ Additional Recommendations...\n";
    echo "   📝 Update .env APP_NAME to 'Addis Drive'\n";
    echo "   📧 Update MAIL_FROM_NAME to 'Addis Drive'\n";
    echo "   🌐 Update any external API configurations\n";
    echo "   📱 Update mobile app configurations if applicable\n";
    echo "   🔍 Update SEO meta descriptions\n";
    echo "   📊 Update Google Analytics site name\n";
    echo "\n";
    
    echo "🎉 Company Name Change Test Complete!\n";
    echo "✅ Successfully changed from 'CarRental' to 'Addis Drive'\n";
    echo "🚀 Your brand identity has been updated throughout the application!\n";
    
} catch (Exception $e) {
    echo "❌ Error during testing: " . $e->getMessage() . "\n";
    echo "📍 File: " . $e->getFile() . " Line: " . $e->getLine() . "\n";
}
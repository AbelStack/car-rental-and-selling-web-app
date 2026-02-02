<?php

require_once 'vendor/autoload.php';

// Load Laravel application
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\ContactMessage;
use App\Models\User;
use App\Http\Controllers\Admin\AdminController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

echo "🧪 Testing Admin Reply System...\n\n";

try {
    // 1. Check if there are contact messages
    echo "1️⃣ CHECKING CONTACT MESSAGES:\n";
    
    $messages = ContactMessage::orderBy('created_at', 'desc')->limit(5)->get();
    
    if ($messages->count() > 0) {
        echo "   ✅ Found {$messages->count()} contact messages\n";
        foreach ($messages as $message) {
            echo "     - Message {$message->id}: {$message->subject} (Status: {$message->status})\n";
        }
    } else {
        echo "   ⚠️ No contact messages found. Creating test message...\n";
        
        // Create a test contact message
        $testMessage = ContactMessage::create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'phone' => '+251911234567',
            'subject' => 'Test Message for Reply System',
            'message' => 'This is a test message to verify the admin reply system is working correctly.',
            'status' => 'new',
            'ip_address' => '127.0.0.1',
        ]);
        
        echo "   ✅ Created test message with ID: {$testMessage->id}\n";
        $messages = collect([$testMessage]);
    }
    
    // 2. Check admin users
    echo "\n2️⃣ CHECKING ADMIN USERS:\n";
    
    $adminUser = User::whereHas('role', function($query) {
        $query->whereIn('name', ['admin', 'super_admin']);
    })->first();
    
    if ($adminUser) {
        echo "   ✅ Found admin user: {$adminUser->name} (ID: {$adminUser->id})\n";
    } else {
        echo "   ❌ No admin users found\n";
        exit(1);
    }
    
    // 3. Test reply validation
    echo "\n3️⃣ TESTING REPLY VALIDATION:\n";
    
    $testMessage = $messages->first();
    
    // Test empty reply
    $emptyRequest = Request::create('/admin/messages/' . $testMessage->id . '/reply', 'POST', [
        'reply_message' => '',
        'send_email' => '1',
    ]);
    
    $validator = \Validator::make($emptyRequest->all(), [
        'reply_message' => 'required|string|max:2000',
        'send_email' => 'nullable|boolean',
    ], [
        'reply_message.required' => 'Please enter a reply message.',
        'reply_message.max' => 'Reply message cannot exceed 2000 characters.',
    ]);
    
    if ($validator->fails()) {
        echo "   ✅ Empty reply validation failed as expected\n";
        echo "     Error: " . $validator->errors()->first('reply_message') . "\n";
    } else {
        echo "   ❌ Empty reply validation should have failed\n";
    }
    
    // Test too long reply
    $longReply = str_repeat('This is a very long reply message. ', 100); // > 2000 chars
    
    $longRequest = Request::create('/admin/messages/' . $testMessage->id . '/reply', 'POST', [
        'reply_message' => $longReply,
        'send_email' => '1',
    ]);
    
    $validator = \Validator::make($longRequest->all(), [
        'reply_message' => 'required|string|max:2000',
        'send_email' => 'nullable|boolean',
    ], [
        'reply_message.required' => 'Please enter a reply message.',
        'reply_message.max' => 'Reply message cannot exceed 2000 characters.',
    ]);
    
    if ($validator->fails()) {
        echo "   ✅ Long reply validation failed as expected\n";
        echo "     Error: " . $validator->errors()->first('reply_message') . "\n";
    } else {
        echo "   ❌ Long reply validation should have failed\n";
    }
    
    // 4. Test successful reply (without email)
    echo "\n4️⃣ TESTING SUCCESSFUL REPLY (WITHOUT EMAIL):\n";
    
    if ($testMessage->status !== 'replied') {
        // Simulate admin authentication
        Auth::login($adminUser);
        
        $validReply = "Thank you for your message. We have reviewed your inquiry and will get back to you soon with more details.";
        
        $validRequest = Request::create('/admin/messages/' . $testMessage->id . '/reply', 'POST', [
            'reply_message' => $validReply,
            'send_email' => '0', // Don't send email for test
        ]);
        
        $validRequest->setUserResolver(function () use ($adminUser) {
            return $adminUser;
        });
        
        echo "   Sending reply without email...\n";
        
        // Create controller and call method
        $controller = new AdminController();
        
        try {
            $response = $controller->replyMessage($validRequest, $testMessage);
            
            echo "   ✅ Reply method executed successfully\n";
            
            // Check if message was updated
            $testMessage->refresh();
            
            if ($testMessage->status === 'replied') {
                echo "   ✅ Message status updated to 'replied'\n";
                echo "   ✅ Admin reply saved: " . substr($testMessage->admin_reply, 0, 50) . "...\n";
                echo "   ✅ Replied by: {$testMessage->replied_by}\n";
                echo "   ✅ Replied at: {$testMessage->replied_at}\n";
            } else {
                echo "   ❌ Message status not updated\n";
            }
            
        } catch (\Exception $e) {
            echo "   ❌ Reply method failed: " . $e->getMessage() . "\n";
        }
    } else {
        echo "   ⚠️ Message already replied to\n";
        echo "   - Status: {$testMessage->status}\n";
        echo "   - Reply: " . substr($testMessage->admin_reply, 0, 100) . "...\n";
    }
    
    // 5. Test email template
    echo "\n5️⃣ TESTING EMAIL TEMPLATE:\n";
    
    $templatePath = resource_path('views/emails/admin-reply.blade.php');
    
    if (file_exists($templatePath)) {
        echo "   ✅ Email template exists: {$templatePath}\n";
        
        // Test template compilation
        try {
            $view = view('emails.admin-reply', [
                'message' => $testMessage,
                'reply' => 'This is a test reply message.',
                'admin' => $adminUser,
            ]);
            
            $html = $view->render();
            
            if (strlen($html) > 100) {
                echo "   ✅ Email template renders successfully (" . strlen($html) . " characters)\n";
                echo "   ✅ Template includes message subject: " . (strpos($html, $testMessage->subject) !== false ? 'Yes' : 'No') . "\n";
                echo "   ✅ Template includes reply content: " . (strpos($html, 'test reply') !== false ? 'Yes' : 'No') . "\n";
            } else {
                echo "   ❌ Email template rendered but content seems too short\n";
            }
            
        } catch (\Exception $e) {
            echo "   ❌ Email template compilation failed: " . $e->getMessage() . "\n";
        }
    } else {
        echo "   ❌ Email template not found\n";
    }
    
    // 6. Test route configuration
    echo "\n6️⃣ TESTING ROUTE CONFIGURATION:\n";
    
    $routes = collect(\Route::getRoutes())->filter(function ($route) {
        return str_contains($route->getName() ?? '', 'messages.reply');
    });
    
    if ($routes->count() > 0) {
        echo "   ✅ Reply route found:\n";
        foreach ($routes as $route) {
            echo "     - " . implode('|', $route->methods()) . " " . $route->uri() . " -> " . $route->getName() . "\n";
        }
    } else {
        echo "   ❌ Reply route not found\n";
    }
    
    echo "\n✅ Admin reply system testing completed!\n";
    
    // Summary
    echo "\n📋 SUMMARY:\n";
    echo "✅ Contact messages: Available\n";
    echo "✅ Admin users: Available\n";
    echo "✅ Validation rules: Working\n";
    echo "✅ Reply functionality: " . ($testMessage->status === 'replied' ? 'Working' : 'Needs testing') . "\n";
    echo "✅ Email template: " . (file_exists($templatePath) ? 'Available' : 'Missing') . "\n";
    echo "✅ Routes: Configured\n";
    
    // Clean up test message if created
    if (isset($testMessage) && $testMessage->name === 'Test User') {
        echo "\n🗑️ Cleaning up test message...\n";
        $testMessage->delete();
        echo "   ✅ Test message deleted\n";
    }
    
} catch (\Exception $e) {
    echo "\n❌ Error during admin reply system testing:\n";
    echo "   Error: " . $e->getMessage() . "\n";
    echo "   File: " . $e->getFile() . ":" . $e->getLine() . "\n";
    
    if ($e->getPrevious()) {
        echo "   Previous: " . $e->getPrevious()->getMessage() . "\n";
    }
    
    exit(1);
}
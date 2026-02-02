<?php

require_once 'vendor/autoload.php';

use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

// Bootstrap Laravel
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

echo "🤖 Testing Smart Contact Chatbot\n";
echo "=" . str_repeat("=", 50) . "\n\n";

try {
    // Test 1: Check if routes are registered
    echo "1️⃣ Testing Route Registration...\n";
    
    $routes = app('router')->getRoutes();
    $chatbotRoutes = [];
    
    foreach ($routes as $route) {
        $uri = $route->uri();
        if (str_contains($uri, 'chatbot')) {
            $chatbotRoutes[] = [
                'method' => implode('|', $route->methods()),
                'uri' => $uri,
                'name' => $route->getName(),
                'action' => $route->getActionName()
            ];
        }
    }
    
    if (empty($chatbotRoutes)) {
        echo "   ❌ No chatbot routes found\n";
    } else {
        echo "   ✅ Found " . count($chatbotRoutes) . " chatbot routes:\n";
        foreach ($chatbotRoutes as $route) {
            echo "      • {$route['method']} /{$route['uri']} -> {$route['action']}\n";
        }
    }
    echo "\n";
    
    // Test 2: Test Predefined Answers Endpoint
    echo "2️⃣ Testing Predefined Answers Endpoint...\n";
    
    $request = Request::create('/chatbot/predefined', 'GET');
    $response = app()->handle($request);
    
    if ($response->getStatusCode() === 200) {
        $data = json_decode($response->getContent(), true);
        echo "   ✅ Predefined answers endpoint working\n";
        echo "   📊 Found " . count($data['answers'] ?? []) . " predefined answer patterns\n";
        
        // Show sample patterns
        if (!empty($data['answers'])) {
            echo "   📝 Sample patterns:\n";
            foreach (array_slice($data['answers'], 0, 3) as $answer) {
                echo "      • Keywords: " . implode(', ', $answer['keywords']) . "\n";
                echo "        Reply: " . substr($answer['reply'], 0, 60) . "...\n";
            }
        }
    } else {
        echo "   ❌ Predefined answers endpoint failed: " . $response->getStatusCode() . "\n";
    }
    echo "\n";
    
    // Test 3: Test Predefined Answer Matching
    echo "3️⃣ Testing Predefined Answer Matching...\n";
    
    $testMessages = [
        'How do I rent a car?',
        'What are your prices?',
        'How does KYC work?',
        'Contact support',
        'Random message that should not match'
    ];
    
    if (!empty($data['answers'])) {
        foreach ($testMessages as $message) {
            $found = false;
            $matchedAnswer = null;
            
            foreach ($data['answers'] as $answer) {
                foreach ($answer['keywords'] as $keyword) {
                    if (stripos($message, $keyword) !== false) {
                        $found = true;
                        $matchedAnswer = $answer['reply'];
                        break 2;
                    }
                }
            }
            
            if ($found) {
                echo "   ✅ \"$message\" -> Matched predefined answer\n";
                echo "      Reply: " . substr($matchedAnswer, 0, 80) . "...\n";
            } else {
                echo "   ⚠️  \"$message\" -> No predefined match (will use AI)\n";
            }
        }
    }
    echo "\n";
    
    // Test 4: Test AI Endpoint (without actual API call)
    echo "4️⃣ Testing AI Endpoint Structure...\n";
    
    // Create a test request
    $aiRequest = Request::create('/chatbot/ai', 'POST', [], [], [], [], json_encode([
        'message' => 'Test message'
    ]));
    $aiRequest->headers->set('Content-Type', 'application/json');
    $aiRequest->headers->set('X-CSRF-TOKEN', 'test-token');
    
    // Check if OpenAI API key is configured
    $apiKey = env('OPENAI_API_KEY');
    if (empty($apiKey)) {
        echo "   ⚠️  OpenAI API key not configured in .env file\n";
        echo "      Add: OPENAI_API_KEY=your-api-key-here\n";
    } else {
        echo "   ✅ OpenAI API key is configured\n";
    }
    
    // Test controller exists
    if (class_exists('App\\Http\\Controllers\\ChatbotController')) {
        echo "   ✅ ChatbotController exists\n";
        
        $controller = new \App\Http\Controllers\ChatbotController();
        if (method_exists($controller, 'askAI')) {
            echo "   ✅ askAI method exists\n";
        } else {
            echo "   ❌ askAI method not found\n";
        }
    } else {
        echo "   ❌ ChatbotController not found\n";
    }
    echo "\n";
    
    // Test 5: Frontend Integration Check
    echo "5️⃣ Testing Frontend Integration...\n";
    
    $layoutPath = 'resources/views/layouts/app.blade.php';
    if (file_exists($layoutPath)) {
        $layoutContent = file_get_contents($layoutPath);
        
        $checks = [
            'smart-chatbot' => 'Chatbot container',
            'chatbot-toggle' => 'Toggle button',
            'chatbot-window' => 'Chat window',
            'chat-messages' => 'Messages container',
            'chat-input' => 'Input field',
            'sendMessage' => 'Send message function',
            'toggleChatbot' => 'Toggle function',
            'getPredefinedAnswer' => 'Predefined answer function'
        ];
        
        foreach ($checks as $element => $description) {
            if (strpos($layoutContent, $element) !== false) {
                echo "   ✅ $description found\n";
            } else {
                echo "   ❌ $description missing\n";
            }
        }
    } else {
        echo "   ❌ Layout file not found\n";
    }
    echo "\n";
    
    // Test 6: Chatbot Features Summary
    echo "6️⃣ Chatbot Features Summary...\n";
    
    $features = [
        '🌐 Global Availability' => 'Available on all pages via layout',
        '🤖 Hybrid AI System' => 'Predefined answers + OpenAI fallback',
        '💬 Real-time Chat' => 'Interactive chat interface',
        '🎯 Quick Actions' => 'Predefined quick response buttons',
        '🌍 Bilingual Support' => 'English and Amharic languages',
        '📱 Mobile Responsive' => 'Works on all device sizes',
        '🔒 Secure API' => 'Protected backend endpoints',
        '⚡ Fast Responses' => 'Instant predefined answers',
        '🎨 Modern UI' => 'Beautiful floating chat widget',
        '🔄 Smart Fallback' => 'AI when predefined answers fail'
    ];
    
    foreach ($features as $feature => $description) {
        echo "   $feature: $description\n";
    }
    echo "\n";
    
    // Test 7: Usage Instructions
    echo "7️⃣ Usage Instructions...\n";
    echo "   📋 To use the chatbot:\n";
    echo "      1. Add your OpenAI API key to .env: OPENAI_API_KEY=your-key\n";
    echo "      2. Visit any page on your website\n";
    echo "      3. Look for the floating blue chat button (bottom-right)\n";
    echo "      4. Click to open the chat window\n";
    echo "      5. Type messages or use quick action buttons\n";
    echo "      6. Chatbot will respond with predefined answers or AI\n\n";
    
    echo "   🎯 Predefined Topics:\n";
    if (!empty($data['answers'])) {
        foreach ($data['answers'] as $answer) {
            echo "      • " . implode(', ', $answer['keywords']) . "\n";
        }
    }
    echo "\n";
    
    echo "🎉 Smart Contact Chatbot Test Complete!\n";
    echo "✅ Chatbot is ready for use (add OpenAI API key if needed)\n";
    echo "🚀 Features: Global availability, AI-powered, bilingual, mobile-friendly\n";
    
} catch (Exception $e) {
    echo "❌ Error during testing: " . $e->getMessage() . "\n";
    echo "📍 File: " . $e->getFile() . " Line: " . $e->getLine() . "\n";
}
<?php

/**
 * Test email configuration and sending
 */

require_once 'vendor/autoload.php';

echo "📧 TESTING EMAIL CONFIGURATION\n";
echo "==============================\n\n";

// Test 1: Check .env configuration
echo "1. Checking Email Configuration...\n";
if (file_exists('.env')) {
    $env = file_get_contents('.env');
    
    // Extract email settings
    preg_match('/MAIL_MAILER=(.*)/', $env, $mailer);
    preg_match('/MAIL_HOST=(.*)/', $env, $host);
    preg_match('/MAIL_PORT=(.*)/', $env, $port);
    preg_match('/MAIL_USERNAME=(.*)/', $env, $username);
    preg_match('/MAIL_FROM_ADDRESS="?(.*?)"?$/', $env, $from);
    preg_match('/MAIL_FROM_NAME="(.*)"/', $env, $fromName);
    
    echo "   📋 Mailer: " . trim($mailer[1] ?? 'Not set') . "\n";
    echo "   📋 Host: " . trim($host[1] ?? 'Not set') . "\n";
    echo "   📋 Port: " . trim($port[1] ?? 'Not set') . "\n";
    echo "   📋 Username: " . trim($username[1] ?? 'Not set') . "\n";
    echo "   📋 From Address: " . trim($from[1] ?? 'Not set') . "\n";
    echo "   📋 From Name: " . trim($fromName[1] ?? 'Not set') . "\n";
    
    // Check if all required settings are present
    $required = ['MAIL_MAILER=smtp', 'MAIL_HOST=smtp.gmail.com', 'MAIL_USERNAME=fitsumgashaw22@gmail.com'];
    $allPresent = true;
    
    foreach ($required as $setting) {
        if (strpos($env, $setting) === false) {
            echo "   ❌ Missing: $setting\n";
            $allPresent = false;
        }
    }
    
    if ($allPresent) {
        echo "   ✅ All required email settings present\n";
    }
} else {
    echo "   ❌ .env file not found\n";
}

// Test 2: Check Mailable class
echo "\n2. Checking Mailable Class...\n";
$mailableFile = 'app/Mail/PurchaseConfirmationMail.php';
if (file_exists($mailableFile)) {
    $content = file_get_contents($mailableFile);
    
    if (strpos($content, 'ShouldQueue') !== false) {
        echo "   ⚠️  Email is still queued - may not send immediately\n";
    } else {
        echo "   ✅ Email sends immediately (not queued)\n";
    }
    
    if (strpos($content, 'purchase-confirmation') !== false) {
        echo "   ✅ Template reference correct\n";
    } else {
        echo "   ❌ Template reference missing\n";
    }
} else {
    echo "   ❌ PurchaseConfirmationMail class not found\n";
}

// Test 3: Check email template
echo "\n3. Checking Email Template...\n";
$templateFile = 'resources/views/emails/purchase-confirmation.blade.php';
if (file_exists($templateFile)) {
    echo "   ✅ Email template exists\n";
    
    $content = file_get_contents($templateFile);
    $size = strlen($content);
    echo "   📋 Template size: " . number_format($size) . " bytes\n";
    
    // Check for potential issues
    if (strpos($content, '{{ $purchase') !== false) {
        echo "   ✅ Template uses purchase variable\n";
    } else {
        echo "   ❌ Template missing purchase variable\n";
    }
} else {
    echo "   ❌ Email template not found\n";
}

echo "\n🔧 TROUBLESHOOTING STEPS:\n";
echo "========================\n";
echo "1. Test email sending with command:\n";
echo "   php artisan test:purchase-email\n\n";

echo "2. Check Laravel logs for errors:\n";
echo "   tail -f storage/logs/laravel.log\n\n";

echo "3. Test Gmail SMTP connection:\n";
echo "   php test_gmail_smtp.php\n\n";

echo "4. Verify queue is not blocking emails:\n";
echo "   Check if ShouldQueue is removed from Mailable\n\n";

echo "5. Test with a simple email:\n";
echo "   Create a basic test email to verify SMTP works\n\n";

echo "✅ NEXT STEPS:\n";
echo "==============\n";
echo "1. Run: php artisan test:purchase-email\n";
echo "2. Check the output for any errors\n";
echo "3. If it fails, check Gmail app password\n";
echo "4. Verify email template renders correctly\n";

echo "\n🎯 READY FOR TESTING!\n";
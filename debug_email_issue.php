<?php

/**
 * Debug script to identify email sending issues
 */

require_once 'vendor/autoload.php';

echo "🔍 DEBUGGING EMAIL SENDING ISSUE\n";
echo "================================\n\n";

// Test 1: Check Laravel configuration
echo "1. Checking Laravel Configuration...\n";
try {
    // Check if we can access Laravel config
    if (file_exists('.env')) {
        $env = file_get_contents('.env');
        
        // Check mail configuration
        if (strpos($env, 'MAIL_MAILER=smtp') !== false) {
            echo "   ✅ SMTP mailer configured\n";
        } else {
            echo "   ❌ SMTP mailer not configured\n";
        }
        
        if (strpos($env, 'MAIL_HOST=smtp.gmail.com') !== false) {
            echo "   ✅ Gmail SMTP host configured\n";
        } else {
            echo "   ❌ Gmail SMTP host not configured\n";
        }
        
        if (strpos($env, 'MAIL_USERNAME=fitsumgashaw22@gmail.com') !== false) {
            echo "   ✅ Gmail username configured\n";
        } else {
            echo "   ❌ Gmail username not configured\n";
        }
        
        if (strpos($env, 'MAIL_PASSWORD=') !== false) {
            echo "   ✅ Gmail password configured\n";
        } else {
            echo "   ❌ Gmail password not configured\n";
        }
    }
} catch (Exception $e) {
    echo "   ⚠️  Error checking configuration: " . $e->getMessage() . "\n";
}

// Test 2: Check if queue is running
echo "\n2. Checking Queue Configuration...\n";
try {
    if (file_exists('.env')) {
        $env = file_get_contents('.env');
        
        if (strpos($env, 'QUEUE_CONNECTION=') !== false) {
            preg_match('/QUEUE_CONNECTION=(.*)/', $env, $matches);
            $queueConnection = trim($matches[1] ?? 'sync');
            echo "   📋 Queue connection: $queueConnection\n";
            
            if ($queueConnection === 'database') {
                echo "   ⚠️  Database queue requires 'php artisan queue:work' to be running\n";
            } elseif ($queueConnection === 'sync') {
                echo "   ✅ Sync queue (emails sent immediately)\n";
            }
        }
    }
} catch (Exception $e) {
    echo "   ⚠️  Error checking queue: " . $e->getMessage() . "\n";
}

// Test 3: Check if Mailable is properly configured
echo "\n3. Checking Mailable Configuration...\n";
$mailableFile = 'app/Mail/PurchaseConfirmationMail.php';
if (file_exists($mailableFile)) {
    $content = file_get_contents($mailableFile);
    
    if (strpos($content, 'ShouldQueue') !== false) {
        echo "   ⚠️  Email is queued - requires queue worker\n";
        echo "   💡 Consider removing 'ShouldQueue' for immediate sending\n";
    } else {
        echo "   ✅ Email sends immediately (not queued)\n";
    }
} else {
    echo "   ❌ PurchaseConfirmationMail not found\n";
}

// Test 4: Check ChapaPaymentController integration
echo "\n4. Checking Controller Integration...\n";
$controllerFile = 'app/Http/Controllers/ChapaPaymentController.php';
if (file_exists($controllerFile)) {
    $content = file_get_contents($controllerFile);
    
    if (strpos($content, 'Mail::to($purchase->user->email)->send(new PurchaseConfirmationMail($purchase))') !== false) {
        echo "   ✅ Email sending code found in controller\n";
    } else {
        echo "   ❌ Email sending code not found in controller\n";
    }
    
    if (strpos($content, 'updatePayableStatus') !== false) {
        echo "   ✅ updatePayableStatus method exists\n";
    } else {
        echo "   ❌ updatePayableStatus method not found\n";
    }
} else {
    echo "   ❌ ChapaPaymentController not found\n";
}

echo "\n🔧 POTENTIAL ISSUES AND SOLUTIONS:\n";
echo "==================================\n";

echo "1. QUEUE ISSUE:\n";
echo "   Problem: Email is queued but queue worker not running\n";
echo "   Solution: Either run 'php artisan queue:work' OR remove ShouldQueue\n\n";

echo "2. EMAIL CONFIGURATION:\n";
echo "   Problem: Gmail SMTP not properly configured\n";
echo "   Solution: Verify .env file has correct Gmail settings\n\n";

echo "3. CONTROLLER INTEGRATION:\n";
echo "   Problem: Email sending code not triggered\n";
echo "   Solution: Verify payment success triggers updatePayableStatus\n\n";

echo "4. ERROR HANDLING:\n";
echo "   Problem: Email errors are caught and logged silently\n";
echo "   Solution: Check Laravel logs for email errors\n\n";

echo "🚀 RECOMMENDED FIXES:\n";
echo "=====================\n";
echo "1. Remove ShouldQueue from PurchaseConfirmationMail for immediate sending\n";
echo "2. Add debug logging to see if email code is reached\n";
echo "3. Test email sending with a simple test command\n";
echo "4. Check Laravel logs for any email errors\n";

echo "\n✅ DEBUG COMPLETE\n";
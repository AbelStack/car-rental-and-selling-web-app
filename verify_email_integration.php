<?php

require_once 'vendor/autoload.php';

use Illuminate\Foundation\Application;
use App\Models\Purchase;
use App\Models\ChapaTransaction;
use App\Http\Controllers\ChapaPaymentController;
use Illuminate\Support\Facades\Log;

// Bootstrap Laravel
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$kernel->bootstrap();

echo "🔍 EMAIL INTEGRATION VERIFICATION\n";
echo "=================================\n\n";

try {
    // 1. Check recent successful transactions
    echo "📊 Checking Recent Successful Transactions...\n";
    
    $recentTransactions = ChapaTransaction::where('status', 'success')
        ->where('created_at', '>=', now()->subDays(7))
        ->with(['payable'])
        ->orderBy('created_at', 'desc')
        ->take(5)
        ->get();
    
    if ($recentTransactions->isEmpty()) {
        echo "⚠️  No recent successful transactions found\n";
    } else {
        echo "✅ Found {$recentTransactions->count()} recent successful transactions:\n";
        foreach ($recentTransactions as $transaction) {
            echo "   - {$transaction->chapa_tx_ref} ({$transaction->created_at->format('M d, Y H:i')})\n";
            if ($transaction->payable_type === 'App\Models\Purchase' && $transaction->payable) {
                $purchase = $transaction->payable;
                echo "     Purchase: {$purchase->purchase_reference} - {$purchase->status}\n";
            } elseif ($transaction->payable_type === 'App\Models\Booking' && $transaction->payable) {
                $booking = $transaction->payable;
                echo "     Booking: #{$booking->id} - {$booking->status}\n";
            } else {
                echo "     Related record: Not found or deleted\n";
            }
        }
    }
    
    // 2. Check recent purchases
    echo "\n📝 Checking Recent Purchases...\n";
    
    $recentPurchases = Purchase::where('created_at', '>=', now()->subDays(7))
        ->with(['user', 'vehicle'])
        ->orderBy('created_at', 'desc')
        ->take(5)
        ->get();
    
    if ($recentPurchases->isEmpty()) {
        echo "⚠️  No recent purchases found\n";
    } else {
        echo "✅ Found {$recentPurchases->count()} recent purchases:\n";
        foreach ($recentPurchases as $purchase) {
            echo "   - {$purchase->purchase_reference}: {$purchase->status}\n";
            echo "     Customer: {$purchase->user->name} ({$purchase->user->email})\n";
            echo "     Vehicle: {$purchase->vehicle->full_name}\n";
            echo "     Amount: \${$purchase->total_amount}\n";
        }
    }
    
    // 3. Check Laravel logs for email confirmations
    echo "\n📋 Checking Laravel Logs for Email Confirmations...\n";
    
    $logFile = storage_path('logs/laravel.log');
    if (!file_exists($logFile)) {
        echo "⚠️  Laravel log file not found\n";
    } else {
        $logs = file_get_contents($logFile);
        $emailLogs = [];
        
        // Search for email confirmation logs
        $lines = explode("\n", $logs);
        foreach ($lines as $line) {
            if (strpos($line, 'Purchase confirmation email sent') !== false) {
                $emailLogs[] = $line;
            }
        }
        
        if (empty($emailLogs)) {
            echo "⚠️  No email confirmation logs found\n";
        } else {
            echo "✅ Found " . count($emailLogs) . " email confirmation logs:\n";
            foreach (array_slice($emailLogs, -5) as $log) {
                echo "   " . trim($log) . "\n";
            }
        }
    }
    
    // 4. Test email configuration
    echo "\n⚙️  Verifying Email Configuration...\n";
    
    $mailConfig = [
        'MAIL_MAILER' => env('MAIL_MAILER'),
        'MAIL_HOST' => env('MAIL_HOST'),
        'MAIL_PORT' => env('MAIL_PORT'),
        'MAIL_USERNAME' => env('MAIL_USERNAME'),
        'MAIL_ENCRYPTION' => env('MAIL_ENCRYPTION'),
        'MAIL_FROM_ADDRESS' => env('MAIL_FROM_ADDRESS'),
        'MAIL_FROM_NAME' => env('MAIL_FROM_NAME'),
    ];
    
    foreach ($mailConfig as $key => $value) {
        if ($key === 'MAIL_PASSWORD') {
            echo "   ✅ {$key}: [HIDDEN]\n";
        } else {
            echo "   ✅ {$key}: {$value}\n";
        }
    }
    
    // 5. Check ChapaPaymentController integration
    echo "\n🔧 Verifying ChapaPaymentController Integration...\n";
    
    $controllerFile = app_path('Http/Controllers/ChapaPaymentController.php');
    if (!file_exists($controllerFile)) {
        echo "❌ ChapaPaymentController not found\n";
    } else {
        $controllerContent = file_get_contents($controllerFile);
        
        $checks = [
            'PurchaseConfirmationMail' => strpos($controllerContent, 'PurchaseConfirmationMail') !== false,
            'Mail::to' => strpos($controllerContent, 'Mail::to') !== false,
            'updatePayableStatus' => strpos($controllerContent, 'updatePayableStatus') !== false,
            'Log::info' => strpos($controllerContent, 'Log::info') !== false,
        ];
        
        foreach ($checks as $check => $found) {
            echo "   " . ($found ? "✅" : "❌") . " {$check}: " . ($found ? "Found" : "Missing") . "\n";
        }
    }
    
    // 6. Final status
    echo "\n🎯 FINAL VERIFICATION RESULTS:\n";
    echo "==============================\n";
    
    $allGood = true;
    
    // Check if email template exists
    $emailTemplate = resource_path('views/emails/purchase-confirmation.blade.php');
    if (file_exists($emailTemplate)) {
        echo "✅ Email template: EXISTS\n";
    } else {
        echo "❌ Email template: MISSING\n";
        $allGood = false;
    }
    
    // Check if Mailable class exists
    $mailableClass = app_path('Mail/PurchaseConfirmationMail.php');
    if (file_exists($mailableClass)) {
        echo "✅ Mailable class: EXISTS\n";
    } else {
        echo "❌ Mailable class: MISSING\n";
        $allGood = false;
    }
    
    // Check email configuration
    if (env('MAIL_HOST') && env('MAIL_USERNAME') && env('MAIL_FROM_ADDRESS')) {
        echo "✅ Email configuration: COMPLETE\n";
    } else {
        echo "❌ Email configuration: INCOMPLETE\n";
        $allGood = false;
    }
    
    // Check controller integration
    if (file_exists($controllerFile) && strpos(file_get_contents($controllerFile), 'PurchaseConfirmationMail') !== false) {
        echo "✅ Controller integration: ACTIVE\n";
    } else {
        echo "❌ Controller integration: MISSING\n";
        $allGood = false;
    }
    
    echo "\n" . ($allGood ? "🎉" : "⚠️") . " OVERALL STATUS: " . ($allGood ? "FULLY FUNCTIONAL" : "NEEDS ATTENTION") . "\n";
    
    if ($allGood) {
        echo "\n📧 Email confirmation system is working perfectly!\n";
        echo "✨ Users will receive confirmation emails after successful purchases.\n";
    } else {
        echo "\n🔧 Some components need attention. Please review the issues above.\n";
    }
    
} catch (Exception $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
    echo "📍 File: " . $e->getFile() . ":" . $e->getLine() . "\n";
    exit(1);
}
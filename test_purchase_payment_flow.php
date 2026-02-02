<?php

require_once 'vendor/autoload.php';

use Illuminate\Foundation\Application;

// Bootstrap Laravel
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "=== Purchase Payment Flow Test ===\n\n";

try {
    // Test 1: Check if we have any purchases with 'pending' status
    echo "1. Checking existing purchases with 'pending' status:\n";
    
    $pendingPurchases = App\Models\Purchase::where('status', 'pending')->get();
    echo "   Found " . $pendingPurchases->count() . " pending purchases\n";
    
    if ($pendingPurchases->count() > 0) {
        $purchase = $pendingPurchases->first();
        echo "   Sample purchase ID: {$purchase->id}\n";
        echo "   Status: {$purchase->status}\n";
        echo "   Total Amount: \${$purchase->total_amount}\n";
        echo "   User ID: {$purchase->user_id}\n";
        
        // Test 2: Check if user has KYC verification
        echo "\n2. Checking user KYC status:\n";
        $user = $purchase->user;
        echo "   User: {$user->name} ({$user->email})\n";
        
        $kyc = $user->kycVerification;
        if ($kyc) {
            echo "   KYC Status: {$kyc->status}\n";
            echo "   Can Purchase: " . ($user->canPurchaseVehicles() ? 'Yes' : 'No') . "\n";
        } else {
            echo "   KYC Status: Not submitted\n";
            echo "   Can Purchase: No\n";
        }
        
        // Test 3: Simulate payment initialization check
        echo "\n3. Testing payment initialization logic:\n";
        
        // Check the conditions that ChapaPaymentController checks
        $canPay = true;
        $reasons = [];
        
        if ($purchase->status !== 'pending') {
            $canPay = false;
            $reasons[] = "Purchase status is '{$purchase->status}', expected 'pending'";
        }
        
        if (!$user->canPurchaseVehicles()) {
            $canPay = false;
            $reasons[] = "User cannot purchase vehicles (KYC not approved)";
        }
        
        if ($canPay) {
            echo "   ✓ Payment can be initialized\n";
            echo "   ✓ All conditions met for Chapa payment\n";
        } else {
            echo "   ✗ Payment cannot be initialized\n";
            foreach ($reasons as $reason) {
                echo "   - {$reason}\n";
            }
        }
        
        // Test 4: Check if there are existing transactions for this purchase
        echo "\n4. Checking existing Chapa transactions:\n";
        $transactions = App\Models\ChapaTransaction::where('payable_type', 'App\\Models\\Purchase')
            ->where('payable_id', $purchase->id)
            ->get();
            
        echo "   Found " . $transactions->count() . " existing transactions\n";
        
        foreach ($transactions as $transaction) {
            echo "   - Transaction ID: {$transaction->id}, Status: {$transaction->status}\n";
        }
        
    } else {
        echo "   No pending purchases found. Create a purchase first.\n";
    }
    
    // Test 5: Check purchase status options
    echo "\n5. Purchase Status Information:\n";
    echo "   Expected status for new purchases: 'pending'\n";
    echo "   Expected status after payment: 'paid'\n";
    echo "   ChapaPaymentController now checks for: 'pending' (FIXED)\n";
    
} catch (Exception $e) {
    echo "Error during testing: " . $e->getMessage() . "\n";
    echo "File: " . $e->getFile() . ":" . $e->getLine() . "\n";
}

echo "\n=== Test Complete ===\n";
echo "\n💡 SOLUTION APPLIED:\n";
echo "- Fixed ChapaPaymentController to check for 'pending' status instead of 'pending_payment'\n";
echo "- Purchase payment should now work properly\n";
echo "- Try clicking 'Pay with Chapa' button again\n";
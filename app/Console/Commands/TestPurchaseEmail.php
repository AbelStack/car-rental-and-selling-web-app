<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Purchase;
use App\Mail\PurchaseConfirmationMail;
use Illuminate\Support\Facades\Mail;

class TestPurchaseEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:purchase-email {purchase_id?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Test sending purchase confirmation email';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('🧪 Testing Purchase Confirmation Email');
        $this->info('====================================');

        // Get purchase ID from argument or find the latest purchase
        $purchaseId = $this->argument('purchase_id');
        
        if ($purchaseId) {
            $purchase = Purchase::find($purchaseId);
            if (!$purchase) {
                $this->error("Purchase with ID {$purchaseId} not found.");
                return 1;
            }
        } else {
            $purchase = Purchase::with(['user', 'vehicle'])->latest()->first();
            if (!$purchase) {
                $this->error('No purchases found in the database.');
                return 1;
            }
        }

        $this->info("Testing with Purchase: {$purchase->purchase_reference}");
        $this->info("Customer: {$purchase->user->name}");
        $this->info("Email: {$purchase->user->email}");
        $this->info("Vehicle: {$purchase->vehicle->full_name}");
        $this->newLine();

        try {
            $this->info('Sending email...');
            
            // Send the email
            Mail::to($purchase->user->email)->send(new PurchaseConfirmationMail($purchase));
            
            $this->info('✅ Email sent successfully!');
            $this->info("📧 Confirmation email sent to: {$purchase->user->email}");
            
            return 0;
            
        } catch (\Exception $e) {
            $this->error('❌ Failed to send email:');
            $this->error($e->getMessage());
            
            $this->newLine();
            $this->warn('Possible issues:');
            $this->warn('1. Gmail SMTP configuration incorrect');
            $this->warn('2. Gmail app password expired');
            $this->warn('3. Email template has errors');
            $this->warn('4. Network connectivity issues');
            
            return 1;
        }
    }
}
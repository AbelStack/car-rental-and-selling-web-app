<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('chapa_transactions', function (Blueprint $table) {
            $table->id();
            
            // Transaction References
            $table->string('chapa_tx_ref')->unique(); // Chapa transaction reference
            $table->string('our_tx_ref')->unique(); // Our internal reference
            $table->morphs('payable'); // booking_id or purchase_id
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            
            // Transaction Details
            $table->decimal('amount', 12, 2);
            $table->string('currency', 3)->default('ETB');
            $table->string('email'); // Customer email for Chapa
            $table->string('phone_number'); // Customer phone
            $table->string('first_name');
            $table->string('last_name');
            
            // Chapa Response Data
            $table->enum('status', ['initiated', 'pending', 'success', 'failed', 'cancelled'])->default('initiated')->index();
            $table->string('chapa_status')->nullable(); // Raw Chapa status
            $table->json('chapa_response')->nullable(); // Full Chapa response
            $table->string('checkout_url')->nullable(); // Chapa checkout URL
            
            // Verification & Callback
            $table->timestamp('paid_at')->nullable();
            $table->string('chapa_reference')->nullable(); // Chapa's internal reference
            $table->json('callback_data')->nullable(); // Webhook callback data
            $table->timestamp('callback_received_at')->nullable();
            
            // Audit Fields
            $table->string('ip_address')->nullable();
            $table->json('user_agent')->nullable();
            
            $table->timestamps();
            
            // Indexes
            $table->index(['user_id', 'status']);
            $table->index('paid_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chapa_transactions');
    }
};
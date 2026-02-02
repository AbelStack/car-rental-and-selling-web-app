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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->string('payment_reference')->unique();
            $table->morphs('payable'); // booking_id or purchase_id
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            
            // Payment details
            $table->decimal('amount', 12, 2);
            $table->enum('payment_method', ['mobile_banking', 'bank_transfer', 'cash'])->default('mobile_banking');
            $table->string('bank_name')->nullable();
            $table->string('account_number')->nullable();
            $table->text('payment_instructions')->nullable();
            
            // Transaction details
            $table->string('transaction_reference')->nullable();
            $table->text('transaction_proof')->nullable(); // file path or description
            $table->timestamp('transaction_date')->nullable();
            
            // Status and verification
            $table->enum('status', ['pending', 'submitted', 'verified', 'rejected', 'expired'])->default('pending');
            $table->text('rejection_reason')->nullable();
            $table->foreignId('verified_by')->nullable()->constrained('users');
            $table->timestamp('verified_at')->nullable();
            $table->timestamp('expires_at')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};

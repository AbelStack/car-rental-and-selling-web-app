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
        Schema::table('users', function (Blueprint $table) {
            // KYC Status Fields
            $table->enum('kyc_status', ['unverified', 'pending', 'under_review', 'verified', 'rejected', 'expired'])
                  ->default('unverified')->after('status')->index();
            $table->timestamp('kyc_verified_at')->nullable()->after('kyc_status');
            $table->text('kyc_rejection_reason')->nullable()->after('kyc_verified_at');
            $table->integer('kyc_attempts')->default(0)->after('kyc_rejection_reason');
            
            // Verification Level (1=email, 2=phone, 3=KYC documents)
            $table->tinyInteger('verification_level')->default(1)->after('kyc_attempts');
            $table->timestamp('phone_verified_at')->nullable()->after('verification_level');
            
            // Account Restrictions
            $table->boolean('can_book')->default(false)->after('phone_verified_at');
            $table->boolean('can_purchase')->default(false)->after('can_book');
            $table->timestamp('restrictions_updated_at')->nullable()->after('can_purchase');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'kyc_status', 'kyc_verified_at', 'kyc_rejection_reason', 'kyc_attempts',
                'verification_level', 'phone_verified_at', 'can_book', 'can_purchase',
                'restrictions_updated_at'
            ]);
        });
    }
};
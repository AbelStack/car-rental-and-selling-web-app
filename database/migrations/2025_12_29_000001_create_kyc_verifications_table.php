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
        Schema::create('kyc_verifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            
            // Document Information
            $table->enum('document_type', ['national_id', 'passport'])->index();
            $table->string('document_number')->unique();
            $table->string('document_front_path'); // Front side image
            $table->string('document_back_path')->nullable(); // Back side (for national ID)
            $table->string('selfie_path'); // Selfie with document
            
            // Personal Information from Document
            $table->string('full_name');
            $table->date('date_of_birth');
            $table->enum('gender', ['male', 'female']);
            $table->string('nationality')->default('Ethiopian');
            $table->date('document_expiry_date')->nullable();
            $table->string('place_of_birth')->nullable();
            
            // Address Information
            $table->string('address_line_1');
            $table->string('address_line_2')->nullable();
            $table->string('city');
            $table->string('region');
            $table->string('postal_code')->nullable();
            
            // Verification Status
            $table->enum('status', ['pending', 'under_review', 'approved', 'rejected', 'expired'])->default('pending')->index();
            $table->text('rejection_reason')->nullable();
            $table->json('verification_notes')->nullable(); // Admin notes
            
            // Verification Details
            $table->foreignId('verified_by')->nullable()->constrained('users');
            $table->timestamp('verified_at')->nullable();
            $table->timestamp('expires_at')->nullable(); // KYC expiry (yearly renewal)
            
            // Audit Fields
            $table->string('ip_address')->nullable();
            $table->json('user_agent')->nullable();
            $table->integer('attempt_number')->default(1); // For resubmissions
            
            $table->timestamps();
            
            // Indexes
            $table->index(['user_id', 'status']);
            $table->index(['document_type', 'document_number']);
            $table->index('verified_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kyc_verifications');
    }
};
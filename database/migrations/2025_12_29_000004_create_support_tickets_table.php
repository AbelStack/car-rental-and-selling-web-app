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
        Schema::create('support_tickets', function (Blueprint $table) {
            $table->id();
            $table->string('ticket_number')->unique(); // TKT-YYYYMMDD-XXXX
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            
            // Ticket Details
            $table->string('subject');
            $table->text('description');
            $table->enum('category', ['general', 'booking', 'payment', 'kyc', 'technical', 'complaint'])->index();
            $table->enum('priority', ['low', 'medium', 'high', 'urgent'])->default('medium')->index();
            $table->enum('status', ['open', 'in_progress', 'waiting_customer', 'resolved', 'closed'])->default('open')->index();
            
            // Assignment & Resolution
            $table->foreignId('assigned_to')->nullable()->constrained('users');
            $table->timestamp('assigned_at')->nullable();
            $table->text('resolution')->nullable();
            $table->timestamp('resolved_at')->nullable();
            $table->foreignId('resolved_by')->nullable()->constrained('users');
            
            // SLA Tracking
            $table->timestamp('first_response_at')->nullable();
            $table->timestamp('due_at')->nullable(); // SLA deadline
            $table->boolean('sla_breached')->default(false);
            
            // Customer Satisfaction
            $table->tinyInteger('rating')->nullable(); // 1-5 stars
            $table->text('feedback')->nullable();
            
            $table->timestamps();
            
            // Indexes
            $table->index(['user_id', 'status']);
            $table->index(['assigned_to', 'status']);
            $table->index(['category', 'priority']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('support_tickets');
    }
};
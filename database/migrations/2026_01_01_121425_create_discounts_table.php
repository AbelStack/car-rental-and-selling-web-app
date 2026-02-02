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
        Schema::create('discounts', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Holiday name or system identifier
            $table->enum('type', ['duration', 'holiday']); // System vs Admin controlled
            $table->decimal('percentage', 5, 2); // Discount percentage (e.g., 8.00 for 8%)
            $table->enum('applies_to', ['rental', 'selling', 'both']); // What it applies to
            $table->date('start_date')->nullable(); // For holiday discounts
            $table->date('end_date')->nullable(); // For holiday discounts
            $table->text('description')->nullable(); // Internal notes
            $table->boolean('is_active')->default(true); // Active/Inactive status
            $table->json('conditions')->nullable(); // Additional conditions (duration ranges, etc.)
            $table->timestamps();
            
            // Indexes for performance
            $table->index(['type', 'is_active']);
            $table->index(['start_date', 'end_date']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('discounts');
    }
};

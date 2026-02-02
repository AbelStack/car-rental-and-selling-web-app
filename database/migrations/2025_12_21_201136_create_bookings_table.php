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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->string('booking_reference')->unique();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('vehicle_id')->constrained()->onDelete('cascade');
            
            // Booking details
            $table->date('pickup_date');
            $table->date('return_date');
            $table->integer('total_days');
            $table->enum('driving_option', ['self_drive', 'with_driver']);
            
            // Location details
            $table->string('pickup_location');
            $table->decimal('pickup_latitude', 10, 8)->nullable();
            $table->decimal('pickup_longitude', 11, 8)->nullable();
            $table->string('return_location');
            $table->decimal('return_latitude', 10, 8)->nullable();
            $table->decimal('return_longitude', 11, 8)->nullable();
            
            // Pricing
            $table->decimal('daily_rate', 10, 2);
            $table->decimal('driver_cost', 10, 2)->default(0);
            $table->decimal('subtotal', 10, 2);
            $table->decimal('tax_amount', 10, 2)->default(0);
            $table->decimal('total_amount', 10, 2);
            
            // Status and timestamps
            $table->enum('status', ['pending_payment', 'paid', 'confirmed', 'active', 'completed', 'cancelled'])->default('pending_payment');
            $table->text('cancellation_reason')->nullable();
            $table->timestamp('cancelled_at')->nullable();
            $table->text('special_requests')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};

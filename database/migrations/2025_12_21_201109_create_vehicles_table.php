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
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->string('make'); // Toyota, Honda, etc.
            $table->string('model'); // Camry, Civic, etc.
            $table->year('year');
            $table->string('color');
            $table->string('license_plate')->unique();
            $table->integer('mileage')->default(0);
            $table->enum('fuel_type', ['petrol', 'diesel', 'hybrid', 'electric']);
            $table->enum('transmission', ['manual', 'automatic']);
            $table->enum('category', ['sedan', 'suv', 'pickup', 'luxury', 'compact', 'van']);
            $table->text('description')->nullable();
            $table->json('features')->nullable(); // AC, GPS, etc.
            
            // Rental specific fields
            $table->boolean('available_for_rent')->default(false);
            $table->decimal('rental_price_per_day', 10, 2)->nullable();
            $table->boolean('self_drive_available')->default(true);
            $table->boolean('with_driver_available')->default(false);
            $table->decimal('driver_cost_per_day', 10, 2)->nullable();
            
            // Sale specific fields
            $table->boolean('available_for_sale')->default(false);
            $table->decimal('sale_price', 12, 2)->nullable();
            $table->enum('condition', ['excellent', 'good', 'fair', 'poor'])->nullable();
            $table->boolean('is_sold')->default(false);
            
            // Status and maintenance
            $table->enum('status', ['available', 'rented', 'maintenance', 'sold', 'inactive'])->default('available');
            $table->timestamp('last_maintenance_at')->nullable();
            $table->text('maintenance_notes')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};

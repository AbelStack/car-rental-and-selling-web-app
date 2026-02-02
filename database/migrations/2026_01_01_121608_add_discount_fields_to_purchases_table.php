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
        Schema::table('purchases', function (Blueprint $table) {
            $table->foreignId('discount_id')->nullable()->constrained()->onDelete('set null');
            $table->string('discount_type')->nullable(); // 'holiday' only for purchases
            $table->decimal('discount_percentage', 5, 2)->nullable(); // Applied discount %
            $table->decimal('discount_amount', 10, 2)->nullable(); // Actual discount amount
            $table->decimal('original_total', 10, 2)->nullable(); // Price before discount
            $table->text('discount_reason')->nullable(); // Why this discount was applied
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('purchases', function (Blueprint $table) {
            $table->dropForeign(['discount_id']);
            $table->dropColumn([
                'discount_id',
                'discount_type',
                'discount_percentage',
                'discount_amount',
                'original_total',
                'discount_reason'
            ]);
        });
    }
};

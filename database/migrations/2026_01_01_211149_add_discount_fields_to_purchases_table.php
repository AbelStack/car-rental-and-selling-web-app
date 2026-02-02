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
            // Add discount fields if they don't exist
            if (!Schema::hasColumn('purchases', 'discount_id')) {
                $table->foreignId('discount_id')->nullable()->after('total_amount')->constrained()->onDelete('set null');
            }
            if (!Schema::hasColumn('purchases', 'discount_type')) {
                $table->string('discount_type')->nullable()->after('discount_id');
            }
            if (!Schema::hasColumn('purchases', 'discount_percentage')) {
                $table->decimal('discount_percentage', 5, 2)->nullable()->after('discount_type');
            }
            if (!Schema::hasColumn('purchases', 'discount_amount')) {
                $table->decimal('discount_amount', 10, 2)->default(0)->after('discount_percentage');
            }
            if (!Schema::hasColumn('purchases', 'original_total')) {
                $table->decimal('original_total', 10, 2)->nullable()->after('discount_amount');
            }
            if (!Schema::hasColumn('purchases', 'discount_reason')) {
                $table->text('discount_reason')->nullable()->after('original_total');
            }
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
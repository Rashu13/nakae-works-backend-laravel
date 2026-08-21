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
        if (Schema::hasTable('vendor_promotions')) {
            Schema::table('vendor_promotions', function (Blueprint $table) {
                if (!Schema::hasColumn('vendor_promotions', 'coupon_code')) {
                    $table->string('coupon_code', 50)->nullable()->after('placement');
                }
                if (!Schema::hasColumn('vendor_promotions', 'discount_type')) {
                    $table->string('discount_type', 20)->default('percent')->after('coupon_code'); // percent or flat
                }
                if (!Schema::hasColumn('vendor_promotions', 'discount_percent')) {
                    $table->integer('discount_percent')->nullable()->default(0)->after('discount_type');
                }
                if (!Schema::hasColumn('vendor_promotions', 'discount_amount')) {
                    $table->decimal('discount_amount', 10, 2)->nullable()->default(0.00)->after('discount_percent');
                }
                if (!Schema::hasColumn('vendor_promotions', 'original_price')) {
                    $table->decimal('original_price', 10, 2)->nullable()->default(0.00)->after('discount_amount');
                }
                if (!Schema::hasColumn('vendor_promotions', 'offer_price')) {
                    $table->decimal('offer_price', 10, 2)->nullable()->default(0.00)->after('original_price');
                }
                if (!Schema::hasColumn('vendor_promotions', 'offer_badge')) {
                    $table->string('offer_badge', 100)->nullable()->after('offer_price');
                }
                if (!Schema::hasColumn('vendor_promotions', 'max_uses_per_user')) {
                    $table->integer('max_uses_per_user')->default(1)->after('offer_badge');
                }
                if (!Schema::hasColumn('vendor_promotions', 'total_usage_limit')) {
                    $table->integer('total_usage_limit')->nullable()->after('max_uses_per_user');
                }
                if (!Schema::hasColumn('vendor_promotions', 'min_order_amount')) {
                    $table->decimal('min_order_amount', 10, 2)->default(0.00)->after('total_usage_limit');
                }
                if (!Schema::hasColumn('vendor_promotions', 'terms_note')) {
                    $table->text('terms_note')->nullable()->after('min_order_amount');
                }
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('vendor_promotions')) {
            Schema::table('vendor_promotions', function (Blueprint $table) {
                $columns = [
                    'coupon_code', 'discount_type', 'discount_percent', 'discount_amount',
                    'original_price', 'offer_price', 'offer_badge', 'max_uses_per_user',
                    'total_usage_limit', 'min_order_amount', 'terms_note'
                ];
                foreach ($columns as $col) {
                    if (Schema::hasColumn('vendor_promotions', $col)) {
                        $table->dropColumn($col);
                    }
                }
            });
        }
    }
};

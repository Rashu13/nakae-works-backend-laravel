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
                if (!Schema::hasColumn('vendor_promotions', 'discount_percent')) {
                    $table->integer('discount_percent')->nullable()->default(0)->after('coupon_code');
                }
                if (!Schema::hasColumn('vendor_promotions', 'discount_amount')) {
                    $table->decimal('discount_amount', 10, 2)->nullable()->default(0.00)->after('discount_percent');
                }
                if (!Schema::hasColumn('vendor_promotions', 'offer_badge')) {
                    $table->string('offer_badge', 100)->nullable()->after('discount_amount');
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
                if (Schema::hasColumn('vendor_promotions', 'coupon_code')) {
                    $table->dropColumn('coupon_code');
                }
                if (Schema::hasColumn('vendor_promotions', 'discount_percent')) {
                    $table->dropColumn('discount_percent');
                }
                if (Schema::hasColumn('vendor_promotions', 'discount_amount')) {
                    $table->dropColumn('discount_amount');
                }
                if (Schema::hasColumn('vendor_promotions', 'offer_badge')) {
                    $table->dropColumn('offer_badge');
                }
            });
        }
    }
};

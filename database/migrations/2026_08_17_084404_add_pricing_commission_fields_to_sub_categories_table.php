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
        Schema::table('sub_categories', function (Blueprint $table) {
            $table->decimal('base_price', 10, 2)->default(0.00)->after('image');
            $table->decimal('visiting_fee', 10, 2)->default(0.00)->after('base_price');
            $table->decimal('tax_rate', 5, 2)->default(18.00)->after('visiting_fee');
            $table->string('tax_type', 20)->default('inclusive')->after('tax_rate');
            $table->decimal('service_charge', 10, 2)->default(0.00)->after('tax_type');
            $table->decimal('delivery_charge', 10, 2)->default(0.00)->after('service_charge');
            $table->string('delivery_charge_type', 20)->default('service_wise')->after('delivery_charge');
            $table->decimal('commission_value', 10, 2)->default(10.00)->after('delivery_charge_type');
            $table->string('commission_type', 20)->default('percentage')->after('commission_value');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sub_categories', function (Blueprint $table) {
            $table->dropColumn([
                'base_price',
                'visiting_fee',
                'tax_rate',
                'tax_type',
                'service_charge',
                'delivery_charge',
                'delivery_charge_type',
                'commission_value',
                'commission_type',
            ]);
        });
    }
};

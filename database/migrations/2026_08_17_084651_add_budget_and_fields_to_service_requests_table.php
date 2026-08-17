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
        Schema::table('service_requests', function (Blueprint $table) {
            if (!Schema::hasColumn('service_requests', 'request_code')) {
                $table->string('request_code')->nullable()->after('id');
            }
            if (!Schema::hasColumn('service_requests', 'address_id')) {
                $table->unsignedBigInteger('address_id')->nullable()->after('sub_category_id');
            }
            if (!Schema::hasColumn('service_requests', 'review_status')) {
                $table->tinyInteger('review_status')->default(0)->after('address_id');
            }
            if (!Schema::hasColumn('service_requests', 'problem_description')) {
                $table->text('problem_description')->nullable()->after('review_status');
            }
            if (!Schema::hasColumn('service_requests', 'vendor_remark')) {
                $table->text('vendor_remark')->nullable()->after('problem_description');
            }
            if (!Schema::hasColumn('service_requests', 'user_cancel_remark')) {
                $table->text('user_cancel_remark')->nullable()->after('vendor_remark');
            }
            if (!Schema::hasColumn('service_requests', 'preferred_date')) {
                $table->string('preferred_date')->nullable()->after('user_cancel_remark');
            }
            if (!Schema::hasColumn('service_requests', 'preferred_time')) {
                $table->string('preferred_time')->nullable()->after('preferred_date');
            }
            if (!Schema::hasColumn('service_requests', 'budget')) {
                $table->decimal('budget', 10, 2)->default(0.00)->after('preferred_time');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('service_requests', function (Blueprint $table) {
            $table->dropColumn([
                'request_code',
                'address_id',
                'review_status',
                'problem_description',
                'vendor_remark',
                'user_cancel_remark',
                'preferred_date',
                'preferred_time',
                'budget',
            ]);
        });
    }
};

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
            if (!Schema::hasColumn('sub_categories', 'desc')) {
                $table->longText('desc')->nullable()->after('sub_category_name');
            }
            if (!Schema::hasColumn('sub_categories', 'description')) {
                $table->longText('description')->nullable()->after('desc');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sub_categories', function (Blueprint $table) {
            if (Schema::hasColumn('sub_categories', 'desc')) {
                $table->dropColumn('desc');
            }
            if (Schema::hasColumn('sub_categories', 'description')) {
                $table->dropColumn('description');
            }
        });
    }
};

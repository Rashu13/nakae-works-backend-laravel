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
        Schema::table('admin_contacts', function (Blueprint $table) {
            if (!Schema::hasColumn('admin_contacts', 'fcm_server_key')) {
                $table->text('fcm_server_key')->nullable();
            }
            if (!Schema::hasColumn('admin_contacts', 'fcm_sender_id')) {
                $table->string('fcm_sender_id')->nullable();
            }
            if (!Schema::hasColumn('admin_contacts', 'fcm_project_id')) {
                $table->string('fcm_project_id')->nullable();
            }
            if (!Schema::hasColumn('admin_contacts', 'fcm_json_path')) {
                $table->string('fcm_json_path')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('admin_contacts', function (Blueprint $table) {
            if (Schema::hasColumn('admin_contacts', 'fcm_server_key')) {
                $table->dropColumn(['fcm_server_key', 'fcm_sender_id', 'fcm_project_id', 'fcm_json_path']);
            }
        });
    }
};

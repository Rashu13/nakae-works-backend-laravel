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
        if (!Schema::hasTable('broadcast_notifications')) {
            Schema::create('broadcast_notifications', function (Blueprint $table) {
                $table->id();
                $table->enum('target_audience', ['all_customers', 'all_vendors', 'specific_city'])->default('all_customers');
                $table->unsignedBigInteger('city_id')->nullable();
                $table->string('title');
                $table->text('message');
                $table->string('image')->nullable();
                $table->integer('sent_count')->default(0);
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('broadcast_notifications');
    }
};

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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->json('attributes')->nullable();
            $table->string('user_id', 128)->nullable();
            $table->json('browser_info')->nullable();
            $table->string('ip_address', 45)->nullable();
            $table->string('country', 45)->nullable();
            $table->timestamps(); // This will create 'created_at' and 'updated_at' columns
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};

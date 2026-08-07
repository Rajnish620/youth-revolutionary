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
        Schema::create('home_settings', function (Blueprint $table) {
            $table->id();
            $table->string('polaroid_1_image')->nullable();
            $table->string('polaroid_1_text')->nullable();
            $table->string('polaroid_2_image')->nullable();
            $table->string('polaroid_2_text')->nullable();
            $table->string('polaroid_3_image')->nullable();
            $table->string('polaroid_3_text')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('home_settings');
    }
};

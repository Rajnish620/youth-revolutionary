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
        Schema::create('about_us_settings', function (Blueprint $table) {
            $table->id();
            $table->string('hero_title')->default('About Us');
            $table->text('hero_subtitle')->nullable();
            $table->string('hero_bg_image')->nullable();
            $table->string('who_we_are_title')->default('Youth Revolutionary');
            $table->text('who_we_are_description')->nullable();
            $table->string('who_we_are_image')->nullable();
            $table->string('mission_title')->default('Our Mission');
            $table->text('mission_description')->nullable();
            $table->string('vision_title')->default('Our Vision');
            $table->text('vision_description')->nullable();
            $table->string('stat_1_count')->default('10000+');
            $table->string('stat_1_label')->default('Students Impacted');
            $table->string('stat_2_count')->default('100+');
            $table->string('stat_2_label')->default('Competitions Hosted');
            $table->string('stat_3_count')->default('50+');
            $table->string('stat_3_label')->default('Partner Schools');
            $table->string('stat_4_count')->default('15+');
            $table->string('stat_4_label')->default('Cities Reached');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('about_us_settings');
    }
};

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
        Schema::table('admit_card_settings', function (Blueprint $table) {
            $table->string('header_title')->nullable()->after('id');
            $table->string('header_subtitle')->nullable()->after('header_title');
            $table->string('logo_path')->nullable()->after('header_subtitle');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('admit_card_settings', function (Blueprint $table) {
            $table->dropColumn(['header_title', 'header_subtitle', 'logo_path']);
        });
    }
};

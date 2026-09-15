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
            if (!Schema::hasColumn('admit_card_settings', 'seal_path')) {
                $table->string('seal_path')->nullable()->after('secretary_role');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('admit_card_settings', function (Blueprint $table) {
            if (Schema::hasColumn('admit_card_settings', 'seal_path')) {
                $table->dropColumn('seal_path');
            }
        });
    }
};

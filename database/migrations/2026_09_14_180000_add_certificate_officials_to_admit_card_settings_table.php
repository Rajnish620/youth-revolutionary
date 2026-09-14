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
            if (!Schema::hasColumn('admit_card_settings', 'president_name')) {
                $table->string('president_name')->nullable()->default('NIKETAN SINGH')->after('signature_path');
            }
            if (!Schema::hasColumn('admit_card_settings', 'president_role')) {
                $table->string('president_role')->nullable()->default('अध्यक्ष')->after('president_name');
            }
            if (!Schema::hasColumn('admit_card_settings', 'secretary_name')) {
                $table->string('secretary_name')->nullable()->default('SHYAM SUNDAR KR.')->after('president_role');
            }
            if (!Schema::hasColumn('admit_card_settings', 'secretary_role')) {
                $table->string('secretary_role')->nullable()->default('सचिव')->after('secretary_name');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('admit_card_settings', function (Blueprint $table) {
            $cols = [];
            foreach (['president_name', 'president_role', 'secretary_name', 'secretary_role'] as $col) {
                if (Schema::hasColumn('admit_card_settings', $col)) {
                    $cols[] = $col;
                }
            }
            if (!empty($cols)) {
                $table->dropColumn($cols);
            }
        });
    }
};

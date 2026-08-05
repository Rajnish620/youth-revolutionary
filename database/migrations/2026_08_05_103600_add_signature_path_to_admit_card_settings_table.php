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
            if (!Schema::hasColumn('admit_card_settings', 'signature_path')) {
                $table->string('signature_path')->nullable()->after('logo_path');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('admit_card_settings', function (Blueprint $table) {
            if (Schema::hasColumn('admit_card_settings', 'signature_path')) {
                $table->dropColumn('signature_path');
            }
        });
    }
};

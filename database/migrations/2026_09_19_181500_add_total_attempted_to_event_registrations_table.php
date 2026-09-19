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
        Schema::table('event_registrations', function (Blueprint $table) {
            if (!Schema::hasColumn('event_registrations', 'total_attempted')) {
                $table->integer('total_attempted')->nullable()->after('marks');
            }
            if (!Schema::hasColumn('event_registrations', 'correct_answers')) {
                $table->integer('correct_answers')->nullable()->after('total_attempted');
            }
            if (!Schema::hasColumn('event_registrations', 'wrong_answers')) {
                $table->integer('wrong_answers')->nullable()->after('correct_answers');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('event_registrations', function (Blueprint $table) {
            if (Schema::hasColumn('event_registrations', 'total_attempted')) {
                $table->dropColumn('total_attempted');
            }
        });
    }
};

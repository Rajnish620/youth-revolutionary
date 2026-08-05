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
        Schema::table('event_groups', function (Blueprint $table) {
            $table->string('centre_name')->nullable()->after('roll_sequence_start');
            $table->time('reporting_time')->nullable()->after('centre_name');
            $table->string('exam_time_duration')->nullable()->after('reporting_time'); // e.g. "11:00 AM to 01:00 PM (2 Hours)"
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('event_groups', function (Blueprint $table) {
            $table->dropColumn(['centre_name', 'reporting_time', 'exam_time_duration']);
        });
    }
};

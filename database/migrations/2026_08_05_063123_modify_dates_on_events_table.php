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
        Schema::table('events', function (Blueprint $table) {
            $table->dropColumn('event_date');
            $table->date('start_event_date')->nullable()->after('location');
            $table->date('end_event_date')->nullable()->after('start_event_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('events', function (Blueprint $table) {
            $table->date('event_date')->nullable()->after('location');
            $table->dropColumn(['start_event_date', 'end_event_date']);
        });
    }
};

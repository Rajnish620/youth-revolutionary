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
        if (Schema::hasTable('events') && !Schema::hasColumn('events', 'evaluation_type')) {
            Schema::table('events', function (Blueprint $table) {
                $table->string('evaluation_type', 30)->default('marks')->after('show_certificate');
            });
        }

        if (Schema::hasTable('event_registrations') && !Schema::hasColumn('event_registrations', 'is_qualified')) {
            Schema::table('event_registrations', function (Blueprint $table) {
                $table->boolean('is_qualified')->nullable()->default(null)->after('marks');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('events') && Schema::hasColumn('events', 'evaluation_type')) {
            Schema::table('events', function (Blueprint $table) {
                $table->dropColumn('evaluation_type');
            });
        }

        if (Schema::hasTable('event_registrations') && Schema::hasColumn('event_registrations', 'is_qualified')) {
            Schema::table('event_registrations', function (Blueprint $table) {
                $table->dropColumn('is_qualified');
            });
        }
    }
};

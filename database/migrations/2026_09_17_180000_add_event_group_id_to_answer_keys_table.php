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
        Schema::table('answer_keys', function (Blueprint $table) {
            $table->foreignId('event_group_id')
                ->nullable()
                ->after('event_id')
                ->constrained('event_groups')
                ->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('answer_keys', function (Blueprint $table) {
            $table->dropForeign(['event_group_id']);
            $table->dropColumn('event_group_id');
        });
    }
};

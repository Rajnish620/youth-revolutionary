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
            $table->boolean('show_marks')->default(false)->after('status');
            $table->boolean('show_certificate')->default(false)->after('show_marks');
            $table->integer('total_questions')->nullable()->after('show_certificate');
            $table->decimal('marks_per_question', 8, 2)->nullable()->after('total_questions');
            $table->decimal('negative_marks', 8, 2)->nullable()->default(0)->after('marks_per_question');
            $table->decimal('total_marks', 8, 2)->nullable()->after('negative_marks');
            $table->decimal('cutoff_marks', 8, 2)->nullable()->after('total_marks');
            $table->text('marking_scheme_notes')->nullable()->after('cutoff_marks');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('events', function (Blueprint $table) {
            $table->dropColumn([
                'show_marks',
                'show_certificate',
                'total_questions',
                'marks_per_question',
                'negative_marks',
                'total_marks',
                'cutoff_marks',
                'marking_scheme_notes',
            ]);
        });
    }
};

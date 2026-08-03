<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('event_registrations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('event_id')->constrained('events')->onDelete('cascade');
            $table->foreignId('event_group_id')->nullable()->constrained('event_groups')->onDelete('set null');
            $table->string('roll_no')->unique(); // e.g. YR-2026-1001
            $table->string('student_name');
            $table->string('father_name')->nullable();
            $table->string('school_name')->nullable();
            $table->string('student_class');
            $table->string('mobile');
            $table->decimal('fee_paid', 8, 2)->default(0.00);
            $table->text('photo')->nullable();
            $table->text('payment_screenshot')->nullable();
            $table->enum('payment_status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->decimal('marks', 5, 2)->nullable();
            $table->string('rank')->nullable(); // e.g. 1st Position, Top 10, Passed
            $table->boolean('certificate_enabled')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('event_registrations');
    }
};

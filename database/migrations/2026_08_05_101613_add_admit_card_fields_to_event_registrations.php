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
            $table->date('dob')->nullable()->after('student_name');
            $table->string('email')->nullable()->after('dob');
            $table->string('gender')->nullable()->after('email');
            $table->string('category')->nullable()->after('gender');
            $table->text('address')->nullable()->after('category');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('event_registrations', function (Blueprint $table) {
            $table->dropColumn(['dob', 'email', 'gender', 'category', 'address']);
        });
    }
};

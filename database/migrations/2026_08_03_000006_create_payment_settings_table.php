<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('payment_settings', function (Blueprint $table) {
            $table->id();
            $table->string('upi_id')->default('sws@upi');
            $table->string('account_holder')->default('Youth Revolutionary Organization');
            $table->text('qr_code_image')->nullable();
            $table->text('instructions')->nullable();
            $table->boolean('auto_enable_certificates')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payment_settings');
    }
};

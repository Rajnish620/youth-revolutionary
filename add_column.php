<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

if(!Schema::hasColumn('event_registrations', 'transaction_id')) {
    Schema::table('event_registrations', function(Blueprint $table) {
        $table->string('transaction_id')->nullable()->unique()->after('payment_status');
    });
    echo "Column added successfully.\n";
} else {
    echo "Column already exists.\n";
}

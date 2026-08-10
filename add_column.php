<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

if(!Schema::hasColumn('home_settings', 'middle_banner_image')) {
    Schema::table('home_settings', function(Blueprint $table) {
        $table->text('middle_banner_image')->nullable();
    });
    echo "Column added successfully.\n";
} else {
    echo "Column already exists.\n";
}

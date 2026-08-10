<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

Schema::table('event_registrations', function (Blueprint $table) {
    if (!Schema::hasColumn('event_registrations', 'registration_no')) {
        $table->string('registration_no')->nullable()->unique()->after('id');
    }
});
echo "Column added successfully.\n";

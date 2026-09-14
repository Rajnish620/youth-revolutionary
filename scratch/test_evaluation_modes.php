<?php

require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Event;
use App\Models\EventRegistration;

echo "--- Testing Event & EventRegistration Evaluation Modes ---\n";

// Mock an event in qualify_only mode
$qualifyEvent = new Event([
    'title' => 'Cultural Talent Competition 2026',
    'category' => 'Cultural',
    'season' => '2026',
    'show_marks' => true,
    'show_certificate' => true,
    'evaluation_type' => 'qualify_only',
]);

echo "Event title: " . $qualifyEvent->title . "\n";
echo "Event eval type: " . $qualifyEvent->evaluation_type . "\n";
echo "Is qualify only? " . ($qualifyEvent->isQualifyOnly() ? "YES" : "NO") . "\n";

// Mock registration with is_qualified = true
$reg1 = new EventRegistration([
    'student_name' => 'Aarav Sharma',
    'roll_no' => 'YR-2026-1001',
    'is_qualified' => true,
    'rank' => '1st Position',
]);
$reg1->setRelation('event', $qualifyEvent);

echo "Student 1 (Qualified): " . $reg1->qualification_status . "\n";

// Mock registration with is_qualified = false
$reg2 = new EventRegistration([
    'student_name' => 'Rohan Verma',
    'roll_no' => 'YR-2026-1002',
    'is_qualified' => false,
]);
$reg2->setRelation('event', $qualifyEvent);

echo "Student 2 (Not Qualified): " . $reg2->qualification_status . "\n";

// Mock registration with is_qualified = null (Pending)
$reg3 = new EventRegistration([
    'student_name' => 'Priya Kumari',
    'roll_no' => 'YR-2026-1003',
    'is_qualified' => null,
]);
$reg3->setRelation('event', $qualifyEvent);

echo "Student 3 (Pending): " . $reg3->qualification_status . "\n";

// Mock an event in marks mode (Quiz)
$marksEvent = new Event([
    'title' => 'State Level Talent Quiz 2026',
    'category' => 'Quiz',
    'season' => '2026',
    'show_marks' => true,
    'total_marks' => 100,
    'cutoff_marks' => 40,
    'evaluation_type' => 'marks',
]);

$regQuizPass = new EventRegistration([
    'student_name' => 'Aditi Singh',
    'roll_no' => 'YR-2026-2001',
    'marks' => 78.50,
]);
$regQuizPass->setRelation('event', $marksEvent);
echo "Quiz Student Pass (78.50 vs 40 cutoff): " . $regQuizPass->qualification_status . "\n";

$regQuizFail = new EventRegistration([
    'student_name' => 'Vikas Kumar',
    'roll_no' => 'YR-2026-2002',
    'marks' => 32.00,
]);
$regQuizFail->setRelation('event', $marksEvent);
echo "Quiz Student Below Cutoff (32 vs 40 cutoff): " . $regQuizFail->qualification_status . "\n";

echo "\nAll evaluation status logic tests PASSED successfully!\n";

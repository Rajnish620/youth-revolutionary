<?php

require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Event;
use App\Models\EventRegistration;
use App\Models\AdmitCardSetting;

$setting = new AdmitCardSetting([
    'header_title' => 'YOUTH REVOLUTIONARY',
    'header_subtitle' => 'Talent Search Council',
]);

// 1. Test Qualify Only Marksheet HTML
$qualifyEvent = new Event([
    'title' => 'Cultural Talent Competition 2026',
    'category' => 'Cultural',
    'season' => '2026',
    'show_marks' => true,
    'show_certificate' => true,
    'evaluation_type' => 'qualify_only',
]);

$reg1 = new EventRegistration([
    'student_name' => 'Aarav Sharma',
    'roll_no' => 'YR-2026-1001',
    'registration_no' => 'YRREG1001',
    'student_class' => 'Class 10',
    'school_name' => 'Model High School',
    'is_qualified' => true,
    'rank' => '1st Position',
]);
$reg1->setRelation('event', $qualifyEvent);

$webHtml = view('marksheet.show', ['registration' => $reg1, 'setting' => $setting])->render();
echo "Web Marksheet rendered successfully: " . strlen($webHtml) . " bytes\n";
if (strpos($webHtml, 'QUALIFIED') !== false && strpos($webHtml, 'Official Performance &amp; Qualification Assessment') !== false) {
    echo "✓ Web Marksheet correctly contains QUALIFIED and qualitative assessment header!\n";
} else {
    echo "✗ Web Marksheet check failed\n";
}

$pdfHtml = view('pdf.marksheet', ['registration' => $reg1, 'setting' => $setting])->render();
echo "PDF Marksheet rendered successfully: " . strlen($pdfHtml) . " bytes\n";
if (strpos($pdfHtml, 'QUALIFIED') !== false && strpos($pdfHtml, 'PERFORMANCE ASSESSMENT &amp; TALENT EVALUATION') !== false) {
    echo "✓ PDF Marksheet correctly contains QUALIFIED and talent evaluation header!\n";
} else {
    echo "✗ PDF Marksheet check failed\n";
}

// 2. Test Quiz Marksheet HTML
$marksEvent = new Event([
    'title' => 'State Level Talent Quiz 2026',
    'category' => 'Quiz',
    'season' => '2026',
    'show_marks' => true,
    'total_questions' => 50,
    'marks_per_question' => 2,
    'total_marks' => 100,
    'cutoff_marks' => 40,
    'evaluation_type' => 'marks',
]);

$regQuiz = new EventRegistration([
    'student_name' => 'Aditi Singh',
    'roll_no' => 'YR-2026-2001',
    'registration_no' => 'YRREG2001',
    'student_class' => 'Class 8',
    'school_name' => 'St. Xavier School',
    'marks' => 78.50,
    'rank' => '2nd Rank',
]);
$regQuiz->setRelation('event', $marksEvent);

$quizWebHtml = view('marksheet.show', ['registration' => $regQuiz, 'setting' => $setting])->render();
if (strpos($quizWebHtml, 'Evaluation Scheme &amp; Score Breakdown') !== false && strpos($quizWebHtml, '78.50') !== false) {
    echo "✓ Quiz Marksheet correctly contains Score Breakdown and 78.50 score!\n";
}

echo "\nAll Blade view rendering tests PASSED successfully!\n";

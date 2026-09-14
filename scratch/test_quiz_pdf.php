<?php

require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Event;
use App\Models\EventRegistration;
use App\Models\AdmitCardSetting;
use Mpdf\Mpdf;

$setting = new AdmitCardSetting([
    'header_title' => 'YOUTH REVOLUTIONARY',
    'header_subtitle' => 'Talent Search Council',
]);

$quizEvent = new Event([
    'title' => 'State Level Talent Quiz 2026',
    'category' => 'Quiz',
    'season' => '2026',
    'show_marks' => true,
    'show_certificate' => true,
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
$regQuiz->setRelation('event', $quizEvent);

$html = view('pdf.marksheet', ['registration' => $regQuiz, 'setting' => $setting])->render();

$mpdf = new Mpdf([
    'format' => 'A4',
    'margin_left' => 6,
    'margin_right' => 6,
    'margin_top' => 6,
    'margin_bottom' => 6,
    'autoScriptToLang' => true,
    'autoLangToFont' => true,
    'tempDir' => __DIR__ . '/mpdf',
]);

$mpdf->WriteHTML($html);
$pdfPath = __DIR__ . '/test_quiz_marksheet.pdf';
$mpdf->Output($pdfPath, 'F');

echo "Generated Quiz PDF successfully at: " . $pdfPath . "\n";

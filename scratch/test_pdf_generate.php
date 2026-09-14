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

$qualifyEvent = new Event([
    'title' => 'Cultural Dance & Singing 2026',
    'category' => 'Cultural',
    'season' => '2026',
    'show_marks' => true,
    'show_certificate' => true,
    'evaluation_type' => 'qualify_only',
]);

$reg = new EventRegistration([
    'student_name' => 'Aarav Sharma',
    'roll_no' => 'YR-2026-1001',
    'registration_no' => 'YRREG1001',
    'student_class' => 'Class 10',
    'school_name' => 'Model High School',
    'is_qualified' => true,
    'rank' => '1st Position',
]);
$reg->setRelation('event', $qualifyEvent);

$html = view('pdf.marksheet', ['registration' => $reg, 'setting' => $setting])->render();

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
$pdfPath = __DIR__ . '/test_qualify_marksheet.pdf';
$mpdf->Output($pdfPath, 'F');

echo "Generated PDF successfully at: " . $pdfPath . " (Size: " . filesize($pdfPath) . " bytes)\n";

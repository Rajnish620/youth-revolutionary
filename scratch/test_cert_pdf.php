<?php

require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$reg = App\Models\EventRegistration::with(['event', 'group'])->whereNotNull('student_name')->first();
if (!$reg) {
    echo "No reg found\n";
    exit;
}
$setting = App\Models\AdmitCardSetting::getSettings();
echo "Found reg: " . $reg->roll_no . " (" . $reg->student_name . ")\n";

$html = view('pdf.certificate', ['registration' => $reg, 'setting' => $setting])->render();
$mpdf = new \Mpdf\Mpdf([
    'format' => 'A4-L',
    'margin_left' => 0,
    'margin_right' => 0,
    'margin_top' => 0,
    'margin_bottom' => 0,
    'autoScriptToLang' => true,
    'autoLangToFont' => true,
]);
$mpdf->WriteHTML($html);
echo "Total certificate pages: " . $mpdf->page . "\n";
file_put_contents(__DIR__ . '/preview_cert.pdf', $mpdf->Output('', 'S'));
echo "Saved scratch/preview_cert.pdf successfully!\n";

$showHtml = view('certificate.show', ['registration' => $reg, 'setting' => $setting])->render();
file_put_contents(__DIR__ . '/preview_cert_show.html', $showHtml);
echo "Saved scratch/preview_cert_show.html successfully!\n";


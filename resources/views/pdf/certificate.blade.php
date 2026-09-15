<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Certificate - {{ $registration->roll_no }}</title>
    <style>
        @page {
            sheet-size: A4-L;
            margin-left: 0mm;
            margin-right: 0mm;
            margin-top: 0mm;
            margin-bottom: 0mm;
            background-image: url('{{ public_path("images/certificate/certificate_frame.svg") }}');
            background-image-resize: 6;
        }
        body {
            font-family: 'FreeSerif', 'FreeSans', 'DejaVu Sans', serif;
            color: #0f172a;
            background-color: transparent;
            margin: 0;
            padding: 0;
            font-size: 10pt;
            line-height: 1.3;
        }
        .cert-body {
            width: 100%;
            height: 100%;
            padding: 13mm 26mm 10mm 26mm;
            box-sizing: border-box;
            text-align: center;
        }

        /* Top Header */
        .logo-box {
            text-align: center;
            margin-bottom: 3px;
        }
        .logo-img {
            width: 66px;
            height: 66px;
            border-radius: 50%;
        }

        .title-main {
            font-size: 28pt;
            font-weight: 900;
            color: #132448;
            letter-spacing: 3px;
            text-transform: uppercase;
            margin: 2px 0 1px 0;
            font-family: 'Times New Roman', 'FreeSerif', serif;
        }
        .title-sub {
            font-size: 21pt;
            font-weight: 900;
            color: #132448;
            letter-spacing: 3.5px;
            text-transform: uppercase;
            margin: 0;
            font-family: 'Times New Roman', 'FreeSerif', serif;
        }
        .cert-type {
            font-size: 21pt;
            font-weight: bold;
            color: #c0262d;
            margin-top: 6px;
            margin-bottom: 8px;
            font-family: 'Times New Roman', 'FreeSerif', serif;
        }

        /* Hindi Competition Title Row */
        .hindi-table {
            width: 84%;
            margin: 6px auto 10px auto;
            border-collapse: collapse;
        }
        .hindi-table td {
            vertical-align: middle;
            text-align: center;
            padding: 0 6px;
        }
        .emblem-img {
            display: inline-block;
            vertical-align: middle;
        }
        .emblem-nataraja {
            height: 75px;
            width: auto;
        }
        .emblem-trophy {
            height: 65px;
            width: auto;
        }
        .hindi-title {
            font-size: 18pt;
            font-weight: 900;
            color: #0f172a;
            font-family: 'FreeSans', 'FreeSerif', sans-serif;
            letter-spacing: 0.5px;
        }

        /* Awarded to */
        .award-lead {
            font-size: 13pt;
            font-weight: bold;
            color: #1f2937;
            margin-top: 8px;
            margin-bottom: 4px;
        }
        .name-box {
            border-bottom: 2px solid #0f172a;
            width: 76%;
            margin: 3px auto 6px auto;
            padding-bottom: 3px;
        }
        .student-name {
            font-size: 26pt;
            font-weight: 900;
            color: #0f172a;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            font-family: 'Times New Roman', 'FreeSerif', serif;
        }
        .award-meta {
            width: 86%;
            margin: 0 auto 5px auto;
            font-size: 10.5pt;
            color: #0f172a;
            line-height: 1.35;
            font-family: 'Times New Roman', 'FreeSerif', serif;
        }
        .meta-label {
            color: #475569;
            font-size: 9.5pt;
        }
        .meta-val {
            font-weight: bold;
            color: #0f172a;
            text-transform: uppercase;
        }
        .citation {
            font-size: 10.5pt;
            font-style: italic;
            color: #334155;
            width: 82%;
            margin: 6px auto 0 auto;
            line-height: 1.35;
        }

        /* Signatures Table */
        .sig-table {
            width: 90%;
            margin: 9mm auto 0 auto;
            border-collapse: collapse;
        }
        .sig-col {
            vertical-align: bottom;
            text-align: center;
        }
        .sig-line {
            border-bottom: 1.5px solid #0f172a;
            width: 85%;
            margin: 0 auto 4px auto;
            padding-bottom: 3px;
            font-size: 13.5pt;
            font-weight: 900;
            color: #0f172a;
            text-transform: uppercase;
            font-family: 'Times New Roman', 'FreeSerif', serif;
            letter-spacing: 0.5px;
        }
        .sig-role {
            font-size: 12pt;
            font-weight: bold;
            color: #334155;
            font-family: 'FreeSans', 'FreeSerif', sans-serif;
        }
        .rosette-img {
            height: 94px;
            width: auto;
            margin-bottom: -10px;
        }
    </style>
</head>
<body>

@php
    $certSubject = $registration->event->category ?? $registration->event->title ?? 'Dance';
    if (strcasecmp($certSubject, 'general') === 0 && !empty($registration->event->title)) {
        $certSubject = $registration->event->title;
    }
    $certSeason = $registration->event->season ?? '2025 SEASON -4';
    if (!str_contains(strtoupper($certSeason), 'SEASON')) {
        $certSeason = $certSeason . ' SEASON -4';
    }
@endphp

<div class="cert-body">

    <!-- TOP HEADER -->
    <table style="width: 100%; border-collapse: collapse; margin-bottom: 2px;">
        <tr>
            <td style="width: 22%; text-align: left; vertical-align: middle; padding-top: 3mm; padding-left: 5mm;">
                <img src="{{ public_path('images/certificate/gold_rosette.svg') }}" style="height: 84px; width: auto;" alt="Excellence Medal">
            </td>
            <td style="width: 56%; text-align: center; vertical-align: middle;">
                <div class="logo-box">
                    @if(!empty($setting->logo_path) && file_exists(public_path($setting->logo_path)))
                        <img src="{{ public_path($setting->logo_path) }}" class="logo-img" alt="Logo">
                    @elseif(file_exists(public_path('logo/logo.jpeg')))
                        <img src="{{ public_path('logo/logo.jpeg') }}" class="logo-img" alt="Logo">
                    @endif
                </div>

                <div class="title-main">{{ $setting->header_title ?? 'YOUTH REVOLUTIONARY' }}</div>
                <div class="title-sub">{{ $setting->header_subtitle ?? 'NASRIGANJ' }}</div>
            </td>
            <td style="width: 22%;">&nbsp;</td>
        </tr>
    </table>

    <div class="cert-type">Certificate of Achievement in {{ $certSubject }}</div>

    <!-- HINDI COMPETITION TITLE WITH ICONS -->
    <table class="hindi-table">
        <tr>
            <td style="width: 16%; text-align: right;">
                <img src="{{ public_path('images/certificate/nataraja_statue.png') }}" class="emblem-img emblem-nataraja" alt="Nataraja">
            </td>
            <td style="width: 68%; text-align: center;">
                <div class="hindi-title">प्रतिभा खोज प्रतियोगिता {{ $certSeason }}</div>
            </td>
            <td style="width: 16%; text-align: left;">
                <img src="{{ public_path('images/certificate/trophy_laurel.svg') }}" class="emblem-img emblem-trophy" alt="Trophy">
            </td>
        </tr>
    </table>

    <!-- AWARDEE SECTION -->
    <div class="award-lead">This certificate is proudly awarded to</div>

    <div class="name-box">
        <div class="student-name">{{ $registration->student_name }}</div>
    </div>

    <!-- CANDIDATE PROFILE DETAILS -->
    <div class="award-meta">
        <div style="margin-bottom: 2px;">
            @if(!empty($registration->father_name))
                <span class="meta-label">S/o / D/o:</span>
                <span class="meta-val">{{ $registration->father_name }}</span>
                <span style="color: #cbd5e1; margin: 0 4px;">|</span>
            @endif
            <span class="meta-label">Class:</span>
            <span class="meta-val">{{ $registration->student_class }}</span>
            @if(!empty($registration->group->group_name))
                <span class="meta-val" style="color: #132448;">({{ $registration->group->group_name }})</span>
            @endif
            @if(!empty($registration->rank))
                <span style="color: #cbd5e1; margin: 0 4px;">|</span>
                <span class="meta-label">Rank:</span>
                <span class="meta-val" style="display: inline-block; background-color: #fef3c7; color: #78350f; border: 1px solid #fcd34d; padding: 1px 7px; border-radius: 4px; font-weight: 900;">{{ $registration->rank }}</span>
            @endif
        </div>
        @if(!empty($registration->school_name))
            <div>
                <span class="meta-label">School / Coaching:</span>
                <span class="meta-val">{{ $registration->school_name }}</span>
            </div>
        @endif
    </div>

    <!-- COMMENDATION QUOTE -->
    <div class="citation">
        “This certificate is a testament to your talent, dedication, and hard work, propelling you one step closer to achieving your goals.”
    </div>

    <!-- BOTTOM SIGNATURES -->
    <table class="sig-table">
        <tr>
            <td class="sig-col" style="width: 38%;">
                <div class="sig-line">{{ !empty($setting->president_name) ? $setting->president_name : 'NIKETAN SINGH' }}</div>
                <div class="sig-role">{{ !empty($setting->president_role) ? $setting->president_role : 'अध्यक्ष' }}</div>
            </td>
            <td class="sig-col" style="width: 24%; text-align: center;">
                <div style="height: 55px; margin-bottom: 2px;">
                    @if(!empty($setting->seal_path) && file_exists(public_path($setting->seal_path)))
                        <img src="{{ public_path($setting->seal_path) }}" class="seal-img" style="height: 55px; width: auto; max-width: 80px;" alt="Official Seal">
                    @else
                        &nbsp;
                    @endif
                </div>
                <div style="font-size: 7.5pt; font-weight: bold; color: #340C6F; text-transform: uppercase;">Official Examination Seal</div>
            </td>
            <td class="sig-col" style="width: 38%;">
                <div class="sig-line">{{ !empty($setting->secretary_name) ? $setting->secretary_name : 'SHYAM SUNDAR KR.' }}</div>
                <div class="sig-role">{{ !empty($setting->secretary_role) ? $setting->secretary_role : 'सचिव' }}</div>
            </td>
        </tr>
    </table>

</div>

</body>
</html>

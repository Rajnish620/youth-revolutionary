<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Certificate - {{ $registration->roll_no }}</title>
    <style>
        @page {
            margin: 8px;
        }
        body {
            font-family: sans-serif;
            color: #0f172a;
            background-color: #ffffff;
            margin: 0;
            padding: 0;
            font-size: 10px;
            line-height: 1.4;
        }
        .cert-border {
            border: 8px solid #340C6F;
            padding: 10px;
            background-color: #ffffff;
        }
        .cert-inner {
            border: 2px solid #d97706;
            padding: 14px 16px;
            text-align: center;
        }
        
        /* Header Banner */
        .banner-box {
            text-align: center;
            margin-bottom: 4px;
        }
        .banner-box img {
            display: block;
            width: 100%;
            height: 105px;
            margin: 0 auto;
        }

        .title-main {
            font-size: 22px;
            font-weight: 900;
            color: #340C6F;
            letter-spacing: 2px;
            text-transform: uppercase;
            margin-top: 4px;
            margin-bottom: 2px;
        }
        .subtitle {
            font-size: 9px;
            color: #b45309;
            font-weight: bold;
            letter-spacing: 1px;
            text-transform: uppercase;
            margin-bottom: 8px;
        }
        .name-box {
            border-bottom: 2px solid #f59e0b;
            margin: 4px auto 10px auto;
            width: 80%;
            padding-bottom: 4px;
        }
        .student-name {
            font-size: 24px;
            font-weight: 900;
            color: #F1400C;
            letter-spacing: 0.5px;
            text-transform: uppercase;
        }
        .citation {
            font-size: 10.5px;
            color: #334155;
            line-height: 1.5;
            margin: 8px auto 12px auto;
            width: 88%;
        }

        /* Performance grid */
        .grid-table {
            width: 80%;
            margin: 0 auto 12px auto;
            border-collapse: collapse;
        }
        .grid-table td {
            border: 1px solid #cbd5e1;
            background-color: #f8fafc;
            padding: 5px 8px;
            font-size: 9px;
            text-align: center;
        }
        .lbl {
            font-size: 7.5px;
            color: #64748b;
            text-transform: uppercase;
            font-weight: bold;
            display: block;
        }
        .val {
            font-weight: bold;
            color: #0f172a;
            font-size: 10px;
        }

        /* Signatures */
        .sig-table {
            width: 90%;
            margin: 16px auto 0 auto;
            border-collapse: collapse;
        }
        .sig-td {
            width: 33.33%;
            text-align: center;
            vertical-align: bottom;
            padding: 0 10px;
        }
        .sig-line {
            border-top: 1px solid #475569;
            padding-top: 3px;
            font-size: 8.5px;
            font-weight: bold;
            color: #1e293b;
            text-transform: uppercase;
        }
        .sig-img {
            height: 38px;
            margin-bottom: 4px;
        }
        .sig-img img {
            height: 35px;
            width: auto;
            max-width: 120px;
        }
    </style>
</head>
<body>

<div class="cert-border">
    <div class="cert-inner">

        <!-- Header Banner Section -->
        <div class="banner-box">
            @if(!empty($setting->header_banner_path) && file_exists(public_path($setting->header_banner_path)))
                <img src="{{ public_path($setting->header_banner_path) }}" alt="Header Banner">
            @elseif(file_exists(public_path('images/header_banner.jpg')))
                <img src="{{ public_path('images/header_banner.jpg') }}" alt="Header Banner">
            @else
                <div style="padding: 10px 0;">
                    <h1 style="color: #340C6F; font-size: 22px; font-weight: 900; margin: 0; text-transform: uppercase;">{{ $setting->header_title ?? 'YOUTH REVOLUTIONARY' }}</h1>
                    <h2 style="color: #F1400C; font-size: 12px; font-weight: 700; margin: 2px 0 0 0; text-transform: uppercase;">{{ $setting->header_subtitle ?? 'A Unit of SWS' }}</h2>
                </div>
            @endif
        </div>

        <div class="title-main">CERTIFICATE OF MERIT</div>
        <div class="subtitle">HONORING ACADEMIC & CO-CURRICULAR EXCELLENCE</div>

        <div style="font-size: 8.5px; color: #64748b; font-weight: bold; text-transform: uppercase;">THIS IS PROUDLY PRESENTED TO</div>

        <!-- Student Name -->
        <div class="name-box">
            <div class="student-name">{{ $registration->student_name }}</div>
        </div>

        <!-- Citation Body -->
        <div class="citation">
            For outstanding performance and meritorious achievement in 
            <strong style="color: #340C6F;">{{ $registration->event->title ?? 'the Youth Competition' }}</strong>
            held for <strong style="color: #0f172a;">{{ $registration->group->group_name ?? 'General Group' }}</strong>.
            @if($registration->rank || $registration->marks !== null)
                <br>Secured 
                @if($registration->rank)<strong style="color: #b45309;">Rank: {{ $registration->rank }}</strong>@endif
                @if($registration->marks !== null) with an overall score of <strong style="color: #340C6F;">{{ $registration->marks }} Marks</strong>@endif.
            @endif
        </div>

        <!-- Details Grid -->
        <table class="grid-table">
            <tr>
                <td>
                    <span class="lbl">Roll Number</span>
                    <span class="val">{{ $registration->roll_no }}</span>
                </td>
                <td>
                    <span class="lbl">Registration No.</span>
                    <span class="val">{{ $registration->registration_no ?? 'N/A' }}</span>
                </td>
                <td>
                    <span class="lbl">Class / Category</span>
                    <span class="val">{{ $registration->student_class }}</span>
                </td>
                <td>
                    <span class="lbl">Issue Date</span>
                    <span class="val">{{ date('d M, Y') }}</span>
                </td>
            </tr>
        </table>

        <!-- Signatures Table -->
        <table class="sig-table">
            <tr>
                <td class="sig-td">
                    <div class="sig-img" style="line-height: 38px; font-weight: bold; font-style: italic; font-size: 13px; color: #1e293b;">
                        Rajnish Kumar
                    </div>
                    <div class="sig-line">President & Patron</div>
                </td>
                <td class="sig-td">
                    <div class="sig-img">
                        <div style="width: 36px; height: 36px; border: 1px dashed #b45309; border-radius: 50%; margin: 0 auto; line-height: 36px; font-size: 7px; color: #b45309; font-weight: bold;">SEAL</div>
                    </div>
                    <div class="sig-line">Certified Seal</div>
                </td>
                <td class="sig-td">
                    <div class="sig-img">
                        @if(!empty($setting->signature_path) && file_exists(public_path($setting->signature_path)))
                            <img src="{{ public_path($setting->signature_path) }}" alt="Signature">
                        @else
                            <div style="line-height: 38px; font-weight: bold; font-style: italic; font-size: 13px; color: #1e293b;">Exam Controller</div>
                        @endif
                    </div>
                    <div class="sig-line">Controller of Exam</div>
                </td>
            </tr>
        </table>

        <div style="margin-top: 10px; font-size: 7px; color: #94a3b8; text-align: center;">
            Verification ID: CERT-{{ $registration->roll_no }} | Youth Revolutionary (A Unit of SWS)
        </div>

    </div>
</div>

</body>
</html>

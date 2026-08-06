<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Admit Card - {{ $registration->roll_no }}</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Noto+Sans+Devanagari:wght@400;700&display=swap');
        
        @page {
            margin: 12px;
        }
        body {
            font-family: 'Noto Sans Devanagari', 'DejaVu Sans', sans-serif;
            color: #0f172a;
            background-color: #ffffff;
            margin: 0;
            padding: 0;
            font-size: 11px;
            line-height: 1.35;
        }

        /* Outer Container */
        .admit-card-wrapper {
            border: 2px solid #340C6F;
            padding: 16px;
            background-color: #ffffff;
        }

        /* Top Header */
        .header-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 4px;
        }
        .header-logo-left {
            width: 100px;
            text-align: left;
            vertical-align: middle;
        }
        .header-logo-left img {
            max-width: 95px;
            max-height: 95px;
        }
        .header-center-title {
            text-align: center;
            vertical-align: middle;
        }
        .header-center-title h1 {
            color: #340C6F;
            font-size: 23px;
            font-weight: 900;
            margin: 0;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .header-center-title h2 {
            color: #F1400C;
            font-size: 13px;
            font-weight: 700;
            margin: 2px 0 0 0;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .header-center-title p {
            color: #64748b;
            font-size: 9px;
            margin: 2px 0 0 0;
            font-weight: 600;
        }

        /* Clean Title - Bold & Larger */
        .hall-ticket-badge {
            color: #340C6F;
            text-align: center;
            font-size: 20px;
            font-weight: 900;
            padding: 2px 0;
            letter-spacing: 2px;
            text-transform: uppercase;
            margin-top: 2px;
            margin-bottom: 6px;
            background-color: transparent;
        }

        /* Table Styling */
        .data-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 6px;
        }
        .data-table th, .data-table td {
            border: 1px solid #cbd5e1;
            padding: 4px 7px;
            font-size: 10px;
            vertical-align: middle;
        }
        .lbl {
            background-color: #f8fafc;
            font-weight: bold;
            color: #475569;
            width: 18%;
            text-transform: uppercase;
            font-size: 9px;
        }
        .val {
            color: #0f172a;
            font-weight: 600;
            width: 32%;
        }

        /* Roll Number Highlight */
        .roll-highlight {
            font-size: 13px;
            font-weight: 900;
            font-family: monospace;
            color: #340C6F;
            letter-spacing: 1px;
        }

        /* Photo Column */
        .photo-cell {
            width: 130px;
            text-align: center;
            vertical-align: top;
            padding: 2px;
            background-color: #ffffff;
        }
        .photo-box {
            width: 115px;
            height: 130px;
            border: 1px solid #94a3b8;
            margin: 0 auto;
            background-color: #f8fafc;
            overflow: hidden;
        }
        .photo-box img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .photo-lbl {
            font-size: 8px;
            font-weight: bold;
            color: #64748b;
            margin-top: 2px;
            text-transform: uppercase;
        }

        /* Clean Section Header (No Dark Background Strip) */
        .sec-banner {
            border-bottom: 2px solid #340C6F;
            color: #340C6F;
            font-size: 10.5px;
            font-weight: 800;
            padding: 2px 0;
            text-transform: uppercase;
            margin-top: 6px;
            margin-bottom: 4px;
            letter-spacing: 0.5px;
            background-color: transparent;
        }

        /* Exam Schedule Table (Clean Light Headers) */
        .exam-grid {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 6px;
        }
        .exam-grid th {
            background-color: #f8fafc;
            color: #340C6F;
            font-size: 9px;
            font-weight: bold;
            text-transform: uppercase;
            padding: 4px 6px;
            border: 1px solid #cbd5e1;
            text-align: left;
        }
        .exam-grid td {
            border: 1px solid #cbd5e1;
            padding: 5px 6px;
            font-size: 10px;
            font-weight: 600;
        }

        /* Signatures Layout */
        .sig-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 8px;
            margin-bottom: 6px;
        }
        .sig-td {
            width: 50%;
            vertical-align: bottom;
            text-align: center;
        }
        .sig-box-line {
            width: 170px;
            border-top: 1px solid #334155;
            margin: 0 auto;
            padding-top: 3px;
            font-size: 9px;
            font-weight: bold;
            color: #340C6F;
            text-transform: uppercase;
        }
        .sig-img-container {
            height: 35px;
            margin-bottom: 2px;
        }
        .sig-img-container img {
            max-height: 34px;
            max-width: 150px;
        }

        /* Instructions Container */
        .inst-box {
            border: 1px solid #cbd5e1;
            background-color: #ffffff;
            padding: 6px 10px;
            border-radius: 2px;
            margin-top: 4px;
        }
        .inst-head {
            font-weight: bold;
            color: #340C6F;
            font-size: 9.5px;
            text-transform: uppercase;
            margin-bottom: 6px;
            border-bottom: 1px solid #e2e8f0;
            padding-bottom: 4px;
            letter-spacing: 0.5px;
        }
        .inst-body {
            font-size: 9px;
            color: #334155;
            line-height: 1.45;
        }
    </style>
</head>
<body>

<div class="admit-card-wrapper">
    <!-- Header Banner Section -->
    <div style="text-align: center; margin-bottom: 4px;">
        @if(!empty($setting->header_banner_path) && file_exists(public_path($setting->header_banner_path)))
            <img src="data:image/jpeg;base64,{{ base64_encode(file_get_contents(public_path($setting->header_banner_path))) }}" style="width: 100%; max-height: 140px; object-fit: contain;" alt="Header Banner">
        @elseif(file_exists(public_path('images/header_banner.jpg')))
            <img src="data:image/jpeg;base64,{{ base64_encode(file_get_contents(public_path('images/header_banner.jpg'))) }}" style="width: 100%; max-height: 140px; object-fit: contain;" alt="Header Banner">
        @endif
    </div>

    <!-- Clean Line Banner Title -->
    <div class="hall-ticket-badge">ADMIT CARD</div>

    <!-- Student & Registration Information -->
    <table class="data-table">
        <tr>
            <td class="lbl">Roll Number</td>
            <td class="val"><span class="roll-highlight">{{ $registration->roll_no }}</span></td>
            <td class="lbl">Registration ID</td>
            <td class="val">#REG-{{ str_pad($registration->id, 5, '0', STR_PAD_LEFT) }}</td>
            <td rowspan="6" class="photo-cell">
                <div class="photo-box">
                    @if($registration->photo && file_exists(public_path($registration->photo)))
                        <img src="data:image/jpeg;base64,{{ base64_encode(file_get_contents(public_path($registration->photo))) }}" alt="Candidate Photo">
                    @else
                        <div style="padding-top: 50px; font-size: 8px; color: #94a3b8; font-weight: bold;">AFFIX PASSPORT<br>PHOTO HERE</div>
                    @endif
                </div>
                <div class="photo-lbl">CANDIDATE PHOTO</div>
            </td>
        </tr>
        <tr>
            <td class="lbl">Candidate Name</td>
            <td class="val"><strong>{{ strtoupper($registration->student_name) }}</strong></td>
            <td class="lbl">Father's Name</td>
            <td class="val">{{ strtoupper($registration->father_name ?? 'N/A') }}</td>
        </tr>
        <tr>
            <td class="lbl">Class / Stream</td>
            <td class="val">{{ $registration->student_class }}</td>
            <td class="lbl">Group Tier</td>
            <td class="val">{{ $registration->group->group_name ?? 'N/A' }}</td>
        </tr>
        <tr>
            <td class="lbl">Competition Event</td>
            <td class="val" colspan="3">
                @php
                    $seasonVal = $registration->event->season ?? \App\Models\Season::latest()->first()?->name;
                @endphp
                <strong>{{ $registration->event->title ?? 'N/A' }} @if(!empty($seasonVal)) ({{ \Illuminate\Support\Str::contains(strtolower($seasonVal), 'season') ? $seasonVal : 'Season ' . $seasonVal }}) @endif</strong>
            </td>
        </tr>
        <tr>
            <td class="lbl">Date of Birth</td>
            <td class="val">{{ $registration->dob ? \Carbon\Carbon::parse($registration->dob)->format('d-m-Y') : 'N/A' }}</td>
            <td class="lbl">Gender / Category</td>
            <td class="val">{{ $registration->gender ?? 'N/A' }} / {{ $registration->category ?? 'General' }}</td>
        </tr>
        <tr>
            <td class="lbl">Mobile Number</td>
            <td class="val">{{ $registration->mobile }}</td>
            <td class="lbl">Email Address</td>
            <td class="val">{{ $registration->email }}</td>
        </tr>
        <tr>
            <td class="lbl">School Name</td>
            <td class="val" colspan="4">{{ $registration->school_name ?? 'N/A' }}</td>
        </tr>
        <tr>
            <td class="lbl">Candidate Address</td>
            <td class="val" colspan="4">{{ $registration->address ?? 'N/A' }}</td>
        </tr>
    </table>

    <!-- Clean Section Title (No Solid Fill) -->
    <div class="sec-banner">EXAMINATION SCHEDULE & VENUE DETAILS</div>

    <table class="exam-grid">
        <thead>
            <tr>
                <th style="width: 20%;">Exam Date</th>
                <th style="width: 20%;">Reporting Time</th>
                <th style="width: 25%;">Competition Timing</th>
                <th style="width: 35%;">Exam Center & Location</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    <strong style="color: #340C6F; font-size: 11px;">
                        @if(!empty($registration->event->event_date))
                            {{ $registration->event->event_date->format('d-m-Y') }}
                        @elseif(!empty($registration->event->start_event_date))
                            {{ $registration->event->start_event_date->format('d-m-Y') }}
                        @else
                            As per Schedule
                        @endif
                    </strong>
                    <div style="font-size: 8px; color: #64748b; margin-top: 2px;">(Date of Competition)</div>
                </td>
                <td>
                    <strong style="color: #340C6F; font-size: 11px;">{{ $registration->event->reporting_time ?? $registration->group->reporting_time ?? '09:00 AM' }}</strong>
                    <div style="font-size: 8px; color: #64748b; margin-top: 2px;">(Be present before gate closes)</div>
                </td>
                <td>
                    <strong style="color: #0f172a; font-size: 11px;">{{ $registration->event->exam_time ?? $registration->group->exam_time ?? '10:00 AM - 12:00 PM' }}</strong>
                    <div style="font-size: 8px; color: #64748b; margin-top: 2px;">(Duration as per rules)</div>
                </td>
                <td>
                    <strong style="color: #0f172a; font-size: 11px;">{{ $registration->group->centre_name ?? $registration->event->location ?? 'Center details available at portal' }}</strong>
                    <div style="font-size: 8px; color: #64748b; margin-top: 2px;">Bring a hard copy of this Admit Card</div>
                </td>
            </tr>
        </tbody>
    </table>

    <!-- Signatures Table -->
    <table class="sig-table">
        <tr>
            <td class="sig-td">
                <div class="sig-img-container"></div>
                <div class="sig-box-line">Signature of Candidate</div>
            </td>
            <td class="sig-td">
                <div class="sig-img-container">
                    @if(!empty($setting->signature_path) && file_exists(public_path($setting->signature_path)))
                        <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path($setting->signature_path))) }}" alt="Signature">
                    @endif
                </div>
                <div class="sig-box-line">Authorized Signatory / Controller</div>
            </td>
        </tr>
    </table>

    <!-- Important Instructions -->
    <div class="inst-box">
        <div class="inst-head">IMPORTANT INSTRUCTIONS FOR CANDIDATES</div>
        <div class="inst-body">
            @php
                $categoryInstructions = null;
                if (!empty($registration->event->category)) {
                    $matchedCategory = \App\Models\Category::where('name', $registration->event->category)->first();
                    if ($matchedCategory && !empty($matchedCategory->instructions)) {
                        $categoryInstructions = $matchedCategory->instructions;
                    }
                }
            @endphp
            {!! nl2br(e($categoryInstructions ?? $setting->instructions)) !!}
        </div>
    </div>
</div>

</body>
</html>

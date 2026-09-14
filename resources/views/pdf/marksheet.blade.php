<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Official Marksheet - {{ $registration->roll_no }}</title>
    <style>
        @page {
            margin: 10px;
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
        .wrapper {
            border: 2px solid #340C6F;
            padding: 14px;
            background-color: #ffffff;
        }
        .text-center { text-align: center; }
        .text-right { text-align: right; }
        .font-bold { font-weight: bold; }
        
        /* Header Banner */
        .header-banner {
            text-align: center;
            margin-bottom: 4px;
            padding-bottom: 4px;
        }
        .header-banner img {
            display: block;
            width: 100%;
            height: 95px;
            margin: 0 auto;
        }
        
        /* Title Badge */
        .title-badge {
            text-align: center;
            font-size: 16px;
            font-weight: 900;
            color: #340C6F;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            margin: 4px 0 2px 0;
        }
        .subtitle {
            text-align: center;
            font-size: 8.5px;
            color: #64748b;
            font-weight: bold;
            margin-bottom: 8px;
        }

        /* Candidate Details Table */
        .candidate-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
        }
        .candidate-table th, .candidate-table td {
            border: 1px solid #cbd5e1;
            padding: 6px 8px;
            font-size: 9.5px;
            vertical-align: middle;
        }
        .lbl {
            background-color: #f8fafc;
            font-weight: bold;
            color: #475569;
            width: 18%;
        }
        .val {
            color: #0f172a;
            width: 27%;
        }
        .photo-cell {
            width: 18%;
            text-align: center;
            vertical-align: middle;
            background-color: #f8fafc;
            padding: 6px;
        }
        .photo-box {
            width: 85px;
            height: 100px;
            margin: 0 auto;
            border: 1px solid #94a3b8;
            background-color: #ffffff;
            text-align: center;
        }
        .photo-box img {
            width: 85px;
            height: 100px;
            object-fit: cover;
        }

        /* Section Head */
        .sec-head {
            font-size: 10px;
            font-weight: bold;
            color: #340C6F;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            padding: 4px 6px;
            background-color: #f1f5f9;
            border: 1px solid #cbd5e1;
            border-bottom: none;
        }

        /* Score Table */
        .score-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
        }
        .score-table th, .score-table td {
            border: 1px solid #cbd5e1;
            padding: 7px 6px;
            font-size: 9.5px;
            text-align: center;
        }
        .score-table th {
            background-color: #f8fafc;
            font-weight: bold;
            color: #334155;
            font-size: 9px;
            text-transform: uppercase;
        }
        .score-obtained {
            font-size: 13px;
            font-weight: 900;
            color: #340C6F;
            background-color: #faf5ff;
        }
        .status-qualified {
            color: #166534;
            font-weight: 900;
            background-color: #dcfce7;
            padding: 2px 6px;
            border-radius: 3px;
        }
        .status-unqualified {
            color: #991b1b;
            font-weight: 900;
            background-color: #fee2e2;
            padding: 2px 6px;
            border-radius: 3px;
        }
        .status-participated {
            color: #1e40af;
            font-weight: 900;
            background-color: #dbeafe;
            padding: 2px 6px;
            border-radius: 3px;
        }

        /* Notes box */
        .notes-box {
            border: 1px solid #cbd5e1;
            background-color: #f8fafc;
            padding: 8px 10px;
            margin-bottom: 16px;
            font-size: 8.5px;
            color: #334155;
            line-height: 1.4;
        }
        .notes-title {
            font-weight: bold;
            color: #340C6F;
            text-transform: uppercase;
            margin-bottom: 3px;
            font-size: 9px;
        }

        /* Signatures */
        .sig-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
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
        .sig-container {
            height: 45px;
            margin-bottom: 4px;
        }
        .sig-container img {
            height: 40px;
            width: auto;
            max-width: 120px;
        }
    </style>
</head>
<body>

<div class="wrapper">

    <!-- Official Header Banner -->
    <div class="header-banner">
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

@php
    $isQualifyMode = ($registration->event && ($registration->event->evaluation_type ?? 'marks') === 'qualify_only');
@endphp

    <!-- Title -->
    <div class="title-badge">{{ $isQualifyMode ? 'OFFICIAL ASSESSMENT & QUALIFICATION STATEMENT' : 'OFFICIAL STATEMENT OF MARKS' }}</div>
    <div class="subtitle">Examination & Talent Search Council | Academic & Skill Assessment Record</div>

    <!-- Candidate Profile Table -->
    <table class="candidate-table">
        <tr>
            <td class="lbl">Roll Number</td>
            <td class="val"><strong style="color: #340C6F; font-size: 11px;">{{ $registration->roll_no }}</strong></td>
            <td class="lbl">Registration No.</td>
            <td class="val">{{ $registration->registration_no ?? 'N/A' }}</td>
            <td rowspan="5" class="photo-cell">
                <div class="photo-box">
                    @if($registration->photo && file_exists(public_path($registration->photo)))
                        <img src="{{ public_path($registration->photo) }}" alt="Photo">
                    @else
                        <div style="padding-top: 35px; font-size: 8px; color: #94a3b8; font-weight: bold;">CANDIDATE<br>PHOTO</div>
                    @endif
                </div>
            </td>
        </tr>
        <tr>
            <td class="lbl">Candidate Name</td>
            <td class="val"><strong style="text-transform: uppercase;">{{ $registration->student_name }}</strong></td>
            <td class="lbl">Father's Name</td>
            <td class="val" style="text-transform: uppercase;">{{ $registration->father_name ?? 'N/A' }}</td>
        </tr>
        <tr>
            <td class="lbl">Class / Group</td>
            <td class="val">{{ $registration->student_class }} ({{ $registration->group->group_name ?? 'General' }})</td>
            <td class="lbl">Category / Gender</td>
            <td class="val">{{ $registration->category ?? 'General' }} / {{ $registration->gender ?? 'N/A' }}</td>
        </tr>
        <tr>
            <td class="lbl">School / Institute</td>
            <td colspan="3" class="val">{{ $registration->school_name ?? 'N/A' }}</td>
        </tr>
        <tr>
            <td class="lbl">Competition Event</td>
            <td class="val"><strong style="color: #F1400C;">{{ $registration->event->title ?? 'N/A' }}</strong></td>
            <td class="lbl">Date of Exam</td>
            <td class="val">{{ $registration->event->event_date ? $registration->event->event_date->format('d M, Y') : 'Scheduled' }}</td>
        </tr>
    </table>

    <!-- Score Breakdown Section -->
    <div class="sec-head">{{ $isQualifyMode ? 'PERFORMANCE ASSESSMENT & TALENT EVALUATION' : 'EVALUATION MATRIX & PERFORMANCE BREAKDOWN' }}</div>
    
    @if($isQualifyMode)
        <!-- Qualitative / Status-Only Assessment Table -->
        <table class="score-table">
            <thead>
                <tr>
                    <th style="width: 35%; text-align: left; padding-left: 10px;">Subject / Competition Event</th>
                    <th style="width: 25%;">Evaluation Scheme</th>
                    <th style="width: 18%;">Merit / Rank Citation</th>
                    <th style="width: 22%;">Official Qualification Status</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td style="text-align: left; padding-left: 10px;">
                        <strong style="font-size: 9.5px; color: #340C6F;">{{ $registration->event->title ?? 'Cultural Event' }}</strong>
                        <div style="font-size: 7.5px; color: #64748b;">Category: {{ $registration->event->category ?? 'General' }}</div>
                    </td>
                    <td style="font-size: 8px; color: #334155;">
                        <strong>Jury Performance Screening</strong>
                        <div style="font-size: 7px; color: #64748b;">Qualitative Evaluation</div>
                    </td>
                    <td style="font-size: 9px;"><strong>{{ $registration->rank ?? '—' }}</strong></td>
                    <td>
                        @if($registration->qualification_status === 'Qualified')
                            <span class="status-qualified" style="font-size: 9.5px; padding: 3px 8px;">QUALIFIED</span>
                        @elseif($registration->qualification_status === 'Not Qualified')
                            <span class="status-unqualified" style="font-size: 9.5px; padding: 3px 8px;">NOT QUALIFIED</span>
                        @else
                            <span class="status-participated" style="font-size: 9.5px; padding: 3px 8px;">UNDER REVIEW</span>
                        @endif
                    </td>
                </tr>
            </tbody>
        </table>
    @else
        <!-- Numeric Score Breakdown Table -->
        <table class="score-table">
            <thead>
                <tr>
                    <th style="width: 25%; text-align: left; padding-left: 8px;">Subject / Component</th>
                    @if(!empty($registration->event->total_questions))
                        <th style="width: 10%;">Questions</th>
                        <th style="width: 10%;">Mark / Q</th>
                    @endif
                    <th style="width: 12%;">Max Marks</th>
                    <th style="width: 12%;">Cutoff Score</th>
                    <th style="width: 15%;">Marks Obtained</th>
                    <th style="width: 12%;">Percentage</th>
                    <th style="width: 14%;">Rank / Merit</th>
                    <th style="width: 16%;">Result Status</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td style="text-align: left; padding-left: 8px;">
                        <strong>{{ $registration->event->title ?? 'General Competition' }}</strong>
                    </td>
                    @if(!empty($registration->event->total_questions))
                        <td>{{ $registration->event->total_questions }}</td>
                        <td>+{{ number_format($registration->event->marks_per_question ?? 1, 1) }}</td>
                    @endif
                    <td><strong>{{ $registration->event->total_marks !== null ? number_format($registration->event->total_marks, 2) : '100.00' }}</strong></td>
                    <td style="color: #b45309; font-weight: bold;">{{ $registration->event->cutoff_marks !== null ? number_format($registration->event->cutoff_marks, 2) : 'N/A' }}</td>
                    <td class="score-obtained">{{ $registration->marks !== null ? number_format($registration->marks, 2) : '0.00' }}</td>
                    <td><strong>{{ $registration->percentage !== null ? $registration->percentage . '%' : 'N/A' }}</strong></td>
                    <td><strong>{{ $registration->rank ?? '—' }}</strong></td>
                    <td>
                        @if($registration->qualification_status === 'Qualified')
                            <span class="status-qualified">QUALIFIED</span>
                        @elseif($registration->qualification_status === 'Not Qualified')
                            <span class="status-unqualified">NOT QUALIFIED</span>
                        @else
                            <span class="status-participated">PARTICIPATED</span>
                        @endif
                    </td>
                </tr>
            </tbody>
        </table>
    @endif

    <!-- Evaluation Criteria & Notes -->
    <div class="notes-box">
        <div class="notes-title">Marking Scheme & Evaluation Notes</div>
        @if(!empty($registration->event->marking_scheme_notes))
            {!! nl2br(e($registration->event->marking_scheme_notes)) !!}
        @elseif($isQualifyMode)
            1. Candidates are evaluated based on artistic excellence, performance standards, and panel jury screening.<br>
            2. Candidates marked <strong>QUALIFIED</strong> are eligible for certificate issuance and selection for further rounds.<br>
            3. This statement is a computer-generated document issued under the authority of Youth Revolutionary Nasriganj.
        @else
            1. Qualification status is determined based on the minimum qualifying cutoff score established for this event.<br>
            2. Candidates marked <strong>QUALIFIED</strong> are eligible for certificate issuance, felicitation and merit prizes.<br>
            3. This statement is a computer-generated document issued under the authority of Youth Revolutionary Nasriganj.
        @endif
    </div>

    <!-- Signatures Table -->
    <table class="sig-table">
        <tr>
            <td class="sig-td">
                <div class="sig-container">&nbsp;</div>
                <div class="sig-line">Signature of Candidate</div>
            </td>
            <td class="sig-td">
                <div class="sig-container">
                    <div style="width: 38px; height: 38px; border: 1px dashed #340C6F; border-radius: 50%; margin: 0 auto; line-height: 38px; font-size: 7px; color: #340C6F; font-weight: bold;">SEAL</div>
                </div>
                <div class="sig-line">Examination Seal</div>
            </td>
            <td class="sig-td">
                <div class="sig-container">
                    @if(!empty($setting->signature_path) && file_exists(public_path($setting->signature_path)))
                        <img src="{{ public_path($setting->signature_path) }}" alt="Signature">
                    @endif
                </div>
                <div class="sig-line">Controller of Examinations</div>
            </td>
        </tr>
    </table>

    <!-- Footer Bar -->
    <div style="border-top: 1px solid #e2e8f0; margin-top: 10px; padding-top: 4px; font-size: 7.5px; color: #94a3b8; text-align: center;">
        Verification ID: {{ strtoupper(substr(md5($registration->roll_no . $registration->id), 0, 14)) }} | Generated on: {{ date('d-m-Y H:i') }} | Youth Revolutionary Nasriganj
    </div>

</div>

</body>
</html>

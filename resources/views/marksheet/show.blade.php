<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Official Marksheet - {{ $registration->student_name }} ({{ $registration->roll_no }})</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@700;900&family=Inter:wght@400;500;600;700;800;900&family=Great+Vibes&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
        .font-cinzel { font-family: 'Cinzel', serif; }
        .font-signature { font-family: 'Great Vibes', cursive; }

        @media print {
            @page {
                size: A4 portrait;
                margin: 5mm 7mm;
            }
            *, *:before, *:after {
                box-sizing: border-box !important;
            }
            html, body {
                background: #ffffff !important;
                margin: 0 !important;
                padding: 0 !important;
                min-height: auto !important;
                height: auto !important;
                -webkit-print-color-adjust: exact !important;
                print-color-adjust: exact !important;
            }
            .no-print { 
                display: none !important; 
            }
            .sheet-card { 
                box-shadow: none !important; 
                border: 2px solid #340C6F !important; 
                border-radius: 8px !important;
                padding: 10px 14px !important;
                margin: 0 auto !important;
                width: 100% !important;
                max-width: 100% !important;
                page-break-inside: avoid !important;
                break-inside: avoid !important;
            }
            .header-banner-img {
                width: 100% !important;
                height: auto !important;
                display: block !important;
                margin: 0 auto !important;
            }
            .print-compact-gap > * + * {
                margin-top: 0.55rem !important;
            }
            .print-table th, .print-table td {
                padding-top: 4px !important;
                padding-bottom: 4px !important;
                padding-left: 6px !important;
                padding-right: 6px !important;
                font-size: 10px !important;
            }
            .print-photo {
                width: 65px !important;
                height: 78px !important;
            }
            .print-seal {
                width: 36px !important;
                height: 36px !important;
            }
            .print-sig-line {
                height: 24px !important;
            }
        }
    </style>
</head>
<body class="bg-slate-900 min-h-screen p-3 sm:p-6 flex flex-col items-center justify-start text-gray-900">

    <!-- Print / Control Bar -->
    <div class="max-w-4xl w-full mb-4 flex flex-wrap items-center justify-between gap-3 no-print bg-slate-800 p-3.5 rounded-2xl border border-slate-700 text-white shadow-xl">
        <div class="flex items-center gap-3">
            <a href="{{ url('/results') }}" class="w-9 h-9 rounded-xl bg-slate-700 hover:bg-slate-600 flex items-center justify-center text-white transition-colors" title="Back to Results">
                <i class="fa-solid fa-arrow-left text-xs"></i>
            </a>
            <div>
                <h1 class="font-extrabold text-sm text-white">Official Marksheet / Scorecard</h1>
                <p class="text-[11px] text-gray-400">Roll No: <span class="font-mono text-amber-400 font-bold">{{ $registration->roll_no }}</span> | Reg No: <span class="font-mono text-gray-300">{{ $registration->registration_no ?? 'N/A' }}</span></p>
            </div>
        </div>
        <div class="flex items-center gap-2">
            <button onclick="window.print()" class="px-4 py-2 rounded-xl bg-slate-700 hover:bg-slate-600 text-white font-bold text-xs shadow-md transition-all flex items-center gap-2 cursor-pointer">
                <i class="fa-solid fa-print"></i>
                <span>Print (Single Page)</span>
            </button>
            <a href="{{ route('marksheet.download', $registration->roll_no) }}" class="px-4 py-2 rounded-xl bg-[#F1400C] hover:bg-orange-600 text-white font-bold text-xs shadow-lg shadow-[#F1400C]/30 transition-all flex items-center gap-2">
                <i class="fa-solid fa-file-pdf"></i>
                <span>Download PDF</span>
            </a>
        </div>
    </div>

    <!-- Official Marksheet Container -->
    <div class="sheet-card max-w-4xl w-full bg-white p-4 sm:p-6 rounded-2xl border-2 border-[#340C6F] shadow-2xl relative overflow-hidden">
        
        <!-- Watermark -->
        <div class="absolute inset-0 flex items-center justify-center pointer-events-none opacity-[0.03]">
            <img src="{{ asset('logo/logo.jpeg') }}" alt="Watermark" class="w-80 h-80 object-contain">
        </div>

        <div class="relative z-10 space-y-3 sm:space-y-3.5 print-compact-gap">

            <!-- Official Admit Card Header Banner (Full Width) -->
            <div class="border-b border-gray-200 pb-2 text-center">
                @if(!empty($setting->header_banner_path) && file_exists(public_path($setting->header_banner_path)))
                    <img src="{{ asset($setting->header_banner_path) }}?v={{ filemtime(public_path($setting->header_banner_path)) }}" class="w-full h-auto block mx-auto header-banner-img" alt="Official Header Banner">
                @elseif(file_exists(public_path('images/header_banner.jpg')))
                    <img src="{{ asset('images/header_banner.jpg') }}?v={{ filemtime(public_path('images/header_banner.jpg')) }}" class="w-full h-auto block mx-auto header-banner-img" alt="Official Header Banner">
                @else
                    <div class="py-1">
                        <div class="flex items-center justify-center gap-3">
                            <img src="{{ asset('logo/logo.jpeg') }}" class="w-10 h-10 rounded-full border border-gray-300" alt="Logo">
                            <div class="text-left">
                                <h1 class="text-xl font-black text-[#340C6F] tracking-wider">{{ $setting->header_title ?? 'YOUTH REVOLUTIONARY' }}</h1>
                                <p class="text-[11px] font-bold text-[#F1400C] tracking-wide">{{ $setting->header_subtitle ?? 'A Unit of SWS (Talent Search Examination)' }}</p>
                            </div>
                        </div>
                    </div>
                @endif
            </div>

            <!-- Title Badge -->
            <div class="text-center">
                <div class="inline-block bg-[#340C6F] text-white px-5 py-1 rounded-full font-black text-xs uppercase tracking-widest shadow-xs">
                    OFFICIAL SCORECARD / MARKSHEET
                </div>
                <p class="text-[10px] text-gray-500 font-bold mt-0.5">Season: {{ $registration->event->season ?? '2026' }} | Academic & Talent Search Council</p>
            </div>

            <!-- Candidate Profile Grid -->
            <div class="border border-gray-200 rounded-xl overflow-hidden bg-gray-50/40">
                <div class="bg-gray-100/80 px-3.5 py-1.5 border-b border-gray-200 text-[11px] font-black text-[#340C6F] uppercase tracking-wider flex items-center justify-between">
                    <span><i class="fa-solid fa-id-card-clip mr-1.5"></i> Candidate Credentials</span>
                    <span class="text-[10px] font-mono text-gray-600">ID: {{ $registration->registration_no ?? ('#YR-'.$registration->id) }}</span>
                </div>
                <div class="p-3 grid grid-cols-1 sm:grid-cols-4 gap-3 items-center">
                    
                    <!-- Candidate Photo -->
                    <div class="sm:col-span-1 flex flex-col items-center justify-center text-center">
                        <div class="w-20 h-24 sm:w-22 sm:h-26 print-photo border border-gray-300 rounded-lg overflow-hidden bg-white shadow-xs flex items-center justify-center">
                            @if($registration->photo && file_exists(public_path($registration->photo)))
                                <img src="{{ asset($registration->photo) }}" class="w-full h-full object-cover" alt="Photo">
                            @else
                                <div class="text-gray-400 text-[10px] font-bold text-center p-1">
                                    <i class="fa-solid fa-user text-xl mb-0.5 text-gray-300"></i><br>PHOTO
                                </div>
                            @endif
                        </div>
                        <span class="text-[9px] font-bold text-gray-400 uppercase mt-0.5">Candidate Photo</span>
                    </div>

                    <!-- Meta Details -->
                    <div class="sm:col-span-3 grid grid-cols-2 sm:grid-cols-3 gap-x-3 gap-y-1.5 text-xs">
                        <div>
                            <span class="block text-[9px] font-bold text-gray-400 uppercase">Roll Number</span>
                            <span class="font-mono font-black text-[#340C6F] text-xs">{{ $registration->roll_no }}</span>
                        </div>
                        <div>
                            <span class="block text-[9px] font-bold text-gray-400 uppercase">Registration No</span>
                            <span class="font-mono font-bold text-gray-800 text-xs">{{ $registration->registration_no ?? 'N/A' }}</span>
                        </div>
                        <div>
                            <span class="block text-[9px] font-bold text-gray-400 uppercase">Candidate Name</span>
                            <span class="font-black text-gray-900 uppercase text-xs">{{ $registration->student_name }}</span>
                        </div>
                        <div>
                            <span class="block text-[9px] font-bold text-gray-400 uppercase">Father's Name</span>
                            <span class="font-bold text-gray-800 uppercase text-xs">{{ $registration->father_name ?? 'N/A' }}</span>
                        </div>
                        <div>
                            <span class="block text-[9px] font-bold text-gray-400 uppercase">Class / Group</span>
                            <span class="font-bold text-gray-800 text-xs">{{ $registration->student_class }} ({{ $registration->group->group_name ?? 'General' }})</span>
                        </div>
                        <div>
                            <span class="block text-[9px] font-bold text-gray-400 uppercase">School / Institute</span>
                            <span class="font-bold text-gray-800 text-xs truncate block" title="{{ $registration->school_name }}">{{ $registration->school_name ?? 'N/A' }}</span>
                        </div>
                        <div class="sm:col-span-2">
                            <span class="block text-[9px] font-bold text-gray-400 uppercase">Competition / Event</span>
                            <span class="font-black text-[#F1400C] text-xs">{{ $registration->event->title ?? 'N/A' }}</span>
                        </div>
                        <div>
                            <span class="block text-[9px] font-bold text-gray-400 uppercase">Exam Date</span>
                            <span class="font-bold text-gray-800 text-xs">{{ $registration->event->event_date ? $registration->event->event_date->format('d M, Y') : 'Scheduled' }}</span>
                        </div>
                    </div>

                </div>
            </div>

            @php
                $isQualifyMode = ($registration->event && ($registration->event->evaluation_type ?? 'marks') === 'qualify_only');
            @endphp

            <!-- Detailed Scoring & Evaluation Scheme Table -->
            <div class="border border-gray-200 rounded-xl overflow-hidden shadow-xs">
                <div class="bg-gray-100/80 px-3.5 py-1.5 border-b border-gray-200 text-[11px] font-black text-[#340C6F] uppercase tracking-wider flex items-center justify-between">
                    <span><i class="fa-solid fa-chart-column mr-1.5"></i> {{ $isQualifyMode ? 'Official Performance & Qualification Assessment' : 'Evaluation Scheme & Score Breakdown' }}</span>
                    <span class="text-[10px] font-semibold text-gray-500">Official Assessment Record</span>
                </div>

                <div class="overflow-x-auto">
                    @if($isQualifyMode)
                        <!-- Qualified / Not Qualified Scheme Layout (No raw marks or questions) -->
                        <table class="w-full text-left text-xs border-collapse print-table">
                            <thead>
                                <tr class="bg-gray-50 text-gray-600 font-bold uppercase text-[9.5px] border-b border-gray-200">
                                    <th class="py-2 px-3">Competition / Event Component</th>
                                    <th class="py-2 px-3">Evaluation Criteria / Mode</th>
                                    <th class="py-2 px-3 text-center">Merit / Rank Citation</th>
                                    <th class="py-2 px-3 text-center">Official Result Status</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                <tr class="font-medium text-gray-800">
                                    <td class="py-2.5 px-3 font-bold text-gray-900 text-xs">
                                        {{ $registration->event->title ?? 'Cultural Competition' }}
                                        <div class="text-[10px] font-normal text-gray-500">Category: {{ $registration->event->category ?? 'General' }}</div>
                                    </td>
                                    <td class="py-2.5 px-3 text-gray-700">
                                        <div class="font-bold text-xs text-[#340C6F]">Jury Performance & Screening Evaluation</div>
                                        <div class="text-[10px] text-gray-400">Qualitative Assessment (Marks Withheld)</div>
                                    </td>
                                    <td class="py-2.5 px-3 text-center">
                                        @if($registration->rank)
                                            <span class="inline-block px-2.5 py-0.5 rounded-lg bg-amber-100 text-amber-900 font-extrabold text-xs border border-amber-300">
                                                {{ $registration->rank }}
                                            </span>
                                        @else
                                            <span class="text-gray-400 text-xs">—</span>
                                        @endif
                                    </td>
                                    <td class="py-2.5 px-3 text-center">
                                        @if($registration->qualification_status === 'Qualified')
                                            <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-black bg-emerald-100 text-emerald-800 border border-emerald-300 shadow-xs">
                                                <i class="fa-solid fa-circle-check text-xs text-emerald-600"></i> QUALIFIED
                                            </span>
                                        @elseif($registration->qualification_status === 'Not Qualified')
                                            <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-black bg-rose-100 text-rose-800 border border-rose-300 shadow-xs">
                                                <i class="fa-solid fa-circle-xmark text-xs text-rose-600"></i> NOT QUALIFIED
                                            </span>
                                        @else
                                            <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-black bg-amber-100 text-amber-800 border border-amber-300 shadow-xs">
                                                <i class="fa-solid fa-clock text-xs text-amber-600"></i> UNDER REVIEW
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    @else
                        <!-- Numeric Marks Scheme Layout (Quiz / Examination) -->
                        <table class="w-full text-left text-xs border-collapse print-table">
                            <thead>
                                <tr class="bg-gray-50 text-gray-600 font-bold uppercase text-[9.5px] border-b border-gray-200">
                                    <th class="py-2 px-3">Subject / Event Component</th>
                                    @if(!empty($registration->event->total_questions))
                                        <th class="py-2 px-2 text-center">Questions</th>
                                        <th class="py-2 px-2 text-center">Mark / Q</th>
                                    @endif
                                    <th class="py-2 px-2.5 text-center">Max Marks</th>
                                    <th class="py-2 px-2.5 text-center">Cutoff Score</th>
                                    <th class="py-2 px-3 text-center font-black text-[#340C6F]">Marks Obtained</th>
                                    <th class="py-2 px-2.5 text-center">Percentage</th>
                                    <th class="py-2 px-2.5 text-center">Rank / Merit</th>
                                    <th class="py-2 px-3 text-center">Result Status</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                <tr class="font-medium text-gray-800">
                                    <td class="py-2.5 px-3 font-bold text-gray-900 text-xs">
                                        {{ $registration->event->title ?? 'Main Event Examination' }}
                                        <div class="text-[10px] font-normal text-gray-400">Category: {{ $registration->event->category ?? 'General' }}</div>
                                    </td>
                                    
                                    @if(!empty($registration->event->total_questions))
                                        <td class="py-2.5 px-2 text-center font-mono font-bold">{{ $registration->event->total_questions }}</td>
                                        <td class="py-2.5 px-2 text-center font-mono text-gray-600 text-[11px]">
                                            +{{ number_format($registration->event->marks_per_question ?? 1, 1) }}
                                            @if($registration->event->negative_marks > 0)
                                                <span class="text-[9px] text-rose-500 block">(-{{ number_format($registration->event->negative_marks, 2) }})</span>
                                            @endif
                                        </td>
                                    @endif

                                    <td class="py-2.5 px-2.5 text-center font-mono font-bold text-gray-700">
                                        {{ $registration->event->total_marks !== null ? number_format($registration->event->total_marks, 2) : '100.00' }}
                                    </td>

                                    <td class="py-2.5 px-2.5 text-center font-mono font-bold text-amber-700 bg-amber-50/50">
                                        {{ $registration->event->cutoff_marks !== null ? number_format($registration->event->cutoff_marks, 2) : 'N/A' }}
                                    </td>

                                    <td class="py-2.5 px-3 text-center bg-purple-50/40">
                                        <span class="font-mono font-black text-sm text-[#340C6F]">
                                            {{ $registration->marks !== null ? number_format($registration->marks, 2) : '0.00' }}
                                        </span>
                                    </td>

                                    <td class="py-2.5 px-2.5 text-center font-mono font-bold text-gray-700">
                                        {{ $registration->percentage !== null ? $registration->percentage . '%' : 'N/A' }}
                                    </td>

                                    <td class="py-2.5 px-2.5 text-center">
                                        @if($registration->rank)
                                            <span class="inline-block px-2 py-0.5 rounded-md bg-amber-100 text-amber-800 font-extrabold text-xs">
                                                {{ $registration->rank }}
                                            </span>
                                        @else
                                            <span class="text-gray-400 text-xs">—</span>
                                        @endif
                                    </td>

                                    <td class="py-2.5 px-3 text-center">
                                        @if($registration->qualification_status === 'Qualified')
                                            <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-xs font-black bg-emerald-100 text-emerald-800 border border-emerald-300">
                                                <i class="fa-solid fa-circle-check text-[10px]"></i> QUALIFIED
                                            </span>
                                        @elseif($registration->qualification_status === 'Not Qualified')
                                            <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-xs font-black bg-rose-100 text-rose-800 border border-rose-300">
                                                <i class="fa-solid fa-circle-xmark text-[10px]"></i> NOT QUALIFIED
                                            </span>
                                        @else
                                            <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-xs font-black bg-blue-100 text-blue-800 border border-blue-300">
                                                <i class="fa-solid fa-award text-[10px]"></i> PARTICIPATED
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>

            <!-- Notes & Instructions Box -->
            <div class="bg-slate-50 border border-slate-200 rounded-xl p-2.5 sm:p-3 text-[10px] space-y-1 text-gray-600">
                <div class="font-bold text-[#340C6F] uppercase text-[10px] flex items-center gap-1.5">
                    <i class="fa-solid fa-circle-info text-amber-600"></i> Marking Scheme & Evaluation Criteria
                </div>
                <div class="text-[10px] leading-relaxed text-gray-600">
                    @if(!empty($registration->event->marking_scheme_notes))
                        {!! nl2br(e($registration->event->marking_scheme_notes)) !!}
                    @elseif($isQualifyMode)
                        1. Candidates are evaluated through qualitative performance and talent screening by the official examination jury.<br>
                        2. Candidates marked <strong>QUALIFIED</strong> are eligible for certificate issuance and selection for further rounds.<br>
                        3. This statement is a computer-generated official document issued under the authority of Youth Revolutionary Nasriganj.
                    @else
                        1. Qualifying status is determined based on the minimum qualifying cutoff score established for this competition.<br>
                        2. Candidates marked <strong>QUALIFIED</strong> are eligible for certificate issuance and merit considerations.<br>
                        3. This document is a computer-generated statement of marks issued by Youth Revolutionary examination authority.
                    @endif
                </div>
            </div>

            <!-- Signatures Section -->
            <div class="pt-3 sm:pt-4 grid grid-cols-3 gap-4 text-center text-xs">
                
                <!-- Candidate Signature -->
                <div class="flex flex-col justify-end items-center">
                    <div class="h-8 sm:h-9 print-sig-line w-full flex items-center justify-center">
                        <span class="text-gray-300 italic text-[10px]">[Candidate's Signature]</span>
                    </div>
                    <div class="w-full border-t border-gray-400 pt-1">
                        <span class="font-bold text-gray-700 uppercase text-[9px]">Signature of Candidate</span>
                    </div>
                </div>

                <!-- Official Stamp / Seal (Hidden - empty div preserves 3-column grid layout) -->
                <div></div>
                <!-- 
                <div class="flex flex-col justify-end items-center">
                    <div class="h-9 sm:h-10 print-seal flex items-center justify-center mb-1">
                        @if(!empty($setting->seal_path) && file_exists(public_path($setting->seal_path)))
                            <img src="{{ asset($setting->seal_path) }}" class="h-9 sm:h-10 max-w-[75px] object-contain" alt="Official Examination Seal">
                        @endif
                    </div>
                    <div class="w-full border-t border-transparent pt-1 text-center">
                        <span class="font-bold text-[#340C6F] uppercase text-[9px]">Official Examination Seal</span>
                    </div>
                </div>
                -->

                <!-- Controller / Authority Signature -->
                <div class="flex flex-col justify-end items-center">
                    <div class="h-8 sm:h-9 print-sig-line w-full flex items-center justify-center">
                        @if(!empty($setting->signature_path) && file_exists(public_path($setting->signature_path)))
                            <img src="{{ asset($setting->signature_path) }}" class="h-8 max-w-[130px] object-contain" alt="Authorized Signature">
                        @else
                            <div class="font-signature text-xl text-gray-800">Authorized Signatory</div>
                        @endif
                    </div>
                    <div class="w-full border-t border-gray-400 pt-1">
                        <span class="font-bold text-gray-700 uppercase text-[9px]">Controller of Examinations</span>
                    </div>
                </div>

            </div>

            <!-- Footer Security Bar -->
            <div class="border-t border-gray-100 pt-2 flex flex-wrap items-center justify-between text-[9px] text-gray-400">
                <span>Verification Ref: {{ strtoupper(substr(md5($registration->roll_no . $registration->id), 0, 12)) }}</span>
                <span>Date of Issue: {{ date('d F, Y') }}</span>
                <span>Youth Revolutionary (A Unit of SWS)</span>
            </div>

        </div>

    </div>

</body>
</html>

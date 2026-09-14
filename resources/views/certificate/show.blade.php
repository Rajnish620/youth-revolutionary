<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Certificate of Achievement - {{ $registration->student_name }} ({{ $registration->roll_no }})</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@600;700;800;900&family=Playfair+Display:ital,wght@0,600;0,700;0,800;1,500;1,600&family=Noto+Sans+Devanagari:wght@600;700;800;900&family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        @page {
            size: A4 landscape;
            margin: 0;
        }
        @media print {
            .no-print { display: none !important; }
            body { 
                background: white !important; 
                padding: 0 !important; 
                margin: 0 !important;
                -webkit-print-color-adjust: exact !important;
                print-color-adjust: exact !important;
            }
            .cert-outer-wrapper {
                padding: 0 !important;
                margin: 0 !important;
                min-height: 100vh !important;
                display: flex !important;
                align-items: center !important;
                justify-content: center !important;
            }
            .cert-card {
                box-shadow: none !important;
                border: none !important;
                width: 100vw !important;
                height: 100vh !important;
                max-width: none !important;
                border-radius: 0 !important;
            }
        }
        .font-cinzel { font-family: 'Cinzel', Georgia, serif; }
        .font-serif-title { font-family: 'Playfair Display', Georgia, serif; }
        .font-hindi { font-family: 'Noto Sans Devanagari', 'DejaVu Sans', Arial, sans-serif; }
    </style>
</head>
<body class="bg-slate-900 min-h-screen p-3 sm:p-6 flex flex-col items-center justify-start text-gray-900 font-sans">

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

    <!-- Action Bar -->
    <div class="max-w-5xl w-full mb-5 flex flex-wrap items-center justify-between gap-3 no-print bg-slate-800 p-3.5 sm:p-4 rounded-2xl border border-slate-700 text-white shadow-xl">
        <div class="flex items-center gap-3">
            <a href="{{ url('/results') }}" class="w-10 h-10 rounded-xl bg-slate-700 hover:bg-slate-600 flex items-center justify-center text-white transition-colors">
                <i class="fa-solid fa-arrow-left"></i>
            </a>
            <div>
                <h1 class="font-extrabold text-sm sm:text-base text-white">Certificate of Achievement</h1>
                <p class="text-xs text-gray-400">Awarded to: <span class="text-amber-400 font-bold">{{ $registration->student_name }}</span> (Roll No: {{ $registration->roll_no }})</p>
            </div>
        </div>
        <div class="flex items-center gap-2">
            <button onclick="window.print()" class="px-4 py-2 sm:px-5 sm:py-2.5 rounded-xl bg-slate-700 hover:bg-slate-600 text-white font-bold text-xs shadow-md transition-all flex items-center gap-2 cursor-pointer">
                <i class="fa-solid fa-print"></i>
                <span>Print</span>
            </button>
            <a href="{{ route('certificate.download', $registration->roll_no) }}" class="px-5 py-2.5 rounded-xl bg-[#F1400C] hover:bg-orange-600 text-white font-bold text-xs shadow-lg shadow-[#F1400C]/30 transition-all flex items-center gap-2">
                <i class="fa-solid fa-file-pdf"></i>
                <span>Download PDF</span>
            </a>
        </div>
    </div>

    <!-- Certificate Outer Container (Landscape Ratio 1.414:1) -->
    <div class="cert-outer-wrapper w-full flex justify-center items-center">
        <div class="cert-card relative w-full max-w-5xl bg-white shadow-2xl rounded-2xl overflow-hidden border border-gray-200" style="aspect-ratio: 1.414 / 1;">
            
            <!-- Exact Vector Background Frame (Navy & Gold Geometrics + Side Guilloche Waves) -->
            <img src="{{ asset('images/certificate/certificate_frame.svg') }}" class="absolute inset-0 w-full h-full object-fill pointer-events-none select-none z-0" alt="Certificate Border Frame">

            <!-- Content Area Layer -->
            <div class="relative z-10 w-full h-full flex flex-col justify-between py-6 sm:py-10 px-6 sm:px-16 text-center select-none">
                
                <!-- TOP HEADER SECTION -->
                <div class="space-y-1 sm:space-y-1.5 pt-1 sm:pt-2">
                    <!-- Circular Youth Revolutionary Logo -->
                    <div class="flex justify-center mb-1">
                        @if(!empty($setting->logo_path) && file_exists(public_path($setting->logo_path)))
                            <img src="{{ asset($setting->logo_path) }}" class="w-14 h-14 sm:w-16 sm:h-16 md:w-20 md:h-20 rounded-full object-contain shadow-sm bg-white p-0.5 border border-gray-200" alt="Logo">
                        @elseif(file_exists(public_path('logo/logo.jpeg')))
                            <img src="{{ asset('logo/logo.jpeg') }}" class="w-14 h-14 sm:w-16 sm:h-16 md:w-20 md:h-20 rounded-full object-contain shadow-sm bg-white p-0.5 border border-gray-200" alt="Logo">
                        @endif
                    </div>

                    <!-- Main Organization Title -->
                    <h1 class="font-cinzel text-xl sm:text-3xl md:text-4xl font-extrabold text-[#132448] tracking-[0.08em] uppercase leading-tight">
                        {{ $setting->header_title ?? 'YOUTH REVOLUTIONARY' }}
                    </h1>

                    <!-- City / Unit Subtitle -->
                    <h2 class="font-cinzel text-base sm:text-xl md:text-2xl font-black text-[#132448] tracking-[0.12em] uppercase leading-tight">
                        {{ $setting->header_subtitle ?? 'NASRIGANJ' }}
                    </h2>

                    <!-- Red Certificate Title -->
                    <div class="pt-1">
                        <h3 class="font-serif-title text-xl sm:text-2xl md:text-3xl font-bold text-[#c0262d] tracking-wide">
                            Certificate of Achievement in {{ $certSubject }}
                        </h3>
                    </div>
                </div>

                <!-- MIDDLE COMPETITION & AWARDEE SECTION -->
                <div class="space-y-3 sm:space-y-4 my-auto">
                    
                    <!-- Hindi Event Title with Nataraja & Trophy Icons -->
                    <div class="flex items-center justify-center gap-3 sm:gap-6 px-4">
                        <!-- Left: Golden Nataraja Emblem -->
                        <div class="shrink-0">
                            <img src="{{ asset('images/certificate/nataraja_gold.svg') }}" class="w-10 h-10 sm:w-14 sm:h-14 md:w-16 md:h-16 object-contain" alt="Nataraja Emblem">
                        </div>

                        <!-- Center: Hindi Title -->
                        <div class="font-hindi text-lg sm:text-2xl md:text-3xl font-black text-gray-900 tracking-wide">
                            प्रतिभा खोज प्रतियोगिता {{ $certSeason }}
                        </div>

                        <!-- Right: Trophy with Laurel Wreath -->
                        <div class="shrink-0">
                            <img src="{{ asset('images/certificate/trophy_laurel.svg') }}" class="w-10 h-10 sm:w-14 sm:h-14 md:w-16 md:h-16 object-contain" alt="Trophy Emblem">
                        </div>
                    </div>

                    <!-- Proudly Awarded To Lead Text -->
                    <div class="pt-1">
                        <p class="text-xs sm:text-base md:text-lg font-bold text-gray-800 tracking-normal">
                            This certificate is proudly awarded to
                        </p>
                    </div>

                    <!-- Student Name with Underline -->
                    <div class="w-4/5 max-w-xl mx-auto border-b-2 border-gray-900 pb-1 pt-1">
                        <span class="font-cinzel text-xl sm:text-3xl md:text-4xl font-extrabold uppercase text-gray-900 tracking-wider">
                            {{ $registration->student_name }}
                        </span>
                    </div>

                    <!-- Commendation Quote -->
                    <div class="max-w-2xl mx-auto px-4 pt-1">
                        <p class="font-serif-title text-[11px] sm:text-sm md:text-base text-gray-700 italic leading-relaxed">
                            “This certificate is a testament to your talent, dedication, and hard work, propelling you one step closer to achieving your goals.”
                        </p>
                    </div>

                </div>

                <!-- BOTTOM SIGNATURES & ROSETTE SECTION -->
                <div class="pt-2 pb-1 px-4 sm:px-10">
                    <div class="flex items-end justify-between max-w-3xl mx-auto">
                        
                        <!-- Left Signatory: NIKETAN SINGH / अध्यक्ष -->
                        <div class="text-center w-36 sm:w-52">
                            <div class="border-b-2 border-gray-900 pb-1 mb-1">
                                <span class="font-cinzel text-xs sm:text-base font-extrabold text-gray-900 uppercase tracking-wider block">
                                    {{ $setting->president_name ?? 'NIKETAN SINGH' }}
                                </span>
                            </div>
                            <span class="font-hindi text-xs sm:text-sm font-bold text-gray-800 block">
                                {{ $setting->president_role ?? 'अध्यक्ष' }}
                            </span>
                        </div>

                        <!-- Center: Golden Rosette Ribbon Medal Badge -->
                        <div class="shrink-0 flex justify-center -mb-2">
                            <img src="{{ asset('images/certificate/gold_rosette.svg') }}" class="w-16 h-20 sm:w-20 sm:h-24 md:w-24 md:h-28 object-contain drop-shadow-md" alt="Golden Seal">
                        </div>

                        <!-- Right Signatory: SHYAM SUNDAR KR. / सचिव -->
                        <div class="text-center w-36 sm:w-52">
                            <div class="border-b-2 border-gray-900 pb-1 mb-1">
                                <span class="font-cinzel text-xs sm:text-base font-extrabold text-gray-900 uppercase tracking-wider block">
                                    {{ $setting->secretary_name ?? 'SHYAM SUNDAR KR.' }}
                                </span>
                            </div>
                            <span class="font-hindi text-xs sm:text-sm font-bold text-gray-800 block">
                                {{ $setting->secretary_role ?? 'सचिव' }}
                            </span>
                        </div>

                    </div>
                </div>

            </div>

        </div>
    </div>

</body>
</html>

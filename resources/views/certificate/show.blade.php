<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Certificate of Achievement - {{ $registration->student_name }} ({{ $registration->roll_no }})</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@600;700;800;900&family=Great+Vibes&family=Playfair+Display:ital,wght@0,600;0,800;1,400&family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        @media print {
            .no-print { display: none !important; }
            body { background: white !important; padding: 0 !important; }
            .cert-container { box-shadow: none !important; border: 10px solid #340C6F !important; }
        }
        .font-cinzel { font-family: 'Cinzel', serif; }
        .font-signature { font-family: 'Great Vibes', cursive; }
        .font-serif-heading { font-family: 'Playfair Display', serif; }
        .bg-parchment {
            background: linear-gradient(135deg, #ffffff 0%, #fffdf7 50%, #fefcf0 100%);
        }
    </style>
</head>
<body class="bg-slate-900 min-h-screen p-4 sm:p-8 flex flex-col items-center justify-start text-gray-900 font-sans">

    <!-- Action Bar -->
    <div class="max-w-4xl w-full mb-6 flex flex-wrap items-center justify-between gap-3 no-print bg-slate-800 p-4 rounded-2xl border border-slate-700 text-white shadow-xl">
        <div class="flex items-center gap-3">
            <a href="{{ url('/results') }}" class="w-10 h-10 rounded-xl bg-slate-700 hover:bg-slate-600 flex items-center justify-center text-white transition-colors">
                <i class="fa-solid fa-arrow-left"></i>
            </a>
            <div>
                <h1 class="font-extrabold text-sm sm:text-base text-white">Digital Certificate of Achievement</h1>
                <p class="text-xs text-gray-400">Awarded to: <span class="text-amber-400 font-bold">{{ $registration->student_name }}</span> ({{ $registration->roll_no }})</p>
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

    <!-- Official Certificate Frame (Distinct Royal Design) -->
    <div class="cert-container max-w-4xl w-full bg-parchment p-6 sm:p-12 rounded-3xl border-[12px] border-[#340C6F] relative overflow-hidden shadow-2xl">
        
        <!-- Corner Ornaments -->
        <div class="absolute top-3 left-3 w-16 h-16 border-t-4 border-l-4 border-amber-500 pointer-events-none rounded-tl-lg"></div>
        <div class="absolute top-3 right-3 w-16 h-16 border-t-4 border-r-4 border-amber-500 pointer-events-none rounded-tr-lg"></div>
        <div class="absolute bottom-3 left-3 w-16 h-16 border-b-4 border-l-4 border-amber-500 pointer-events-none rounded-bl-lg"></div>
        <div class="absolute bottom-3 right-3 w-16 h-16 border-b-4 border-r-4 border-amber-500 pointer-events-none rounded-br-lg"></div>

        <!-- Inner Gold Filigree Border -->
        <div class="border-2 border-amber-600/70 p-6 sm:p-10 rounded-2xl relative z-10 text-center space-y-6 bg-white/60 backdrop-blur-sm">

            <!-- Official Admit Card Header Banner -->
            <div class="border-b border-amber-200 pb-4">
                @if(!empty($setting->header_banner_path) && file_exists(public_path($setting->header_banner_path)))
                    <img src="{{ asset($setting->header_banner_path) }}" class="w-full h-auto max-h-[115px] object-contain mx-auto" alt="Header Banner">
                @elseif(file_exists(public_path('images/header_banner.jpg')))
                    <img src="{{ asset('images/header_banner.jpg') }}" class="w-full h-auto max-h-[115px] object-contain mx-auto" alt="Header Banner">
                @else
                    <div class="space-y-1">
                        <div class="inline-flex items-center gap-2 text-xs font-black uppercase tracking-widest text-[#F1400C]">
                            <i class="fa-solid fa-crown text-amber-600 text-sm"></i> YOUTH REVOLUTIONARY NASRIGANJ
                        </div>
                        <h2 class="font-cinzel text-2xl sm:text-3xl font-black text-[#340C6F] tracking-wide">
                            {{ $setting->header_title ?? 'YOUTH REVOLUTIONARY' }}
                        </h2>
                        <p class="text-xs text-gray-500 font-semibold uppercase tracking-widest">{{ $setting->header_subtitle ?? 'A Unit of SWS (Talent Search Council)' }}</p>
                    </div>
                @endif
            </div>

            <!-- Title & Presentation Header -->
            <div class="space-y-2 pt-2">
                <div class="inline-flex items-center gap-3">
                    <span class="w-12 h-0.5 bg-amber-500"></span>
                    <span class="text-xs uppercase font-extrabold tracking-[0.25em] text-amber-700">Official Honor & Recognition</span>
                    <span class="w-12 h-0.5 bg-amber-500"></span>
                </div>
                <h2 class="font-cinzel text-3xl sm:text-5xl font-black text-[#340C6F] tracking-wide drop-shadow-sm">
                    CERTIFICATE OF MERIT
                </h2>
                <p class="text-xs text-gray-500 font-bold uppercase tracking-widest">THIS IS PROUDLY PRESENTED TO</p>
            </div>

            <!-- Recipient Candidate Name -->
            <div class="py-2 border-b-2 border-amber-500/50 max-w-xl mx-auto">
                <h3 class="font-signature text-5xl sm:text-7xl text-[#F1400C] leading-tight select-none">
                    {{ $registration->student_name }}
                </h3>
            </div>

            <!-- Commendation Text -->
            <div class="max-w-2xl mx-auto text-sm sm:text-base text-gray-700 leading-relaxed font-medium">
                <p>
                    In recognition of outstanding dedication, knowledge, and exemplary achievement in 
                    <span class="font-bold text-[#340C6F]">{{ $registration->event->title ?? 'the Youth Competition' }}</span>
                    organized under <span class="font-bold text-gray-900">{{ $registration->group->group_name ?? 'General Category' }}</span>.
                </p>

                <!-- Performance Highlight Badges -->
                <div class="flex flex-wrap items-center justify-center gap-3 pt-3">
                    @if($registration->rank)
                        <div class="inline-flex items-center gap-1.5 bg-gradient-to-r from-amber-500 to-amber-600 text-white px-4 py-1.5 rounded-full text-xs font-black shadow-md">
                            <i class="fa-solid fa-trophy"></i>
                            <span>Rank: {{ $registration->rank }}</span>
                        </div>
                    @endif
                    @if($registration->marks !== null)
                        <div class="inline-flex items-center gap-1.5 bg-gradient-to-r from-[#340C6F] to-purple-900 text-white px-4 py-1.5 rounded-full text-xs font-black shadow-md">
                            <i class="fa-solid fa-star"></i>
                            <span>Score: {{ $registration->marks }} Marks</span>
                        </div>
                    @endif
                    @if($registration->qualification_status === 'Qualified')
                        <div class="inline-flex items-center gap-1.5 bg-emerald-600 text-white px-4 py-1.5 rounded-full text-xs font-black shadow-md">
                            <i class="fa-solid fa-circle-check"></i>
                            <span>Status: Qualified</span>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Credential Grid -->
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 max-w-2xl mx-auto pt-2 text-xs font-semibold text-gray-700">
                <div class="bg-white/90 p-2.5 rounded-xl border border-amber-200 shadow-sm">
                    <span class="block text-[10px] text-gray-400 uppercase">Roll Number</span>
                    <span class="font-mono font-extrabold text-[#340C6F]">{{ $registration->roll_no }}</span>
                </div>
                <div class="bg-white/90 p-2.5 rounded-xl border border-amber-200 shadow-sm">
                    <span class="block text-[10px] text-gray-400 uppercase">Registration No</span>
                    <span class="font-mono font-extrabold text-gray-800">{{ $registration->registration_no ?? 'N/A' }}</span>
                </div>
                <div class="bg-white/90 p-2.5 rounded-xl border border-amber-200 shadow-sm">
                    <span class="block text-[10px] text-gray-400 uppercase">Class / Group</span>
                    <span class="font-extrabold text-gray-800">{{ $registration->student_class }}</span>
                </div>
                <div class="bg-white/90 p-2.5 rounded-xl border border-amber-200 shadow-sm">
                    <span class="block text-[10px] text-gray-400 uppercase">Issue Date</span>
                    <span class="font-extrabold text-gray-800">{{ date('d M, Y') }}</span>
                </div>
            </div>

            <!-- Signatures Section -->
            <div class="pt-8 flex items-end justify-between max-w-2xl mx-auto">
                
                <!-- President -->
                <div class="text-center space-y-1 w-44">
                    <div class="font-signature text-2xl text-gray-800">Rajnish Kumar</div>
                    <div class="border-t border-gray-400 pt-1 text-[11px] font-bold text-gray-700 uppercase">
                        President & Patron
                    </div>
                </div>

                <!-- Central Gold Medal Seal -->
                <div class="relative flex flex-col items-center">
                    <div class="w-20 h-20 rounded-full bg-gradient-to-br from-yellow-300 via-amber-500 to-amber-700 text-white flex items-center justify-center shadow-xl border-4 border-white transform hover:scale-105 transition-transform">
                        <div class="text-center">
                            <i class="fa-solid fa-ribbon text-2xl text-yellow-100"></i>
                            <span class="block text-[8px] font-black uppercase tracking-widest text-white">SEAL</span>
                        </div>
                    </div>
                    <span class="text-[9px] font-bold text-amber-800 uppercase tracking-widest mt-1">Certified Excellence</span>
                </div>

                <!-- Controller of Examination Signature (from AdmitCardSetting) -->
                <div class="text-center space-y-1 w-44">
                    <div class="h-10 flex items-center justify-center">
                        @if(!empty($setting->signature_path) && file_exists(public_path($setting->signature_path)))
                            <img src="{{ asset($setting->signature_path) }}" class="h-9 max-w-[130px] object-contain" alt="Authorized Signature">
                        @else
                            <div class="font-signature text-2xl text-gray-800">Controller of Exam</div>
                        @endif
                    </div>
                    <div class="border-t border-gray-400 pt-1 text-[11px] font-bold text-gray-700 uppercase">
                        Controller of Exam
                    </div>
                </div>

            </div>

        </div>

    </div>

</body>
</html>

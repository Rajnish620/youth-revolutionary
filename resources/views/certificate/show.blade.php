<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Official Certificate - {{ $registration->student_name }} ({{ $registration->roll_no }})</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@700;900&family=Great+Vibes&family=Inter:wght@400;600;800&display=swap" rel="stylesheet">
    <style>
        @media print {
            .no-print { display: none !important; }
            body { background: white !important; padding: 0 !important; }
            .cert-box { box-shadow: none !important; border: 8px solid #340C6F !important; }
        }
        .font-cinzel { font-family: 'Cinzel', serif; }
        .font-signature { font-family: 'Great Vibes', cursive; }
    </style>
</head>
<body class="bg-slate-900 min-h-screen p-4 sm:p-8 flex flex-col items-center justify-center text-gray-900">

    <!-- Print Control Bar -->
    <div class="max-w-4xl w-full mb-6 flex items-center justify-between no-print bg-slate-800 p-4 rounded-2xl border border-slate-700 text-white shadow-xl">
        <div class="flex items-center gap-3">
            <a href="{{ url('/') }}" class="w-10 h-10 rounded-xl bg-slate-700 hover:bg-slate-600 flex items-center justify-center text-white">
                <i class="fa-solid fa-arrow-left"></i>
            </a>
            <div>
                <h1 class="font-extrabold text-base">Digital Certificate & Marksheet</h1>
                <p class="text-xs text-gray-400">Roll No: <span class="font-mono text-amber-400 font-bold">{{ $registration->roll_no }}</span></p>
            </div>
        </div>
        <button onclick="window.print()" class="px-6 py-2.5 rounded-xl bg-[#F1400C] hover:bg-orange-600 text-white font-bold text-sm shadow-lg shadow-[#F1400C]/30 transition-all flex items-center gap-2">
            <i class="fa-solid fa-print"></i>
            <span>Print Certificate</span>
        </button>
    </div>

    <!-- Official Certificate Frame -->
    <div class="cert-box max-w-4xl w-full bg-amber-50/40 p-8 sm:p-14 rounded-3xl border-[12px] border-[#340C6F] relative overflow-hidden shadow-2xl bg-[radial-gradient(#e2e8f0_1px,transparent_1px)] [background-size:16px_16px]">
        
        <!-- Inner Gold Border -->
        <div class="border-2 border-amber-600/60 p-8 rounded-xl relative z-10 text-center space-y-6">

            <!-- Organization Header -->
            <div class="space-y-2">
                <div class="inline-flex items-center gap-2 text-xs font-black uppercase tracking-widest text-[#F1400C]">
                    <i class="fa-solid fa-award text-amber-600 text-base"></i> YOUTH REVOLUTIONARY NASRIGANJ
                </div>
                <h2 class="font-cinzel text-3xl sm:text-5xl font-black text-[#340C6F] tracking-wide">
                    CERTIFICATE OF ACHIEVEMENT
                </h2>
                <p class="text-xs text-gray-500 font-semibold uppercase tracking-widest">PROUDLY PRESENTED TO</p>
            </div>

            <!-- Student Name -->
            <div class="py-2 border-b-2 border-amber-600/40 max-w-xl mx-auto">
                <h3 class="font-signature text-5xl sm:text-6xl text-[#F1400C] leading-none">{{ $registration->student_name }}</h3>
            </div>

            <!-- Description & Performance -->
            <div class="max-w-2xl mx-auto text-sm sm:text-base text-gray-700 leading-relaxed space-y-2 font-medium">
                <p>
                    For outstanding participation and exemplary performance in the 
                    <span class="font-bold text-[#340C6F]">{{ $registration->event->title ?? 'Youth Revolutionary Event' }}</span> 
                    in <span class="font-bold text-gray-900">{{ $registration->group->group_name ?? 'General Category' }}</span>.
                </p>

                @if($registration->rank || $registration->marks)
                    <div class="inline-flex items-center gap-4 bg-white px-6 py-2 rounded-2xl border border-amber-200 shadow-sm mt-3">
                        @if($registration->rank)
                            <div class="text-xs font-bold text-amber-700">Rank/Position: <span class="text-[#F1400C] font-extrabold text-sm">{{ $registration->rank }}</span></div>
                        @endif
                        @if($registration->marks)
                            <div class="text-xs font-bold text-purple-900">Score: <span class="text-[#340C6F] font-extrabold text-sm">{{ $registration->marks }} Marks</span></div>
                        @endif
                    </div>
                @endif
            </div>

            <!-- Details Table / Grid -->
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 max-w-2xl mx-auto pt-2 text-xs font-semibold text-gray-600">
                <div class="bg-white p-2 rounded-xl border border-slate-200">
                    <span class="block text-[10px] text-gray-400 uppercase">Roll Number</span>
                    <span class="font-mono font-extrabold text-gray-900">{{ $registration->roll_no }}</span>
                </div>
                <div class="bg-white p-2 rounded-xl border border-slate-200">
                    <span class="block text-[10px] text-gray-400 uppercase">Class</span>
                    <span class="font-extrabold text-gray-900">{{ $registration->student_class }}</span>
                </div>
                <div class="bg-white p-2 rounded-xl border border-slate-200">
                    <span class="block text-[10px] text-gray-400 uppercase">School</span>
                    <span class="font-extrabold text-gray-900 truncate block">{{ $registration->school_name ?? 'N/A' }}</span>
                </div>
                <div class="bg-white p-2 rounded-xl border border-slate-200">
                    <span class="block text-[10px] text-gray-400 uppercase">Date</span>
                    <span class="font-extrabold text-gray-900">{{ $registration->event->event_date ? $registration->event->event_date->format('M d, Y') : date('M d, Y') }}</span>
                </div>
            </div>

            <!-- Signatures Footer -->
            <div class="pt-8 flex items-end justify-between max-w-2xl mx-auto">
                <div class="text-center space-y-1">
                    <div class="font-signature text-2xl text-gray-800">Rajnish Kumar</div>
                    <div class="border-t border-gray-400 pt-1 text-[11px] font-bold text-gray-600 uppercase">President</div>
                </div>

                <!-- Gold Seal -->
                <div class="w-16 h-16 rounded-full bg-gradient-to-br from-amber-400 to-amber-600 text-white flex items-center justify-center shadow-lg border-2 border-white">
                    <i class="fa-solid fa-ribbon text-2xl"></i>
                </div>

                <div class="text-center space-y-1">
                    <div class="font-signature text-2xl text-gray-800">Event Coordinator</div>
                    <div class="border-t border-gray-400 pt-1 text-[11px] font-bold text-gray-600 uppercase">Youth Representative</div>
                </div>
            </div>

        </div>
    </div>

</body>
</html>

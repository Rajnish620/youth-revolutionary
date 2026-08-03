<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Printable Competition Desk Slips - Youth Revolutionary</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <style>
        @media print {
            .no-print { display: none !important; }
            body { background: white !important; }
            .desk-slip { page-break-inside: avoid; }
        }
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-gray-100 p-6 text-gray-900">

    <!-- Print Control Bar -->
    <div class="max-w-6xl mx-auto mb-6 flex items-center justify-between no-print bg-white p-4 rounded-2xl shadow border border-gray-200">
        <div>
            <h1 class="font-extrabold text-lg text-gray-900">Exam Bench / Desk Number Slips</h1>
            <p class="text-xs text-gray-500">Printable desk chips to cut out and tape on competition desks on event day.</p>
        </div>
        <button onclick="window.print()" class="px-6 py-2.5 rounded-xl bg-[#F1400C] hover:bg-orange-600 text-white font-bold text-sm shadow-md transition-all flex items-center gap-2">
            <i class="fa-solid fa-print"></i>
            <span>Print Desk Slips</span>
        </button>
    </div>

    <!-- Desk Slips Grid -->
    <div class="max-w-6xl mx-auto grid grid-cols-2 md:grid-cols-3 gap-4">
        @forelse($registrations as $index => $reg)
            <div class="desk-slip bg-white p-4 rounded-xl border-2 border-dashed border-gray-400 shadow-sm relative flex flex-col justify-between h-48">
                
                <!-- Header -->
                <div class="flex items-center justify-between border-b border-gray-200 pb-2">
                    <span class="text-[10px] font-black tracking-wider uppercase text-[#340C6F]">YOUTH REVOLUTIONARY</span>
                    <span class="text-[10px] font-bold text-[#F1400C] px-2 py-0.5 rounded bg-orange-50 border border-orange-200">SEAT #{{ $index + 1 }}</span>
                </div>

                <!-- Main Content -->
                <div class="my-2 space-y-1">
                    <div class="text-[11px] font-bold text-gray-400 uppercase tracking-widest">ROLL NUMBER</div>
                    <div class="text-2xl font-black text-[#340C6F] font-mono tracking-wider">{{ $reg->roll_no }}</div>
                    
                    <div class="font-extrabold text-sm text-gray-900 truncate mt-1">{{ $reg->student_name }}</div>
                    <div class="text-xs font-semibold text-gray-600 flex items-center justify-between">
                        <span>{{ $reg->student_class }}</span>
                        <span class="text-[#F1400C] font-bold text-[11px]">{{ $reg->group->group_name ?? 'General' }}</span>
                    </div>
                </div>

                <!-- Footer -->
                <div class="border-t border-gray-200 pt-2 flex items-center justify-between text-[10px] text-gray-500 font-medium">
                    <span class="truncate max-w-[140px]">{{ $reg->event->title ?? 'Competition' }}</span>
                    <span class="font-bold text-gray-700">{{ $reg->school_name ?? 'School' }}</span>
                </div>
            </div>
        @empty
            <div class="col-span-full bg-white p-12 rounded-2xl text-center text-gray-400 font-semibold">
                No approved student registrations to generate desk slips.
            </div>
        @endforelse
    </div>

</body>
</html>

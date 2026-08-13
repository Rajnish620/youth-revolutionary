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
            @page { margin: 10mm; size: A4 portrait; }
            .no-print { display: none !important; }
            body { background: white !important; padding: 0 !important; margin: 0 !important; }
            .desk-slip { page-break-inside: avoid; border-color: #9ca3af !important; }
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
    <div class="w-[210mm] mx-auto grid grid-cols-4 gap-1 no-print-margin" style="page-break-inside: auto;">
        @forelse($registrations as $index => $reg)
            <div class="desk-slip bg-white p-1.5 border border-dashed border-gray-400 flex flex-col items-center justify-center text-center h-[52mm] overflow-hidden m-0.5">
                <span class="text-[8px] font-black tracking-widest uppercase text-[#340C6F] mb-1">YOUTH REVOLUTIONARY</span>
                
                <img src="{{ str_starts_with($reg->photo, 'http') ? $reg->photo : asset($reg->photo ?? 'images/quize.jpg') }}" 
                     class="w-20 h-20 object-fill border border-gray-300 rounded mb-1.5 shadow-sm">
                     
                <div class="text-[14px] font-black text-[#F1400C] font-mono leading-none mb-1 tracking-wide">{{ $reg->roll_no }}</div>
                
                <div class="text-[11px] font-extrabold text-gray-900 leading-tight w-full truncate mb-0.5">{{ $reg->student_name }}</div>
                <div class="text-[9px] font-bold text-gray-600 w-full truncate">{{ $reg->group->group_name ?? 'General' }}</div>
            </div>
        @empty
            <div class="col-span-full bg-white p-12 rounded-2xl text-center text-gray-400 font-semibold">
                No approved student registrations to generate desk slips.
            </div>
        @endforelse
    </div>

</body>
</html>

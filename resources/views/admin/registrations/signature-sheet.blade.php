<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Day Attendance & Signature Sheet - Youth Revolutionary</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <style>
        @media print {
            .no-print { display: none !important; }
            body { background: white !important; color: black !important; }
            table { page-break-inside: auto; }
            tr { page-break-inside: avoid; page-break-after: auto; }
        }
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-gray-100 p-6 text-gray-900">

    <!-- Top Non-Printable Header Controls -->
    <div class="max-w-5xl mx-auto mb-6 flex items-center justify-between no-print bg-white p-4 rounded-2xl shadow border border-gray-200">
        <div>
            <h1 class="font-extrabold text-lg text-gray-900">Event Day Attendance & Signature Sheet</h1>
            <p class="text-xs text-gray-500">Ready for A4 Printing. Click print below to generate physical attendance sheets for exam day.</p>
        </div>
        <button onclick="window.print()" class="px-6 py-2.5 rounded-xl bg-[#340C6F] hover:bg-purple-900 text-white font-bold text-sm shadow-md transition-all flex items-center gap-2">
            <i class="fa-solid fa-print"></i>
            <span>Print Sheet Now</span>
        </button>
    </div>

    <!-- Printable Attendance Sheet Page -->
    <div class="max-w-5xl mx-auto bg-white p-8 rounded-2xl shadow-lg border border-gray-200">
        
        <!-- Document Header -->
        <div class="border-b-2 border-gray-900 pb-4 mb-6 text-center">
            <h2 class="text-2xl font-black uppercase tracking-wider text-gray-900">YOUTH REVOLUTIONARY ORGANISATION</h2>
            <h3 class="text-lg font-bold text-[#F1400C] uppercase mt-1">{{ $event ? $event->title : 'Event Attendance & Verification Sheet' }}</h3>
            <p class="text-xs text-gray-600 font-semibold mt-1">
                Date: {{ $event && $event->event_date ? $event->event_date->format('d F Y') : date('d F Y') }} | Location: {{ $event->location ?? 'Patna Nashariganj' }}
            </p>
        </div>

        <!-- Student Attendance Table -->
        <table class="w-full text-left border-collapse border border-gray-300">
            <thead>
                <tr class="bg-gray-200 text-[11px] font-extrabold text-gray-900 uppercase tracking-wider border-b border-gray-400">
                    <th class="py-3 px-3 border border-gray-300 text-center w-12">Sl No</th>
                    <th class="py-3 px-3 border border-gray-300 text-center w-16">Photo</th>
                    <th class="py-3 px-3 border border-gray-300 w-32">Roll No</th>
                    <th class="py-3 px-3 border border-gray-300">Student Name</th>
                    <th class="py-3 px-3 border border-gray-300 w-36">Group / Class</th>
                    <th class="py-3 px-3 border border-gray-300">School / Institution</th>
                    <th class="py-3 px-3 border border-gray-300 text-center w-40">Student Signature</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-300 text-xs">
                @forelse($registrations as $index => $reg)
                    <tr class="hover:bg-gray-50">
                        <td class="py-2.5 px-3 border border-gray-300 text-center font-bold">{{ $index + 1 }}</td>
                        <td class="py-2.5 px-3 border border-gray-300 text-center">
                            <img src="{{ str_starts_with($reg->photo, 'http') ? $reg->photo : asset($reg->photo ?? 'images/quize.jpg') }}" 
                                 class="w-10 h-10 object-cover rounded mx-auto border border-gray-400">
                        </td>
                        <td class="py-2.5 px-3 border border-gray-300 font-mono font-extrabold text-sm text-[#340C6F]">
                            {{ $reg->roll_no }}
                        </td>
                        <td class="py-2.5 px-3 border border-gray-300 font-bold text-gray-900">
                            <div>{{ $reg->student_name }}</div>
                            <div class="text-[10px] text-gray-500 font-normal">S/O: {{ $reg->father_name ?? 'N/A' }}</div>
                        </td>
                        <td class="py-2.5 px-3 border border-gray-300 font-semibold text-gray-800">
                            <div>{{ $reg->student_class }}</div>
                            <div class="text-[10px] text-[#F1400C]">{{ $reg->group->group_name ?? 'General' }}</div>
                        </td>
                        <td class="py-2.5 px-3 border border-gray-300 text-gray-700 font-medium">
                            {{ $reg->school_name ?? 'N/A' }}
                        </td>
                        <td class="py-2.5 px-3 border border-gray-300 text-center bg-gray-50/50">
                            <!-- Blank box for physical signature on event day -->
                            <div class="h-9 w-full border border-dashed border-gray-400 rounded bg-white"></div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="py-8 text-center text-gray-500 font-semibold">
                            No approved student registrations found for this event sheet.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <!-- Document Footer -->
        <div class="mt-12 flex items-center justify-between text-xs font-bold text-gray-700 pt-6 border-t border-gray-300">
            <div>
                <p>Invigilator Signature: _______________________</p>
                <p class="text-[10px] text-gray-400 font-normal mt-1">Verified on Event Day</p>
            </div>
            <div>
                <p>Event Coordinator Signature: _______________________</p>
                <p class="text-[10px] text-gray-400 font-normal mt-1">Youth Revolutionary Secretariat</p>
            </div>
        </div>

    </div>

</body>
</html>

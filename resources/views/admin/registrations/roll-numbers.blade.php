<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Roll Numbers - {{ $event->title ?? 'All Events' }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @media print {
            .no-print { display: none !important; }
            body { background: white; margin: 0; padding: 20px; }
            @page { margin: 15mm; }
        }
    </style>
</head>
<body class="bg-gray-100 text-gray-900 font-sans p-8">
    <div class="max-w-4xl mx-auto bg-white p-10 shadow-lg print:shadow-none print:p-0">
        <div class="flex justify-between items-center mb-8 border-b pb-4">
            <div>
                <h1 class="text-2xl font-bold uppercase tracking-wide">Roll Numbers List</h1>
                <p class="text-gray-600 mt-1 font-semibold">Event: {{ $event->title ?? 'All Events' }}</p>
                <p class="text-gray-600 font-semibold">Group: {{ $group->group_name ?? 'All Groups' }}</p>
            </div>
            <button onclick="window.print()" class="no-print bg-blue-600 text-white px-5 py-2 rounded-lg font-bold hover:bg-blue-700 transition">
                Print Now
            </button>
        </div>

        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-6 text-center print:grid-cols-3">
            @forelse($registrations as $reg)
                <div class="border-2 border-black py-4 px-2 font-mono font-extrabold text-xl text-black bg-white rounded-xl print:shadow-none print:break-inside-avoid">
                    {{ $reg->roll_no }}
                </div>
            @empty
                <div class="col-span-full py-10 text-gray-500 italic text-lg">No approved registrations found for this selection.</div>
            @endforelse
        </div>
    </div>
    
    <script>
        window.onload = function() {
            setTimeout(() => {
                window.print();
            }, 500);
        }
    </script>
</body>
</html>

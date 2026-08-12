<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Finance Report - Youth Revolutionary</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @media print {
            .no-print { display: none !important; }
            body { background: white; margin: 0; padding: 20px; font-size: 12pt; }
            @page { margin: 15mm; }
            table { page-break-inside: auto; }
            tr { page-break-inside: avoid; page-break-after: auto; }
        }
    </style>
</head>
<body class="bg-gray-100 text-gray-900 font-sans p-8">
    <div class="max-w-4xl mx-auto bg-white p-10 shadow-lg print:shadow-none print:p-0">
        
        <div class="flex justify-between items-start mb-8 border-b pb-6 border-gray-300">
            <div>
                <h1 class="text-3xl font-extrabold uppercase tracking-wide text-gray-900">Finance Report</h1>
                <p class="text-gray-600 mt-2 font-semibold">
                    Report Type: <span class="capitalize text-gray-900">{{ $type }}</span>
                </p>
                @if($startDate || $endDate)
                    <p class="text-gray-600 font-semibold text-sm mt-1">
                        Date Range: 
                        <span class="text-gray-900">{{ $startDate ? \Carbon\Carbon::parse($startDate)->format('d M Y') : 'Start' }}</span> 
                        to 
                        <span class="text-gray-900">{{ $endDate ? \Carbon\Carbon::parse($endDate)->format('d M Y') : 'Present' }}</span>
                    </p>
                @endif
            </div>
            <button onclick="window.print()" class="no-print bg-[#340C6F] text-white px-5 py-2.5 rounded-lg font-bold hover:bg-purple-800 transition flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M5 4v3H4a2 2 0 00-2 2v3a2 2 0 002 2h1v2a2 2 0 002 2h6a2 2 0 002-2v-2h1a2 2 0 002-2V9a2 2 0 00-2-2h-1V4a2 2 0 00-2-2H7a2 2 0 00-2 2zm8 0H7v3h6V4zm0 8H7v4h6v-4z" clip-rule="evenodd" />
                </svg>
                Print Report
            </button>
        </div>

        @if($type === 'contributions' || $type === 'both')
            <div class="mb-10">
                <h2 class="text-xl font-bold text-gray-800 mb-4 border-b-2 border-gray-200 inline-block pb-1">Contributions / Income</h2>
                
                @if($contributions->isEmpty())
                    <p class="text-gray-500 italic">No contributions found for this period.</p>
                @else
                    <table class="w-full text-left border-collapse border border-gray-300">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="py-2 px-4 border border-gray-300 font-semibold text-sm w-24">Date</th>
                                <th class="py-2 px-4 border border-gray-300 font-semibold text-sm">Contributor Name</th>
                                <th class="py-2 px-4 border border-gray-300 font-semibold text-sm">Description</th>
                                <th class="py-2 px-4 border border-gray-300 font-semibold text-sm text-right w-32">Amount (₹)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $totalContrib = 0; @endphp
                            @foreach($contributions as $c)
                                @php $totalContrib += $c->amount; @endphp
                                <tr>
                                    <td class="py-2 px-4 border border-gray-300 text-sm whitespace-nowrap">{{ \Carbon\Carbon::parse($c->date)->format('d M Y') }}</td>
                                    <td class="py-2 px-4 border border-gray-300 text-sm font-semibold">{{ $c->name }}</td>
                                    <td class="py-2 px-4 border border-gray-300 text-sm text-gray-600">{{ $c->description ?: '-' }}</td>
                                    <td class="py-2 px-4 border border-gray-300 text-sm font-bold text-right text-green-700">{{ number_format($c->amount, 2) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr class="bg-gray-50">
                                <td colspan="3" class="py-2 px-4 border border-gray-300 text-right font-bold text-gray-800">Total Contributions:</td>
                                <td class="py-2 px-4 border border-gray-300 font-bold text-right text-green-700 text-base">₹{{ number_format($totalContrib, 2) }}</td>
                            </tr>
                        </tfoot>
                    </table>
                @endif
            </div>
        @endif

        @if($type === 'expenses' || $type === 'both')
            <div class="mb-10">
                <h2 class="text-xl font-bold text-gray-800 mb-4 border-b-2 border-gray-200 inline-block pb-1">Expenses</h2>
                
                @if($expenses->isEmpty())
                    <p class="text-gray-500 italic">No expenses found for this period.</p>
                @else
                    <table class="w-full text-left border-collapse border border-gray-300">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="py-2 px-4 border border-gray-300 font-semibold text-sm w-24">Date</th>
                                <th class="py-2 px-4 border border-gray-300 font-semibold text-sm">Expense Item</th>
                                <th class="py-2 px-4 border border-gray-300 font-semibold text-sm">Description</th>
                                <th class="py-2 px-4 border border-gray-300 font-semibold text-sm text-right w-32">Amount (₹)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $totalExp = 0; @endphp
                            @foreach($expenses as $e)
                                @php $totalExp += $e->amount; @endphp
                                <tr>
                                    <td class="py-2 px-4 border border-gray-300 text-sm whitespace-nowrap">{{ \Carbon\Carbon::parse($e->date)->format('d M Y') }}</td>
                                    <td class="py-2 px-4 border border-gray-300 text-sm font-semibold">{{ $e->item_name }}</td>
                                    <td class="py-2 px-4 border border-gray-300 text-sm text-gray-600">{{ $e->description ?: '-' }}</td>
                                    <td class="py-2 px-4 border border-gray-300 text-sm font-bold text-right text-red-600">{{ number_format($e->amount, 2) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr class="bg-gray-50">
                                <td colspan="3" class="py-2 px-4 border border-gray-300 text-right font-bold text-gray-800">Total Expenses:</td>
                                <td class="py-2 px-4 border border-gray-300 font-bold text-right text-red-600 text-base">₹{{ number_format($totalExp, 2) }}</td>
                            </tr>
                        </tfoot>
                    </table>
                @endif
            </div>
        @endif

        @if($type === 'both')
            <div class="mt-8 border-2 border-gray-800 rounded-lg p-6 bg-gray-50 break-inside-avoid">
                <h3 class="text-lg font-bold text-gray-900 mb-3 uppercase tracking-wider">Summary</h3>
                <div class="flex justify-between items-center mb-2">
                    <span class="text-gray-700 font-semibold">Total Contributions</span>
                    <span class="text-green-700 font-bold">₹{{ number_format($totalContrib ?? 0, 2) }}</span>
                </div>
                <div class="flex justify-between items-center mb-4">
                    <span class="text-gray-700 font-semibold">Total Expenses</span>
                    <span class="text-red-600 font-bold">₹{{ number_format($totalExp ?? 0, 2) }}</span>
                </div>
                <div class="flex justify-between items-center border-t border-gray-300 pt-3">
                    <span class="text-gray-900 font-extrabold text-lg">Net Balance</span>
                    <span class="font-extrabold text-xl {{ ($totalContrib ?? 0) - ($totalExp ?? 0) >= 0 ? 'text-blue-700' : 'text-red-700' }}">
                        ₹{{ number_format(($totalContrib ?? 0) - ($totalExp ?? 0), 2) }}
                    </span>
                </div>
            </div>
        @endif
        
        <div class="mt-12 text-sm text-gray-400 text-center no-print">
            Report generated automatically from Admin Panel.
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

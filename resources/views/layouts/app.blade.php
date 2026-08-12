<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="overflow-x-hidden">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Youth Revolutionary</title>
    @php
        $favicon = \App\Models\HomeSetting::first()->favicon ?? null;
    @endphp
    @if($favicon)
        <link rel="icon" href="{{ asset($favicon) }}">
    @endif
    <!-- FontAwesome for social icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased bg-gray-50 text-gray-900 overflow-x-hidden max-w-full">
    <x-navbar />

    <main class="min-h-screen">
        {{ $slot }}
    </main>

    <x-footer />
</body>
</html>

@php
$events = [
    [
        'title' => 'Quiz Competition',
        'date' => '14 September 2025',
        'location' => 'Patna Nashariganj',
        'image' => 'images/quize.jpg',
    ],
    [
        'title' => 'Inter School run racing Tournament',
        'date' => '20 September 2025',
        'location' => 'Patna Nashariganj',
        'image' => 'images/FB_IMG_1780913014941.jpg.jpeg',
    ],
    [
        'title' => 'Dance Championship',
        'date' => '5 October 2025',
        'location' => 'Patna Nashariganj',
        'image' => 'images/danses.jpeg',
    ],
];
@endphp

<section class="py-24 bg-gray-50">
    <div class="max-w-7xl mx-auto px-6">
        <!-- Event Cards -->
        <div class="grid md:grid-cols-3 gap-8">
            @foreach($events as $index => $event)
                <div x-data="{ show: false }" x-intersect.once="show = true"
                     x-show="show"
                     x-transition:enter="transition ease-out duration-700 delay-[{{ $index * 150 }}ms]"
                     x-transition:enter-start="opacity-0 translate-y-24"
                     x-transition:enter-end="opacity-100 translate-y-0"
                     class="bg-white rounded-3xl overflow-hidden shadow-lg hover:shadow-xl transition duration-300 group hover:-translate-y-2">
                    
                    <!-- Image -->
                    <div class="overflow-hidden">
                        <img src="{{ asset($event['image']) }}" alt="{{ $event['title'] }}" class="w-full h-64 object-cover group-hover:scale-110 transition delay-200 duration-700" />
                    </div>

                    <!-- Content -->
                    <div class="p-6">
                        <h3 class="text-2xl font-bold mb-4">{{ $event['title'] }}</h3>
                        
                        <div class="flex items-center gap-2 text-gray-600 mb-3">
                            <i class="fa-regular fa-calendar text-lg w-5"></i>
                            {{ $event['date'] }}
                        </div>

                        <div class="flex items-center gap-2 text-gray-600 mb-5">
                            <i class="fa-solid fa-location-dot text-lg w-5"></i>
                            {{ $event['location'] }}
                        </div>

                        <a href="{{ url('/educationlearn') }}" class="inline-block mt-5 px-5 py-2 bg-[#028CD4] text-white rounded-lg hover:bg-blue-700">
                            View Details
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

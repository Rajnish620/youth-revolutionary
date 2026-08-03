@php
if (!isset($events) || count($events) === 0) {
    $dbEvents = \App\Models\Event::latest()->get();
} else {
    $dbEvents = $events;
}
@endphp

<section class="py-6 bg-transparent">
    <div class="max-w-7xl mx-auto px-6">
        <!-- Event Cards -->
        <div class="grid md:grid-cols-3 gap-8">
            @forelse($dbEvents as $index => $event)
                @php
                $title = is_array($event) ? $event['title'] : $event->title;
                $img = is_array($event) ? $event['image'] : ($event->image ?? 'images/quize.jpg');
                $dateStr = is_array($event) ? $event['date'] : ($event->event_date ? $event->event_date->format('d F Y') : 'Upcoming');
                $location = is_array($event) ? $event['location'] : ($event->location ?? 'Patna Nashariganj');
                $category = is_array($event) ? 'General' : ($event->category ?? 'General');
                @endphp
                <div x-data="{ show: false }" x-intersect.once="show = true"
                     x-show="show"
                     x-transition:enter="transition ease-out duration-700 delay-[{{ $index * 150 }}ms]"
                     x-transition:enter-start="opacity-0 translate-y-24"
                     x-transition:enter-end="opacity-100 translate-y-0"
                     class="bg-white rounded-3xl overflow-hidden shadow-lg hover:shadow-xl transition duration-300 group hover:-translate-y-2 border border-slate-100 flex flex-col justify-between">
                    
                    <!-- Image -->
                    <div class="relative overflow-hidden aspect-video">
                        <img src="{{ str_starts_with($img, 'http') ? $img : asset($img) }}" alt="{{ $title }}" class="w-full h-full object-cover group-hover:scale-110 transition delay-200 duration-700" />
                        <div class="absolute top-3 left-3 bg-[#340C6F] text-white text-[11px] font-bold px-3 py-1 rounded-full shadow-md">
                            {{ $category }}
                        </div>
                    </div>

                    <!-- Content -->
                    <div class="p-6 flex-1 flex flex-col justify-between">
                        <div>
                            <h3 class="text-xl font-bold mb-3 text-slate-900 line-clamp-1">{{ $title }}</h3>
                            
                            <div class="flex items-center gap-2 text-slate-500 text-xs mb-2">
                                <i class="fa-regular fa-calendar text-[#F1400C]"></i>
                                <span>{{ $dateStr }}</span>
                            </div>

                            <div class="flex items-center gap-2 text-slate-500 text-xs mb-4">
                                <i class="fa-solid fa-location-dot text-[#028CD4]"></i>
                                <span>{{ $location }}</span>
                            </div>
                        </div>

                        <a href="{{ url('/register') }}" class="inline-flex items-center justify-center gap-2 mt-4 w-full py-2.5 bg-[#028CD4] hover:bg-blue-600 text-white font-bold text-xs rounded-xl shadow-md transition-all">
                            <span>Register for Event</span>
                            <i class="fa-solid fa-arrow-right text-[10px]"></i>
                        </a>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-12 text-gray-400">
                    <p>No upcoming events available at the moment.</p>
                </div>
            @endforelse
        </div>
    </div>
</section>

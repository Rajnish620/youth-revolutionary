@php
if (!isset($events) || count($events) === 0) {
    $dbEvents = \App\Models\Event::latest()->get();
} else {
    $dbEvents = $events;
}
@endphp

<section class="py-6 bg-transparent" x-data="{ openModalId: null }">
    <div class="max-w-7xl mx-auto px-6">
        <!-- Event Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8">
            @forelse($dbEvents as $index => $event)
                @php
                $title = is_array($event) ? $event['title'] : $event->title;
                $img = is_array($event) ? $event['image'] : ($event->image ?? 'images/quize.jpg');
                $dateStr = is_array($event) ? $event['date'] : ($event->event_date ? $event->event_date->format('d F Y') : 'Upcoming');
                $location = is_array($event) ? $event['location'] : ($event->location ?? 'Nasriganj');
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

                            @if(isset($event->description) && !empty($event->description))
                                <div class="mb-4">
                                    <button @click.prevent="openModalId = {{ $event->id }}" class="group/more inline-flex items-center gap-1.5 text-[11px] font-extrabold font-manrope uppercase tracking-wider text-[#028CD4] hover:text-[#340C6F] transition-colors">
                                        More Details
                                        <i class="fa-solid fa-circle-info text-[10px] group-hover/more:scale-110 transition-transform"></i>
                                    </button>
                                </div>
                            @endif
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
        
        <!-- Modals Rendering -->
        @foreach($dbEvents as $event)
            @if(isset($event->description) && !empty($event->description))
                <div x-show="openModalId === {{ $event->id }}" x-cloak style="display: none;" class="fixed inset-0 z-[100] flex items-center justify-center bg-black/70 backdrop-blur-md p-4">
                    <div @click.away="openModalId = null" 
                         x-show="openModalId === {{ $event->id }}" 
                         x-transition:enter="transition ease-out duration-300"
                         x-transition:enter-start="opacity-0 scale-95"
                         x-transition:enter-end="opacity-100 scale-100"
                         x-transition:leave="transition ease-in duration-200"
                         x-transition:leave-start="opacity-100 scale-100"
                         x-transition:leave-end="opacity-0 scale-95"
                         class="bg-white rounded-3xl max-w-2xl w-full p-8 shadow-2xl relative max-h-[90vh] overflow-y-auto border border-gray-100">
                         
                        <button @click="openModalId = null" class="absolute top-5 right-5 w-10 h-10 flex items-center justify-center rounded-full bg-gray-100 hover:bg-[#340C6F] hover:text-white text-gray-600 transition-all shadow-sm">
                            <i class="fa-solid fa-xmark text-lg"></i>
                        </button>
                        
                        <h2 class="font-playfair text-3xl font-bold text-slate-900 mb-2 pr-12 leading-tight">{{ is_array($event) ? $event['title'] : $event->title }}</h2>
                        
                        @php
                            $dateStr = is_array($event) ? $event['date'] : ($event->event_date ? $event->event_date->format('d M, Y') : 'TBA');
                            $location = is_array($event) ? $event['location'] : ($event->location ?? 'TBA');
                        @endphp
                        <div class="flex items-center gap-3 text-xs font-manrope font-bold text-gray-500 mb-6 pb-4 border-b border-gray-100">
                            <span class="flex items-center gap-1.5"><i class="fa-regular fa-calendar text-[#F1400C]"></i> {{ $dateStr }}</span>
                            <span class="w-1 h-1 rounded-full bg-gray-300"></span>
                            <span class="flex items-center gap-1.5"><i class="fa-solid fa-location-dot text-[#028CD4]"></i> {{ $location }}</span>
                        </div>
                        
                        <div class="prose prose-sm prose-p:font-manrope prose-p:text-sm prose-p:text-gray-700 max-w-none prose-headings:font-playfair prose-headings:text-slate-900">
                            {!! is_array($event) ? $event['description'] : $event->description !!}
                        </div>
                        
                        <div class="mt-8 pt-6 border-t border-gray-100 flex justify-end">
                            <a href="{{ url('/register') }}?event={{ $event->id }}" class="inline-flex items-center justify-center gap-2 px-8 py-3.5 bg-[#028CD4] hover:bg-blue-600 text-white font-manrope font-extrabold text-xs uppercase tracking-widest rounded-xl transition-all shadow-md">
                                Register For Event
                                <i class="fa-solid fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            @endif
        @endforeach

    </div>
</section>

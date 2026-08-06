@php
$categories = [
    [
        'title' => 'Education',
        'icon' => 'fa-book-open',
        'description' => 'Quiz, Debate, Essay Writing and other academic competitions.',
        'items' => ['Quiz', 'Debate', 'Essay Writing'],
        'link' => '/educationlearn'
    ],
    [
        'title' => 'Sports',
        'icon' => 'fa-trophy',
        'description' => 'Show your talent in various sports competitions.',
        'items' => ['Cricket', 'Kabaddi', 'Chess'],
        'link' => '/sportslearn'
    ],
    [
        'title' => 'Cultural',
        'icon' => 'fa-music',
        'description' => 'Explore creativity through cultural activities.',
        'items' => ['Dance', 'Singing', 'Drawing'],
        'link' => '/culturallearn'
    ]
];
@endphp

<section class="bg-gray-50 pt-16">
    <div class="max-w-7xl mx-auto px-6">
        <!-- Heading -->
        <div class="text-center mb-14" x-data="{ show: false }" x-intersect.once="show = true">
            <h2 x-show="show" 
                x-transition:enter="transition ease-out duration-700"
                x-transition:enter-start="opacity-0 translate-y-10"
                x-transition:enter-end="opacity-100 translate-y-0"
                class="text-4xl font-bold text-gray-900">
                Competition Categories
            </h2>
            <p x-show="show" 
               x-transition:enter="transition ease-out duration-700 delay-100"
               x-transition:enter-start="opacity-0 translate-y-10"
               x-transition:enter-end="opacity-100 translate-y-0"
               class="text-gray-600 mt-4">
                Choose your field and participate in exciting competitions.
            </p>
        </div>

        <section class="py-20">
            <div class="max-w-7xl mx-auto px-6">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-10">
                    @foreach($categories as $index => $category)
                        <div x-data="{ show: false }" x-intersect.once="show = true"
                             x-show="show"
                             x-transition:enter="transition ease-out duration-700 delay-[{{ $index * 150 }}ms]"
                             x-transition:enter-start="opacity-0 translate-y-24"
                             x-transition:enter-end="opacity-100 translate-y-0"
                             class="group relative bg-white/80 backdrop-blur-lg border border-gray-100 rounded-3xl p-8 shadow-md hover:shadow-2xl hover:-translate-y-2 transition-all duration-300 overflow-hidden">
                            
                            <!-- Glow background effect -->
                            <div class="absolute inset-0 bg-linear-to-br from-blue-50 to-transparent opacity-0 group-hover:opacity-100 transition"></div>

                            <div class="relative">
                                <!-- Icon -->
                                <div class="w-14 h-14 flex items-center justify-center rounded-2xl bg-linear-to-r from-[#028CD4] to-indigo-500 text-white text-2xl mb-5 shadow-lg group-hover:scale-110 transition">
                                    <i class="fa-solid {{ $category['icon'] }}"></i>
                                </div>

                                <!-- Title -->
                                <h3 class="text-2xl font-bold text-gray-900 mb-3 group-hover:text-[#EC3C00] transition">
                                    {{ $category['title'] }}
                                </h3>

                                <!-- Description -->
                                <p class="text-gray-600 mb-5 leading-relaxed">
                                    {{ $category['description'] }}
                                </p>

                                <!-- List -->
                                <ul class="space-y-2 text-gray-700">
                                    @foreach($category['items'] as $item)
                                        <li class="flex items-start gap-2">
                                            <span class="text-green-500 mt-1">✔</span>
                                            <span>{{ $item }}</span>
                                        </li>
                                    @endforeach
                                </ul>

                                <!-- Button -->
                                <a href="{{ url($category['link']) }}" class="inline-block mt-5 px-5 py-2 bg-[#028CD4] text-white rounded-lg hover:bg-blue-700">
                                    Learn More
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    </div>
</section>

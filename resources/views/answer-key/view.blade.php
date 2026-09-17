<x-app-layout>
    <!-- PDF.js CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.min.js"></script>
    <script>
        // Set worker source for PDF.js
        pdfjsLib.GlobalWorkerOptions.workerSrc = 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.worker.min.js';
    </script>

    <div class="min-h-screen bg-slate-50 py-10 px-4 sm:px-6 lg:px-8" style="padding-top: 130px;">
        <div class="max-w-5xl mx-auto space-y-6">

            <!-- Student Verification Profile Banner -->
            <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-6 sm:p-8 flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
                <div class="flex items-start sm:items-center gap-4">
                    <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-[#340C6F] to-[#7C3AED] text-white flex items-center justify-center text-2xl shadow-md shrink-0">
                        <i class="fa-solid fa-graduation-cap"></i>
                    </div>
                    <div>
                        <div class="flex flex-wrap items-center gap-2 mb-1">
                            <h1 class="text-xl sm:text-2xl font-extrabold text-gray-900 tracking-tight">
                                {{ $registration->student_name }}
                            </h1>
                            <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-xs font-bold bg-green-50 text-green-700 border border-green-200">
                                <i class="fa-solid fa-circle-check text-[10px]"></i> Verified
                            </span>
                        </div>
                        <div class="flex flex-wrap items-center gap-x-4 gap-y-1 text-xs sm:text-sm text-gray-500">
                            <span><strong class="text-gray-700">Roll No:</strong> {{ $registration->roll_no }}</span>
                            <span>&bull;</span>
                            <span><strong class="text-gray-700">Exam:</strong> {{ $registration->event->title ?? 'N/A' }}</span>
                            @if($registration->event && $registration->event->season)
                                <span>&bull;</span>
                                <span class="text-[#340C6F] font-semibold"><i class="fa-regular fa-calendar mr-1"></i>{{ $registration->event->season }}</span>
                            @endif
                            @if($registration->group)
                                <span>&bull;</span>
                                <span class="text-amber-700 font-bold"><i class="fa-solid fa-users mr-1"></i>{{ $registration->group->group_name }}</span>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Exit / Logout -->
                <div class="self-end md:self-auto shrink-0">
                    <form action="{{ route('answer-key.logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="text-xs sm:text-sm font-semibold text-gray-600 hover:text-red-600 transition-colors px-4 py-2.5 bg-gray-50 hover:bg-red-50 rounded-xl border border-gray-200 hover:border-red-200 flex items-center gap-2 cursor-pointer shadow-2xs">
                            <i class="fa-solid fa-arrow-right-from-bracket"></i>
                            <span>Exit Portal</span>
                        </button>
                    </form>
                </div>
            </div>

            <!-- Answer Keys Section -->
            @if($answerKeys->count() > 0)
                <div class="space-y-6">
                    @foreach($answerKeys as $index => $key)
                        @php
                            $ext = strtolower(pathinfo($key->file_path, PATHINFO_EXTENSION));
                            $isPdf = $ext === 'pdf';
                            $viewerId = 'pdf-viewer-' . $key->id;
                            $containerId = 'pdf-container-' . $key->id;
                        @endphp

                        <div x-data="inlinePdfViewer('{{ asset($key->file_path) }}', '{{ $containerId }}', {{ $isPdf ? 'true' : 'false' }})" 
                             x-init="initViewer()" 
                             class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
                            
                            <!-- Card Header & Controls Bar -->
                            <div class="p-4 sm:p-6 border-b border-gray-100 bg-gray-50/70 flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                                <div>
                                    <div class="flex items-center gap-2">
                                        <span class="w-8 h-8 rounded-lg bg-purple-100 text-[#340C6F] flex items-center justify-center text-sm shrink-0">
                                            <i class="fa-solid {{ $isPdf ? 'fa-file-pdf text-red-500' : 'fa-file-image text-blue-500' }}"></i>
                                        </span>
                                        <h2 class="text-base sm:text-lg font-bold text-gray-900">
                                            {{ $key->title }}
                                        </h2>
                                    </div>
                                    <div class="flex items-center gap-2 mt-1.5 ml-10 text-xs text-gray-500">
                                        @if($key->group)
                                            <span class="inline-flex items-center px-2 py-0.5 rounded-md font-bold bg-amber-50 text-amber-700 border border-amber-200">
                                                <i class="fa-solid fa-users text-[10px] mr-1"></i> {{ $key->group->group_name }}
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-2 py-0.5 rounded-md font-semibold bg-blue-50 text-blue-700 border border-blue-200">
                                                Common Key
                                            </span>
                                        @endif
                                        <span>&bull;</span>
                                        <span>Uploaded: {{ $key->created_at->format('d M Y') }}</span>
                                    </div>
                                </div>

                                <!-- PDF Interactive Viewer Controls -->
                                @if($isPdf)
                                    <div class="flex flex-wrap items-center gap-2 bg-white px-3 py-1.5 rounded-2xl border border-gray-200 shadow-2xs self-stretch sm:self-auto justify-between sm:justify-start">
                                        <!-- Page Counter -->
                                        <div class="text-xs font-semibold text-gray-600 px-2 flex items-center gap-1">
                                            <i class="fa-regular fa-file-lines text-gray-400"></i>
                                            <span x-text="totalPages > 0 ? totalPages + ' Pages' : 'Loading...'"></span>
                                        </div>

                                        <div class="h-4 w-px bg-gray-200 mx-1"></div>

                                        <!-- Zoom Out -->
                                        <button @click="zoomOut()" :disabled="scale <= 0.6" type="button" class="p-1.5 text-gray-600 hover:text-[#340C6F] hover:bg-gray-100 rounded-lg disabled:opacity-40 cursor-pointer transition-colors" title="Zoom Out">
                                            <i class="fa-solid fa-magnifying-glass-minus text-xs"></i>
                                        </button>

                                        <!-- Zoom Level -->
                                        <span class="text-xs font-bold text-gray-700 w-12 text-center" x-text="Math.round(scale * 100) + '%'"></span>

                                        <!-- Zoom In -->
                                        <button @click="zoomIn()" :disabled="scale >= 2.5" type="button" class="p-1.5 text-gray-600 hover:text-[#340C6F] hover:bg-gray-100 rounded-lg disabled:opacity-40 cursor-pointer transition-colors" title="Zoom In">
                                            <i class="fa-solid fa-magnifying-glass-plus text-xs"></i>
                                        </button>

                                        <!-- Reset Zoom -->
                                        <button @click="resetZoom()" type="button" class="p-1.5 text-gray-600 hover:text-[#340C6F] hover:bg-gray-100 rounded-lg cursor-pointer transition-colors" title="Fit to Width">
                                            <i class="fa-solid fa-arrows-left-right text-xs"></i>
                                        </button>

                                        <div class="h-4 w-px bg-gray-200 mx-1"></div>

                                        <!-- Download Button -->
                                        <a href="{{ asset($key->file_path) }}" download class="px-3 py-1 bg-[#340C6F] hover:bg-[#250850] text-white rounded-lg text-xs font-bold transition-colors flex items-center gap-1.5 shadow-xs">
                                            <i class="fa-solid fa-download text-[11px]"></i>
                                            <span>Download</span>
                                        </a>
                                    </div>
                                @else
                                    <a href="{{ asset($key->file_path) }}" download class="px-4 py-2 bg-[#340C6F] hover:bg-[#250850] text-white rounded-xl text-xs font-bold transition-colors flex items-center gap-1.5 shadow-xs">
                                        <i class="fa-solid fa-download"></i>
                                        <span>Download Image</span>
                                    </a>
                                @endif
                            </div>

                            <!-- In-Page Canvas Document Viewer Area -->
                            <div class="p-4 sm:p-6 bg-slate-100/70">
                                @if($isPdf)
                                    <!-- Loading Spinner State -->
                                    <div x-show="loading" class="py-16 text-center">
                                        <div class="inline-block animate-spin rounded-full h-10 w-10 border-4 border-gray-300 border-t-[#340C6F] mb-3"></div>
                                        <p class="text-sm font-semibold text-gray-700">Rendering Answer Key Document...</p>
                                        <p class="text-xs text-gray-400">Loading directly on your screen without leaving the website.</p>
                                    </div>

                                    <!-- Error State -->
                                    <div x-show="errorMessage" x-cloak class="p-6 bg-red-50 border border-red-200 rounded-2xl text-center text-red-600 my-4">
                                        <i class="fa-solid fa-triangle-exclamation text-2xl mb-2"></i>
                                        <p class="text-sm font-bold" x-text="errorMessage"></p>
                                        <div class="mt-3">
                                            <a :href="pdfUrl" target="_blank" class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl text-xs font-bold bg-red-600 text-white hover:bg-red-700">
                                                <i class="fa-solid fa-arrow-up-right-from-square"></i> Open In Browser Viewer
                                            </a>
                                        </div>
                                    </div>

                                    <!-- PDF Pages Container (Renders each page cleanly on a Canvas) -->
                                    <div id="{{ $containerId }}" class="space-y-6 flex flex-col items-center overflow-x-auto max-w-full py-2">
                                        <!-- Dynamic canvas pages are appended here by PDF.js script -->
                                    </div>
                                @else
                                    <!-- Image Format Answer Key Viewer -->
                                    <div class="flex justify-center p-2">
                                        <img src="{{ asset($key->file_path) }}" alt="{{ $key->title }}" class="max-w-full h-auto rounded-2xl shadow-md border border-gray-200">
                                    </div>
                                @endif
                            </div>

                            <!-- Card Footer Note -->
                            <div class="px-6 py-3 bg-white border-t border-gray-100 text-xs text-gray-400 flex flex-col sm:flex-row justify-between items-center gap-2">
                                <div class="flex items-center gap-1.5">
                                    <i class="fa-solid fa-shield-halved text-green-500"></i>
                                    <span>Official Answer Key issued by Youth Revolutionary Examination Board.</span>
                                </div>
                                <div class="text-gray-400">
                                    All rights reserved.
                                </div>
                            </div>

                        </div>
                    @endforeach
                </div>
            @else
                <!-- Empty State -->
                <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-12 text-center">
                    <div class="w-20 h-20 bg-amber-50 rounded-full flex items-center justify-center mx-auto mb-4 text-amber-500">
                        <i class="fa-solid fa-file-circle-exclamation text-3xl"></i>
                    </div>
                    <h3 class="text-lg font-bold text-gray-800 mb-1">Answer Key Under Processing</h3>
                    <p class="text-sm text-gray-500 max-w-md mx-auto">
                        The official answer key for 
                        <strong>{{ $registration->event->title ?? 'your exam' }}</strong> 
                        @if($registration->group)
                            (<strong>{{ $registration->group->group_name }}</strong>)
                        @endif 
                        has not been uploaded yet. Please check back shortly after the evaluation team publishes it.
                    </p>
                    <div class="mt-6">
                        <a href="{{ route('home') }}" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl text-xs font-bold bg-[#340C6F] text-white hover:bg-[#250850] transition-colors shadow-sm">
                            <i class="fa-solid fa-house"></i> Return to Home
                        </a>
                    </div>
                </div>
            @endif

        </div>
    </div>

    <!-- Alpine In-Page PDF.js Renderer Component -->
    <script>
        function inlinePdfViewer(pdfUrl, containerId, isPdf) {
            return {
                pdfUrl: pdfUrl,
                containerId: containerId,
                isPdf: isPdf,
                pdfDoc: null,
                totalPages: 0,
                scale: 1.2,
                loading: true,
                errorMessage: '',
                renderingQueue: false,

                initViewer() {
                    if (!this.isPdf) return;
                    this.loadPdf();

                    // Auto adjust scale for mobile viewports
                    if (window.innerWidth < 640) {
                        this.scale = 0.85;
                    } else if (window.innerWidth < 1024) {
                        this.scale = 1.0;
                    }
                },

                async loadPdf() {
                    this.loading = true;
                    this.errorMessage = '';
                    try {
                        const loadingTask = pdfjsLib.getDocument(this.pdfUrl);
                        this.pdfDoc = await loadingTask.promise;
                        this.totalPages = this.pdfDoc.numPages;
                        await this.renderAllPages();
                        this.loading = false;
                    } catch (err) {
                        console.error('PDF.js loading error:', err);
                        this.errorMessage = 'Unable to render PDF inside page directly. Please use the Download option above.';
                        this.loading = false;
                    }
                },

                async renderAllPages() {
                    const container = document.getElementById(this.containerId);
                    if (!container) return;
                    container.innerHTML = ''; // clear

                    for (let pageNum = 1; pageNum <= this.totalPages; pageNum++) {
                        const page = await this.pdfDoc.getPage(pageNum);
                        const viewport = page.getViewport({ scale: this.scale });

                        // Wrapper card for page
                        const pageWrapper = document.createElement('div');
                        pageWrapper.className = 'relative bg-white shadow-md rounded-xl overflow-hidden border border-gray-200 transition-all';
                        
                        // Page Number Badge inside
                        const pageBadge = document.createElement('div');
                        pageBadge.className = 'absolute top-3 right-3 bg-gray-900/60 text-white text-[10px] font-bold px-2 py-0.5 rounded-full pointer-events-none backdrop-blur-xs z-10';
                        pageBadge.innerText = 'Page ' + pageNum + ' / ' + this.totalPages;
                        pageWrapper.appendChild(pageBadge);

                        // Canvas Element
                        const canvas = document.createElement('canvas');
                        canvas.className = 'block max-w-full';
                        const context = canvas.getContext('2d');
                        canvas.height = viewport.height;
                        canvas.width = viewport.width;

                        pageWrapper.appendChild(canvas);
                        container.appendChild(pageWrapper);

                        const renderContext = {
                            canvasContext: context,
                            viewport: viewport
                        };
                        await page.render(renderContext).promise;
                    }
                },

                zoomIn() {
                    if (this.scale >= 2.5) return;
                    this.scale = parseFloat((this.scale + 0.2).toFixed(2));
                    this.renderAllPages();
                },

                zoomOut() {
                    if (this.scale <= 0.6) return;
                    this.scale = parseFloat((this.scale - 0.2).toFixed(2));
                    this.renderAllPages();
                },

                resetZoom() {
                    const container = document.getElementById(this.containerId);
                    const containerWidth = container ? container.clientWidth : window.innerWidth;
                    if (window.innerWidth < 640) {
                        this.scale = 0.85;
                    } else {
                        this.scale = 1.2;
                    }
                    this.renderAllPages();
                }
            };
        }
    </script>
</x-app-layout>

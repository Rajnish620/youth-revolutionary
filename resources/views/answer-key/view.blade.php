<x-app-layout>
    <div class="min-h-screen bg-gray-50 py-12 px-4 sm:px-6 lg:px-8" style="padding-top: 140px;">
        <div class="max-w-4xl mx-auto">
            <!-- Header section -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 sm:p-8 mb-8 flex flex-col sm:flex-row justify-between items-center gap-4">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">Official Answer Key</h1>
                    <p class="text-gray-500 mt-1">
                        Exam: <span class="font-semibold text-brand-purple">{{ $registration->event->title ?? 'N/A' }}</span>
                    </p>
                    <p class="text-sm text-gray-400 mt-1">Student: {{ $registration->student_name }} ({{ $registration->roll_no }})</p>
                </div>
                <div>
                    <form action="{{ route('answer-key.logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="text-sm font-medium text-gray-500 hover:text-red-500 transition-colors px-4 py-2 bg-gray-50 rounded-lg border border-gray-200 hover:bg-red-50 hover:border-red-200">
                            <i class="fa-solid fa-right-from-bracket mr-1"></i> Exit
                        </button>
                    </form>
                </div>
            </div>

            <!-- Answer Keys Section -->
            @if($answerKeys->count() > 0)
                <div class="space-y-6">
                    @foreach($answerKeys as $key)
                        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                            <div class="p-4 sm:p-6 border-b border-gray-100 flex justify-between items-center bg-gray-50/50">
                                <h2 class="text-lg font-bold text-gray-800 flex items-center">
                                    <i class="fa-solid fa-file-circle-check text-green-500 mr-2 text-xl"></i>
                                    {{ $key->title }}
                                </h2>
                                <a href="{{ asset($key->file_path) }}" download class="bg-brand-purple hover:bg-brand-dark text-white px-4 py-2 rounded-lg text-sm font-semibold transition-colors shadow-sm">
                                    <i class="fa-solid fa-download mr-1"></i> Download
                                </a>
                            </div>
                            <div class="p-4 sm:p-6 bg-gray-100/50 flex justify-center">
                                @php
                                    $extension = strtolower(pathinfo($key->file_path, PATHINFO_EXTENSION));
                                @endphp

                                @if(in_array($extension, ['jpg', 'jpeg', 'png']))
                                    <img src="{{ asset($key->file_path) }}" alt="{{ $key->title }}" class="max-w-full h-auto rounded-lg shadow-sm border border-gray-200">
                                @elseif($extension == 'pdf')
                                    <iframe src="{{ asset($key->file_path) }}" class="w-full h-[600px] border-0 rounded-lg shadow-sm"></iframe>
                                @else
                                    <div class="text-center py-12">
                                        <i class="fa-solid fa-file-lines text-4xl text-gray-300 mb-3"></i>
                                        <p class="text-gray-500">Document preview not available.</p>
                                        <a href="{{ asset($key->file_path) }}" download class="text-brand-purple font-semibold hover:underline mt-2 inline-block">Download File</a>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-12 text-center">
                    <div class="w-20 h-20 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-4 text-gray-300">
                        <i class="fa-solid fa-file-circle-xmark text-3xl"></i>
                    </div>
                    <h3 class="text-lg font-bold text-gray-800 mb-1">No Answer Key Available</h3>
                    <p class="text-gray-500">The answer key for your exam has not been uploaded yet. Please check back later.</p>
                </div>
            @endif

        </div>
    </div>
</x-app-layout>

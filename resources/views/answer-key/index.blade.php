<x-app-layout>
    <div class="min-h-screen bg-gray-50 flex flex-col justify-center items-center py-12 px-4 sm:px-6 lg:px-8" style="padding-top: 140px;">
        <div class="w-full max-w-lg relative z-10 mx-auto">
            
            <!-- Premium Header inside the container -->
            <div class="text-center mb-8">
                <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-blue-100 mb-4 shadow-inner">
                    <i class="fa-solid fa-file-shield text-2xl text-blue-600"></i>
                </div>
                <h2 class="text-3xl sm:text-4xl font-extrabold text-gray-900 tracking-tight">Answer Key Portal</h2>
                <p class="mt-3 text-base text-gray-600">Securely access your personalized exam answer key.</p>
            </div>

            <!-- Login Card -->
            <div class="bg-white py-10 px-6 sm:px-8 shadow-2xl rounded-3xl border border-gray-100">
                @if(session('error'))
                    <div class="mb-8 bg-red-50 border border-red-200 text-red-600 px-4 py-3 rounded-xl text-sm flex items-start">
                        <i class="fa-solid fa-circle-exclamation mt-0.5 mr-2"></i>
                        <span>{{ session('error') }}</span>
                    </div>
                @endif

                <form action="{{ route('answer-key.authenticate') }}" method="POST" class="space-y-6">
                    @csrf
                    <div>
                        <label for="roll_no" class="block text-sm font-bold text-gray-700 mb-2">Roll Number <span class="text-red-500">*</span></label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <i class="fa-solid fa-id-card text-gray-400"></i>
                            </div>
                            <input type="text" name="roll_no" id="roll_no" required 
                                class="pl-11 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 block w-full text-base border-gray-300 rounded-xl py-3 border shadow-sm transition-colors bg-gray-50 hover:bg-white focus:bg-white" 
                                placeholder="e.g., YR20261001" value="{{ old('roll_no') }}">
                        </div>
                    </div>

                    <div>
                        <label for="dob" class="block text-sm font-bold text-gray-700 mb-2">Date of Birth <span class="text-red-500">*</span></label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <i class="fa-solid fa-calendar-day text-gray-400"></i>
                            </div>
                            <input type="date" name="dob" id="dob" required 
                                class="pl-11 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 block w-full text-base border-gray-300 rounded-xl py-3 border shadow-sm transition-colors bg-gray-50 hover:bg-white focus:bg-white"
                                value="{{ old('dob') }}">
                        </div>
                    </div>

                    <div class="pt-4">
                        <button type="submit" class="w-full flex justify-center items-center py-3.5 px-4 rounded-xl shadow-lg text-base font-bold text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all transform hover:-translate-y-0.5 active:translate-y-0">
                            Access Answer Key <i class="fa-solid fa-arrow-right ml-2 mt-0.5"></i>
                        </button>
                    </div>
                </form>
            </div>
            
            <!-- Secure footer note -->
            <div class="mt-8 text-center text-sm text-gray-500 flex items-center justify-center gap-2">
                <i class="fa-solid fa-lock text-gray-400"></i>
                Your information is securely encrypted and processed.
            </div>
        </div>
    </div>
</x-app-layout>

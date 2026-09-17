<x-app-layout>
    <div class="min-h-screen bg-slate-50 flex flex-col justify-center items-center py-12 px-4 sm:px-6 lg:px-8" style="padding-top: 140px;">
        <div class="w-full max-w-lg relative z-10 mx-auto">
            
            <!-- Premium Header inside the container -->
            <div class="text-center mb-8">
                <div class="inline-flex items-center justify-center w-16 h-16 rounded-2xl bg-gradient-to-br from-[#340C6F] to-[#7C3AED] text-white mb-4 shadow-lg shadow-[#340C6F]/20">
                    <i class="fa-solid fa-file-shield text-2xl"></i>
                </div>
                <h2 class="text-3xl sm:text-4xl font-extrabold text-gray-900 tracking-tight">Answer Key Portal</h2>
                <p class="mt-2 text-sm text-gray-600">Access official examination answer key tailored for your group.</p>
            </div>

            <!-- Login Card -->
            <div class="bg-white py-8 px-6 sm:px-8 shadow-xl rounded-3xl border border-gray-100">
                @if(session('error'))
                    <div class="mb-6 bg-red-50 border border-red-200 text-red-600 px-4 py-3 rounded-2xl text-xs font-semibold flex items-center gap-2">
                        <i class="fa-solid fa-circle-exclamation text-sm shrink-0"></i>
                        <span>{{ session('error') }}</span>
                    </div>
                @endif

                <form action="{{ route('answer-key.authenticate') }}" method="POST" class="space-y-5">
                    @csrf
                    <div>
                        <label for="roll_no" class="block text-xs font-bold text-gray-700 mb-1.5">Roll Number <span class="text-red-500">*</span></label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-gray-400">
                                <i class="fa-solid fa-id-card text-sm"></i>
                            </div>
                            <input type="text" name="roll_no" id="roll_no" required 
                                class="pl-10 focus:ring-2 focus:ring-[#340C6F] focus:border-[#340C6F] block w-full text-sm border-gray-200 rounded-xl py-3 border shadow-2xs transition-colors bg-gray-50/50 hover:bg-white focus:bg-white uppercase placeholder:normal-case font-semibold text-gray-800" 
                                placeholder="e.g., YR20261000" value="{{ old('roll_no') }}">
                        </div>
                    </div>

                    <div>
                        <label for="dob" class="block text-xs font-bold text-gray-700 mb-1.5">Date of Birth <span class="text-red-500">*</span></label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-gray-400">
                                <i class="fa-solid fa-calendar-day text-sm"></i>
                            </div>
                            <input type="date" name="dob" id="dob" required 
                                class="pl-10 focus:ring-2 focus:ring-[#340C6F] focus:border-[#340C6F] block w-full text-sm border-gray-200 rounded-xl py-3 border shadow-2xs transition-colors bg-gray-50/50 hover:bg-white focus:bg-white font-semibold text-gray-800"
                                value="{{ old('dob') }}">
                        </div>
                    </div>

                    <div class="pt-2">
                        <button type="submit" class="w-full flex justify-center items-center py-3.5 px-4 rounded-xl shadow-lg shadow-[#340C6F]/25 text-sm font-bold text-white bg-[#340C6F] hover:bg-[#250850] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#340C6F] transition-all transform hover:-translate-y-0.5 active:translate-y-0 cursor-pointer">
                            <span>View My Answer Key</span>
                            <i class="fa-solid fa-arrow-right ml-2 text-xs"></i>
                        </button>
                    </div>
                </form>
            </div>
            
            <!-- Secure footer note -->
            <div class="mt-8 text-center text-xs text-gray-500 flex items-center justify-center gap-1.5">
                <i class="fa-solid fa-lock text-gray-400"></i>
                <span>Your details are validated securely against registration records.</span>
            </div>
        </div>
    </div>
</x-app-layout>

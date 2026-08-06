<x-app-layout>
<div class="min-h-screen bg-slate-50 pt-24 pb-12 flex flex-col items-center justify-center">
    
    <div class="max-w-md w-full px-6">
        <div class="text-center mb-10">
            <h1 class="text-3xl font-extrabold text-[#340C6F] mb-4">Download Admit Card</h1>
            <p class="text-slate-600 text-sm">Enter your Date of Birth and Mobile Number associated with your approved registration.</p>
        </div>

        <div class="bg-white rounded-3xl p-8 shadow-xl shadow-[#028CD4]/5 border border-slate-100">
            @if(session('error'))
                <div class="bg-red-50 text-red-600 px-4 py-3 rounded-xl mb-6 text-sm font-medium border border-red-100 flex items-center gap-2">
                    <i class="fa-solid fa-circle-exclamation"></i>
                    {{ session('error') }}
                </div>
            @endif

            <form action="{{ route('admit-card.download') }}" method="POST" class="space-y-6">
                @csrf
                
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Mobile Number</label>
                    <div class="relative">
                        <i class="fa-solid fa-phone absolute left-4 top-1/2 -translate-y-1/2 text-slate-400"></i>
                        <input type="tel" name="mobile" required placeholder="e.g. 9876543210"
                            class="w-full bg-slate-50 border border-slate-200 rounded-2xl pl-11 pr-4 py-3.5 text-sm font-semibold text-slate-900 focus:bg-white focus:border-[#028CD4] outline-none transition-all">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Date of Birth</label>
                    <div class="relative">
                        <input type="date" name="dob" required
                            class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-4 py-3.5 text-sm font-semibold text-slate-900 focus:bg-white focus:border-[#028CD4] outline-none transition-all">
                    </div>
                </div>

                <button type="submit" class="w-full bg-gradient-to-r from-[#028CD4] to-[#026BA3] text-white font-bold py-4 rounded-2xl shadow-lg shadow-[#028CD4]/30 hover:shadow-[#028CD4]/50 hover:-translate-y-0.5 transition-all duration-300">
                    <i class="fa-solid fa-download mr-2"></i>
                    Download Admit Card
                </button>
            </form>
        </div>
    </div>
</div>
</x-app-layout>

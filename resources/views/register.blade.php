<x-app-layout>
    <section class="py-16 bg-[#F8FAFC] min-h-screen text-slate-800">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 mt-10">

            <!-- Success Application Badge Banner -->
            @if(session('success_registration'))
                @php $reg = session('success_registration'); @endphp
                <div class="mb-10 p-8 sm:p-10 rounded-3xl bg-gradient-to-r from-emerald-500 to-teal-600 text-white shadow-2xl space-y-4 text-center">
                    <div class="w-20 h-20 rounded-full bg-white/20 flex items-center justify-center mx-auto text-4xl shadow-inner">
                        <i class="fa-solid fa-circle-check"></i>
                    </div>
                    <h2 class="text-3xl sm:text-4xl font-black tracking-tight">REGISTRATION SUCCESSFUL!</h2>
                    <p class="text-emerald-100 text-sm sm:text-base max-w-md mx-auto font-medium">
                        Your application has been received successfully and sent to Admin for payment verification.
                    </p>
                    
                    <div class="inline-block bg-white text-slate-900 px-8 py-3.5 rounded-2xl font-mono text-2xl font-black shadow-lg">
                        REG NO: <span class="text-[#F1400C]">{{ is_array($reg) ? ($reg['registration_no'] ?? '') : ($reg->registration_no ?? '') }}</span>
                    </div>
                    <!-- <div class="inline-block bg-white text-slate-900 px-8 py-3.5 rounded-2xl font-mono text-xl font-black shadow-lg mt-2">
                        ROLL NO: <span class="text-[#028CD4]">{{ is_array($reg) ? ($reg['roll_no'] ?? '') : ($reg->roll_no ?? '') }}</span>
                    </div> -->

                    <div class="text-xs text-emerald-100 font-medium pt-2">
                        Please save or note down this Registration Number for competition day and certificates.
                    </div>
                </div>
            @endif

            <!-- Main Form Card -->
            <div class="bg-white rounded-3xl shadow-xl border border-slate-200/80 overflow-hidden">
                
                <!-- Friendly Aesthetic Header -->
                <div class="bg-gradient-to-r from-[#028CD4] via-[#340C6F] to-[#028CD4] text-white p-8 sm:p-12 text-center relative">
                    <div class="space-y-3 relative z-10">
                        <span class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-white/15 text-xs font-bold tracking-widest uppercase border border-white/20">
                            <i class="fa-solid fa-graduation-cap"></i> Student Competition Portal
                        </span>
                        <h1 class="text-3xl sm:text-5xl font-black tracking-tight">Student Registration</h1>
                        <p class="text-blue-100 text-xs sm:text-sm max-w-lg mx-auto font-medium">
                            Please enter your details carefully. Fields marked with <span class="text-orange-300 font-bold">*</span> are required.
                        </p>
                    </div>
                </div>

                <!-- Registration Form -->
                <script>
                    document.addEventListener('alpine:init', () => {
                        Alpine.data('registrationForm', () => ({
                            events: @json($events ?? []),
                            selectedEventId: '{{ $events->first()->id ?? '' }}',
                            selectedGroupId: '',
                            photoType: 'upload', // 'upload' or 'camera'
                            
                            get selectedEvent() {
                                return this.events.find(e => e.id == this.selectedEventId) || null;
                            },

                            get availableGroups() {
                                const groups = this.selectedEvent ? (this.selectedEvent.groups || []) : [];
                                const uniqueGroups = [];
                                const seen = new Set();
                                for (const grp of groups) {
                                    if (!seen.has(grp.group_name)) {
                                        seen.add(grp.group_name);
                                        uniqueGroups.push(grp);
                                    }
                                }
                                return uniqueGroups;
                            },

                            get currentFee() {
                                if(!this.selectedGroupId) return 100;
                                const grp = this.availableGroups.find(g => g.id == this.selectedGroupId);
                                return grp ? grp.fee : 100;
                            },

                            get availableClasses() {
                                const allClasses = [
                                    'Class 5th', 'Class 6th', 'Class 7th', 'Class 8th', 
                                    'Class 9th', 'Class 10th', 'Class 11th', 'Class 12th',
                                    'General Below to 25 years'
                                ];
                                if(!this.selectedGroupId) return allClasses;
                                
                                const grp = this.availableGroups.find(g => g.id == this.selectedGroupId);
                                if(!grp) return allClasses;
                                
                                const groupName = (grp.group_name || '').toLowerCase();
                                const classRange = (grp.class_range || '').toLowerCase();
                                const rangeStr = (grp.class_range || grp.group_name || '').toLowerCase();
                                const numbers = rangeStr.match(/\d+/g);
                                
                                if (!numbers || numbers.length === 0) return allClasses;

                                let allowedClasses = [];
                                
                                // If they typed something like "5th, 6th, 8th" or "5 & 6"
                                if(rangeStr.includes(',') || rangeStr.includes('&') || rangeStr.includes('and')) {
                                    allowedClasses = allClasses.filter(c => {
                                        const match = c.match(/\d+/);
                                        const cNum = match ? match[0] : null;
                                        return numbers.includes(cNum);
                                    });
                                } else {
                                    // If they typed a range like "9 to 12" or single class "5"
                                    let start = parseInt(numbers[0]);
                                    let end = numbers.length > 1 ? parseInt(numbers[numbers.length - 1]) : start;
                                    
                                    if (start && end) {
                                        allowedClasses = allClasses.filter(c => {
                                            const match = c.match(/\d+/);
                                            if (!match) return false;
                                            const cNum = parseInt(match[0]);
                                            return cNum >= Math.min(start, end) && cNum <= Math.max(start, end);
                                        });
                                    } else {
                                        allowedClasses = allClasses;
                                    }
                                }

                                // Explicitly include 'General Below to 25 years' for Group D, Group 5, or any group with Class 12th
                                if (
                                    groupName.includes('group d') || 
                                    groupName.includes('grp 5') ||
                                    groupName.includes('group 5') ||
                                    classRange.includes('25') || 
                                    groupName.includes('25') ||
                                    allowedClasses.includes('Class 12th')
                                ) {
                                    if (!allowedClasses.includes('General Below to 25 years')) {
                                        allowedClasses.push('General Below to 25 years');
                                    }
                                }
                                
                                return allowedClasses;
                            },

                            get classOptionsHtml() {
                                let html = '<option value="">Select Class</option>';
                                this.availableClasses.forEach(c => {
                                    html += `<option value="${c}">${c}</option>`;
                                });
                                return html;
                            },

                            showCamera: false,
                            capturedImage: null,
                            stream: null,

                            openCamera() {
                                this.showCamera = true;
                                navigator.mediaDevices.getUserMedia({ video: { facingMode: 'user' } })
                                    .then(stream => {
                                        this.stream = stream;
                                        this.$refs.video.srcObject = stream;
                                    })
                                    .catch(err => {
                                        alert('Could not access camera.');
                                        this.showCamera = false;
                                    });
                            },

                            capturePhoto() {
                                const canvas = document.createElement('canvas');
                                canvas.width = this.$refs.video.videoWidth;
                                canvas.height = this.$refs.video.videoHeight;
                                canvas.getContext('2d').drawImage(this.$refs.video, 0, 0);
                                this.capturedImage = canvas.toDataURL('image/jpeg');
                                this.stopCamera();
                                this.showCamera = false;
                            },

                            stopCamera() {
                                if(this.stream) {
                                    this.stream.getTracks().forEach(track => track.stop());
                                    this.stream = null;
                                }
                            }
                        }));
                    });
                </script>
                <div 
                    x-data="registrationForm()" 
                    class="p-6 sm:p-10 space-y-10"
                >
                    <form method="POST" action="{{ url('/register') }}" class="space-y-10" enctype="multipart/form-data">
                        @csrf
                        
                        <!-- Hidden Input for Live Photo -->
                        <input type="hidden" name="live_photo_base64" :value="capturedImage">

                        <!-- SECTION 1: EVENT & CLASS GROUP SELECTION -->
                        <div class="space-y-5 bg-blue-50/50 p-6 sm:p-8 rounded-3xl border border-blue-100">
                            <div class="flex items-center gap-3">
                                <span class="w-8 h-8 rounded-2xl bg-[#028CD4] text-white font-black text-sm flex items-center justify-center shadow-md">1</span>
                                <h3 class="text-base font-extrabold text-[#340C6F]">Select Competition & Class Group</h3>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Event -->
                                <div>
                                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Competition Event *</label>
                                    <select name="event_id" x-model="selectedEventId" @change="selectedGroupId = ''" required
                                        class="w-full bg-white border border-slate-300 rounded-2xl px-4 py-3.5 text-sm font-bold text-slate-900 outline-none focus:border-[#028CD4] focus:ring-2 focus:ring-[#028CD4]/20 transition-all">
                                        @foreach($events as $ev)
                                            <option value="{{ $ev->id }}">{{ $ev->title }} ({{ $ev->category }})</option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Group Tier -->
                                <div>
                                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Class Group Tier *</label>
                                    <select name="event_group_id" x-model="selectedGroupId" required
                                        class="w-full bg-white border border-slate-300 rounded-2xl px-4 py-3.5 text-sm font-bold text-slate-900 outline-none focus:border-[#028CD4] focus:ring-2 focus:ring-[#028CD4]/20 transition-all">
                                        <option value="">-- Choose Class Group --</option>
                                        <template x-for="grp in availableGroups" :key="grp.id">
                                            <option :value="grp.id" x-text="grp.group_name + ' — ₹' + grp.fee"></option>
                                        </template>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- SECTION 2: STUDENT PERSONAL DETAILS -->
                        <div class="space-y-5">
                            <div class="flex items-center gap-3">
                                <span class="w-8 h-8 rounded-2xl bg-[#340C6F] text-white font-black text-sm flex items-center justify-center shadow-md">2</span>
                                <h3 class="text-base font-extrabold text-[#340C6F]">Personal & School Details</h3>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Student Name -->
                                <div>
                                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Student Name *</label>
                                    <input type="text" name="student_name" required placeholder="e.g. Raju Kumar"
                                        class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-4 py-3.5 text-sm font-semibold text-slate-900 focus:bg-white focus:border-[#028CD4] outline-none transition-all">
                                </div>

                                <!-- Father's Name -->
                                <div>
                                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Father's Name *</label>
                                    <input type="text" name="father_name" required placeholder="e.g. Rajesh Singh"
                                        class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-4 py-3.5 text-sm font-semibold text-slate-900 focus:bg-white focus:border-[#028CD4] outline-none transition-all">
                                </div>

                                <!-- Mobile Number -->
                                <div>
                                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Mobile Number *</label>
                                    <input type="tel" name="mobile" required placeholder="+91 9876543210"
                                        class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-4 py-3.5 text-sm font-semibold text-slate-900 focus:bg-white focus:border-[#028CD4] outline-none transition-all">
                                </div>

                                <!-- Email -->
                                <div>
                                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Email Address</label>
                                    <input type="email" name="email" placeholder="student@gmail.com"
                                        class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-4 py-3.5 text-sm font-semibold text-slate-900 focus:bg-white focus:border-[#028CD4] outline-none transition-all">
                                </div>

                                <!-- Class Level -->
                                <div>
                                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Class *</label>
                                    <select name="student_class" required class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-4 py-3.5 text-sm font-bold text-slate-900 focus:bg-white focus:border-[#028CD4] outline-none transition-all" x-html="classOptionsHtml">
                                    </select>
                                </div>

                                <!-- Date of Birth -->
                                <div>
                                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Date of Birth *</label>
                                    <input type="date" name="dob" required
                                        class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-4 py-3.5 text-sm font-semibold text-slate-900 focus:bg-white focus:border-[#028CD4] outline-none transition-all">
                                </div>

                                <!-- Gender -->
                                <div>
                                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Gender *</label>
                                    <select name="gender" required class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-4 py-3.5 text-sm font-bold text-slate-900 focus:bg-white focus:border-[#028CD4] outline-none transition-all">
                                        <option value="">-- Select Gender --</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                        <option value="Other">Other</option>
                                    </select>
                                </div>

                                <!-- Category -->
                                <div>
                                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Category *</label>
                                    <select name="category" required class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-4 py-3.5 text-sm font-bold text-slate-900 focus:bg-white focus:border-[#028CD4] outline-none transition-all">
                                        <option value="">-- Select Category --</option>
                                        <option value="General">General</option>
                                        <option value="OBC">OBC</option>
                                        <option value="SC">SC</option>
                                        <option value="ST">ST</option>
                                        <option value="EWS">EWS</option>
                                    </select>
                                </div>

                                <!-- School Name -->
                                <div class="md:col-span-2">
                                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">School Name / Coaching Centre Name </label>
                                    <input type="text" name="school_name" placeholder="e.g. ABC Public School"
                                        class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-4 py-3.5 text-sm font-semibold text-slate-900 focus:bg-white focus:border-[#028CD4] outline-none transition-all">
                                </div>

                                <!-- Address -->
                                <div>
                                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Address *</label>
                                    <input type="text" name="address" required placeholder="e.g. Nasriganj"
                                        class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-4 py-3.5 text-sm font-semibold text-slate-900 focus:bg-white focus:border-[#028CD4] outline-none transition-all">
                                </div>

                                <!-- PIN Code -->
                                <div>
                                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">PIN Code</label>
                                    <input type="text" name="pincode" maxlength="6" placeholder="e.g. 800001"
                                        class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-4 py-3.5 text-sm font-semibold text-slate-900 focus:bg-white focus:border-[#028CD4] outline-none transition-all">
                                </div>
                            </div>
                        </div>

                        <!-- SECTION 3: STUDENT PHOTO -->
                        <div class="space-y-4 bg-slate-50/80 p-6 sm:p-8 rounded-3xl border border-slate-200">
                            <div class="flex items-center gap-3">
                                <span class="w-8 h-8 rounded-2xl bg-[#340C6F] text-white font-black text-sm flex items-center justify-center shadow-md">3</span>
                                <h3 class="text-base font-extrabold text-[#340C6F]">Student Photo</h3>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Option A: Image File Upload -->
                                <div>
                                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Upload Photo File</label>
                                    <input type="file" name="photo" accept="image/*"
                                        class="w-full bg-white border border-slate-300 rounded-2xl px-4 py-3.5 text-sm outline-none focus:border-[#028CD4]">
                                    <p class="text-[11px] text-slate-500 mt-1">Select an image from your device.</p>
                                </div>

                                <!-- Option B: Live Camera Capture -->
                                <!-- <div>
                                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Or Take Live Photo</label>
                                    
                                    <div x-show="!showCamera && !capturedImage">
                                        <button type="button" @click="openCamera()" class="w-full bg-[#028CD4] text-white py-3.5 rounded-2xl font-bold text-xs hover:bg-blue-600 transition shadow-sm flex items-center justify-center gap-2">
                                            <i class="fa-solid fa-camera text-sm"></i>
                                            <span>Open Camera</span>
                                        </button>
                                    </div>

                                    <div x-show="showCamera" class="space-y-3" style="display: none;">
                                        <video x-ref="video" autoplay playsinline class="w-full rounded-2xl bg-black h-44 object-cover border border-slate-300"></video>
                                        <div class="flex gap-2">
                                            <button type="button" @click="capturePhoto()" class="bg-green-600 text-white px-4 py-2 rounded-xl font-bold text-xs">Capture Photo</button>
                                            <button type="button" @click="stopCamera(); showCamera = false" class="bg-red-500 text-white px-4 py-2 rounded-xl font-bold text-xs">Cancel</button>
                                        </div>
                                    </div>

                                    <div x-show="capturedImage" class="space-y-2" style="display: none;">
                                        <img :src="capturedImage" class="w-24 h-24 object-cover rounded-2xl border-2 border-[#028CD4]" />
                                        <button type="button" @click="capturedImage = null; openCamera()" class="text-xs text-orange-600 font-bold hover:underline">Retake Photo</button>
                                    </div>
                                </div> -->
                            </div>
                        </div>

                        <!-- SECTION 4: PAYMENT QR CODE & SCREENSHOT -->
                        <div class="space-y-5 bg-orange-50/70 p-6 sm:p-8 rounded-3xl border border-orange-200">
                            <div class="flex items-center gap-3">
                                <span class="w-8 h-8 rounded-2xl bg-[#F1400C] text-white font-black text-sm flex items-center justify-center shadow-md">4</span>
                                <h3 class="text-base font-extrabold text-[#F1400C]">Fee Payment & Screenshot</h3>
                            </div>

                            <div class="flex flex-col sm:flex-row items-center gap-8">
                                <!-- QR Code Display -->
                                <div class="bg-white p-5 rounded-3xl border border-orange-300 shadow-md text-center shrink-0">
                                    <img src="{{ str_starts_with($paymentSetting->qr_code_image, 'http') ? $paymentSetting->qr_code_image : asset($paymentSetting->qr_code_image ?? 'images/quize.jpg') }}" 
                                         alt="Payment QR Code" class="w-44 h-44 object-contain mx-auto rounded-2xl">
                                    <div class="mt-3 font-mono font-black text-xs text-[#340C6F] bg-purple-50 px-3 py-1.5 rounded-xl border border-purple-100">
                                        UPI: {{ $paymentSetting->upi_id }}
                                    </div>
                                </div>

                                <!-- Fee Amount & Screenshot Field -->
                                <div class="space-y-5 flex-1">
                                    <div class="bg-white p-5 rounded-2xl border border-orange-200 space-y-1">
                                        <span class="text-xs font-bold text-slate-500 uppercase tracking-wider block">Registration Fee</span>
                                        <div class="text-4xl font-black text-[#F1400C]">₹<span x-text="currentFee"></span></div>
                                        <p class="text-xs text-slate-600 font-medium leading-relaxed pt-1">{{ $paymentSetting->instructions }}</p>
                                    </div>

                                    <div>
                                        <label class="block text-xs font-bold text-slate-800 uppercase tracking-wider mb-2">Upload Payment Screenshot *</label>
                                        <input type="file" name="payment_screenshot" required accept="image/*"
                                            class="w-full bg-white border border-slate-300 rounded-2xl px-4 py-3.5 text-sm font-semibold text-slate-900 focus:border-[#F1400C] outline-none transition-all">
                                        <p class="text-[11px] text-slate-500 mt-1">Upload the payment confirmation screenshot image</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- SUBMIT BUTTON -->
                        <div class="pt-4">
                            <button type="submit" 
                                class="w-full py-4 rounded-2xl bg-gradient-to-r from-[#F1400C] via-orange-600 to-[#F1400C] text-white font-black text-lg shadow-xl shadow-[#F1400C]/30 hover:scale-[1.01] active:scale-95 transition-all cursor-pointer">
                                Complete Registration
                            </button>
                        </div>

                    </form>
                </div>
            </div>

        </div>
    </section>
</x-app-layout>

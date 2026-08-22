<x-app-layout>
    <section class="py-16 bg-[#F8FAFC] min-h-screen text-slate-800">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 mt-10">

            <!-- Success Application Badge & Review Slip Banner -->
            @if(session('success_registration'))
                @php 
                    $reg = session('success_registration'); 
                    $regNo = is_array($reg) ? ($reg['registration_no'] ?? '') : ($reg->registration_no ?? '');
                    $rollNo = is_array($reg) ? ($reg['roll_no'] ?? '') : ($reg->roll_no ?? '');
                    $name = is_array($reg) ? ($reg['student_name'] ?? '') : ($reg->student_name ?? '');
                    $father = is_array($reg) ? ($reg['father_name'] ?? '') : ($reg->father_name ?? '');
                    $mobile = is_array($reg) ? ($reg['mobile'] ?? '') : ($reg->mobile ?? '');
                    $email = is_array($reg) ? ($reg['email'] ?? '') : ($reg->email ?? '');
                    $cls = is_array($reg) ? ($reg['student_class'] ?? '') : ($reg->student_class ?? '');
                    $dob = is_array($reg) ? ($reg['dob'] ?? '') : ($reg->dob ?? '');
                    $gender = is_array($reg) ? ($reg['gender'] ?? '') : ($reg->gender ?? '');
                    $category = is_array($reg) ? ($reg['category'] ?? '') : ($reg->category ?? '');
                    $school = is_array($reg) ? ($reg['school_name'] ?? '') : ($reg->school_name ?? '');
                    $address = is_array($reg) ? ($reg['address'] ?? '') : ($reg->address ?? '');
                    $pincode = is_array($reg) ? ($reg['pincode'] ?? '') : ($reg->pincode ?? '');
                    $photo = is_array($reg) ? ($reg['photo'] ?? '') : ($reg->photo ?? '');
                    $paymentImg = is_array($reg) ? ($reg['payment_screenshot'] ?? '') : ($reg->payment_screenshot ?? '');
                    $txn = is_array($reg) ? ($reg['transaction_id'] ?? '') : ($reg->transaction_id ?? '');
                    $feePaid = is_array($reg) ? ($reg['fee_paid'] ?? '') : ($reg->fee_paid ?? '');
                    $eventTitle = is_array($reg) ? ($reg['event']['title'] ?? ($reg->event->title ?? 'N/A')) : ($reg->event->title ?? 'N/A');
                    $groupName = is_array($reg) ? ($reg['group']['group_name'] ?? ($reg->group->group_name ?? 'N/A')) : ($reg->group->group_name ?? 'N/A');
                @endphp

                <div class="mb-10 rounded-3xl bg-white border border-emerald-200 shadow-2xl overflow-hidden print:shadow-none print:border-none">
                    <!-- Success Banner Header -->
                    <div class="p-6 sm:p-10 bg-gradient-to-r from-emerald-500 to-teal-600 text-white text-center space-y-4">
                        <div class="w-20 h-20 rounded-full bg-white/20 flex items-center justify-center mx-auto text-4xl shadow-inner">
                            <i class="fa-solid fa-circle-check"></i>
                        </div>
                        <h2 class="text-3xl sm:text-4xl font-black tracking-tight">REGISTRATION SUCCESSFUL!</h2>
                        <p class="text-emerald-100 text-sm sm:text-base max-w-md mx-auto font-medium">
                            Your application has been received successfully and sent to Admin for payment verification.
                        </p>
                        
                        <div class="inline-flex items-center gap-3 bg-white text-slate-900 px-8 py-3.5 rounded-2xl font-mono text-2xl sm:text-3xl font-black shadow-lg">
                            <span>REG NO:</span> <span class="text-[#F1400C]">{{ $regNo }}</span>
                        </div>
                    </div>

                    <!-- Submitted Application Review Details -->
                    <div class="p-6 sm:p-10 space-y-8 bg-slate-50/50">
                        <div class="flex flex-col sm:flex-row items-center justify-between border-b border-slate-200 pb-4 gap-4">
                            <div>
                                <h3 class="text-xl font-black text-[#340C6F] flex items-center gap-2">
                                    <i class="fa-solid fa-clipboard-check text-[#028CD4]"></i> Registration Review Summary
                                </h3>
                                <p class="text-xs text-slate-500 font-medium">Full details submitted for your application</p>
                            </div>
                            <button onclick="window.print()" class="px-5 py-2.5 rounded-xl bg-slate-900 text-white font-bold text-xs hover:bg-slate-800 transition flex items-center gap-2 shadow-md print:hidden">
                                <i class="fa-solid fa-print"></i> Print Review Slip
                            </button>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 items-start">
                            <!-- Photo & Badges -->
                            <div class="bg-white p-5 rounded-2xl border border-slate-200 text-center space-y-4 shadow-sm md:col-span-1">
                                @if($photo)
                                    <img src="{{ asset($photo) }}" alt="Student Photo" class="w-36 h-36 object-cover rounded-2xl mx-auto border-2 border-[#028CD4] shadow-md">
                                @else
                                    <div class="w-36 h-36 rounded-2xl bg-slate-100 flex items-center justify-center text-slate-400 mx-auto text-4xl border border-slate-200">
                                        <i class="fa-solid fa-user"></i>
                                    </div>
                                @endif
                                <div class="space-y-1.5">
                                    <span class="inline-block px-3 py-1 bg-amber-100 text-amber-800 rounded-full text-xs font-extrabold uppercase tracking-wide">
                                        Payment: Pending
                                    </span>
                                    <div class="text-xs font-mono font-bold text-slate-600">Fee Paid: ₹{{ $feePaid }}</div>
                                </div>
                            </div>

                            <!-- Detail Grid -->
                            <div class="md:col-span-3 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 text-xs sm:text-sm">
                                <div class="bg-white p-3.5 rounded-xl border border-slate-200 shadow-sm">
                                    <span class="text-slate-500 font-bold block text-[11px] uppercase tracking-wider">Student Name</span>
                                    <span class="font-extrabold text-slate-900 text-base">{{ $name }}</span>
                                </div>
                                <div class="bg-white p-3.5 rounded-xl border border-slate-200 shadow-sm">
                                    <span class="text-slate-500 font-bold block text-[11px] uppercase tracking-wider">Father's Name</span>
                                    <span class="font-extrabold text-slate-900">{{ $father }}</span>
                                </div>
                                <div class="bg-white p-3.5 rounded-xl border border-slate-200 shadow-sm">
                                    <span class="text-slate-500 font-bold block text-[11px] uppercase tracking-wider">Mobile Number</span>
                                    <span class="font-extrabold text-slate-900">{{ $mobile }}</span>
                                </div>
                                <div class="bg-white p-3.5 rounded-xl border border-slate-200 shadow-sm">
                                    <span class="text-slate-500 font-bold block text-[11px] uppercase tracking-wider">Email Address</span>
                                    <span class="font-bold text-slate-800">{{ $email ?: 'N/A' }}</span>
                                </div>
                                <div class="bg-white p-3.5 rounded-xl border border-slate-200 shadow-sm">
                                    <span class="text-slate-500 font-bold block text-[11px] uppercase tracking-wider">Event</span>
                                    <span class="font-extrabold text-[#340C6F]">{{ $eventTitle }}</span>
                                </div>
                                <div class="bg-white p-3.5 rounded-xl border border-slate-200 shadow-sm">
                                    <span class="text-slate-500 font-bold block text-[11px] uppercase tracking-wider">Class & Group Tier</span>
                                    <span class="font-bold text-slate-900">{{ $cls }} ({{ $groupName }})</span>
                                </div>
                                <div class="bg-white p-3.5 rounded-xl border border-slate-200 shadow-sm">
                                    <span class="text-slate-500 font-bold block text-[11px] uppercase tracking-wider">Date of Birth</span>
                                    <span class="font-bold text-slate-900">{{ $dob }}</span>
                                </div>
                                <div class="bg-white p-3.5 rounded-xl border border-slate-200 shadow-sm">
                                    <span class="text-slate-500 font-bold block text-[11px] uppercase tracking-wider">Gender & Category</span>
                                    <span class="font-bold text-slate-900">{{ $gender }} / {{ $category }}</span>
                                </div>
                                <div class="bg-white p-3.5 rounded-xl border border-slate-200 shadow-sm sm:col-span-2 lg:col-span-1">
                                    <span class="text-slate-500 font-bold block text-[11px] uppercase tracking-wider">School / Coaching</span>
                                    <span class="font-bold text-slate-900">{{ $school ?: 'N/A' }}</span>
                                </div>
                                <div class="bg-white p-3.5 rounded-xl border border-slate-200 shadow-sm sm:col-span-2 lg:col-span-3">
                                    <span class="text-slate-500 font-bold block text-[11px] uppercase tracking-wider">Address</span>
                                    <span class="font-bold text-slate-900">{{ $address }} {{ $pincode ? ' - '.$pincode : '' }}</span>
                                </div>
                                <div class="bg-orange-50 p-3.5 rounded-xl border border-orange-200 sm:col-span-2 lg:col-span-3 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-3">
                                    <div>
                                        <span class="text-slate-500 font-bold block text-[11px] uppercase tracking-wider">Transaction ID / UTR</span>
                                        <span class="font-mono font-extrabold text-slate-900 text-base">{{ $txn }}</span>
                                    </div>
                                    @if($paymentImg)
                                        <a href="{{ asset($paymentImg) }}" target="_blank" class="px-3 py-1.5 bg-white border border-orange-300 rounded-lg text-xs text-[#F1400C] font-bold hover:bg-orange-100 transition shadow-sm flex items-center gap-1">
                                            <i class="fa-solid fa-image"></i> View Payment Screenshot
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="text-center text-xs text-slate-500 font-medium pt-2">
                            Please save or note down this Registration Number for competition day and admit cards.
                        </div>
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
                            
                            showReviewModal: false,
                            isSubmitting: false,
                            photoPreviewUrl: '',
                            paymentPreviewUrl: '',
                            reviewData: {},

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
                                
                                if(rangeStr.includes(',') || rangeStr.includes('&') || rangeStr.includes('and')) {
                                    allowedClasses = allClasses.filter(c => {
                                        const match = c.match(/\d+/);
                                        const cNum = match ? match[0] : null;
                                        return numbers.includes(cNum);
                                    });
                                } else {
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
                            },

                            openReviewModal() {
                                const form = this.$refs.regForm;
                                if (!form.checkValidity()) {
                                    form.reportValidity();
                                    return;
                                }

                                if (form.terms && !form.terms.checked) {
                                    alert('Please accept the Terms & Conditions to proceed.');
                                    return;
                                }

                                // Photo preview
                                if (form.photo && form.photo.files && form.photo.files[0]) {
                                    this.photoPreviewUrl = URL.createObjectURL(form.photo.files[0]);
                                } else if (this.capturedImage) {
                                    this.photoPreviewUrl = this.capturedImage;
                                } else {
                                    this.photoPreviewUrl = '';
                                }

                                // Payment screenshot preview
                                if (form.payment_screenshot && form.payment_screenshot.files && form.payment_screenshot.files[0]) {
                                    this.paymentPreviewUrl = URL.createObjectURL(form.payment_screenshot.files[0]);
                                } else {
                                    this.paymentPreviewUrl = '';
                                }

                                const ev = this.selectedEvent;
                                const grp = this.availableGroups.find(g => g.id == this.selectedGroupId);

                                this.reviewData = {
                                    event_title: ev ? ev.title : '',
                                    category_name: ev ? ev.category : '',
                                    group_name: grp ? (grp.group_name + ' (₹' + grp.fee + ')') : 'Default Group',
                                    student_name: form.student_name ? form.student_name.value : '',
                                    father_name: form.father_name ? form.father_name.value : '',
                                    mobile: form.mobile ? form.mobile.value : '',
                                    email: form.email ? form.email.value : '',
                                    student_class: form.student_class ? form.student_class.value : '',
                                    dob: form.dob ? form.dob.value : '',
                                    gender: form.gender ? form.gender.value : '',
                                    category: form.category ? form.category.value : '',
                                    school_name: (form.school_name && form.school_name.value) ? form.school_name.value : '',
                                    address: form.address ? form.address.value : '',
                                    pincode: (form.pincode && form.pincode.value) ? form.pincode.value : '',
                                    transaction_id: form.transaction_id ? form.transaction_id.value : '',
                                    fee: this.currentFee
                                };

                                this.showReviewModal = true;
                            },

                            submitForm() {
                                this.isSubmitting = true;
                                this.$refs.regForm.submit();
                            }
                        }));
                    });
                </script>

                <div 
                    x-data="registrationForm()" 
                    class="p-6 sm:p-10 space-y-10 relative"
                >
                    <form x-ref="regForm" method="POST" action="{{ url('/register') }}" class="space-y-10" enctype="multipart/form-data">
                        @csrf
                        
                        @if ($errors->any())
                            <div class="bg-red-50 border border-red-200 text-red-600 px-6 py-4 rounded-2xl mb-6">
                                <h4 class="font-bold mb-2">Please fix the following errors:</h4>
                                <ul class="list-disc list-inside text-sm font-medium space-y-1">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        
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
                                <h3 class="text-base font-extrabold text-[#340C6F]">Student Photo *</h3>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Image File Upload -->
                                <div>
                                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Upload Photo File *</label>
                                    <input type="file" name="photo" accept="image/*" required
                                        class="w-full bg-white border border-slate-300 rounded-2xl px-4 py-3.5 text-sm outline-none focus:border-[#028CD4]">
                                    <p class="text-[11px] text-slate-500 mt-1">Select a passport-size photo from your device (Required for Admit Card).</p>
                                    @error('photo')
                                        <p class="text-xs text-red-500 font-bold mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
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
                                <div class="bg-white p-5 rounded-3xl border border-orange-300 shadow-md text-center shrink-0 flex flex-col items-center w-full sm:w-auto">
                                    <img src="{{ str_starts_with($paymentSetting->qr_code_image, 'http') ? $paymentSetting->qr_code_image : asset($paymentSetting->qr_code_image ?? 'images/quize.jpg') }}" 
                                         alt="Payment QR Code" class="w-44 h-44 object-contain mx-auto rounded-2xl">
                                    <div class="mt-3 font-mono font-black text-xs text-[#340C6F] bg-purple-50 px-3 py-1.5 rounded-xl border border-purple-100 w-full">
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
                                        <label class="block text-xs font-bold text-slate-800 uppercase tracking-wider mb-2">Transaction ID / UTR Number *</label>
                                        <input type="text" name="transaction_id" required value="{{ old('transaction_id') }}" placeholder="e.g. 3182XXXXXXXX"
                                            class="w-full bg-white border border-slate-300 rounded-2xl px-4 py-3.5 text-sm font-semibold text-slate-900 focus:border-[#F1400C] outline-none transition-all">
                                        @error('transaction_id')
                                            <p class="text-xs text-red-500 font-bold mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div>
                                        <label class="block text-xs font-bold text-slate-800 uppercase tracking-wider mb-2">Upload Payment Screenshot *</label>
                                        <input type="file" name="payment_screenshot" required accept="image/*"
                                            class="w-full bg-white border border-slate-300 rounded-2xl px-4 py-3.5 text-sm font-semibold text-slate-900 focus:border-[#F1400C] outline-none transition-all">
                                        <p class="text-[11px] text-slate-500 mt-1">Upload the payment confirmation screenshot image</p>
                                        @error('payment_screenshot')
                                            <p class="text-xs text-red-500 font-bold mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- TERMS & CONDITIONS CHECKBOX -->
                        <div class="pt-6 pb-2">
                            <label class="flex items-start gap-3 cursor-pointer group">
                                <div class="relative flex items-center justify-center mt-0.5">
                                    <input type="checkbox" name="terms" required class="peer appearance-none w-5 h-5 border-2 border-slate-300 rounded-md checked:bg-[#F1400C] checked:border-[#F1400C] transition-colors cursor-pointer focus:ring-2 focus:ring-[#F1400C]/20 outline-none">
                                    <i class="fa-solid fa-check absolute text-white text-[10px] opacity-0 peer-checked:opacity-100 pointer-events-none transition-opacity"></i>
                                </div>
                                <span class="text-sm font-semibold text-slate-700 leading-snug select-none group-hover:text-slate-900 transition-colors">
                                    I have read and agree to the <a href="{{ url('/terms') }}" target="_blank" class="text-[#F1400C] hover:underline">Terms & Conditions, Privacy & Refund Policy</a>.
                                </span>
                            </label>
                        </div>

                        <!-- REVIEW & SUBMIT BUTTON -->
                        <div class="pt-4">
                            <button type="button" @click="openReviewModal()"
                                style="background-color: #F1400C; color: #ffffff;"
                                class="w-full py-4 rounded-2xl text-white font-black text-lg shadow-xl shadow-orange-500/30 hover:bg-orange-600 active:scale-95 transition-all cursor-pointer flex items-center justify-center gap-3">
                                <i class="fa-solid fa-magnifying-glass text-xl text-white"></i>
                                <span class="text-white">Review & Complete Registration</span>
                            </button>
                        </div>

                    </form>

                    <!-- PRE-SUBMISSION REVIEW MODAL -->
                    <div x-show="showReviewModal" style="display: none;"
                         class="fixed inset-0 z-50 overflow-y-auto bg-slate-900/80 backdrop-blur-md flex items-center justify-center p-4 sm:p-6">

                        <div class="bg-white w-full max-w-3xl rounded-3xl shadow-2xl border border-slate-200 overflow-hidden my-8 transform transition-all">
                            <!-- Modal Header -->
                            <div class="bg-gradient-to-r from-[#340C6F] via-purple-900 to-[#028CD4] text-white p-6 sm:p-8 flex items-center justify-between">
                                <div>
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-white/20 rounded-full text-xs font-black tracking-wider uppercase mb-1">
                                        <i class="fa-solid fa-eye"></i> Step: Final Review
                                    </span>
                                    <h3 class="text-2xl sm:text-3xl font-black">Review Filled Information</h3>
                                    <p class="text-xs text-purple-200 mt-1 font-medium">Please review all details before final submission.</p>
                                </div>
                                <button type="button" @click="showReviewModal = false" class="w-10 h-10 rounded-2xl bg-white/10 hover:bg-white/20 text-white flex items-center justify-center text-lg transition">
                                    <i class="fa-solid fa-xmark"></i>
                                </button>
                            </div>

                            <!-- Modal Body -->
                            <div class="p-6 sm:p-8 max-h-[65vh] overflow-y-auto space-y-6">

                                <!-- Competition & Tier -->
                                <div class="bg-blue-50/70 p-4 sm:p-5 rounded-2xl border border-blue-100 space-y-2">
                                    <h4 class="text-xs font-black text-[#340C6F] uppercase tracking-wider flex items-center gap-2">
                                        <i class="fa-solid fa-trophy text-[#028CD4]"></i> Selected Competition & Class Tier
                                    </h4>
                                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm">
                                        <div>
                                            <span class="text-xs text-slate-500 block font-bold">Event Title</span>
                                            <span class="font-extrabold text-slate-900" x-text="reviewData.event_title"></span>
                                        </div>
                                        <div>
                                            <span class="text-xs text-slate-500 block font-bold">Class Group & Fee</span>
                                            <span class="font-extrabold text-[#F1400C]" x-text="reviewData.group_name"></span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Personal Information -->
                                <div class="bg-slate-50 p-4 sm:p-5 rounded-2xl border border-slate-200 space-y-3">
                                    <h4 class="text-xs font-black text-[#340C6F] uppercase tracking-wider flex items-center gap-2">
                                        <i class="fa-solid fa-user text-[#340C6F]"></i> Student Personal Details
                                    </h4>
                                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 text-xs sm:text-sm">
                                        <div>
                                            <span class="text-slate-500 block font-bold">Student Name</span>
                                            <span class="font-black text-slate-900 text-base" x-text="reviewData.student_name"></span>
                                        </div>
                                        <div>
                                            <span class="text-slate-500 block font-bold">Father's Name</span>
                                            <span class="font-bold text-slate-900" x-text="reviewData.father_name"></span>
                                        </div>
                                        <div>
                                            <span class="text-slate-500 block font-bold">Mobile Number</span>
                                            <span class="font-bold text-slate-900" x-text="reviewData.mobile"></span>
                                        </div>
                                        <div>
                                            <span class="text-slate-500 block font-bold">Email Address</span>
                                            <span class="font-semibold text-slate-800" x-text="reviewData.email || 'N/A'"></span>
                                        </div>
                                        <div>
                                            <span class="text-slate-500 block font-bold">Class</span>
                                            <span class="font-bold text-slate-900" x-text="reviewData.student_class"></span>
                                        </div>
                                        <div>
                                            <span class="text-slate-500 block font-bold">Date of Birth</span>
                                            <span class="font-bold text-slate-900" x-text="reviewData.dob"></span>
                                        </div>
                                        <div>
                                            <span class="text-slate-500 block font-bold">Gender</span>
                                            <span class="font-bold text-slate-900" x-text="reviewData.gender"></span>
                                        </div>
                                        <div>
                                            <span class="text-slate-500 block font-bold">Category</span>
                                            <span class="font-bold text-slate-900" x-text="reviewData.category"></span>
                                        </div>
                                    </div>
                                </div>

                                <!-- School & Address -->
                                <div class="bg-slate-50 p-4 sm:p-5 rounded-2xl border border-slate-200 space-y-3">
                                    <h4 class="text-xs font-black text-[#340C6F] uppercase tracking-wider flex items-center gap-2">
                                        <i class="fa-solid fa-school text-[#340C6F]"></i> School & Address Details
                                    </h4>
                                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-xs sm:text-sm">
                                        <div class="sm:col-span-2">
                                            <span class="text-slate-500 block font-bold">School / Coaching Name</span>
                                            <span class="font-bold text-slate-900" x-text="reviewData.school_name || 'N/A'"></span>
                                        </div>
                                        <div>
                                            <span class="text-slate-500 block font-bold">Full Address</span>
                                            <span class="font-bold text-slate-900" x-text="reviewData.address"></span>
                                        </div>
                                        <div>
                                            <span class="text-slate-500 block font-bold">PIN Code</span>
                                            <span class="font-bold text-slate-900" x-text="reviewData.pincode || 'N/A'"></span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Photo & Payment Proof -->
                                <div class="bg-orange-50/70 p-4 sm:p-5 rounded-2xl border border-orange-200 space-y-3">
                                    <h4 class="text-xs font-black text-[#F1400C] uppercase tracking-wider flex items-center gap-2">
                                        <i class="fa-solid fa-receipt text-[#F1400C]"></i> Photo & Payment Upload Review
                                    </h4>
                                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 text-xs sm:text-sm">
                                        <div>
                                            <span class="text-slate-500 block font-bold mb-2">Student Photo Attached</span>
                                            <template x-if="photoPreviewUrl">
                                                <img :src="photoPreviewUrl" class="w-28 h-28 object-cover rounded-2xl border-2 border-purple-500 shadow-md">
                                            </template>
                                            <template x-if="!photoPreviewUrl">
                                                <span class="text-xs text-red-500 font-bold">No photo attached</span>
                                            </template>
                                        </div>

                                        <div class="space-y-3">
                                            <div>
                                                <span class="text-slate-500 block font-bold">Transaction ID / UTR</span>
                                                <span class="font-mono font-black text-slate-900 bg-white px-3 py-1 rounded-lg border border-slate-300 inline-block mt-1 text-sm" x-text="reviewData.transaction_id"></span>
                                            </div>
                                            <div>
                                                <span class="text-slate-500 block font-bold mb-1.5">Payment Screenshot</span>
                                                <template x-if="paymentPreviewUrl">
                                                    <img :src="paymentPreviewUrl" class="w-36 h-24 object-cover rounded-xl border border-slate-300 shadow-sm">
                                                </template>
                                                <template x-if="!paymentPreviewUrl">
                                                    <span class="text-xs text-red-500 font-bold">No screenshot attached</span>
                                                </template>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <!-- Modal Actions -->
                            <div class="bg-slate-100 p-5 sm:p-6 border-t border-slate-200 flex flex-col sm:flex-row items-center justify-between gap-4">
                                <button type="button" @click="showReviewModal = false" 
                                    style="background-color: #ffffff; color: #1e293b; border: 1px solid #cbd5e1;"
                                    class="w-full sm:w-auto px-6 py-3.5 rounded-2xl font-bold text-sm hover:bg-slate-50 transition shadow-sm flex items-center justify-center gap-2 cursor-pointer">
                                    <i class="fa-solid fa-pen-to-square"></i> Edit Details
                                </button>

                                <button type="button" @click="submitForm()" :disabled="isSubmitting"
                                    style="background-color: #059669; color: #ffffff;"
                                    class="w-full sm:w-auto px-8 py-3.5 rounded-2xl text-white font-black text-base shadow-xl hover:bg-emerald-700 active:scale-95 transition flex items-center justify-center gap-2 cursor-pointer disabled:opacity-50">
                                    <span x-show="!isSubmitting" class="flex items-center gap-2 text-white"><i class="fa-solid fa-circle-check text-white"></i> Confirm & Final Submit</span>
                                    <span x-show="isSubmitting" class="flex items-center gap-2 text-white"><i class="fa-solid fa-circle-notch fa-spin text-white"></i> Submitting...</span>
                                </button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </section>
</x-app-layout>

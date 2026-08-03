<x-app-layout>
    <section class="py-16 bg-gray-50">
        <div class="max-w-4xl mx-auto px-6">
            <div class="bg-white rounded-3xl shadow-lg overflow-hidden">
                <!-- Header -->
                <div class="bg-[#028CD4] text-white p-8 text-center">
                    <h2 class="text-4xl font-bold">Competition Registration</h2>
                    <p class="mt-2 text-blue-100">Fill your details carefully before submitting.</p>
                </div>

                <!-- Form -->
                <div x-data="{
                        name: '', fatherName: '', mobile: '', email: '', school: '',
                        classLevel: '', dob: '', address: '', pincode: '',
                        showCamera: false, capturedImage: null, stream: null,
                        errors: {},
                        validate() {
                            this.errors = {};
                            if(!this.name) this.errors.name = 'Student Name is required';
                            if(!this.mobile) this.errors.mobile = 'Mobile Number is required';
                            if(!this.dob) this.errors.dob = 'Date of Birth is required';
                            if(!this.address) this.errors.address = 'Address is required';
                            if(!this.pincode) {
                                this.errors.pincode = 'PIN Code is required';
                            } else if(!/^[0-9]{6}$/.test(this.pincode)) {
                                this.errors.pincode = 'Enter a valid 6-digit PIN Code';
                            }
                            return Object.keys(this.errors).length === 0;
                        },
                        submit() {
                            if(this.validate()) {
                                console.log({
                                    name: this.name, fatherName: this.fatherName,
                                    mobile: this.mobile, email: this.email,
                                    school: this.school, classLevel: this.classLevel,
                                    dob: this.dob, address: this.address, pincode: this.pincode,
                                    image: this.capturedImage
                                });
                                alert('Registration Submitted!');
                            }
                        },
                        openCamera() {
                            this.showCamera = true;
                            navigator.mediaDevices.getUserMedia({ video: { facingMode: 'user' } })
                                .then(stream => {
                                    this.stream = stream;
                                    this.$refs.video.srcObject = stream;
                                })
                                .catch(err => {
                                    console.error('Camera error: ', err);
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
                    }" 
                    class="p-8">
                    
                    <form @submit.prevent="submit" class="grid md:grid-cols-2 gap-5">
                        
                        <div>
                            <label class="font-semibold">Student Name</label>
                            <input type="text" placeholder="Raju kumar" x-model="name" class="w-full mt-2 p-3 border-2 border-gray-200 outline-[#028CD4] rounded-xl">
                            <p x-show="errors.name" x-text="errors.name" class="text-red-500 text-sm mt-1"></p>
                        </div>

                        <div>
                            <label class="font-semibold">Father's Name</label>
                            <input type="text" placeholder="Rajesh Singh" x-model="fatherName" class="w-full mt-2 p-3 border-2 border-gray-200 outline-[#028CD4] rounded-xl">
                        </div>

                        <div>
                            <label class="font-semibold">Mobile Number</label>
                            <input type="tel" placeholder="+91534*****" x-model="mobile" class="w-full mt-2 p-3 border-2 border-gray-200 outline-[#028CD4] rounded-xl">
                            <p x-show="errors.mobile" x-text="errors.mobile" class="text-red-500 text-sm mt-1"></p>
                        </div>

                        <div>
                            <label class="font-semibold">Email</label>
                            <input type="email" placeholder="123@gmail.com" x-model="email" class="w-full mt-2 p-3 border-2 border-gray-200 outline-[#028CD4] rounded-xl">
                        </div>

                        <div>
                            <label class="font-semibold">School Name</label>
                            <input type="text" placeholder="ABC School" x-model="school" class="w-full mt-2 p-3 border-2 border-gray-200 outline-[#028CD4] rounded-xl">
                        </div>

                        <div>
                            <label class="font-semibold">Class</label>
                            <select x-model="classLevel" class="w-full mt-2 p-3 border-2 border-gray-200 outline-[#028CD4] rounded-xl">
                                <option value="">Select Class</option>
                                <option>5</option><option>6</option><option>7</option>
                                <option>8</option><option>9</option><option>10</option>
                                <option>11</option><option>12</option>
                            </select>
                        </div>

                        <div>
                            <label class="font-semibold">Date of Birth</label>
                            <input type="date" x-model="dob" class="w-full mt-2 p-3 border-2 border-gray-200 outline-[#028CD4] rounded-xl">
                            <p x-show="errors.dob" x-text="errors.dob" class="text-red-500 text-sm mt-1"></p>
                        </div>

                        <div>
                            <label class="font-semibold">Address</label>
                            <input type="text" placeholder="Patna Nashariganj" x-model="address" class="w-full mt-2 p-3 border-2 border-gray-200 outline-[#028CD4] rounded-xl">
                            <p x-show="errors.address" x-text="errors.address" class="text-red-500 text-sm mt-1"></p>
                        </div>

                        <div>
                            <label class="font-semibold">PIN Code</label>
                            <input type="text" placeholder="Pin-424543" maxlength="6" x-model="pincode" class="w-full mt-2 p-3 border-2 border-gray-200 outline-[#028CD4] rounded-xl">
                            <p x-show="errors.pincode" x-text="errors.pincode" class="text-red-500 text-sm mt-1"></p>
                        </div>

                        <div class="md:col-span-2 mt-4">
                            <label class="font-semibold block mb-3">Student Photo</label>
                            
                            <div class="grid md:grid-cols-2 gap-6">
                                <!-- Upload From Device -->
                                <div>
                                    <label class="block text-sm font-medium mb-2">Upload From Device</label>
                                    <input type="file" accept="image/*" class="w-full p-3 border-2 rounded-xl border-gray-200">
                                </div>

                                <!-- Live Camera -->
                                <div>
                                    <label class="block text-sm font-medium mb-2">Take Live Photo</label>

                                    <div x-show="!showCamera && !capturedImage">
                                        <button type="button" @click="openCamera()" class="bg-[#028CD4] text-white px-4 py-2 rounded-xl hover:bg-[#0177b4] transition">
                                            Open Camera
                                        </button>
                                    </div>

                                    <div x-show="showCamera" class="space-y-3">
                                        <video x-ref="video" autoplay playsinline class="w-full rounded-xl border bg-black"></video>
                                        <div class="flex gap-2">
                                            <button type="button" @click="capturePhoto()" class="bg-green-600 text-white px-4 py-2 rounded-xl hover:bg-green-700 transition">
                                                Capture Photo
                                            </button>
                                            <button type="button" @click="stopCamera(); showCamera = false" class="bg-red-500 text-white px-4 py-2 rounded-xl hover:bg-red-600 transition">
                                                Cancel
                                            </button>
                                        </div>
                                    </div>

                                    <div x-show="capturedImage" class="space-y-3" style="display: none;">
                                        <img :src="capturedImage" alt="Captured" class="w-40 h-40 object-cover rounded-xl border">
                                        <button type="button" @click="capturedImage = null; openCamera()" class="bg-orange-500 text-white px-4 py-2 rounded-xl hover:bg-orange-600 transition">
                                            Retake Photo
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="md:col-span-2 mt-6">
                            <button type="submit" class="w-full bg-[#F1400C] hover:bg-orange-700 text-white py-4 rounded-xl font-bold transition">
                                Register
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>

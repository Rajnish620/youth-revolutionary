<div class="max-w-4xl mx-auto bg-white/90 backdrop-blur-md rounded-3xl p-8 md:p-10" x-data="{
    formData: {
        name: '',
        school: '',
        className: '',
        mobile: '',
        email: '',
        paymentMethod: '',
        transactionId: ''
    },
    submitForm() {
        if (!this.formData.name || !this.formData.school || !this.formData.className || !this.formData.mobile || !this.formData.email || !this.formData.paymentMethod || !this.formData.transactionId) {
            alert('Please fill out all fields');
            return;
        }
        console.log(this.formData);
        alert('Registration Successful!');
        this.formData = {
            name: '', school: '', className: '', mobile: '', email: '', paymentMethod: '', transactionId: ''
        };
    }
}">
    <form @submit.prevent="submitForm">
        <div class="grid md:grid-cols-2 gap-5">
            <!-- Student Name -->
            <div>
                <input type="text" placeholder="Student Name" required minlength="3" x-model="formData.name"
                    class="w-full border-2 focus:outline-[#028CD4] border-gray-100 p-3 rounded-xl" />
            </div>

            <!-- School Name -->
            <div>
                <input type="text" placeholder="School Name" required x-model="formData.school"
                    class="w-full border-2 focus:outline-[#028CD4] border-gray-100 p-3 rounded-xl" />
            </div>

            <!-- Class -->
            <div>
                <input type="text" placeholder="Class" required x-model="formData.className"
                    class="w-full border-2 focus:outline-[#028CD4] border-gray-100 p-3 rounded-xl" />
            </div>

            <!-- Mobile -->
            <div>
                <input type="tel" placeholder="Registration Number" required pattern="[0-9]{12}" x-model="formData.mobile"
                    class="w-full border-2 focus:outline-[#028CD4] border-gray-100 p-3 rounded-xl" />
            </div>

            <!-- Email -->
            <div class="md:col-span-2">
                <input type="email" placeholder="Email Address" required x-model="formData.email"
                    class="w-full border-2 focus:outline-[#028CD4] border-gray-100 p-3 rounded-xl" />
            </div>
        </div>

        <!-- Payment Information -->
        <div class="bg-white rounded-2xl p-6 mb-6 mt-6 border">
            <h3 class="text-xl font-semibold text-[#028CD4] mb-5">Payment Information</h3>
            <div class="grid md:grid-cols-2 gap-5">
                <!-- Competition Fee -->
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-600">Competition Fee</label>
                    <input type="text" value="₹200" readonly
                        class="w-full border-2 border-gray-100 bg-gray-50 p-3 rounded-xl font-semibold" />
                </div>

                <!-- Payment Method -->
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-600">Payment Method</label>
                    <select required x-model="formData.paymentMethod"
                        class="w-full border-2 border-gray-100 p-3 rounded-xl focus:outline-none focus:border-[#028CD4]">
                        <option value="">Select Payment Method</option>
                        <option value="upi">UPI</option>
                        <option value="card">Debit/Credit Card</option>
                        <option value="netbanking">Net Banking</option>
                    </select>
                </div>

                <!-- Transaction ID -->
                <div class="md:col-span-2">
                    <label class="block mb-2 text-sm font-medium text-gray-600">Transaction ID</label>
                    <input type="text" placeholder="Enter Transaction ID" required x-model="formData.transactionId"
                        class="w-full border-2 border-gray-100 p-3 rounded-xl focus:outline-none focus:border-[#028CD4]" />
                </div>
            </div>
        </div>

        <!-- Submit Button -->
        <button type="submit"
            class="w-full bg-[#028CD4] text-white py-4 rounded-xl font-semibold text-lg hover:bg-[#0174b1] transition duration-300 shadow-lg">
            Pay & Register
        </button>
    </form>
</div>

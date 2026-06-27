import { useForm } from "react-hook-form";

function CompetitionsForm() {

    const {
        register,
        handleSubmit,
        formState: { errors },
    } = useForm();

    const onSubmit = (data) => {
        console.log(data);
        alert("Registration Successful!");
    };
    return (
        <div>

            <div className="max-w-4xl mx-auto bg-white/90 backdrop-blur-md rounded-3xl  p-8 md:p-10">
                {/* Form */}


                <form onSubmit={handleSubmit(onSubmit)}>
                    <div className="grid md:grid-cols-2 gap-5">

                        {/* Student Name */}
                        <div>
                            <input
                                type="text"
                                placeholder="Student Name"
                                className="w-full border-2 focus:outline-blue-500 border-gray-100 p-3 rounded-xl"
                                {...register("name", {
                                    required: "Student Name is required",
                                    minLength: {
                                        value: 3,
                                        message: "Minimum 3 characters required",
                                    },
                                })}
                            />
                            {errors.name && (
                                <p className="text-red-500 text-sm mt-1">
                                    {errors.name.message}
                                </p>
                            )}
                        </div>

                        {/* School Name */}
                        <div>
                            <input
                                type="text"
                                placeholder="School Name"
                                className="w-full  border-2 focus:outline-blue-500 border-gray-100  p-3 rounded-xl"
                                {...register("school", {
                                    required: "School Name is required",
                                })}
                            />
                            {errors.school && (
                                <p className="text-red-500 text-sm mt-1">
                                    {errors.school.message}
                                </p>
                            )}
                        </div>

                        {/* Class */}
                        <div>
                            <input
                                type="text"
                                placeholder="Class"
                                className="w-full  border-2 focus:outline-blue-500 border-gray-100  p-3 rounded-xl"
                                {...register("className", {
                                    required: "Class is required",
                                })}
                            />
                            {errors.className && (
                                <p className="text-red-500 text-sm mt-1">
                                    {errors.className.message}
                                </p>
                            )}
                        </div>

                        {/* Mobile */}
                        <div>
                            <input
                                type="tel"
                                placeholder="Registration Number"
                                className="w-full  border-2 focus:outline-blue-500 border-gray-100  p-3 rounded-xl"
                                {...register("mobile", {
                                    required: "Registration Number is required",
                                    pattern: {
                                        value: /^[0-9]{12}$/,
                                        message: "Enter valid 10 digit mobile number",
                                    },
                                })}
                            />
                            {errors.mobile && (
                                <p className="text-red-500 text-sm mt-1">
                                    {errors.mobile.message}
                                </p>
                            )}
                        </div>

                        {/* Email */}
                        <div className="md:col-span-2">
                            <input
                                type="email"
                                placeholder="Email Address"
                                className="w-full  border-2  focus:outline-blue-400 border-gray-100  p-3 rounded-xl"
                                {...register("email", {
                                    required: "Email is required",
                                    pattern: {
                                        value:
                                            /^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,}$/i,
                                        message: "Invalid email address",
                                    },
                                })}
                            />
                            {errors.email && (
                                <p className="text-red-500 text-sm mt-1">
                                    {errors.email.message}
                                </p>
                            )}
                        </div>
                    </div>









                    {/* Payment Information */}
                    <div className="bg-white rounded-2xl  p-6 mb-6">
                        <h3 className="text-xl font-semibold text-[#028CD4] mb-5">
                            Payment Information
                        </h3>

                        <div className="grid md:grid-cols-2 gap-5">
                            {/* Competition Fee */}
                            <div>
                                <label className="block mb-2 text-sm font-medium text-gray-600">
                                    Competition Fee
                                </label>

                                <input
                                    type="text"
                                    value="₹200"
                                    readOnly
                                    className="w-full border-2 border-gray-100 bg-gray-50 p-3 rounded-xl font-semibold"
                                />
                            </div>

                            {/* Payment Method */}
                            <div>
                                <label className="block mb-2 text-sm font-medium text-gray-600">
                                    Payment Method
                                </label>

                                <select
                                    className="w-full border-2 border-gray-100 p-3 rounded-xl focus:outline-none focus:border-[#028CD4]"
                                    {...register("paymentMethod", {
                                        required: "Please select payment method",
                                    })}
                                >
                                    <option value="">Select Payment Method</option>
                                    <option value="upi">UPI</option>
                                    <option value="card">Debit/Credit Card</option>
                                    <option value="netbanking">Net Banking</option>
                                </select>

                                {errors.paymentMethod && (
                                    <p className="text-red-500 text-sm mt-1">
                                        {errors.paymentMethod.message}
                                    </p>
                                )}
                            </div>

                            {/* Transaction ID */}
                            <div className="md:col-span-2">
                                <label className="block mb-2 text-sm font-medium text-gray-600">
                                    Transaction ID
                                </label>

                                <input
                                    type="text"
                                    placeholder="Enter Transaction ID"
                                    className="w-full border-2 border-gray-100 p-3 rounded-xl focus:outline-none focus:border-[#028CD4]"
                                    {...register("transactionId", {
                                        required: "Transaction ID is required",
                                    })}
                                />

                                {errors.transactionId && (
                                    <p className="text-red-500 text-sm mt-1">
                                        {errors.transactionId.message}
                                    </p>
                                )}
                            </div>
                        </div>
                    </div>

                    {/* Submit Button */}
                    <button
                        type="submit"
                        className="w-full bg-[#028CD4] text-white py-4 rounded-xl font-semibold text-lg hover:bg-[#0174b1] transition duration-300 shadow-lg"
                    >
                        Pay & Register
                    </button>
                </form>

            </div>


        </div>
    )
}

export default CompetitionsForm
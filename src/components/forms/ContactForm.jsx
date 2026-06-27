import { useForm } from "react-hook-form";

function ContactForm() {

   const {
    register,
    handleSubmit,
    reset,
    formState: { errors },
  } = useForm();

  const onSubmit = (data) => {
    console.log(data);
    alert("Message Sent Successfully!");
    reset();
  };
  return (

      <div className="bg-white p-8 ">

            
            <form
              onSubmit={handleSubmit(onSubmit)}
              className="space-y-5"
            >

              {/* Name */}
              <div>
                <input
                  type="text"
                  placeholder="Full Name"
                  className="w-full border-2 border-gray-200 p-4 rounded-xl focus:border-[#028CD4] outline-none"
                  {...register("name", {
                    required: "Name is required",
                  })}
                />

                {errors.name && (
                  <p className="text-red-500 mt-1">
                    {errors.name.message}
                  </p>
                )}
              </div>

              {/* Email */}
              <div>
                <input
                  type="email"
                  placeholder="Email Address"
                  className="w-full border-2 border-gray-200 p-4 rounded-xl focus:border-[#028CD4] outline-none"
                  {...register("email", {
                    required: "Email is required",
                    pattern: {
                      value:
                        /^[^\s@]+@[^\s@]+\.[^\s@]+$/,
                      message: "Invalid Email",
                    },
                  })}
                />

                {errors.email && (
                  <p className="text-red-500 mt-1">
                    {errors.email.message}
                  </p>
                )}
              </div>

              {/* Message */}
              <div>
                <textarea
                  rows="5"
                  placeholder="Your Message"
                  className="w-full border-2 border-gray-200 p-4 rounded-xl focus:border-[#028CD4] outline-none"
                  {...register("message", {
                    required: "Message is required",
                    minLength: {
                      value: 10,
                      message:
                        "Minimum 10 characters required",
                    },
                  })}
                />

                {errors.message && (
                  <p className="text-red-500 mt-1">
                    {errors.message.message}
                  </p>
                )}
              </div>

              <button
                type="submit"
                className="w-full bg-[#028CD4] hover:bg-[#0177b4] text-white py-4 rounded-xl font-semibold transition"
              >
                Send Message
              </button>

            </form>
          </div>

  )
}

export default ContactForm
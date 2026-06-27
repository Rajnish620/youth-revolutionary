import { useForm } from "react-hook-form";
import Webcam from "react-webcam";
import { useRef, useState } from "react";
function RegistrationForm() {
  const {
    register,
    handleSubmit,
    formState: { errors },
  } = useForm();

  const webcamRef = useRef(null);

  const onSubmit = (data) => {
    console.log(data);
  };

  const [showCamera, setShowCamera] = useState(false);
  const [capturedImage, setCapturedImage] = useState(null);

  const capturePhoto = () => {
    const imageSrc = webcamRef.current?.getScreenshot();

    if (imageSrc) {
      setCapturedImage(imageSrc);
      setShowCamera(false);
    }

  };



  return (
    <section className="py-16 bg-gray-50">
      <div className="max-w-4xl mx-auto px-6">

        <div className="bg-white rounded-3xl shadow-lg overflow-hidden">

          {/* Header */}
          <div className="bg-[#028CD4] text-white p-8 text-center">
            <h2 className="text-4xl font-bold">
              Competition Registration
            </h2>

            <p className="mt-2 text-blue-100">
              Fill your details carefully before submitting.
            </p>
          </div>

          {/* Form */}
          <form
            onSubmit={handleSubmit(onSubmit)}
            className="p-8 grid md:grid-cols-2 gap-5"
          >
            <div>
              <label className="font-semibold">Student Name</label>
              <input
                type="text" placeholder="Raju kumar"
                className="w-full mt-2 p-3 border-2 border-gray-200 outline-[#028CD4] rounded-xl"
                {...register("name", {
                  required: "Student Name is required",
                })}
              />
              {errors.name && (
                <p className="text-red-500 text-sm">{errors.name.message}</p>
              )}
            </div>

            <div>
              <label className="font-semibold">Father's Name</label>
              <input
                type="text" placeholder="Rajesh Singh"
                className="w-full mt-2 p-3 border rounded-xl border-gray-200 outline-[#028CD4]"
                {...register("fatherName")}
              />
            </div>

            <div>
              <label className="font-semibold">Mobile Number</label>
              <input
                type="tel" placeholder="+91534*****"
                className="w-full mt-2 p-3 border rounded-xl border-gray-200 outline-[#028CD4]"
                {...register("mobile", {
                  required: "Mobile Number is required",
                })}
              />
              {errors.mobile && (
                <p className="text-red-500 text-sm">{errors.mobile.message}</p>
              )}
            </div>

            <div>
              <label className="font-semibold">Email</label>
              <input
                type="email" placeholder="123@gmail.com"
                className="w-full mt-2 p-3 border rounded-xl border-gray-200 outline-[#028CD4]"
                {...register("email")}
              />
            </div>

            <div>
              <label className="font-semibold">School Name</label>
              <input
                type="text" placeholder="ABC School "
                className="w-full mt-2 p-3 border rounded-xl border-gray-200 outline-[#028CD4]"
                {...register("school")}
              />
            </div>

            <div>
              <label className="font-semibold">Class</label>
              <select
                className="w-full mt-2 p-3 border rounded-xl border-gray-200 outline-[#028CD4]"
                {...register("class")}
              >
                <option value="">Select Class</option>
                <option>5</option>
                <option>6</option>
                <option>7</option>
                <option>8</option>
                <option>9</option>
                <option>10</option>
                <option>11</option>
                <option>12</option>

              </select>
            </div>

            {/* DOB Added */}
            <div>
              <label className="font-semibold">Date of Birth</label>
              <input
                type="date" 
                className="w-full mt-2 p-3 border rounded-xl border-gray-200 outline-[#028CD4]"
                {...register("dob", {
                  required: "Date of Birth is required",
                })}
              />
              {errors.dob && (
                <p className="text-red-500 text-sm">{errors.dob.message}</p>
              )}
            </div>

            {/* Address Added instead of District + State */}
            <div>
              <label className="font-semibold">Address</label>
              <input
                type="text" placeholder="Patna Nashariganj"
                className="w-full mt-2 p-3 border rounded-xl border-gray-200 outline-[#028CD4]"
                {...register("address", {
                  required: "Address is required",
                })}
              />
              {errors.address && (
                <p className="text-red-500 text-sm">{errors.address.message}</p>
              )}
            </div>

            {/* Pin Code Added */}
            <div>
              <label className="font-semibold">PIN Code</label>
              <input
                type="text" placeholder="Pin-424543"
                maxLength={6}
                className="w-full mt-2 p-3 border rounded-xl border-gray-200 outline-[#028CD4]"
                {...register("pincode", {
                  required: "PIN Code is required",
                  pattern: {
                    value: /^[0-9]{6}$/,
                    message: "Enter a valid 6-digit PIN Code",
                  },
                })}
              />
              {errors.pincode && (
                <p className="text-red-500 text-sm">{errors.pincode.message}</p>
              )}
            </div>

            <div className="md:col-span-2">
              <label className="font-semibold block mb-3">Student Photo</label>

              <div className="grid md:grid-cols-2 gap-6">
                {/* Upload From Device */}
                <div>
                  <label className="block text-sm font-medium mb-2">
                    Upload From Device
                  </label>

                  <input
                    type="file"
                    accept="image/*"
                    className="w-full p-3 border rounded-xl border-gray-200"
                    {...register("photo")}
                  />
                </div>

                {/* Live Camera */}
                <div>
                  <label className="block text-sm font-medium mb-2">
                    Take Live Photo
                  </label>

                  {!showCamera && !capturedImage && (
                    <button
                      type="button"
                      onClick={() => setShowCamera(true)}
                      className="bg-[#028CD4] text-white px-4 py-2 rounded-xl"
                    >
                      Open Camera
                    </button>
                  )}

                  {showCamera && (
                    <div className="space-y-3">
                      <Webcam
                        ref={webcamRef}
                        audio={false}
                        screenshotFormat="image/jpeg"
                        className="w-full rounded-xl border"
                        videoConstraints={{
                          facingMode: "user",
                          width: 640,
                          height: 480,
                        }}
                      />

                      <button
                        type="button"
                        onClick={capturePhoto}
                        className="bg-green-600 text-white px-4 py-2 rounded-xl"
                      >
                        Capture Photo
                      </button>
                    </div>
                  )}

                  {capturedImage && (
                    <div className="space-y-3">
                      <img
                        src={capturedImage}
                        alt="Captured"
                        className="w-40 h-40 object-cover rounded-xl border"
                      />

                      <button
                        type="button"
                        onClick={() => {
                          setCapturedImage(null);
                          setShowCamera(true);
                        }}
                        className="bg-orange-500 text-white px-4 py-2 rounded-xl"
                      >
                        Retake Photo
                      </button>
                    </div>
                  )}
                </div>
              </div>
            </div>

            <div className="md:col-span-2">
              <button
                type="submit"
                className="w-full bg-[#F1400C] hover:bg-orange-700 text-white py-4 rounded-xl font-bold transition"
              >
                Register
              </button>
            </div>
          </form>
        </div>

      </div>
    </section>
  );
}

export default RegistrationForm;
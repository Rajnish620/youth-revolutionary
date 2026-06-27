import { useState, useRef } from "react";
import { useForm } from "react-hook-form";
import { downloadHtmlAsPdf } from "../utils/downloadHtmlAsPdf";
import resultsData from "../components/data/resultsData";


function AdmitCard() {
    const [student, setStudent] = useState(null);
    const printableRef = useRef(null);

    const {
        register,
        handleSubmit,
        formState: { errors },
    } = useForm();



    const onSubmit = (data) => {
        const result = resultsData.find(
            (s) =>
                s.regNo.toLowerCase() === data.regNo.toLowerCase() &&
                s.name.toLowerCase() === data.name.toLowerCase()
        );

        if (result) {
            setStudent(result);
        } else {
            alert("No Admit Card Found");
            setStudent(null);
        }
    };

    return (
        <div className="max-w-5xl mx-auto py-10 px-4">

            {/* Form */}
            <div className="bg-white  rounded-3xl p-8">

                <h2 className="text-3xl font-bold text-[#028CD4] mb-6">
                    Admit Card Download
                </h2>

                <form
                    onSubmit={handleSubmit(onSubmit)}
                    className="grid md:grid-cols-2 gap-5"
                >
                    <div>
                        <label className="block mb-2 font-medium">
                            Registration Number
                        </label>

                        <input
                            type="text"
                            placeholder="Enter Registration No."
                            className="w-full border-2 border-gray-100 p-4 rounded-xl  focus:outline-blue-500"
                            {...register("regNo", {
                                required: "Registration Number is required",
                            })}
                        />

                        {errors.regNo && (
                            <p className="text-red-500 text-sm mt-1">
                                {errors.regNo.message}
                            </p>
                        )}
                    </div>

                    <div>
                        <label className="block mb-2 font-medium">
                            Student Name
                        </label>

                        <input
                            type="text"
                            placeholder="Enter Full Name"
                            className="w-full border  border-gray-100 p-4 rounded-xl  focus:outline-blue-500"
                            {...register("name", {
                                required: "Name is required",
                            })}
                        />

                        {errors.name && (
                            <p className="text-red-500 text-sm mt-1">
                                {errors.name.message}
                            </p>
                        )}
                    </div>

                    <div className="md:col-span-2">
                        <button
                            type="submit"
                            className="w-full bg-[#028CD4] text-white py-4 cursor-pointer rounded-xl font-semibold"
                        >
                            View Admit Card
                        </button>
                        <div className="mt-8 flex gap-3">
                            <button
                                onClick={() => {
                                    if (printableRef.current) {
                                        downloadHtmlAsPdf(printableRef.current, `${student.regNo || 'admit-card'}.pdf`);
                                    }
                                }}
                                className="flex-1 text-center hover:text-blue-700 cursor-pointer bg-white   text-gray-800 py-4 mb-5 rounded-xl font-semibold"
                            >
                                Download PDF
                            </button>
                        </div>
                    </div>
                </form>
                {student && (
                    <div ref={printableRef} className="mt-10 bg-white rounded-3xl overflow-hidden shadow-2xl border border-gray-200 " ref={printableRef}
                        className="mt-10 bg-white rounded-3xl overflow-hidden border border-gray-200"
                        style={{
                            width: "1000px",
                            maxWidth: "1000px",
                            margin: "0 auto",
                        }}
                    >

                        {/* Header */}
                        <div className="bg-[#028CD4] text-white p-8">

                            <div className="flex flex-row justify-between items-center">

                                <div className="flex flex-row items-center gap-4">

                                    <img
                                        src="/logo/logo.jpeg"
                                        alt="Logo"
                                        className="w-16 h-16 object-contain rounded-full"
                                    />

                                    <div className="text-center md:text-left">
                                        <h1 className="text-3xl font-bold uppercase">
                                            Youth Revolutionary
                                        </h1>

                                        <p className="text-blue-100 text-sm tracking-widest">
                                            OFFICIAL EXAMINATION ADMIT CARD
                                        </p>
                                    </div>

                                </div>

                                <div className="mt-4 md:mt-0 bg-white text-[#028CD4] px-6 py-2 rounded-full font-bold">
                                    ADMIT CARD
                                </div>

                            </div>

                        </div>

                        {/* Body */}
                        <div className="p-8">

                            <div
                                style={{
                                    display: "flex",
                                    justifyContent: "space-between",
                                    alignItems: "flex-start",
                                    gap: "30px",
                                }}
                            >
                                {/* Student Details */}
                                <div className="flex-1">

                                    <h2 className="text-xl font-bold mb-5 text-gray-800 border-b pb-3">
                                        Candidate Information
                                    </h2>

                                    <div className="grid grid-cols-2 gap-3">

                                        <div className="bg-gray-50 p-2 rounded-xl">
                                            <p className="text-sm text-gray-500">
                                                Student Name
                                            </p>

                                            <h3 className="font-semibold text-lg">
                                                {student.name}
                                            </h3>
                                        </div>

                                        <div className="bg-gray-50 p-2 rounded-xl">
                                            <p className="text-sm text-gray-500">
                                                Father's Name
                                            </p>

                                            <h3 className="font-semibold text-lg">
                                                {student.fatherName}
                                            </h3>
                                        </div>

                                         <div className="bg-gray-50 p-2 rounded-xl">
                                            <p className="text-sm text-gray-500">
                                                DOB
                                            </p>

                                            <h3 className="font-semibold text-lg">
                                                {student.dateOfBirth}
                                            </h3>
                                        </div>
                                        
                                      

                                        <div className="bg-gray-50 p-2 rounded-xl">
                                            <p className="text-sm text-gray-500">
                                                Registration No.
                                            </p>

                                            <h3 className="font-semibold text-lg">
                                                {student.regNo}
                                            </h3>
                                        </div>

                                        <div className="bg-gray-50 p-2 rounded-xl">
                                            <p className="text-sm text-gray-500">
                                                Roll Number
                                            </p>

                                            <h3 className="font-semibold text-lg">
                                                {student.rollNo}
                                            </h3>
                                        </div>

                                        <div className="bg-gray-50 p-2 rounded-xl">
                                            <p className="text-sm text-gray-500">
                                                Gender
                                            </p>

                                            <h3 className="font-semibold text-lg">
                                                {student.Gender}
                                            </h3>
                                        </div>

                                    </div>

                                <div className="mt-5 bg-green-50 border border-gray-100 p-2 rounded-xl">

                                    <p className="text-sm text-gray-500">
                                        School Name/institude
                                    </p>

                                    <h3 className="font-bold text-lg">
                                        {student.schoolName}
                                    </h3>

                                </div>
                                </div>

                                {/* Photo */}
                                <div
                                    style={{
                                        width: "180px",
                                        minWidth: "180px",
                                        display: "flex",
                                        justifyContent: "center",
                                    }}
                                >

                                    <div className="border-3 border-[#028CD4] rounded-sm overflow-hidden">

                                        <img
                                            src={student.image}
                                            alt="Student"
                                            style={{
                                                width: "120px",
                                                height: "170px",
                                                objectFit: "cover",
                                            }}
                                        />

                                    </div>

                                </div>

                            </div>

                            {/* Exam Details */}
                            <div className="mt-8">

                                <h2 className="text-xl font-bold mb-5 text-gray-800 border-b pb-3">
                                    Examination Details
                                </h2>

                                <div className="grid grid-cols-3 gap-5">

                                    <div className="bg-blue-50 border border-blue-100 p-5 rounded-xl">
                                        <p className="text-sm text-gray-500">
                                            Exam Date
                                        </p>

                                        <h3 className="font-bold text-lg">
                                            {student.examDate}
                                        </h3>
                                    </div>

                                    <div className="bg-blue-50 border border-blue-100 p-5 rounded-xl">
                                        <p className="text-sm text-gray-500">
                                            Exam Time
                                        </p>

                                        <h3 className="font-bold text-lg">
                                             {student.examStartTime} - {student.examEndTime}
                                        </h3>
                                    </div>

                                    <div className="bg-blue-50 border border-blue-100 p-5 rounded-xl">
                                        <p className="text-sm text-gray-500">
                                            Reporting Time
                                        </p>

                                        <h3 className="font-bold text-lg">
                                            09:00 AM
                                        </h3>
                                    </div>

                                </div>

                                <div className="mt-5 bg-gray-50 border p-5 rounded-xl">

                                    <p className="text-sm text-gray-500">
                                        Examination Center
                                    </p>

                                    <h3 className="font-bold text-lg">
                                        {student.center}
                                    </h3>

                                </div>

                            </div>

                            {/* Instructions */}
                            <div className="mt-8">

                                <h2 className="text-xl font-bold mb-4">
                                    Important Instructions
                                </h2>

                                <ul className="space-y-2 text-gray-600 list-disc pl-5">
                                    <li>Carry this admit card to the examination center.</li>
                                    <li>Bring a valid photo identity proof.</li>
                                    <li>Reach the center at least 30 minutes before reporting time.</li>
                                    <li>Mobile phones and electronic devices are prohibited.</li>
                                </ul>

                            </div>

                            {/* Signature */}
                            <div className="mt-14 flex justify-between">

                                <div className="text-center">
                                    <div className="w-40 border-b-2 border-gray-400"></div>
                                    <p className="mt-2 font-medium">
                                        Candidate Signature
                                    </p>
                                </div>

                                <div className="text-center">
                                    <div className="w-40 border-b-2 border-gray-400"></div>
                                    <p className="mt-2 font-medium">
                                        Authorized Signatory
                                    </p>
                                </div>

                            </div>

                        </div>

                    </div>
                )}
            </div>
        </div>
    );
}

export default AdmitCard;
import { useState } from "react";
import { useRef } from "react";
import { useForm } from "react-hook-form";
import resultsData from "../data/resultsData";



function StudentResultSearch() {
    const [student, setStudent] = useState(null);
    const printableRef = useRef(null);

    const {
        register,
        handleSubmit,
        formState: { errors },
    } = useForm();

    const onSubmit = (data) => {
        const result = resultsData.find(
            (item) =>
                item.name.toLowerCase().trim() === data.name.toLowerCase().trim() &&
                item.regNo.toLowerCase().trim() === data.regNo.toLowerCase().trim()
        );

        setStudent(result || false);
    };


    return (
        <section className="py-16">
            <div className="max-w-7xl mx-auto px-6">

                <div className="bg-white rounded-3xl  overflow-hidden">

                    <div className={`${student ? "block" : "grid lg:grid-cols-2"}`}>

                        {/* LEFT SIDE FORM */}
                        {!student && (
                            <div className="bg-[#028CD4] p-10 text-white">

                                <h2 className="text-4xl font-bold mb-3">
                                     Your Certificate
                                </h2>

                                <p className="mb-8 text-blue-100">
                                    Enter your Name and Registration Number
                                    to view your competition Certificate.
                                </p>

                                <form
                                    onSubmit={handleSubmit(onSubmit)}
                                    className="space-y-5"
                                >
                                    <div>
                                        <input
                                            type="text"
                                            placeholder="Student Name"
                                            className="w-full p-4 rounded-xl text-black bg-white"
                                            {...register("name", {
                                                required: "Name is required",
                                            })}
                                        />

                                        {errors.name && (
                                            <p className="text-yellow-200 mt-1">
                                                {errors.name.message}
                                            </p>
                                        )}
                                    </div>

                                    <div>
                                        <input
                                            type="text"
                                            placeholder="Registration Number"
                                            className="w-full p-4 rounded-xl text-black bg-white"
                                            {...register("regNo", {
                                                required:
                                                    "Registration Number is required",
                                            })}
                                        />

                                        {errors.regNo && (
                                            <p className="text-yellow-200 mt-1">
                                                {errors.regNo.message}
                                            </p>
                                        )}
                                    </div>

                                    <button
                                        type="submit"
                                        className="w-full bg-[#F1400C] hover:bg-orange-700 transition py-4 rounded-xl font-bold"
                                    >
                                        Search Certificate
                                    </button>
                                </form>

                            </div>

                        )}

                        {/* RIGHT SIDE RESULT */}
                        <div
                            className={`${student
                                ? "w-full p-4 md:p-10"
                                : "p-10 flex items-center justify-center"
                                }`}
                        >

                            {student == null && (

                                <div className="text-center">
                                    <img
                                        src="/logo/logo.jpeg"
                                        alt="Search Result"
                                        className="w-32 mx-auto mb-2"
                                    />

                                    <h3 className="text-2xl font-bold text-gray-700">
                                        Certificate Preview
                                    </h3>

                                    <p className="text-gray-500 mt-2">
                                        Search your Certificate to view details.
                                    </p>
                                </div>
                            )}

                            {student === false && (
                                <div className="bg-red-50  border-red-300 rounded-2xl p-8 text-center w-full">
                                    <h3 className="text-2xl font-bold text-red-600">
                                        No Result Found
                                    </h3>

                                    <p className="mt-3 text-gray-600">
                                        Please check your Name and
                                        Registration Number.
                                    </p>
                                </div>
                            )}

                            {student && (
                                <div>
                                    <div ref={printableRef} className="relative w-full max-w-4xl mx-auto overflow-hidden rounded-2xl shadow-2xl border border-yellow-200" style={{
                                        width: "210mm",
                                        height: "297mm",
                                        padding: "15mm",
                                        boxSizing: "border-box",
                                        overflow: "hidden",
                                        background: "linear-gradient(135deg, #ffffff 0%, #fefce8 50%, #fef3c7 100%)"
                                    }}>



                                        {/* Decorative corner elements */}
                                        <div className="absolute top-0 left-0 w-24 h-24 border-t-4 border-l-4 border-yellow-500 rounded-tl-2xl"></div>
                                        <div className="absolute top-0 right-0 w-24 h-24 border-t-4 border-r-4 border-yellow-500 rounded-tr-2xl"></div>
                                        <div className="absolute bottom-0 left-0 w-24 h-24 border-b-4 border-l-4 border-yellow-500 rounded-bl-2xl"></div>
                                        <div className="absolute bottom-0 right-0 w-24 h-24 border-b-4 border-r-4 border-yellow-500 rounded-br-2xl"></div>

                                        {/* Subtle pattern overlay */}
                                        <div className="absolute inset-0 opacity-[0.03] pointer-events-none"
                                        ></div>

                                        {/* Golden border frame */}
                                        <div className="absolute inset-3 border-2 border-yellow-300/60 rounded-xl pointer-events-none"></div>

                                        {/* Certificate content */}
                                        <div className="relative z-10 px-6 py-6">

                                            {/* Top decorative line */}
                                            <div className="flex items-center gap-4 mb-8">
                                                <div className="flex-1 h-0.5 bg-linear-to-r from-transparent via-yellow-400 to-transparent"></div>
                                                <div className="w-3 h-3 bg-yellow-500 rotate-45"></div>
                                                <div className="flex-1 h-0.5 bg-linear-to-r from-transparent via-yellow-400 to-transparent"></div>
                                            </div>

                                            {/* Header with emblem */}
                                            <div className="text-center">
                                                <div className="relative inline-block mb-4">
                                                    <div className="absolute inset-0 bg-yellow-200/30 rounded-full blur-2xl"></div>
                                                    <div className="relative w-20 h-20 md:w-24 md:h-24 mx-auto rounded-full border-2 border-yellow-400 p-1.5 shadow-md">
                                                        <div className="w-full h-full rounded-full overflow-hidden bg-white flex items-center justify-center">
                                                            <img src="/public/logo/logo.jpeg" alt="Logo" className="w-full h-full object-contain" />
                                                        </div>
                                                    </div>
                                                </div>

                                                <h1 className="text-2xl md:text-3xl font-bold text-amber-900 tracking-wider uppercase">
                                                    <span className="text-[#340C6F]">YOUTH</span> <span className="text-[#F1400C]">REVOLUTIONARY</span>
                                                </h1>

                                                <p className="text-2xl md:text-3xl font-bold text-amber-900 tracking-wider uppercase text-center">"NASRIGANJ"</p>

                                                <p className="text-amber-700/80 mt-1 text-sm md:text-base font-medium italic">
                                                    "Excellence in Education &amp; Competitive Achievement"
                                                </p>

                                                {/* Decorative divider */}
                                                <div className="flex items-center justify-center gap-3 mt-5">
                                                    <span className="w-16 h-px bg-amber-300"></span>
                                                    <span className="text-amber-400 text-xl">✦</span>
                                                    <span className="w-16 h-px bg-amber-300"></span>
                                                </div>
                                            </div>

                                            {/* Certificate Title */}
                                            <div className="text-center mt-6">
                                                <h2 className="text-4xl md:text-5xl font-serif font-bold text-gray-800 tracking-wide">
                                                    Certificate
                                                </h2>
                                                <p className="text-lg md:text-xl font-serif italic text-amber-600 mt-1">
                                                    Of Achievement
                                                </p>
                                            </div>

                                            {/* Main Text */}
                                            <div className="text-center mt-6">
                                                <p className=" text-gray-400 uppercase font-semibold">SEASON - 4</p>
                                                <p className="text-lg md:text-xl text-gray-500 font-light">This Certificate is Proudly Presented To</p>

                                                <div className="relative inline-block mt-3">
                                                    <h2 className="text-3xl md:text-4xl font-bold text-amber-900 tracking-wide">
                                                        {student.name}
                                                    </h2>
                                                    <div className="absolute -bottom-1 left-0 right-0 h-0.75 bg-linear-to-r from-transparent via-amber-400 to-transparent rounded-full"></div>
                                                </div>

                                                <p className="mt-6 text-base md:text-lg leading-relaxed text-gray-600 max-w-2xl mx-auto">
                                                    In recognition of outstanding performance in
                                                    <span className="font-bold text-amber-700"> {student.category}</span>,
                                                    securing
                                                    <span className="font-bold text-emerald-600"> Rank #{student.rank}</span>
                                                    with an excellent score of
                                                    <span className="font-bold text-rose-500"> {student.score}</span>.
                                                    Your dedication, hard work, and commitment to excellence
                                                    have brought pride and distinction to the institution.
                                                </p>
                                            </div>

                                            {/* Student Photo with decorative frame */}
                                            <div className="flex justify-center mt-6">
                                                <div className="relative">
                                                    <div className="absolute inset-0 bg-linear-to-br from-amber-300 to-amber-500 rounded-full blur-sm"></div>
                                                    <div className="relative p-1 rounded-full bg-linear-to-br from-amber-400 to-amber-600 shadow-lg">
                                                        <div className="w-28 h-28 md:w-32 md:h-32 rounded-full overflow-hidden border-4 border-white">
                                                            <img src={student.image} alt={student.name} className="w-full h-full object-cover" />
                                                        </div>
                                                    </div>
                                                    {/* Small decorative stars */}
                                                    <span className="absolute -top-1 -right-1 text-amber-400 text-lg">⭐</span>
                                                    <span className="absolute -bottom-1 -left-1 text-amber-400 text-lg">⭐</span>
                                                </div>
                                            </div>

                                            {/* Details Section */}
                                            <div
                                                style={{
                                                    display: "grid",
                                                    gridTemplateColumns: "1fr 1fr",
                                                    gap: "16px",
                                                    marginTop: "40px",
                                                }}
                                            >
                                                <div
                                                    style={{
                                                        background: "#FEF3C7",
                                                        padding: "16px",
                                                        borderRadius: "8px",
                                                        border: "1px solid #FCD34D",
                                                    }}
                                                >
                                                    <strong>Registration No :</strong> {student.regNo}
                                                </div>

                                                <div
                                                    style={{
                                                        background: "#FEF3C7",
                                                        padding: "16px",
                                                        borderRadius: "8px",
                                                        border: "1px solid #FCD34D",
                                                    }}
                                                >
                                                    <strong>Class Group :</strong> {student.classGroup}
                                                </div>

                                                <div
                                                    style={{
                                                        background: "#FEF3C7",
                                                        padding: "16px",
                                                        borderRadius: "8px",
                                                        border: "1px solid #FCD34D",
                                                    }}
                                                >
                                                    <strong>Certificate ID :</strong> CERT-{student.regNo}
                                                </div>

                                                <div
                                                    style={{
                                                        background: "#FEF3C7",
                                                        padding: "16px",
                                                        borderRadius: "8px",
                                                        border: "1px solid #FCD34D",
                                                    }}
                                                >
                                                    <strong>Date :</strong>{" "}
                                                    {new Date().toLocaleDateString("en-US", {
                                                        year: "numeric",
                                                        month: "long",
                                                        day: "numeric",
                                                    })}
                                                </div>
                                            </div>

                                            {/* Winner Badge */}
                                            <div className="flex justify-center mt-10">

                                            </div>

                                            {/* Signatures */}
                                            <div className="flex justify-between mt-10 gap-6">
                                                <div className="text-center flex-1">
                                                    <div className="relative">
                                                        <div className="w-36 md:w-44 border-b-2 border-amber-400 mx-auto"></div>

                                                    </div>
                                                    <p className="mt-2 font-semibold text-gray-700 text-sm">Chairman</p>
                                                </div>
                                                <div className="text-center flex-1">
                                                    <div className="relative">
                                                        <div className="w-36 md:w-44 border-b-2 border-amber-400 mx-auto"></div>

                                                    </div>
                                                    <p className="mt-2 font-semibold text-gray-700 text-sm">Secretary</p>
                                                </div>
                                            </div>

                                            {/* Bottom decorative line */}
                                            <div className="flex items-center gap-4 mt-10">
                                                <div className="flex-1 h-0.5 bg-linear-to-r from-transparent via-amber-400 to-transparent"></div>
                                                <div className="w-3 h-3 bg-amber-500 rotate-45"></div>
                                                <div className="flex-1 h-0.5 bg-linear-to-r from-transparent via-amber-400 to-transparent"></div>
                                            </div>

                                        </div>
                                    </div>

                                    <div className="flex flex-col items-center gap-3">
                                        <button
                                            type="button"
                                            onClick={() => setStudent(null)}
                                            className="max-w-xs w-full sm:w-auto mx-auto mt-4 text-center bg-white text-amber-700 border border-amber-300 py-1 px-2 rounded-xl font-semibold text-lg transition shadow-sm hover:shadow-md active:scale-95"
                                        >
                                            Search Again
                                        </button>

                                        {/* Download Button */}
                                        <button
                                            type="button"
                                            onClick={() => {
                                                if (printableRef.current) {
                                                    import('../../utils/downloadHtmlAsPdf').then(mod => {
                                                        const fn = mod.downloadHtmlAsPdf;
                                                        if (fn) fn(printableRef.current, `${student.regNo || 'certificate'}.pdf`);
                                                    });
                                                }
                                            }}
                                            className="max-w-xs w-full sm:w-auto mx-auto mt-2 text-center bg-linear-to-r from-amber-600 to-amber-700 hover:from-amber-700 hover:to-amber-800 text-white py-2 px-3 rounded-xl font-semibold text-lg transition shadow-lg hover:shadow-xl active:scale-95 flex items-center justify-center gap-2"
                                        >
                                            <svg className="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                            </svg>
                                            Download Certificate PDF
                                        </button>
                                    </div>
                                </div>
                            )}

                        </div>

                    </div>

                </div>

            </div>
        </section>
    );
}

export default StudentResultSearch;
import { BookOpen, Trophy, Users, GraduationCap } from "lucide-react";
import { Link } from "react-router-dom";

function EducationLearn() {
    return (
        <div>

            <div className="bg-gray-50 min-h-screen">

                {/* Hero Section */}
                <section className="relative bg-[#028CD4] text-white py-28 pt-40 overflow-hidden">

                    <div className="absolute inset-0 bg-black/10"></div>

                    <div className="relative max-w-7xl mx-auto px-6 text-center">
                        <BookOpen size={70} className="mx-auto mb-6" />

                        <h1 className="text-4xl font-bold mb-6">
                            Education Competitions
                        </h1>

                        <p className="max-w-3xl mx-auto text-lg text-blue-100">
                            Inspiring students to learn, compete, innovate and achieve
                            academic excellence through engaging competitions.
                        </p>
                    </div>

                </section>

                <section className="bg-white py-20">
                    <div className="max-w-7xl mx-auto px-6">

                        <h2 className="text-3xl font-bold text-center mb-12">
                            Participation Process
                        </h2>

                        <div className="grid md:grid-cols-4 gap-6">

                            {[
                                "Register",
                                "Select Competition",
                                "Participate",
                                "Win Awards"
                            ].map((step, index) => (
                                <div
                                    key={index}
                                    className="bg-gray-50 p-6 rounded-2xl text-center"
                                >
                                    <div className="w-14 h-14 bg-[#028CD4] text-white rounded-full flex items-center justify-center mx-auto mb-4 font-bold">
                                        {index + 1}
                                    </div>

                                    <h3 className="font-bold text-lg">
                                        {step}
                                    </h3>
                                </div>
                            ))}
                        </div>

                    </div>
                </section>

                {/* Competition Types */}
                <section className="max-w-7xl mx-auto px-6 pb-16">
                    <h2 className="text-3xl font-bold text-center mb-10">
                        Available Competitions
                    </h2>

                    <div className="grid md:grid-cols-3 gap-6">

                        <div className="bg-white p-6 rounded-2xl shadow-md">
                            <h3 className="text-xl font-bold text-[#028CD4] mb-3">
                                Quiz Competition
                            </h3>
                            <p className="text-gray-600">
                                Test your knowledge in Science, Mathematics,
                                General Knowledge, History and Current Affairs.
                            </p>
                        </div>

                        <div className="bg-white p-6 rounded-2xl shadow-md">
                            <h3 className="text-xl font-bold text-[#028CD4] mb-3">
                                Debate Competition
                            </h3>
                            <p className="text-gray-600">
                                Improve communication, critical thinking and
                                public speaking abilities.
                            </p>
                        </div>

                        <div className="bg-white p-6 rounded-2xl shadow-md">
                            <h3 className="text-xl font-bold text-[#028CD4] mb-3">
                                Essay Writing
                            </h3>
                            <p className="text-gray-600">
                                Showcase creativity, writing skills and
                                analytical thinking on various topics.
                            </p>
                        </div>

                    </div>
                </section>

                {/* Benefits */}
                <section className="bg-white py-16">
                    <div className="max-w-7xl mx-auto px-6">

                        <h2 className="text-3xl font-bold text-center mb-10">
                            Benefits of Participation
                        </h2>

                        <div className="grid md:grid-cols-4 gap-6">

                            <div className="text-center p-6">
                                <Trophy size={40} className="mx-auto text-[#028CD4]" />
                                <h3 className="font-bold mt-4">Recognition</h3>
                                <p className="text-gray-600 mt-2">
                                    Win awards, medals and certificates.
                                </p>
                            </div>

                            <div className="text-center p-6">
                                <GraduationCap size={40} className="mx-auto text-[#028CD4]" />
                                <h3 className="font-bold mt-4">Learning</h3>
                                <p className="text-gray-600 mt-2">
                                    Enhance academic knowledge and skills.
                                </p>
                            </div>

                            <div className="text-center p-6">
                                <Users size={40} className="mx-auto text-[#028CD4]" />
                                <h3 className="font-bold mt-4">Confidence</h3>
                                <p className="text-gray-600 mt-2">
                                    Build leadership and communication abilities.
                                </p>
                            </div>

                            <div className="text-center p-6">
                                <BookOpen size={40} className="mx-auto text-[#028CD4]" />
                                <h3 className="font-bold mt-4">Knowledge</h3>
                                <p className="text-gray-600 mt-2">
                                    Gain practical learning experience.
                                </p>
                            </div>

                        </div>
                    </div>
                </section>

                {/* Eligibility */}
                <section className="max-w-7xl mx-auto px-6 py-16">
                    <div className="bg-white rounded-3xl shadow-lg p-8">
                        <h2 className="text-3xl font-bold mb-6">
                            Eligibility
                        </h2>

                        <ul className="space-y-3 text-gray-600">
                            <li>✔ Students from Class 1 to 12 can participate.</li>
                            <li>✔ Individual participation is allowed.</li>
                            <li>✔ School registration may be required.</li>
                            <li>✔ Valid student identity proof is mandatory.</li>
                        </ul>
                    </div>
                </section>
                {/* Stats Section */}
                <section className="max-w-7xl mx-auto px-6 py-16">
                    <div className="grid grid-cols-2 md:grid-cols-4 gap-6">

                        <div className="bg-white rounded-2xl shadow-lg p-6 text-center">
                            <h3 className="text-4xl font-bold text-[#028CD4]">500+</h3>
                            <p className="text-gray-600 mt-2">Participants</p>
                        </div>

                        <div className="bg-white rounded-2xl shadow-lg p-6 text-center">
                            <h3 className="text-4xl font-bold text-[#028CD4]">50+</h3>
                            <p className="text-gray-600 mt-2">Schools</p>
                        </div>

                        <div className="bg-white rounded-2xl shadow-lg p-6 text-center">
                            <h3 className="text-4xl font-bold text-[#028CD4]">20+</h3>
                            <p className="text-gray-600 mt-2">Competitions</p>
                        </div>

                        <div className="bg-white rounded-2xl shadow-lg p-6 text-center">
                            <h3 className="text-4xl font-bold text-[#028CD4]">100+</h3>
                            <p className="text-gray-600 mt-2">Awards</p>
                        </div>

                    </div>
                </section>
                {/* CTA */}
                <section className="bg-[#028CD4] text-white py-16 text-center">
                    <h2 className="text-4xl font-bold mb-4">
                        Ready to Participate?
                    </h2>

                    <p className="mb-6">
                        Register today and showcase your academic excellence.
                    </p>

                    <Link to="../competitions/Education" className="bg-white text-[#028CD4] px-8 py-3 rounded-xl font-semibold">
                        Register Now
                    </Link>
                </section>

            </div>

        </div>
    )
}

export default EducationLearn
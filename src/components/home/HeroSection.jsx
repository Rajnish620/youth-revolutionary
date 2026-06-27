import { Link } from "react-router-dom";
import { motion } from "framer-motion";
function HeroSection() {
    return (
        <div>{/* Hero Section */}
            <section className="relative h-screen flex items-center justify-center text-white overflow-hidden">

                {/* Background Video */}
                <video
                    autoPlay
                    loop
                    muted
                    playsInline
                    className="absolute top-0 left-0 w-full h-full object-cover"
                >
                    <source src="/public/video/heroSection.mp4" type="video/mp4" />
                </video>

                {/* Dark Overlay */}
                <div className="absolute inset-0 bg-black/65"></div>

                {/* Content */}
                <div className="relative z-10 max-w-7xl mx-auto px-6 lg:pt-40 text-center">

                    <motion.h1
                        initial={{ opacity: 0, x: -500 }}
                        animate={{ opacity: 1, x: 0 }}
                        transition={{ delay: 0.4, duration: 0.8 }}

                        className="text-5xl md:text-7xl font-bold mb-6 text-[#F1400C]">
                        <span className="text-[#340C6F]">Youth</span> Revolutionary
                    </motion.h1>

                    <motion.p
                        initial={{ opacity: 0, x: 500 }}
                        animate={{ opacity: 1, x: 0 }}
                        transition={{ duration: 0.8 }}
                        className="text-xl md:text-2xl mb-8 max-w-3xl mx-auto">
                       Providing Students a Platform to Showcase Their Talent Through Education, Sports, Cultural Programs & Competitive Excellence
                    </motion.p>
                    

                    <motion.div
                        initial={{ opacity: 0, x: 500 }}
                        animate={{ opacity: 1, x: 0 }}
                        transition={{ duration: 0.8 }}
                        className="flex flex-col sm:flex-row justify-center gap-4">



                       <motion.div className="mt-5"
                        initial={{ opacity: 0, y: -500 }}
                        animate={{ opacity: 1, y: 0 }}
                        transition={{ duration: 0.8 }}>
                         <Link
                            to="/register"
                            className="bg-blue-600 hover:bg-blue-700 px-6 py-3 rounded-lg font-semibold"
                        >
                            Register Now
                        </Link>
                       </motion.div >

                        <motion.div  className="mt-5"
                        initial={{ opacity: 0, y: 500 }}
                        animate={{ opacity: 1, y: 0 }}
                        transition={{ duration: 0.8 }}>
                            <Link
                            to="../competitions/Education"
                            className="border border-white px-6 py-3 rounded-lg hover:bg-white hover:text-black"
                        >
                            Explore Competitions
                        </Link>

                        </motion.div>
                    </motion.div>
              

                </div>
            </section>
        </div>
    )
}

export default HeroSection
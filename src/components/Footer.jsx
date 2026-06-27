
import { Link } from "react-router-dom";
import {

    Phone,
    Mail,
    MapPin,
} from "lucide-react";


const Footer = () => {
    return (
        <footer className="bg-gray-900 text-gray-300">
            <div className="max-w-7xl mx-auto px-6 py-12">

                <div className="grid md:grid-cols-4 gap-10">

                    {/* About */}
                    <div>
                        <h2 className="text-2xl font-bold text-white mb-4">
                            Youth Revolutionary
                        </h2>

                        <p className="text-sm leading-6">
                            A platform for students from Class 5th to 12th
                            to participate in Education, Sports and Cultural
                            Competitions.
                        </p>
                    </div>

                    {/* Quick Links */}
                    <div>
                        <h3 className="text-lg font-semibold text-white mb-4">
                            Quick Links
                        </h3>


                        <ul>
                            <li>
                                <Link to="/" className="hover:text-blue-400">
                                    Home
                                </Link>
                            </li>

                            <li>
                                <Link to="/about" className="hover:text-blue-400">
                                    About
                                </Link>
                            </li>

                            <li>
                                <Link to="/competitions" className="hover:text-blue-400">
                                    Competitions
                                </Link>
                            </li>

                            <li>
                                <Link to="/events" className="hover:text-blue-400">
                                    Events
                                </Link>
                            </li>

                            <li>
                                <Link to="/results" className="hover:text-blue-400">
                                    Results
                                </Link>
                            </li>

                            <li>
                                <Link to="/gallery" className="hover:text-blue-400">
                                    Gallery
                                </Link>
                            </li>
                        </ul>

                    </div>

                    {/* Competitions */}
                    <div>
                        <h3 className="text-lg font-semibold text-white mb-4">
                            Competitions
                        </h3>

                        <ul className="space-y-2 flex flex-col">
                            <Link  className="hover:text-blue-400"   to="./competitions/education">Education</Link>
                            <Link className="hover:text-blue-400"  to="./competitions/sports">Sports</Link>
                            <Link  className="hover:text-blue-400" to="./competitions/cultural">Cultural</Link>
                        </ul>
                    </div>

                    {/* Contact */}
                    <div>
                        <h3 className="text-lg font-semibold text-white mb-4">
                            Contact Us
                        </h3>

                        <div className="space-y-3">

                            <div className="flex items-center gap-2">
                                <Phone size={16} />
                                <span>+91 XXXXX XXXXX</span>
                            </div>

                            <div className="flex items-center gap-2">
                                <Mail size={16} />
                                <span>info@youthrevolutionary.com</span>
                            </div>

                            <div className="flex items-start gap-2">
                                <MapPin size={16} className="mt-1" />
                                <span>India</span>
                            </div>

                        </div>
                    </div>

                </div>

                {/* Social Media */}
               
        <hr className=" border-t-gray-500 m-5" />
               <div className="flex  justify-between items-center">
                <p> Copyright</p>
               <div>
                 <div className="flex justify-center gap-6 mt-10 pt-6  border-gray-700">

                    <a href="#" className="hover:text-blue-400">
                        <i class="fa-brands fa-facebook-f"></i>
                    </a>

                    <a href="https://www.instagram.com/youthrevolutionarynasriganj?igsh=dXZzb2lpYXIzYWZ5" target="_blanck" className="hover:text-pink-400">
                        <i class="fa-brands fa-instagram"></i>
                    </a>

                    <a href="https://youtube.com/@youthrevolutionary6914?si=cStQfkgHXTkbsNzO" className="hover:text-red-400" target="_blanck">
                        <i class="fa-brands fa-youtube"></i>
                    </a>

                </div>
                 <div className="text-center mt-6 text-sm text-gray-400">
                    © {new Date().getFullYear()} Youth Revolutionary.
                    All Rights Reserved.
                </div>
               </div>
                <Link to="./terms" className="hover:text-blue-400">
                    Terms & Conditions
                   
                </Link>
               </div>

            </div>
        </footer>
    );
};

export default Footer;
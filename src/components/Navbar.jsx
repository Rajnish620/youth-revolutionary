import { useState, useEffect, useRef } from "react";
import { Link } from "react-router-dom";
import { motion } from "framer-motion";
import { ChevronDown, ChevronUp } from "lucide-react";

const Navbar = () => {
  const [menuOpen, setMenuOpen] = useState(false);
  const [dropdownOpen, setDropdownOpen] = useState(false);
  const [mobileCompetitionOpen, setMobileCompetitionOpen] =
    useState(false);
  const [scrolled, setScrolled] = useState(false);

  const dropdownRef = useRef(null);

  // Scroll Effect
  useEffect(() => {
    const handleScroll = () => {
      setScrolled(window.scrollY > 100);
    };
    window.addEventListener("scroll", handleScroll);

    return () =>
      window.removeEventListener("scroll", handleScroll);
  }, []);

  // Close desktop dropdown on outside click
  useEffect(() => {
    const handleClickOutside = (e) => {
      if (
        dropdownRef.current &&
        !dropdownRef.current.contains(e.target)
      ) {
        setDropdownOpen(false);
      }
    };

    document.addEventListener("mousedown", handleClickOutside);

    return () =>
      document.removeEventListener(
        "mousedown",
        handleClickOutside
      );
  }, []);

  // Close Mobile Menu
  const closeMobileMenu = () => {
    setMenuOpen(false);
    setMobileCompetitionOpen(false);
  };

  return (
    <motion.nav
      initial={{ opacity: 0, x: -500 }}
      animate={{ opacity: 1, x: 0 }}
      transition={{ duration: 0.7 }}
      className={`
      fixed left-1/2 -translate-x-1/2 z-50
      transition-all duration-500 ease-out

      ${
        scrolled
          ? "top-0 w-full shadow-md bg-white/80 backdrop-blur-lg md:rounded-b-4xl lg:rounded-b-4xl"
          : "top-8 w-[85%] rounded-3xl shadow-md bg-white/80 backdrop-blur-3xl"
      }
    `}
    >
      <div className="max-w-7xl mx-auto px-5">
        <div className="flex justify-between items-center h-20">

          {/* Logo */}
          <Link
  to="/"
  className="flex items-center gap-2 sm:gap-3"
>
  <img
    src="/logo/logo.jpeg"
    alt="Youth Revolutionary"
    className="w-10 h-10 sm:w-12 sm:h-12 md:w-14 md:h-14 rounded-full object-cover border-2 border-[#F1400C]"
  />

  <div className="flex flex-col leading-none">
    <span className="font-bold text-[#340C6F] text-xs sm:text-sm md:text-lg lg:text-xl">
      YOUTH
    </span>

    <span className="font-bold text-[#F1400C] text-xs sm:text-sm md:text-lg lg:text-xl">
      REVOLUTIONARY
    </span>
  </div>
</Link>
          {/* Desktop Menu */}
          <div className="hidden md:flex items-center gap-8">

            <Link
              to="/"
              className="focus:text-[#028CD4] font-medium"
            >
              Home
            </Link>

            <Link
              to="/about"
              className="focus:text-[#028CD4] font-medium"
            >
              About
            </Link>

            {/* Competition Dropdown */}
            <div
              ref={dropdownRef}
              className="relative"
            >
              <button
                onClick={() =>
                  setDropdownOpen(!dropdownOpen)
                }
                className="flex items-center gap-1 font-medium"
              >
                Competitions

                {dropdownOpen ? (
                  <ChevronUp size={18} />
                ) : (
                  <ChevronDown size={18} />
                )}
              </button>

              {dropdownOpen && (
                <div className="absolute top-10 left-0 w-56 rounded-xl border border-blue-100 bg-white shadow-xl">

                  <Link
                    to="/competitions/education"
                    onClick={() =>
                      setDropdownOpen(false)
                    }
                    className="block px-4 py-3 hover:bg-gray-100"
                  >
                    Education
                  </Link>

                  <Link
                    to="/competitions/sports"
                    onClick={() =>
                      setDropdownOpen(false)
                    }
                    className="block px-4 py-3 hover:bg-gray-100"
                  >
                    Sports
                  </Link>

                  <Link
                    to="/competitions/cultural"
                    onClick={() =>
                      setDropdownOpen(false)
                    }
                    className="block px-4 py-3 hover:bg-gray-100"
                  >
                    Cultural
                  </Link>

                </div>
              )}
            </div>

            <Link
              to="/events"
              className="focus:text-[#028CD4] font-medium"
            >
              Events
            </Link>

            <Link
              to="/results"
              className="focus:text-[#028CD4] font-medium"
            >
              Results
            </Link>

            <Link
              to="/gallery"
              className="focus:text-[#028CD4] font-medium"
            >
              Gallery
            </Link>

            <Link
              to="/contact"
              className="focus:text-[#028CD4] font-medium"
            >
              Contact
            </Link>

            <motion.div
              whileHover={{
                scale: 1.05,
                y: -5,
              }}
              whileTap={{
                scale: 0.95,
              }}
              className="relative"
            >
              <span className="absolute inline-flex h-3 w-3 left-34 bottom-7 animate-ping rounded-full bg-[#3c19d8]"></span>

              <span className="absolute inline-flex h-3 w-3 left-34 bottom-7 rounded-full bg-[#3c19d8]"></span>

              <Link
                to="/register"
                className="px-5 py-3 rounded-xl bg-[#F1400C] text-white font-bold shadow-lg border-2 border-[#F1400C] hover:bg-white hover:text-[#F1400C] transition-all duration-300"
              >
                Register Now
              </Link>
            </motion.div>
          </div>

          {/* Mobile Button */}
          <button
            className="md:hidden text-3xl"
            onClick={() =>
              setMenuOpen(!menuOpen)
            }
          >
            ☰
          </button>
        </div>

                {/* Mobile Menu */}
        {menuOpen && (
          <div
            className="
              absolute top-full left-0 right-0
              z-50
              bg-white/80
              backdrop-blur-xl
              border-t
              shadow-2xl
              rounded-b-3xl
              p-5
              flex flex-col gap-4
            "
          >
            <Link to="/" onClick={closeMobileMenu}>
              Home
            </Link>

            <Link to="/about" onClick={closeMobileMenu}>
              About
            </Link>

            <div>
              <button
                onClick={() =>
                  setMobileCompetitionOpen(!mobileCompetitionOpen)
                }
                className="w-full flex justify-between items-center"
              >
                <span>Competitions</span>
                <span>
                  {mobileCompetitionOpen ? "▲" : "▼"}
                </span>
              </button>

              {mobileCompetitionOpen && (
                <div className="ml-4 mt-3 flex flex-col gap-3 border-l-2 border-gray-200 pl-4">

                  <Link
                    to="/competitions/education"
                    onClick={closeMobileMenu}
                  >
                    Education
                  </Link>

                  <Link
                    to="/competitions/sports"
                    onClick={closeMobileMenu}
                  >
                    Sports
                  </Link>

                  <Link
                    to="/competitions/cultural"
                    onClick={closeMobileMenu}
                  >
                    Cultural
                  </Link>

                </div>
              )}
            </div>

            <Link to="/events" onClick={closeMobileMenu}>
              Events
            </Link>

            <Link to="/results" onClick={closeMobileMenu}>
              Results
            </Link>

            <Link to="/gallery" onClick={closeMobileMenu}>
              Gallery
            </Link>

            <Link to="/contact" onClick={closeMobileMenu}>
              Contact
            </Link>

            <Link
              to="/register"
              onClick={closeMobileMenu}
              className="
                text-center
                py-3
                rounded-xl
                bg-[#F1400C]
                text-white
                font-bold
              "
            >
              Register Now
            </Link>
          </div>
        )}
      </div>
    </motion.nav>
  );
};

export default Navbar;
import { Link } from "react-router-dom";
import HeroSection from "../components/home/HeroSection";
import CategoriesSection from "../components/home/CategoriesSection";
import EventsSection from "../components/home/EventsSection";
import GallerySection from "../components/home/GallerySection";

const Home = () => {
  return (
    <div>

      <HeroSection />
      <CategoriesSection />

      {/* Heading */}

      <section className="py-24 bg-gray-50" >

        <div className="max-w-7xl mx-auto px-6">
          <div className="text-center mb-14">
            <h2 className="text-4xl font-bold text-center mb-12 text-blue-600">
              Upcoming Events
            </h2>
            <h2 className="text-4xl md:text-5xl font-bold mt-3 ">
              Participate & Showcase Your Talent
            </h2>

            <p className="text-gray-600 mt-4 max-w-2xl mx-auto">
              Join exciting competitions in Education, Sports and Cultural
              activities and compete with talented students.
            </p>
          </div>
          {/* Featured Video */}
          <div className="mb-16">
            <div className="relative overflow-hidden rounded-3xl shadow-2xl">

              <video
                autoPlay
                muted
                loop
                playsInline
                className="w-full h-125 object-cover"
              >
                <source
                  src="/public/video/videoplayback (4).mp4"
                  type="video/mp4"
                />
              </video>

              <div className="absolute inset-0 bg-black/50"></div>

              <div className="absolute inset-0 flex items-center justify-center text-center px-6">
                <div>
                  <h3 className="text-white text-4xl md:text-6xl font-bold mb-4">
                    Youth Revolutionary Events
                  </h3>

                  <p className="text-gray-200 text-lg md:text-xl max-w-2xl">
                    Experience the excitement of competitions,
                    sports tournaments and cultural performances.
                  </p>
                </div>
              </div>

            </div>
          </div>
        </div>
      </section>
      <EventsSection />
      <GallerySection />
      {/* About */}
      <section className="py-20">
        <div className="max-w-6xl mx-auto px-6 text-center">
          <h2 className="text-4xl font-bold mb-6">
            About Youth Revolutionary
          </h2>

          <p className="text-gray-600 max-w-3xl mx-auto">
            Youth Revolutionary is a platform for students from
            Class 5th to 12th to showcase their talent through
            Education, Sports and Cultural Competitions.
          </p>
        </div>
      </section>




      {/* Why Choose Us */}
      <section className="bg-gray-100 py-20">
        <div className="max-w-7xl mx-auto px-6">
          <h2 className="text-4xl font-bold text-center mb-12">
            Why Choose Us
          </h2>

          <div className="grid md:grid-cols-4 gap-6 text-center">

            <div className="bg-white p-6 rounded-xl shadow">
              🏆
              <h3 className="font-bold mt-3">
                Fair Competition
              </h3>
            </div>

            <div className="bg-white p-6 rounded-xl shadow">
              📜
              <h3 className="font-bold mt-3">
                Certificates
              </h3>
            </div>

            <div className="bg-white p-6 rounded-xl shadow">
              🎯
              <h3 className="font-bold mt-3">
                Skill Development
              </h3>
            </div>

            <div className="bg-white p-6 rounded-xl shadow">
              🌍
              <h3 className="font-bold mt-3">
                State Level Exposure
              </h3>
            </div>

          </div>
        </div>
      </section>


      {/* CTA */}
      <section className="bg-[#028CD4] text-white py-20">
        <div className="text-center px-6">
          <h2 className="text-4xl font-bold mb-4">
            Ready to Showcase Your Talent?
          </h2>

          <p className="mb-8">
            Join Youth Revolutionary Today
          </p>

          <Link
            to="/register"
            className="bg-white text-blue-600 px-6 py-3 rounded-lg font-semibold"
          >
            Register Now
          </Link>
        </div>
      </section>
    </div>
  );
};

export default Home;
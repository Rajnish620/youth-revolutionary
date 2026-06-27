import { Music, Users, Award, Sparkles } from "lucide-react";
import { Link } from "react-router-dom";

function CulturalLearn() {
  return (
    <div className="bg-gray-50 min-h-screen">

      {/* Hero Section */}
      <section className="bg-linear-to-r from-[#028CD4] to-blue-700 text-white py-24 pt-40">
        <div className="max-w-7xl mx-auto px-6 text-center">

          <Music size={70} className="mx-auto mb-6" />

          <h1 className="text-5xl md:text-6xl font-bold mb-6">
            Cultural Competitions
          </h1>

          <p className="max-w-3xl mx-auto text-xl text-blue-100">
            Discover your creativity, showcase your artistic talent,
            and celebrate culture through exciting competitions.
          </p>

        </div>
      </section>

      {/* About */}
      <section className="max-w-7xl mx-auto px-6 py-20">
        <h2 className="text-4xl font-bold text-center mb-8">
          About Cultural Competitions
        </h2>

        <p className="max-w-4xl mx-auto text-center text-gray-600 leading-8">
          Cultural competitions encourage students to express themselves
          through art, music, dance, and creativity. These events help
          participants develop confidence, performance skills, and a
          deeper appreciation of culture and traditions.
        </p>
      </section>

      {/* Activities */}
      <section className="max-w-7xl mx-auto px-6 pb-20">
        <h2 className="text-4xl font-bold text-center mb-12">
          Available Activities
        </h2>

        <div className="grid md:grid-cols-3 gap-8">

          {[
            {
              title: "Dance Competition",
              icon: "💃",
              desc: "Show your rhythm, energy and stage performance skills."
            },
            {
              title: "Singing Competition",
              icon: "🎤",
              desc: "Demonstrate your vocal talent and musical abilities."
            },
            {
              title: "Drawing Competition",
              icon: "🎨",
              desc: "Express your imagination and creativity through art."
            }
          ].map((activity, index) => (
            <div
              key={index}
              className="bg-white rounded-3xl p-8 shadow-lg hover:shadow-2xl transition hover:-translate-y-2"
            >
              <div className="text-5xl mb-4">
                {activity.icon}
              </div>

              <h3 className="text-2xl font-bold text-[#028CD4] mb-3">
                {activity.title}
              </h3>

              <p className="text-gray-600">
                {activity.desc}
              </p>
            </div>
          ))}

        </div>
      </section>

      {/* Statistics */}
      <section className="max-w-7xl mx-auto px-6 py-10">
        <div className="grid grid-cols-2 md:grid-cols-4 gap-6">

          <div className="bg-white p-6 rounded-2xl shadow-lg text-center">
            <h3 className="text-4xl font-bold text-[#028CD4]">1000+</h3>
            <p className="text-gray-600 mt-2">Participants</p>
          </div>

          <div className="bg-white p-6 rounded-2xl shadow-lg text-center">
            <h3 className="text-4xl font-bold text-[#028CD4]">50+</h3>
            <p className="text-gray-600 mt-2">Schools</p>
          </div>

          <div className="bg-white p-6 rounded-2xl shadow-lg text-center">
            <h3 className="text-4xl font-bold text-[#028CD4]">25+</h3>
            <p className="text-gray-600 mt-2">Events</p>
          </div>

          <div className="bg-white p-6 rounded-2xl shadow-lg text-center">
            <h3 className="text-4xl font-bold text-[#028CD4]">150+</h3>
            <p className="text-gray-600 mt-2">Awards</p>
          </div>

        </div>
      </section>

      {/* Benefits */}
      <section className="bg-white py-20 mt-16">
        <div className="max-w-7xl mx-auto px-6">

          <h2 className="text-4xl font-bold text-center mb-12">
            Benefits of Participation
          </h2>

          <div className="grid md:grid-cols-4 gap-8">

            <div className="text-center">
              <Award size={45} className="mx-auto text-[#028CD4]" />
              <h3 className="font-bold text-xl mt-4">
                Recognition
              </h3>
              <p className="text-gray-600 mt-2">
                Win awards, trophies and certificates.
              </p>
            </div>

            <div className="text-center">
              <Users size={45} className="mx-auto text-[#028CD4]" />
              <h3 className="font-bold text-xl mt-4">
                Confidence
              </h3>
              <p className="text-gray-600 mt-2">
                Improve stage presence and self-confidence.
              </p>
            </div>

            <div className="text-center">
              <Sparkles size={45} className="mx-auto text-[#028CD4]" />
              <h3 className="font-bold text-xl mt-4">
                Creativity
              </h3>
              <p className="text-gray-600 mt-2">
                Explore and develop artistic talents.
              </p>
            </div>

            <div className="text-center">
              <Music size={45} className="mx-auto text-[#028CD4]" />
              <h3 className="font-bold text-xl mt-4">
                Expression
              </h3>
              <p className="text-gray-600 mt-2">
                Showcase unique cultural and artistic skills.
              </p>
            </div>

          </div>

        </div>
      </section>

      {/* Eligibility */}
      <section className="max-w-7xl mx-auto px-6 py-20">
        <div className="bg-white rounded-3xl shadow-lg p-10">

          <h2 className="text-3xl font-bold mb-6">
            Eligibility
          </h2>

          <ul className="space-y-3 text-gray-600">
            <li>✔ Students from Class 1 to 12 can participate.</li>
            <li>✔ Individual and Group participation allowed.</li>
            <li>✔ Participants must follow competition guidelines.</li>
            <li>✔ Original performances and artwork are encouraged.</li>
          </ul>

        </div>
      </section>

      {/* CTA */}
      <section className="bg-linear-to-r from-[#028CD4] to-blue-700 text-white py-20">
        <div className="max-w-4xl mx-auto text-center px-6">

          <h2 className="text-5xl font-bold mb-6">
            Showcase Your Talent
          </h2>

          <p className="text-lg mb-8">
            Participate in cultural competitions and let your creativity shine.
          </p>
          
          <Link to="../competitions/Cultural" className="bg-white text-[#028CD4] px-10 py-4 rounded-2xl font-bold hover:scale-105 transition">
            Register Now
          </Link>

        </div>
      </section>

    </div>
  );
}

export default CulturalLearn;
import { Trophy, Medal, Users, Target } from "lucide-react";
import { Link } from "react-router-dom";

function SportsLearn() {
  return (
    <div className="bg-gray-50 min-h-screen">

      {/* Hero Section */}
      <section className="bg-linear-to-r from-[#028CD4] to-blue-700 text-white py-24 pt-40">
        <div className="max-w-7xl mx-auto px-6 text-center">
          <Trophy size={70} className="mx-auto mb-6" />

          <h1 className="text-5xl md:text-6xl font-bold mb-6">
            Sports Competitions
          </h1>

          <p className="max-w-3xl mx-auto text-xl text-blue-100">
            Showcase your athletic skills, teamwork, discipline and
            sportsmanship through exciting sports competitions.
          </p>
        </div>
      </section>

      {/* About */}
      <section className="max-w-7xl mx-auto px-6 py-20">
        <h2 className="text-4xl font-bold text-center mb-8">
          About Sports Competitions
        </h2>

        <p className="max-w-4xl mx-auto text-center text-gray-600 leading-8">
          Sports competitions provide students with opportunities to
          improve physical fitness, leadership qualities, teamwork and
          confidence. Participants compete in various indoor and outdoor
          sports while learning discipline and fair play.
        </p>
      </section>

      {/* Sports Categories */}
      <section className="max-w-7xl mx-auto px-6 pb-20">
        <h2 className="text-4xl font-bold text-center mb-12">
          Available Sports
        </h2>

        <div className="grid md:grid-cols-3 gap-8">

          {[
            {
              title: "Cricket",
              icon: "🏏",
              desc: "Demonstrate batting, bowling and fielding skills in competitive matches."
            },
            {
              title: "Kabaddi",
              icon: "🤼",
              desc: "Show strength, strategy and teamwork in exciting kabaddi events."
            },
            {
              title: "Chess",
              icon: "♟️",
              desc: "Test your intelligence and strategic thinking abilities."
            }
          ].map((sport, index) => (
            <div
              key={index}
              className="bg-white rounded-3xl p-8 shadow-lg hover:shadow-2xl transition hover:-translate-y-2"
            >
              <div className="text-5xl mb-4">
                {sport.icon}
              </div>

              <h3 className="text-2xl font-bold text-[#028CD4] mb-3">
                {sport.title}
              </h3>

              <p className="text-gray-600">
                {sport.desc}
              </p>
            </div>
          ))}
        </div>
      </section>

      {/* Stats */}
      <section className="max-w-7xl mx-auto px-6 py-10">
        <div className="grid grid-cols-2 md:grid-cols-4 gap-6">

          <div className="bg-white p-6 rounded-2xl shadow-lg text-center">
            <h3 className="text-4xl font-bold text-[#028CD4]">500+</h3>
            <p className="text-gray-600 mt-2">Players</p>
          </div>

          <div className="bg-white p-6 rounded-2xl shadow-lg text-center">
            <h3 className="text-4xl font-bold text-[#028CD4]">30+</h3>
            <p className="text-gray-600 mt-2">Schools</p>
          </div>

          <div className="bg-white p-6 rounded-2xl shadow-lg text-center">
            <h3 className="text-4xl font-bold text-[#028CD4]">15+</h3>
            <p className="text-gray-600 mt-2">Events</p>
          </div>

          <div className="bg-white p-6 rounded-2xl shadow-lg text-center">
            <h3 className="text-4xl font-bold text-[#028CD4]">100+</h3>
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
              <Trophy
                size={45}
                className="mx-auto text-[#028CD4]"
              />
              <h3 className="font-bold text-xl mt-4">
                Recognition
              </h3>
              <p className="text-gray-600 mt-2">
                Win trophies, medals and certificates.
              </p>
            </div>

            <div className="text-center">
              <Users
                size={45}
                className="mx-auto text-[#028CD4]"
              />
              <h3 className="font-bold text-xl mt-4">
                Teamwork
              </h3>
              <p className="text-gray-600 mt-2">
                Build collaboration and leadership skills.
              </p>
            </div>

            <div className="text-center">
              <Target
                size={45}
                className="mx-auto text-[#028CD4]"
              />
              <h3 className="font-bold text-xl mt-4">
                Discipline
              </h3>
              <p className="text-gray-600 mt-2">
                Improve focus and commitment.
              </p>
            </div>

            <div className="text-center">
              <Medal
                size={45}
                className="mx-auto text-[#028CD4]"
              />
              <h3 className="font-bold text-xl mt-4">
                Fitness
              </h3>
              <p className="text-gray-600 mt-2">
                Enhance physical and mental well-being.
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
            <li>✔ Individual and Team participation allowed.</li>
            <li>✔ School registration may be required.</li>
            <li>✔ Participants must follow sports rules and regulations.</li>
          </ul>

        </div>
      </section>

      {/* CTA */}
      <section className="bg-linear-to-r from-[#028CD4] to-blue-700 text-white py-20">
        <div className="max-w-4xl mx-auto text-center px-6">

          <h2 className="text-5xl font-bold mb-6">
            Ready to Compete?
          </h2>

          <p className="text-lg mb-8">
            Join our sports competitions and showcase your talent.
          </p>

          <Link  to="../competitions/Sports" className="bg-white text-[#028CD4] px-10 py-4 rounded-2xl font-bold hover:scale-105 transition">
            Register Now
          </Link>

        </div>
      </section>

    </div>
  );
}

export default SportsLearn;
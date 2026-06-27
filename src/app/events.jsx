import {
  Trophy,
  GraduationCap,
  Music,
  Medal,
  Users,
  Award,
  Sparkles,
  CalendarDays,
  CircleHelp,
} from "lucide-react";
import EventsSection from "../components/home/EventsSection";
import { motion } from "framer-motion";
import { Link } from "react-router-dom";

const stats = [
  { value: "5000+", label: "Participants" },
  { value: "50+", label: "Schools" },
  { value: "20+", label: "Competitions" },
  { value: "100+", label: "Awards" },
];

const categories = [
  {
    title: "Education Competitions",
    desc: "Quiz, Olympiad, essay writing, science challenge and academic activities for students.",
    icon: GraduationCap,
  },
  {
    title: "Sports Competitions",
    desc: "Indoor and outdoor sports events that promote discipline, teamwork and physical excellence.",
    icon: Trophy,
  },
  {
    title: "Cultural Programs",
    desc: "Dance, singing, drama, poetry, speech and creative talent competitions.",
    icon: Music,
  },
];

const benefits = [
  {
    title: "Certificates & Recognition",
    desc: "Participants and winners receive official certificates and recognition for their achievements.",
    icon: Award,
  },
  {
    title: "Confidence Building",
    desc: "Events help students improve stage confidence, communication and presentation skills.",
    icon: Sparkles,
  },
  {
    title: "Skill Development",
    desc: "Students sharpen academic, creative, cultural and leadership skills through participation.",
    icon: Medal,
  },
  {
    title: "Competitive Learning",
    desc: "Healthy competition motivates students to perform better and learn from peers.",
    icon: Trophy,
  },
  {
    title: "Teamwork & Leadership",
    desc: "Group activities and event participation develop responsibility, discipline and teamwork.",
    icon: Users,
  },
  {
    title: "Awards & Appreciation",
    desc: "Top performers receive prizes, awards and appreciation that inspire future growth.",
    icon: Award,
  },
];

const journey = [
  {
    title: "Registration Opens",
    desc: "Students can register online and choose their event category.",
  },
  {
    title: "Confirmation & Preparation",
    desc: "Participants receive confirmation and event details for preparation.",
  },
  {
    title: "Competition Day",
    desc: "Students participate, perform and showcase their talent with confidence.",
  },
  {
    title: "Results & Recognition",
    desc: "Top performers are announced and certificates / awards are distributed.",
  },
];

const faqs = [
  {
    q: "Who can participate in these events?",
    a: "Students from Class 5th to 12th can participate depending on the event category and eligibility.",
  },
  {
    q: "Will participants receive certificates?",
    a: "Yes, eligible participants and winners receive certificates and recognition based on participation and performance.",
  },
  {
    q: "How can I register for an event?",
    a: "You can register online through the registration page available on the website.",
  },
  {
    q: "Are these events only academic?",
    a: "No. We organize educational, sports, cultural, talent-search and creative competitions as well.",
  },
];



const Events = () => {
  return (
    <>
      {/* Hero Section */}
      <section className="relative flex h-[95vh] items-center justify-center overflow-hidden">
        <video
          autoPlay
          muted
          loop
          playsInline
          className="absolute h-full w-full object-cover"
        >
          <source src="/video/videoplayback (4).mp4 "type="video/mp4" />
        </video>

        <div className="absolute inset-0 bg-black/60" />

        <div className="relative z-10 px-6 text-center text-white">
          <motion.h1
            initial={{ y: 120, opacity: 0 }}
            animate={{ y: 0, opacity: 1 }}
            transition={{ duration: 0.8 }}
            className="mb-4 text-5xl font-extrabold md:text-7xl"
          >
            Our Events
          </motion.h1>

          <motion.p
            initial={{ x: 120, opacity: 0 }}
            animate={{ x: 0, opacity: 1 }}
            transition={{ duration: 0.8 }}
            className="mx-auto max-w-3xl text-lg leading-8 md:text-xl"
          >
            Discover exciting education, sports and cultural competitions
            designed for students from Class 5th to 12th, helping them
            showcase talent, build confidence and grow through healthy
            competition.
          </motion.p>

          <motion.div
            initial={{ y: 80, opacity: 0 }}
            animate={{ y: 0, opacity: 1 }}
            transition={{ duration: 0.9 }}
            className="mt-8 flex flex-wrap items-center justify-center gap-4"
          >
            <Link
              to="/register"
              className="rounded-2xl bg-[#028CD4] px-7 py-3.5 font-semibold text-white shadow-lg transition hover:bg-[#0277b7]"
            >
              Register Now
            </Link>

           
          </motion.div>
        </div>
      </section>

      {/* Stats Section */}
      <section className="bg-slate-50 py-16">
        <div className="mx-auto max-w-7xl px-6">
          <div className="grid grid-cols-2 gap-6 md:grid-cols-4">
            {stats.map((item, i) => (
              <div
                key={i}
                className="rounded-3xl bg-white p-6 text-center shadow-md transition hover:-translate-y-1 hover:shadow-xl"
              >
                <h3 className="text-4xl font-extrabold text-[#028CD4]">
                  {item.value}
                </h3>
                <p className="mt-2 text-slate-600">{item.label}</p>
              </div>
            ))}
          </div>
        </div>
      </section>

      {/* Featured Event */}
      <section className="bg-white py-24">
        <div className="mx-auto max-w-7xl px-6">
          <div className="grid items-center gap-10 md:grid-cols-2">
            <div className="overflow-hidden rounded-3xl shadow-2xl">
              <img
                src="/images/NIKON Z 502317.JPG.jpeg"
                alt="Talent Search Festival"
                className="h-full w-full object-cover"
              />
            </div>

            <div>
              <span className="inline-block rounded-full bg-blue-50 px-4 py-1.5 text-sm font-semibold text-blue-600">
                FEATURED EVENT
              </span>

              <h2 className="mt-4 text-4xl font-extrabold leading-tight text-slate-900 md:text-5xl">
                Talent Search Festival Nashariganj
              </h2>

              <p className="mt-6 text-lg font-light leading-8 text-gray-600">
                प्रतिभा खोज महोत्सव एक ऐसा मंच है, जहाँ बच्चों, युवाओं एवं
                प्रतिभाशाली व्यक्तियों को अपनी कला, ज्ञान, कौशल और रचनात्मकता
                प्रदर्शित करने का अवसर प्रदान किया जाता है। इस महोत्सव का
                उद्देश्य विभिन्न क्षेत्रों में छिपी हुई प्रतिभाओं की पहचान
                करना, उन्हें प्रोत्साहित करना तथा उनके आत्मविश्वास और व्यक्तित्व
                का विकास करना है। इसमें गायन, नृत्य, चित्रकला, भाषण,
                कविता-पाठ, अभिनय, सामान्य ज्ञान तथा अन्य रचनात्मक प्रतियोगिताओं
                का आयोजन किया जाता है। यह महोत्सव प्रतिभागियों को अपनी क्षमता
                दिखाने, नई प्रेरणा प्राप्त करने और उज्ज्वल भविष्य की ओर आगे
                बढ़ने का अवसर प्रदान करता है।
              </p>

              <div className="mt-8 flex flex-wrap gap-3">
                <span className="rounded-full bg-slate-100 px-4 py-2 text-sm font-medium text-slate-700">
                  Education
                </span>
                <span className="rounded-full bg-slate-100 px-4 py-2 text-sm font-medium text-slate-700">
                  Culture
                </span>
                <span className="rounded-full bg-slate-100 px-4 py-2 text-sm font-medium text-slate-700">
                  Talent Search
                </span>
              </div>
            </div>
          </div>
        </div>
      </section>

      {/* Event Categories */}
      <section className="bg-white py-20">
        <div className="mx-auto max-w-7xl px-6">
          <h2 className="mb-4 text-center text-4xl font-extrabold text-slate-900 md:text-5xl">
            Event Categories
          </h2>
          <p className="mx-auto mb-12 max-w-3xl text-center text-slate-600">
            We organize diverse competitions to help students explore their
            academic, athletic, creative and cultural potential.
          </p>

          <div className="grid gap-8 md:grid-cols-3">
            {categories.map((item, i) => {
              const Icon = item.icon;
              return (
                <div
                  key={i}
                  className="rounded-3xl border border-slate-200 bg-slate-50 p-8 shadow-sm transition hover:-translate-y-2 hover:shadow-xl"
                >
                  <div className="mb-5 inline-flex rounded-2xl bg-[#028CD4]/10 p-4 text-[#028CD4]">
                    <Icon size={28} />
                  </div>

                  <h3 className="text-2xl font-bold text-slate-900">
                    {item.title}
                  </h3>

                  <p className="mt-4 leading-7 text-slate-600">
                    {item.desc}
                  </p>
                </div>
              );
            })}
          </div>
        </div>
      </section>

      {/* Upcoming Events */}
      <section id="upcoming-events" className="bg-slate-50 py-20">
        <div className="mx-auto max-w-7xl px-6">
          <h2 className="mb-4 text-center text-4xl font-extrabold text-blue-600 md:text-5xl">
            Upcoming Events
          </h2>
          <p className="mx-auto mb-12 max-w-3xl text-center text-slate-600">
            Explore our upcoming competitions and choose the event that matches
            your passion, talent and ambition.
          </p>

          <EventsSection />
        </div>
      </section>

      {/* Why Participate */}
      <section className="bg-white py-20">
        <div className="mx-auto max-w-7xl px-6">
          <h2 className="mb-4 text-center text-4xl font-extrabold text-slate-900 md:text-5xl">
            Why Participate?
          </h2>
          <p className="mx-auto mb-12 max-w-3xl text-center text-slate-600">
            Our events are designed not just as competitions, but as learning
            experiences that shape confidence, creativity and leadership.
          </p>

          <div className="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
            {benefits.map((item, i) => {
              const Icon = item.icon;
              return (
                <div
                  key={i}
                  className="rounded-3xl  hover:border-slate-200 hover:bg-slate-50 p-6  transition hover:-translate-y-1 hover:shadow-lg"
                >
                  <div className="mb-4 inline-flex rounded-2xl bg-orange-50 p-3 text-[#F1400C]">
                    <Icon size={24} />
                  </div>

                  <h3 className="text-xl font-bold text-slate-900">
                    {item.title}
                  </h3>

                  <p className="mt-3 leading-7 text-slate-600">
                    {item.desc}
                  </p>
                </div>
              );
            })}
          </div>
        </div>
      </section>

      {/* Event Journey */}
      <section className="bg-slate-50 py-24">
        <div className="mx-auto max-w-5xl px-6">
          <h2 className="mb-4 text-center text-4xl font-extrabold text-slate-900 md:text-5xl">
            Event Journey
          </h2>
          <p className="mx-auto mb-14 max-w-3xl text-center text-slate-600">
            From registration to results, every event follows a smooth process
            to ensure a great experience for students and organizers.
          </p>

          <div className="space-y-6">
            {journey.map((item, i) => (
              <div
                key={i}
                className="flex gap-5 rounded bg-white p-6 shadow "
              >
                <div className="flex h-14 w-14 shrink-0 items-center justify-center rounded-2xl bg-blue-50 text-[#028CD4]">
                  <CalendarDays size={26} />
                </div>

                <div>
                  <h3 className="text-xl font-bold text-slate-900">
                    {item.title}
                  </h3>
                  <p className="mt-2 leading-7 text-slate-600">{item.desc}</p>
                </div>
              </div>
            ))}
          </div>
        </div>
      </section>

      

      {/* FAQ */}
      <section className="bg-slate-50 py-20">
        <div className="mx-auto max-w-4xl px-6">
          <h2 className="mb-4 text-center text-4xl font-extrabold text-slate-900 md:text-5xl">
            Frequently Asked Questions
          </h2>
          <p className="mx-auto mb-12 max-w-3xl text-center text-slate-600">
            Common questions about eligibility, participation, certificates and
            registration process.
          </p>

          <div className="space-y-5">
            {faqs.map((item, i) => (
              <div
                key={i}
                className="rounded-xl bg-white p-3 mt-10 shadow transition hover:shadow-md"
              >
                <div className="flex items-start gap-3 ">
                  <CircleHelp className="mt-1 text-[#028CD4]" size={22} />
                  <div>
                    <h3 className="text-lg font-bold text-slate-900">
                      {item.q}
                    </h3>
                    <p className="mt-2 leading-7 text-slate-600">{item.a}</p>
                  </div>
                </div>
              </div>
            ))}
          </div>
        </div>
      </section>

      {/* Final CTA */}
      <section className="bg-[#028CD4] py-24 text-center text-white">
        <div className="mx-auto max-w-4xl px-6">
          <h2 className="text-4xl font-extrabold md:text-5xl">
            Ready To Participate?
          </h2>

          <p className="mx-auto mt-5 max-w-2xl text-lg leading-8 text-white/90">
            Join our upcoming competitions and showcase your talent, creativity
            and skills on a bigger platform.
          </p>

          <div className="mt-8 flex flex-wrap items-center justify-center gap-4">
            <Link
              to="/register"
              className="rounded-2xl bg-white px-8 py-4 font-semibold text-[#028CD4] shadow-lg transition hover:bg-slate-100"
            >
              Register Now
            </Link>

          </div>
        </div>
      </section>
    </>
  );
};

export default Events;
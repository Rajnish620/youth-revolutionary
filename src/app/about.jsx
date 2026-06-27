import { Users, Target, Eye, } from "lucide-react";
import { Link } from "react-router-dom";
import { motion } from "framer-motion";

// ---------- animation variants ----------
const fadeUp = {
  hidden: { opacity: 0, y: 40 },
  visible: (i = 1) => ({
    opacity: 1,
    y: 0,
    transition: {
      delay: i * 0.08,
      duration: 0.6,
      ease: "easeOut",
    },
  }),
};



// ---------- data ----------
const teamMembers = [/* same as yours */];
const featuredMembers = [/* same as yours */];

const About = () => {
  return (
    <>
      {/* HERO */}
      <section className="relative h-[70vh] flex items-center justify-center">

        <motion.img
          src="/images/NIKON Z 502317.JPG.jpeg"
          alt="About Banner"
          initial={{ scale: 1.1, opacity: 0 }}
          animate={{ scale: 1, opacity: 1 }}
          transition={{ duration: 1 }}
          className="absolute w-full h-full object-cover"
        />

        <div className="absolute inset-0 bg-black/65"></div>

        <motion.div
          initial={{ opacity: 0, y: 30 }}
          animate={{ opacity: 1, y: 0 }}
          transition={{ delay: 0.3 }}
          className="relative z-10 text-center text-white px-6"
        >
          <h1 className="text-5xl md:text-7xl font-bold mb-4">
            About Us
          </h1>
          <p className="text-xl max-w-3xl mx-auto">
            Empowering Young Minds Through Education, Sports & Cultural Excellence.
          </p>
        </motion.div>
      </section>

      {/* ABOUT */}
      <section className="py-24 bg-white">
        <div className="max-w-7xl mx-auto px-6 grid md:grid-cols-2 gap-16 items-center">

          <motion.div
            initial={{ opacity: 0, x: -50 }}
            whileInView={{ opacity: 1, x: 0 }}
            viewport={{ once: true }}
          >
            <img
              src="/images/WhatsApp Image 2026-06-24 at 12.37.06 PM.jpeg"
              className="rounded-3xl shadow-xl"
              alt=""
            />
          </motion.div>

          <motion.div
            initial={{ opacity: 0, x: 50 }}
            whileInView={{ opacity: 1, x: 0 }}
            viewport={{ once: true }}
          >
            <h2 className="text-4xl font-bold mb-6">Youth Revolutionary</h2>
            <p className="text-gray-600 text-lg leading-8">
              Youth Revolutionary is a student-focused organization...
            </p>
          </motion.div>

        </div>
      </section>

      {/* MISSION / VISION */}
      <section className="py-24 bg-gray-100">
        <div className="max-w-7xl mx-auto px-6 grid md:grid-cols-2 gap-8">

          {[{
            icon: <Target size={50} className="text-blue-600 mb-4" />,
            title: "Our Mission",
            text: "To provide students..."
          }, {
            icon: <Eye size={50} className="text-blue-600 mb-4" />,
            title: "Our Vision",
            text: "To become one of the leading youth organizations..."
          }].map((item, i) => (
            <motion.div
              key={i}
              initial={{ opacity: 0, y: 40 }}
              whileInView={{ opacity: 1, y: 0 }}
              viewport={{ once: true }}
              transition={{ delay: i * 0.2 }}
              className="p-8 rounded-3xl hover:bg-white hover:shadow-md duration-300"
            >
              {item.icon}
              <h3 className="text-3xl font-bold mb-4">{item.title}</h3>
              <p className="text-gray-600">{item.text}</p>
            </motion.div>
          ))}

        </div>
      </section>

      {/* TEAM */}
      <section className="py-24 bg-white">
        <div className="max-w-7xl mx-auto px-6 text-center mb-14">
          <h2 className="text-5xl font-bold">Meet Our Team</h2>
        </div>

        <div className="grid gap-8 sm:grid-cols-2 lg:grid-cols-3">
          {teamMembers.map((member, index) => (
            <motion.div
              key={index}
              custom={index}
              variants={fadeUp}
              initial="hidden"
              whileInView="visible"
              viewport={{ once: true }}
              className="group overflow-hidden rounded-3xl border-2 border-blue-100 bg-white hover:-translate-y-2 hover:shadow transition"
            >
              <img
                src={member.image}
                className="h-72 w-full object-cover"
                alt={member.name}
              />

              <div className="p-6 text-left">
                <h3 className="text-xl font-bold">{member.name}</h3>
                <p className="text-blue-600 text-sm font-semibold">
                  {member.role}
                </p>
                <p className="text-sm text-gray-600 mt-3">
                  {member.description}
                </p>
              </div>
            </motion.div>
          ))}
        </div>
      </section>

      {/* FEATURED */}
      <section className="py-10">
        <div className="grid sm:grid-cols-3 md:grid-cols-6 gap-6 mx-10">

          {featuredMembers.map((member, i) => (
            <motion.div
              key={i}
              whileHover={{ scale: 1.05, y: -5 }}
              className="text-center p-2 border rounded-2xl"
            >
              <img
                src={member.image}
                className="w-24 h-24 mx-auto rounded-full object-cover"
              />
              <h3 className="mt-3 font-bold">{member.name}</h3>
              <p className="text-sm text-blue-600">{member.role}</p>
            </motion.div>
          ))}

        </div>
      </section>

      {/* STATS */}
      <motion.section
        initial={{ opacity: 0 }}
        whileInView={{ opacity: 1 }}
        className="py-24 bg-blue-600 text-white"
      >
        <div className="max-w-7xl mx-auto grid md:grid-cols-4 text-center gap-8">

          {[["5000+", "Students"], ["100+", "Competitions"], ["50+", "Schools"], ["15+", "Cities"]]
            .map((item, i) => (
              <div key={i}>
                <Users className="mx-auto mb-3" />
                <h3 className="text-4xl font-bold">{item[0]}</h3>
                <p>{item[1]}</p>
              </div>
            ))}
        </div>
      </motion.section>

      {/* CTA */}
      <section className="py-24 bg-gray-100 text-center">
        <h2 className="text-5xl font-bold mb-6">
          Ready To Showcase Your Talent?
        </h2>

        <div className="mt-10">
          <Link
          to="/register"
          className="bg-blue-600 text-white px-8 py-4 rounded-xl hover:bg-blue-700"
        >
          Register Now
        </Link>
        </div>
      </section>
    </>
  );
};

export default About;
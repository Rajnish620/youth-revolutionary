import { BookOpen, Trophy, Music } from "lucide-react";
import { motion } from "framer-motion";
import { Link } from "react-router-dom";

const categories = [
  {
    title: "Education",
    icon: <BookOpen size={40} />,
    description:
      "Quiz, Debate, Essay Writing and other academic competitions.",
    items: ["Quiz", "Debate", "Essay Writing"],
    EducationLearn:"../cateoriesSectionLearn/EducationLearn"
  },
  {
    title: "Sports",
    icon: <Trophy size={40} />,
    description:
      "Show your talent in various sports competitions.",
    items: ["Cricket", "Kabaddi", "Chess"],
  },
  {
    title: "Cultural",
    icon: <Music size={40} />,
    description:
      "Explore creativity through cultural activities.",
    items: ["Dance", "Singing", "Drawing"],
  },
];

const CategoriesSection = () => {
  return (

    <section className="bg-gray-50  pt-16">

      <div className="max-w-7xl mx-auto px-6  ">

        {/* Heading */}
        <div className="text-center mb-14">
          <h2 className="text-4xl font-bold text-gray-900">
            Competition Categories
          </h2>

          <p className="text-gray-600 mt-4">
            Choose your field and participate in exciting competitions.
          </p>
        </div>



        <section className="py-20">
          <div className="max-w-7xl mx-auto px-6">
            <div className="grid md:grid-cols-3 gap-10">

              {categories.map((category, index) => (
                <motion.div
                  initial={{
                    opacity: 0,
                    y: 100,
                  }}
                  whileInView={{
                    opacity: 1,
                    y: 0,
                  }}
                  viewport={{ once: true }}
                  transition={{
                    duration: 0.7,
                  }}
                  key={index}
                  className="group relative bg-white/80 backdrop-blur-lg border border-gray-100 rounded-3xl p-8 shadow-md 
                 hover:shadow-2xl hover:-translate-y-2 transition-all duration-300 overflow-hidden"
                >

                  {/* Glow background effect */}
                  <div className="absolute inset-0 bg-linear-to-br from-blue-50 to-transparent opacity-0 group-hover:opacity-100 transition"></div>

                  <div className="relative">

                    {/* Icon */}
                    <div className="w-14 h-14 flex items-center justify-center rounded-2xl 
                        bg-linear-to-r from-[#028CD4] to-indigo-500 text-white text-2xl mb-5
                        shadow-lg group-hover:scale-110 transition">
                      {category.icon}
                    </div>

                    {/* Title */}
                    <h3 className="text-2xl font-bold text-gray-900 mb-3 group-hover:text-[#EC3C00] transition">
                      {category.title}
                    </h3>

                    {/* Description */}
                    <p className="text-gray-600 mb-5 leading-relaxed">
                      {category.description}
                    </p>

                    {/* List */}
                    <ul className="space-y-2 text-gray-700">
                      {category.items.map((item, i) => (
                        <li key={i} className="flex items-start gap-2">
                          <span className="text-green-500 mt-1">✔</span>
                          <span>{item}</span>
                        </li>
                      ))}
                    </ul>

                    {/* Button */}
                    <Link
                      to={`/${category.title.toLowerCase()}learn`}
                      className="inline-block mt-5 px-5 py-2 bg-[#028CD4] text-white rounded-lg hover:bg-blue-700"
                    >
                      Learn More
                    </Link>

                  </div>
                </motion.div>
              ))}
            </div>
          </div>

        </section>
      </div>
    </section>
  );
};

export default CategoriesSection;
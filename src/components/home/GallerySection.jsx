import { Camera, ImageIcon } from "lucide-react";
import { Link } from "react-router-dom";
import { motion } from "framer-motion";

const galleryImages = [
  "/public/images/NIKON Z 502317.JPG.jpeg",
  "/public/images/1000262316.jpg.jpeg",
  "/public/images/1000262334.jpg.jpeg",
  "/public/images/1000262354.jpg.jpeg",
  "/public/images/1000262510.jpg.jpeg",
  "/public/images/1000262505.jpg.jpeg",
];

const GallerySection = () => {
  return (
    <section className="py-24 bg-white">
      <div className="max-w-7xl mx-auto px-6">

        {/* Heading */}
        <div className="text-center mb-14">
          <span className="text-blue-600 font-semibold uppercase tracking-widest">
            Gallery
          </span>

          <h2 className="text-4xl md:text-5xl font-bold mt-3">
            Moments That Inspire
          </h2>

          <p className="text-gray-600 mt-4 max-w-2xl mx-auto">
            Explore highlights from our Education, Sports and Cultural
            Competitions held across different locations.
          </p>
        </div>

        {/* Gallery Grid */}
        <div className="grid grid-cols-2 md:grid-cols-4 gap-4">

          {/* Large Image */}
          <div className="col-span-2 row-span-2 relative group overflow-hidden rounded-3xl">
            <motion.img
              whileHover={{
                scale: 1.1
              }}
              transition={{
                duration: 0.5
              }}

              src={galleryImages[0]}
              alt=""
              className="w-full h-full object-cover group-hover:scale-110 transition duration-700"
            />

            <div className="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition flex items-center justify-center">
              <Camera size={50} className="text-white" />
            </div>
          </div>

          {galleryImages.slice(1).map((img, index) => (
            <div
              key={index}
              className="relative group overflow-hidden rounded-3xl"
            >
              <img
                src={img}
                alt=""
                className="w-full h-64 object-cover group-hover:scale-110 transition duration-700"
              />

              <div className="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition flex items-center justify-center">
                <ImageIcon size={40} className="text-white" />
              </div>
            </div>
          ))}

        </div>

        {/* Stats */}
        <motion.div initial={{ opacity: 0, y: 500 }}
          animate={{ opacity: 1, y: 0 }}
          transition={{ duration: 0.8 }}

          className="grid md:grid-cols-3 gap-6 mt-16">

          <div className="bg-blue-50 p-8 rounded-3xl text-center">
            <h3 className="text-4xl font-bold text-blue-600">
              5000+
            </h3>
            <p className="text-gray-600 mt-2">
              Student Participants
            </p>
          </div>

          <div className="bg-orange-50 p-8 rounded-3xl text-center">
            <h3 className="text-4xl font-bold text-orange-500">
              100+
            </h3>
            <p className="text-gray-600 mt-2">
              Competitions Organized
            </p>
          </div>

          <div className="bg-green-50 p-8 rounded-3xl text-center">
            <h3 className="text-4xl font-bold text-green-600">
              50+
            </h3>
            <p className="text-gray-600 mt-2">
              Schools Connected
            </p>
          </div>

        </motion.div>

        {/* CTA */}
        <motion.div
          whileHover={{
            scale: 1.05,
            y: -5
          }}
          whileTap={{
            scale: 0.95
          }} className="text-center mt-14">
          <Link
            to="/gallery"
            className="inline-flex items-center gap-2 bg-blue-600 text-white px-8 py-4 rounded-xl hover:bg-blue-700 transition"
          >
            View Full Gallery
          </Link>
        </motion.div>

      </div>
    </section>
  );
};

export default GallerySection;
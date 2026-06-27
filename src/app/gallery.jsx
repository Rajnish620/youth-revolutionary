import { ChevronLeft, ChevronRight,  X } from "lucide-react";
import {  motion } from 'framer-motion';
import { useState } from "react";

const categories = ["All", "Session 1", "Session 2", "Session 3", "Session 4"];

const galleryItems = {
  "Session 1": [
    {
      image: "/public/images/dance1.JPG",
      title: "Quiz Competition",
    },
    {
      image: "/public/images/dance2.JPG",
      title: "Cricket Tournament",
    },
    {
      image: "/public/images/dance3.JPG",
      title: "Dance Performance",
    },
  ],

  "Session 2": [
    {
      image: "/public/images/danses.jpeg",
      title: "Debate Competition",
    },
    {
      image: "/public/images/quize.jpg",
      title: "Chess Championship",
    },
    {
      image: "/public/images/sports.png",
      title: "Singing Event",
    },
  ],

  "Session 3": [],

  "Session 4": [
  {
    image: "/public/images/song.JPG",
    title: "Singing Event",
  },
  {
    image: "/public/images/NIKON Z 502317.JPG.jpeg",
    title: "Award Ceremony",
  },
  {
    image: "/public/images/image2.jpg",
    title: "Chess Championship",
  },
  {
    image: "/public/images/image3.jpg",
    title: "Singing Event",
  },
  {
    image: "/public/images/image4.jpg",
    title: "Award Ceremony",
  },
  {
    image: "/public/images/image5.JPG",
    title: "Winner Celebration",
  },
  {
    image: "/public/images/1000262268.jpg.jpeg",
    title: "Singing Event",
  },
  {
    image: "/public/images/1000262306.jpg.jpeg",
    title: "Award Ceremony",
  },
  {
    image: "/public/images/1000262316.jpg.jpeg",
    title: "Winner Celebration",
  },
  {
    image: "/public/images/1000262334.jpg.jpeg",
    title: "Chess Championship",
  },
  {
    image: "/public/images/1000262354.jpg.jpeg",
    title: "Singing Event",
  },
  {
    image: "/public/images/1000262356.jpg.jpeg",
    title: "Award Ceremony",
  },
  {
    image: "/public/images/1000262437.jpg.jpeg",
    title: "Winner Celebration",
  },
  {
    image: "/public/images/WhatsApp Image 2026-06-24 at 1.07.17 PM.jpeg",
    title: "Singing Event",
  },
  {
    image: "/public/images/WhatsApp Image 2026-06-24 at 1.07.18 PM.jpeg",
    title: "Award Ceremony",
  },
  {
    image: "/public/images/WhatsApp Image 2026-06-24 at 1.07.20 PM.jpeg",
    title: "Winner Celebration",
  },
  {
    image: "/public/images/WhatsApp Image 2026-06-24 at 1.07.21 PM.jpeg",
    title: "Chess Championship",
  },
  {
    image: "/public/images/WhatsApp Image 2026-06-24 at 1.07.24 PM.jpeg",
    title: "Singing Event",
  },
  {
    image: "/public/images/WhatsApp Image 2026-06-24 at 1.07.27 PM.jpeg",
    title: "Award Ceremony",
  },
  {
    image: "/public/images/WhatsApp Image 2026-06-24 at 1.07.29 PM.jpeg",
    title: "Winner Celebration",
  },
  {
    image: "/public/images/WhatsApp Image 2026-06-24 at 1.07.30 PM.jpeg",
    title: "Singing Event",
  },
  {
    image: "/public/images/WhatsApp Image 2026-06-24 at 1.07.32 PM.jpeg",
    title: "Award Ceremony",
  },
  {
    image: "/public/images/WhatsApp Image 2026-06-24 at 1.07.35 PM.jpeg",
    title: "Winner Celebration",
  },
  {
    image: "/public/images/WhatsApp Image 2026-06-24 at 1.07.36 PM.jpeg",
    title: "Chess Championship",
  },
  {
    image: "/public/images/WhatsApp Image 2026-06-24 at 1.07.37 PM.jpeg",
    title: "Singing Event",
  },
  {
    image: "/public/images/WhatsApp Image 2026-06-24 at 1.07.38 PM.jpeg",
    title: "Award Ceremony",
  },
  {
    image: "/public/images/WhatsApp Image 2026-06-24 at 1.07.39 PM.jpeg",
    title: "Winner Celebration",
  },
  {
    image: "/public/images/WhatsApp Image 2026-06-24 at 1.07.42 PM.jpeg",
    title: "Singing Event",
  },
  {
    image: "/public/images/WhatsApp Image 2026-06-24 at 1.07.44 PM.jpeg",
    title: "Award Ceremony",
  },
  {
    image: "/public/images/WhatsApp Image 2026-06-24 at 1.07.45 PM.jpeg",
    title: "Winner Celebration",
  },
  {
    image: "/public/images/WhatsApp Image 2026-06-24 at 1.07.47 PM.jpeg",
    title: "Singing Event",
  },
  {
    image: "/public/images/WhatsApp Image 2026-06-24 at 1.07.49 PM.jpeg",
    title: "Award Ceremony",
  },
  {
    image: "/public/images/WhatsApp Image 2026-06-24 at 1.07.50 PM.jpeg",
    title: "Winner Celebration",
  },
  {
    image: "/public/images/WhatsApp Image 2026-06-24 at 1.07.51 PM.jpeg",
    title: "Singing Event",
  },
  {
    image: "/public/images/WhatsApp Image 2026-06-24 at 1.07.53 PM.jpeg",
    title: "Award Ceremony",
  },
  {
    image: "/public/images/WhatsApp Image 2026-06-24 at 1.07.54 PM.jpeg",
    title: "Winner Celebration",
  },
  {
    image: "/public/images/WhatsApp Image 2026-06-24 at 1.07.59 PM.jpeg",
    title: "Chess Championship",
  },
  {
    image: "/public/images/WhatsApp Image 2026-06-24 at 1.08.00 PM.jpeg",
    title: "Singing Event",
  },
  {
    image: "/public/images/WhatsApp Image 2026-06-24 at 1.08.02 PM.jpeg",
    title: "Award Ceremony",
  },
  {
    image: "/public/images/WhatsApp Image 2026-06-24 at 1.08.03 PM.jpeg",
    title: "Winner Celebration",
  },
  {
    image: "/public/images/WhatsApp Image 2026-06-24 at 1.08.04 PM.jpeg",
    title: "Chess Championship",
  },
  {
    image: "/public/images/WhatsApp Image 2026-06-24 at 1.08.05 PM.jpeg",
    title: "Singing Event",
  },
  {
    image: "/public/images/WhatsApp Image 2026-06-24 at 1.08.06 PM.jpeg",
    title: "Award Ceremony",
  },
  {
    image: "/public/images/WhatsApp Image 2026-06-24 at 1.08.07 PM.jpeg",
    title: "Winner Celebration",
  },
  {
    image: "/public/images/WhatsApp Image 2026-06-24 at 1.08.08 PM.jpeg",
    title: "Winner Celebration",
  },
  {
    image: "/public/images/WhatsApp Image 2026-06-24 at 1.08.10 PM.jpeg",
    title: "Winner Celebration",
  },
],
};
for (let i = 2; i <= 50; i++) {
  galleryItems["Session 3"].push({
    image: `/public/images/Session-3/image copy ${i}.png`,
  });
}

const gallery = () => {
  // eslint-disable-next-line react-hooks/rules-of-hooks
  const [activeCategory, setActiveCategory] = useState("All");
  // eslint-disable-next-line react-hooks/rules-of-hooks
  const [selectedIndex, setSelectedIndex] = useState(null);

  // Session wise filtering
  const filteredImages =
    activeCategory === "All"
      ? Object.values(galleryItems).flat()
      : galleryItems[activeCategory] || [];

  const nextImage = () => {
    setSelectedIndex((prev) =>
      prev === filteredImages.length - 1 ? 0 : prev + 1
    );
  };

  const prevImage = () => {
    setSelectedIndex((prev) =>
      prev === 0 ? filteredImages.length - 1 : prev - 1
    );
  };

  return (
    <>
      <section className="py-24 bg-slate-50 mt-20">
        <div className="max-w-7xl mx-auto px-6">
          {/* Heading */}
          <div className="text-center mb-12">
            <motion.h2
              initial={{ x: 500, opacity: 0 }}
              animate={{ x: 0, opacity: 1 }}
              transition={{ duration: 0.8 }}
              className="text-5xl font-bold mb-4"
            >
              Event Gallery
            </motion.h2>

            <motion.p
              initial={{ y: 500, opacity: 0 }}
              animate={{ y: 0, opacity: 1 }}
              transition={{ duration: 0.8 }}
              className="text-gray-600"
            >
              Moments of Learning, Sports & Celebration
            </motion.p>
          </div>

          {/* Filter Buttons */}
          <div className="flex flex-wrap justify-center gap-3 mb-14">
            {categories.map((category) => (
              <button
                key={category}
                onClick={() => {
                  setActiveCategory(category);
                  setSelectedIndex(null);
                }}
                className={`px-5 py-1.5 rounded-full transition hover:-translate-y-0.5 duration-300 shadow ${
                  activeCategory === category
                    ? "bg-blue-600 text-white"
                    : "bg-white border border-gray-200"
                }`}
              >
                {category}
              </button>
            ))}
          </div>

          {/* Masonry Gallery */}
          <div className="columns-1 sm:columns-2 lg:columns-3 gap-3">
            {filteredImages.map((item, index) => (
              <div
                key={index}
                className="mb-3 break-inside-avoid overflow-hidden rounded-md cursor-pointer group relative"
                onClick={() => setSelectedIndex(index)}
              >
                <img
                  src={item.image}
                  alt="image"
                  className="rounded-md group-hover:scale-110 transition duration-700"
                />

                <div className="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition flex flex-col justify-end p-5"></div>
              </div>
            ))}
          </div>
        </div>
      </section>

      {/* Fullscreen Lightbox */}
      {selectedIndex !== null && filteredImages.length > 0 && (
        <div className="fixed inset-0 z-50 bg-black/95 flex items-center justify-center">
          {/* Close */}
          <button
            onClick={() => setSelectedIndex(null)}
            className="absolute top-6 right-6 text-white"
          >
            <X size={40} />
          </button>

          {/* Previous */}
          <button onClick={prevImage} className="absolute left-5 text-white">
            <ChevronLeft size={50} />
          </button>

          {/* Image */}
          <img
            src={filteredImages[selectedIndex].image}
            alt={filteredImages[selectedIndex].title}
            className="max-w-[90vw] max-h-[90vh] object-contain rounded-2xl"
          />

          {/* Next */}
          <button onClick={nextImage} className="absolute right-5 text-white">
            <ChevronRight size={50} />
          </button>

          {/* Counter */}
          <div className="absolute bottom-6 text-white">
            {selectedIndex + 1} / {filteredImages.length}
          </div>
        </div>
      )}
    </>
  );
};

export default gallery;
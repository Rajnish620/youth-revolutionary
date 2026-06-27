
import { Calendar, MapPin } from "lucide-react";
import { Link } from "react-router-dom";

const events = [
  {
    title: "Quiz Competition",
    date: "14 September 2025",
    location: " Patna Nashariganj",
    image: "/public/images/quize.jpg",
  },
  {
    title: "Inter School run racing  Tournament",
    date: "20 September 2025",
    location: " Patna Nashariganj",
    image: "/public/images/FB_IMG_1780913014941.jpg.jpeg",
  },
  {
    title: "Dance Championship",
    date: "5 October 2025",
    location: " Patna Nashariganj",
    image: "/public/images/danses.jpeg",

  },
];

const EventsSection = () => {
  return (
    <section className="py-24 bg-gray-50">
      <div className="max-w-7xl mx-auto px-6">



        {/* Event Cards */}
        <div className="grid md:grid-cols-3 gap-8">

          {events.map((event, index) => (
            <div
              key={index}
              className="bg-white rounded-3xl overflow-hidden shadow-lg hover:shadow-xl transition duration-300 group hover:-translate-y-2"
            >
              {/* Image */}
              <div className="overflow-hidden ">
                <img
                  src={event.image}
                  alt={event.title}
                  className="w-full h-64 object-cover group-hover:scale-110 transition delay-200 duration-700"
                />
              </div>

              {/* Content */}
              <div className="p-6">

                <h3 className="text-2xl font-bold mb-4">
                  {event.title}
                </h3>

                <div className="flex items-center gap-2 text-gray-600 mb-3">
                  <Calendar size={18} />
                  {event.date}
                </div>

                <div className="flex items-center gap-2 text-gray-600 mb-5">
                  <MapPin size={18} />
                  {event.location}
                </div>


                <Link
                  to="/educationlearn"
                  className="inline-block mt-5 px-5 py-2 bg-[#028CD4] text-white rounded-lg hover:bg-blue-700"
                >
                  View Details
                </Link>

              </div>
            </div>
          ))}

        </div>

      </div>
    </section>
  );
};

export default EventsSection;
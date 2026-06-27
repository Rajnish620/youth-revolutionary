import {
  Trophy,
  Award,
  Medal,
  Star,
} from "lucide-react";

function TopWinners({ data }) {
  const topWinners = [...data]
    .sort((a, b) => a.rank - b.rank)
    .slice(0, 3);

  return (
    <section className="mb-20 m-6 ">
      <h2 className="text-4xl font-bold text-center my-16">
        🏆 Top 3 Champions
      </h2>

      <div className="grid md:grid-cols-3 gap-8">

        {topWinners.map((winner) => (

          <div
            key={winner.id}
            className={`relative bg-white rounded-lg overflow-hidden  hover:shadow-2xl hover:-translate-y-3 transition-all duration-300

            ${winner.rank === 1
                ? "ring-4 ring-yellow-400"
                : winner.rank === 2
                  ? "ring-4 ring-gray-300"
                  : "ring-4 ring-orange-400"
              }
            `}
          >

            {/* Header */}
            <div className="relative h-32 bg-[#028CD4] overflow-hidden">

              {/* Background Icons */}
              <Trophy
                size={60}
                className="absolute top-3 left-4 text-white/20"
              />

              <Award
                size={50}
                className="absolute top-4 right-10 text-white/20"
              />

              <Star
                size={25}
                className="absolute bottom-4 left-16 text-white/20"
              />

              <Medal
                size={35}
                className="absolute bottom-3 right-5 text-white/20"
              />

              {/* Decorative Circles */}
              <div className="absolute -top-10 -left-10 w-28 h-28 rounded-full bg-white/10"></div>

              <div className="absolute -bottom-10 -right-10 w-36 h-36 rounded-full bg-white/20"></div>

            </div>

            {/* Rank Badge */}
            <div className="absolute top-4 right-4 z-20">

              <span
                className={`px-4 py-2 rounded-full text-white font-bold shadow-lg

                ${winner.rank === 1
                    ? "bg-yellow-500"
                    : winner.rank === 2
                      ? "bg-gray-500"
                      : "bg-orange-500"
                  }
                `}
              >
                🏆 #{winner.rank}
              </span>

            </div>

            {/* Profile Image */}
            <div className="relative flex justify-center -mt-14 z-10">

              <div className="relative">

                <img
                  src={winner.image}
                  alt={winner.name}
                  className="w-32 h-32 rounded-full border-4 border-white shadow-xl object-cover"
                />


              </div>

            </div>

            {/* Content */}
            <div className="p-6 text-center">

              <div className="flex justify-center mb-4 ">
                <div
                  className={`
    p-3 rounded-full size-28 relative

    ${winner.rank === 1
                      ? "bg-yellow-100"
                      : winner.rank === 2
                        ? "bg-gray-100"
                        : "bg-orange-100"
                    }
  `}
                >
                  <Trophy
                    size={28}
                    className={`
      size-14 absolute left-7 top-6

      ${winner.rank === 1
                        ? "text-yellow-500"
                        : winner.rank === 2
                          ? "text-gray-500"
                          : "text-orange-500"
                      }
    `}
                  />
                </div>
              </div>

              <h3 className="text-2xl font-bold text-gray-800">
                {winner.name}
              </h3>

              <p className="text-[#028CD4] font-semibold mt-2">
                {winner.category}
              </p>

              <p className="text-gray-500 mt-1">
                Reg No: {winner.regNo}
              </p>

              <div className="flex justify-center gap-3 mt-5 flex-wrap">

                <div className="bg-green-100 text-green-700 px-4 py-2 rounded-full text-sm font-semibold">
                  🎯 Score: {winner.score}
                </div>

                <div className="bg-blue-100 text-blue-700 px-4 py-2 rounded-full text-sm font-semibold">
                  🏅 Rank #{winner.rank}
                </div>

              </div>

            </div>

          </div>

        ))}

      </div>
    </section>
  );
}

export default TopWinners;
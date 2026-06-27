import { useState } from "react";
import { sportsData } from "../data/SportsData";
import CompetitionsForm from "../forms/CompetitionsForm";

function Sports() {
  const [activeSport, setActiveSport] = useState(0);

  const selectedSport = sportsData[activeSport];

 

  return (
    
    <div className="mt-40 mb-10 max-w-7xl mx-auto px-4">
      <div className="text-center mb-10">
        <h1 className="text-4xl font-bold">
          Sports Competitions
        </h1>
        <p className="text-gray-600 mt-3">
          Participate in various sports events and showcase
          your talent.
        </p>
      </div>

      {/* Sports Buttons */}
      <div className="flex flex-wrap justify-center gap-4 mb-8">
        {sportsData.map((sport, index) => (
          <button
            key={index}
            onClick={() => setActiveSport(index)}
            className={`px-6 py-3 rounded-full font-semibold transition   shadow-sm  border border-gray-100 ${
              activeSport === index
               ? "bg-[#028CD4] text-white"
              : "bg-blue-50 border hover:bg-white "
              }`}
          >
            {sport.title}
          </button>
        ))}
      </div>

      {/* Banner */}
      <div className="bg-linear-to-r from-green-800 to-green-500 text-white p-8 rounded-2xl mb-8">
        <h2 className="text-3xl font-bold mb-3">
          {selectedSport.title}
        </h2>

        <p>{selectedSport.description}</p>
      </div>

      {/* Dates */}
      <div className="bg-green-50 border border-green-200 p-4 rounded-xl mb-8">
        <p className="text-center font-semibold">
          Registration Open:
          <span className="text-green-700 ml-2">
            {selectedSport.registrationStart}
          </span>
          {" "}to{" "}
          <span className="text-red-600">
            {selectedSport.registrationEnd}
          </span>
        </p>
      </div>

      {/* Details */}
      <div className="grid md:grid-cols-3 gap-6 mb-10">
        <div className="bg-white shadow rounded-xl p-5">
          <h3 className="font-bold text-green-700">
            Eligibility
          </h3>
          <p>{selectedSport.eligibility}</p>
        </div>

        <div className="bg-white shadow rounded-xl p-5">
          <h3 className="font-bold text-green-700">
            Mode
          </h3>
          <p>{selectedSport.mode}</p>
        </div>

        <div className="bg-white shadow rounded-xl p-5">
          <h3 className="font-bold text-green-700">
            Rewards
          </h3>
          <p>{selectedSport.rewards}</p>
        </div>
      </div>

      {/* Registration Form */}
      <div className="bg-white shadow-lg rounded-2xl p-8">
        <h3 className="text-2xl font-bold mb-6 text-center">
          {selectedSport.title} Registration
        </h3>

          <CompetitionsForm/>
      </div>
       {/* <img
          src="/public/images/sports.png"
          alt="Sports Competition"
          className="w-full h-full object-cover"
        /> */}


    </div>
  );
}

export default Sports;
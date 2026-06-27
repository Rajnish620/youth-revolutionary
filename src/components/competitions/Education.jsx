
import { useState } from "react";
import { competitionData } from "../data/CompetitionsData";
import CompetitionsForm from "../forms/CompetitionsForm";

function Education() {
 

  const [activeCompetition, setActiveCompetition] = useState(0);

  const selectedCompetition = competitionData[activeCompetition];



  return (

    <div>


      <div className="mt-40 mb-10 max-w-7xl mx-auto px-4">
        <div className="text-center mb-10">
          <h1 className="text-4xl font-bold text-gray-800">
            Education Competitions
          </h1>
          <p className="text-gray-600 mt-2">
            Participate in Quiz, Essay Writing, Drawing & Creative Art Competitions
            to showcase your talent and knowledge.
          </p>
        </div>



        <div className="bg-linear-to-r from-[#028CD4] to-blue-600 text-white p-8 rounded-2xl mb-8">
          <h2 className="text-3xl font-bold mb-3">
            {selectedCompetition.title}
          </h2>

          <p className="text-lg">
            {selectedCompetition.description}
          </p>
        </div>

        <div className="flex flex-wrap gap-4 justify-center mb-8">
          {competitionData.map((competition, index) => (
            <button
              key={index}
              onClick={() => setActiveCompetition(index)}
             className={`px-6 py-3 rounded-full font-semibold transition   shadow-sm  border border-gray-100  ${activeCompetition === index
              ? "bg-[#028CD4] text-white"
              : "bg-blue-50 border hover:bg-white "
              }`}
            >
              {competition.title}
            </button>
          ))}
        </div>

        <div className="bg-yellow-50 border border-yellow-300 rounded-xl p-4 mb-6">
          <p className="text-center font-semibold text-gray-800">
            📅 Registration Open:
            <span className="text-[#028CD4]"> {selectedCompetition.registrationStart} </span>
            to
            <span className="text-red-600"> {selectedCompetition.registrationEnd} </span>
          </p>
        </div>

        {/* Competition Details */}
        <div className="grid md:grid-cols-3 gap-6 mb-10">
          <div className="bg-white shadow-md rounded-xl p-5">
            <h3 className="font-bold text-[#028CD4] mb-2">Eligibility</h3>
            <p>{selectedCompetition.eligibility}</p>
          </div>

          <div className="bg-white shadow-md rounded-xl p-5">
            <h3 className="font-bold text-[#028CD4] mb-2">Mode</h3>
            <p> {selectedCompetition.mode}</p>
          </div>

          <div className="bg-white shadow-md rounded-xl p-5">
            <h3 className="font-bold text-[#028CD4] mb-2">Rewards</h3>
            <p>{selectedCompetition.rewards}</p>
          </div>
        </div>

        {/* Registration Form */}
        <div className="bg-white shadow-lg rounded-2xl p-8">
          <h3 className="text-2xl font-bold mb-6 text-center">
            {selectedCompetition.title}
          </h3>

         <CompetitionsForm/>
        </div>
      </div>


    </div>

  );
}

export default Education;
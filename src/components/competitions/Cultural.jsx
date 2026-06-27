import { useState } from "react"
import { culturalData } from "../data/culturalData"
import CompetitionsForm from "../forms/CompetitionsForm";
function Cultural() {

  const [activeCompetition, setActiveCompetition] = useState(0);
  const selectedCompetition = culturalData[activeCompetition];

  return (


    <div className="mt-40 mb-10 max-w-7xl mx-auto px-4">
      <div className="text-center mb-10">
        <h1 className="text-4xl font-bold">
          Cultural Competitions         </h1>
        <p className="text-gray-600 mt-3">
          Celebrate creativity, talent and culture through Dance,
          Singing, Drama and Fancy Dress competitions.
          Showcase your skills and win exciting prizes.
        </p>
      </div>


      <div className="flex flex-wrap justify-center gap-4 mb-10">
        {culturalData.map((item, index) => (
          <button
            key={index}
            onClick={() => setActiveCompetition(index)}
            className={`px-6 py-3 rounded-full font-semibold transition   shadow-sm  border border-gray-100  ${activeCompetition === index
              ? "bg-[#028CD4] text-white"
              : "bg-blue-50 border hover:bg-white "
              }`}
          >
            {item.title}
          </button>
        ))}
      </div>

      <div className="bg-linear-to-r from-[#028CD4] to-blue-600 text-white p-8 rounded-2xl mb-8">
        <h2 className="text-3xl font-bold mb-3">
          {selectedCompetition.title}
        </h2>

        <p className="text-lg">
          {selectedCompetition.description}
        </p>
      </div>

      <div className="bg-yellow-50 border border-yellow-300 rounded-xl p-4 mb-6">
        <p className="text-center font-semibold text-gray-800">
          📅 Registration Open:
          <span className="text-[#028CD4]"> {selectedCompetition.registrationStart} </span>
          to
          <span className="text-red-600"> {selectedCompetition.registrationEnd} </span>
        </p>
      </div>

      <div className="grid md:grid-cols-3 gap-6 mb-10">
        <div className="bg-white shadow-md rounded-xl p-5 border border-gray-100 hover:shadow-lg transition">
          <h3 className="font-bold text-[#028CD4] mb-2">
            Eligibility
          </h3>
          <p className="text-gray-600">
            {selectedCompetition.eligibility}
          </p>
        </div>

        <div className="bg-white shadow-md rounded-xl p-5 border border-gray-100 hover:shadow-lg transition">
          <h3 className="font-bold text-[#028CD4] mb-2">
            Category
          </h3>
          <p className="text-gray-600">
            {selectedCompetition.category}
          </p>
        </div>



        <div className="bg-white shadow-md rounded-xl p-5 border border-gray-100 hover:shadow-lg transition">
          <h3 className="font-bold text-[#028CD4] mb-2">
            Rewards
          </h3>
          <p className="text-gray-600">
            {selectedCompetition.rewards}
          </p>
        </div>
      </div>

       <div className="bg-white shadow-lg rounded-2xl p-8">
          <h3 className="text-2xl font-bold mb-6 text-center">
            {selectedCompetition.title}
          </h3>
           <CompetitionsForm />
          </div>

        
     
    </div>
  )
}

export default Cultural
import { motion } from "framer-motion";

const Terms = () => {
  return (
    <div className="bg-gray-50 min-h-screen py-40 px-6">

      <motion.div
        initial={{ opacity: 0, y: 30 }}
        animate={{ opacity: 1, y: 0 }}
        transition={{ duration: 0.6 }}
        className="max-w-5xl mx-auto bg-white rounded-2xl shadow-md p-8 md:p-12"
      >

        <h1 className="text-4xl font-bold text-gray-800 mb-6">
          Terms & Conditions
        </h1>

        <p className="text-gray-600 mb-6">
          Welcome to <b>Youth Revolutionary</b>. By accessing our website and participating in our programs,
          you agree to follow the terms and conditions mentioned below.
        </p>

        {/* Section 1 */}
        <h2 className="text-2xl font-semibold mt-8 mb-3">
          1. Participation
        </h2>
        <p className="text-gray-600 leading-7">
          Students from Class 5th to 12th are eligible to participate in our educational,
          sports, and cultural competitions. Participation must be done through proper registration.
        </p>

        {/* Section 2 */}
        <h2 className="text-2xl font-semibold mt-8 mb-3">
          2. Registration Rules
        </h2>
        <p className="text-gray-600 leading-7">
          All participants must provide correct information during registration.
          Any false or misleading information may result in disqualification.
        </p>

        {/* Section 3 */}
        <h2 className="text-2xl font-semibold mt-8 mb-3">
          3. Code of Conduct
        </h2>
        <p className="text-gray-600 leading-7">
          Participants are expected to maintain discipline, respect others,
          and follow all instructions given by organizers during events.
        </p>

        {/* Section 4 */}
        <h2 className="text-2xl font-semibold mt-8 mb-3">
          4. Event Changes
        </h2>
        <p className="text-gray-600 leading-7">
          Youth Revolutionary reserves the right to modify, reschedule,
          or cancel any event due to unavoidable circumstances.
        </p>

        {/* Section 5 */}
        <h2 className="text-2xl font-semibold mt-8 mb-3">
          5. Results & Decisions
        </h2>
        <p className="text-gray-600 leading-7">
          All decisions made by judges and organizing committee will be final
          and binding. No disputes will be entertained after results are declared.
        </p>

        {/* Section 6 */}
        <h2 className="text-2xl font-semibold mt-8 mb-3">
          6. Liability
        </h2>
        <p className="text-gray-600 leading-7">
          Youth Revolutionary is not responsible for any personal loss,
          injury, or damage during participation in any event.
        </p>

        {/* Section 7 */}
        <h2 className="text-2xl font-semibold mt-8 mb-3">
          7. Contact
        </h2>
        <p className="text-gray-600 leading-7">
          For any queries related to terms and conditions, you can contact us at:
          <br />
          <span className="text-blue-600 font-medium">
            info@youthrevolutionary.com
          </span>
        </p>

        {/* Footer note */}
        <p className="text-sm text-gray-400 mt-10">
          Last updated: June 2026
        </p>

      </motion.div>
    </div>
  );
};

export default Terms;
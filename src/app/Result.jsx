import ResultTable from "../components/results/ResultTable";
import Results from "../components/results/Results";
import resultsData from "../components/data/resultsData";
import StudentResultSearch from "../components/forms/StudentResultSearch";
import AdmitCard from "./AdmitCard";
import { motion } from "framer-motion";

const container = {
  hidden: { opacity: 0 },
  show: {
    opacity: 1,
    transition: {
      staggerChildren: 0.15,
    },
  },
};

const fadeUp = {
  hidden: { opacity: 0, y: 40 },
  show: {
    opacity: 1,
    y: 0,
    transition: {
      duration: 0.6,
      ease: "easeOut",
    },
  },
};

function Result() {
  return (
    <motion.div
      className="mt-40"
      initial="hidden"
      animate="show"
      variants={container}
    >
      <section className="md:mx-30 lg:mx-40">

        {/* Results Header */}
        <motion.div variants={fadeUp}>
          <Results data={resultsData} />
        </motion.div>

        {/* Admit Card */}
        <motion.div variants={fadeUp}>
          <AdmitCard />
        </motion.div>

        {/* Search */}
        <motion.div variants={fadeUp}>
          <StudentResultSearch data={resultsData} />
        </motion.div>

        {/* Table */}
        <motion.div variants={fadeUp}>
          <ResultTable data={resultsData} />
        </motion.div>

      </section>
    </motion.div>
  );
}

export default Result;
import { BrowserRouter, Routes, Route } from "react-router-dom";

import Navbar from "./components/Navbar";
import Footer from "./components/Footer";

import Home from "./app/Home";
import About from "./app/about";
import Events from "./app/events";
import Results from "./app/Result";
import Gallery from "./app/gallery";
import Contact from "./app/contact";
import Register from "./app/register";
import Education from "./components/competitions/Education";
import Sports from "./components/competitions/Sports";
import Cultural from "./components/competitions/Cultural";
import EducationLearn from "./components/cateoriesSectionLearn/EducationLearn";
import SportsLearn from "./components/cateoriesSectionLearn/SportsLearn";
import CulturalLearn from "./components/cateoriesSectionLearn/CulturalLearn";
import Terms from "./components/home/Terms";



function App() {
  return (
    <BrowserRouter>
      <Navbar />

      <Routes>
        <Route path="/" element={<Home />} />
        <Route path="/about" element={<About />} />

        <Route path="/events" element={<Events />} />
        <Route path="/results" element={<Results />} />
        <Route path="/competitions/education" element={<Education />} />
        <Route path="/competitions/sports" element={<Sports />} />
        <Route path="/competitions/cultural" element={<Cultural />} />


        <Route path="/gallery" element={<Gallery />} />
        <Route path="/contact" element={<Contact />} />
        <Route path="/register" element={<Register />} />


        <Route path="/educationlearn" element={<EducationLearn/>} />
        <Route path="/sportslearn" element={<SportsLearn/>} />
        <Route path="/culturallearn" element={<CulturalLearn/>} />
        <Route path="/terms" element={<Terms/>} />

        
        
      </Routes>


      <Footer />
    </BrowserRouter>
  );
}

export default App;
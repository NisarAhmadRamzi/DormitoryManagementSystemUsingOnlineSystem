import React from "react";
import "./App.css";
import ReactDOM from "react-dom/client";
import Admin from "./admin/Admin";
import Home from "./home/Home";
import { BrowserRouter, Route, Routes } from "react-router-dom";
import Navbar from "./navbar/Navbar";
import About from "./about/About";
import Contact from "./contact/Contact";
import View_Dorm from "./view-dorm/View_Dorm";
import Member from "./member/Member";
import "bootstrap/dist/css/bootstrap.min.css";
import Footer from "./footer/Footer";
import AdminPanel from "./adminPanel/AdminPanel";
export default function App() {
    return (
        <BrowserRouter>
            <Navbar />
            <Routes>
                <Route path="/" element={<Home />} />
                <Route path="/admin" element={<Admin />} />
                <Route path="/about" element={<About />} />
                <Route path="/contact" element={<Contact />} />
                <Route path="/view-dorm" element={<View_Dorm />} />
                <Route path="/member" element={<Member />} />
                <Route path="/adminPanel" element={<AdminPanel />} />
            </Routes>
            <Footer />
        </BrowserRouter>
    );
}

const container = document.getElementById("app");
const root = ReactDOM.createRoot(container); // Note the lowercase `root` here (variable name shouldn't conflict with imported modules)
root.render(<App />);

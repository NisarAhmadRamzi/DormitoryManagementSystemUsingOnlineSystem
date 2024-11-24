import React from "react";
import "./App.css";
import ReactDOM from "react-dom/client";
import Admin from "../pages/admin/Admin";
import Home from "../pages/home/Home";
import { BrowserRouter, Route, Routes } from "react-router-dom";
import Navbar from "./navbar/Navbar";
import About from "../pages/about/About";
import Contact from "../pages/contact/Contact";
import View_Dorm from "../pages/view-dorm/View_Dorm";
import Member from "../pages/member/Member";
import "bootstrap/dist/css/bootstrap.min.css";
import AdminPanel from "../pages/adminPanel/AdminPanel";
import AdminItem from "../pages/adminItem/AdminItem";
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
                <Route path="/adminItem" element={<AdminItem />} />
            </Routes>
        </BrowserRouter>
    );
}

const container = document.getElementById("app");
const root = ReactDOM.createRoot(container); // Note the lowercase `root` here (variable name shouldn't conflict with imported modules)
root.render(<App />);

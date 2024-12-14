import React from "react";
import "./App.css";
import ReactDOM from "react-dom/client";
import Admin from "../pages/admin/Admin";
import Home from "../pages/home/Home";
import { BrowserRouter, useRoutes } from "react-router-dom";
import About from "../pages/about/About";
import Contact from "../pages/contact/Contact";
import View_Dorm from "../pages/view-dorm/View_Dorm";
import Member from "../pages/member/Member";
import "bootstrap/dist/css/bootstrap.min.css";
import AdminPanel from "../pages/adminPanel/AdminPanel";
import AddUser from "../pages/addUser/AddUser";
import EditUser from "../pages/editUser/EditUser";
import MyNavbar from "./navbar/Navbar";
export default function App() {
    const routes = useRoutes([
        { path: "/", element: <Home /> },
        { path: "/admin", element: <Admin /> },
        { path: "/about", element: <About /> },
        { path: "/contact", element: <Contact /> },
        { path: "/view-dorm", element: <View_Dorm /> },
        { path: "/member", element: <Member /> },
        { path: "/adminPanel", element: <AdminPanel /> },
        { path: "/addUser", element: <AddUser /> },
        { path: "/editUser/:userId", element: <EditUser /> },
    ]);
    return routes;
}

const container = document.getElementById("app");
const root = ReactDOM.createRoot(container); // Note the lowercase `root` here (variable name shouldn't conflict with imported modules)
root.render(
    <BrowserRouter>
        <MyNavbar />
        <App />
    </BrowserRouter>
);

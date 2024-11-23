import React from "react";
import "./App.css";
import ReactDOM from "react-dom/client";
import { BrowserRouter, Route, Routes, useRoutes } from "react-router-dom";
import Navbar from "./navbar/Navbar";
import "bootstrap/dist/css/bootstrap.min.css";
import routes from "./routes";
export default function App() {
    let router = useRoutes(routes);
    return router;
}

const container = document.getElementById("app");
const root = ReactDOM.createRoot(container); // Note the lowercase `root` here (variable name shouldn't conflict with imported modules)
root.render(
    <BrowserRouter>
        <Navbar />
        <App />
    </BrowserRouter>
);

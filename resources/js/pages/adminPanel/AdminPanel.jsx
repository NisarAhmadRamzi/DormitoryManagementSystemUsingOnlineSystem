// import React, { useEffect } from "react";
// import "./AdminPanel.css";
// import { Link } from "react-router-dom";
// import {
//     FaTachometerAlt,
//     FaFileAlt,
//     FaUsers,
//     FaInfoCircle,
//     FaCog,
//     FaUserShield,
// } from "react-icons/fa";
// import { FaTrashCanArrowUp } from "react-icons/fa6";
// import { LiaEdit } from "react-icons/lia"; // Import relevant icons
// import { Button } from "react-bootstrap";

// const AdminPanel = () => {
//     return (
//         <div className="container-fluid">
//             <div className="row">
//                 {/* Sidebar */}
//                 <div className="col-md-3 col-lg-2 bg-dark text-white p-4">
//                     <h4>Admin Panel</h4>
//                     <ul className="nav flex-column">
//                         <li className="nav-item">
//                             <Link
//                                 to="/admin/dashboard"
//                                 className="nav-link text-white"
//                             >
//                                 <span className="mr-2">
//                                     <FaTachometerAlt />
//                                 </span>{" "}
//                                 Dashboard
//                             </Link>
//                         </li>
//                         <li className="nav-item">
//                             <Link
//                                 to="/admin/posts"
//                                 className="nav-link text-white"
//                             >
//                                 <span className="mr-2">
//                                     <FaFileAlt />
//                                 </span>{" "}
//                                 Posts
//                             </Link>
//                         </li>
//                         <li className="nav-item">
//                             <Link
//                                 to="/admin/users"
//                                 className="nav-link text-white"
//                             >
//                                 <span className="mr-2">
//                                     <FaUsers />
//                                 </span>{" "}
//                                 Users
//                             </Link>
//                         </li>
//                         <li className="nav-item">
//                             <Link
//                                 to="/admin/about"
//                                 className="nav-link text-white"
//                             >
//                                 <span className="mr-2">
//                                     <FaInfoCircle />
//                                 </span>{" "}
//                                 About
//                             </Link>
//                         </li>
//                         <li className="nav-item">
//                             <Link
//                                 to="/admin/settings"
//                                 className="nav-link text-white"
//                             >
//                                 <span className="mr-2">
//                                     <FaCog />
//                                 </span>{" "}
//                                 Settings
//                             </Link>
//                         </li>
//                         <li className="nav-item">
//                             <Link
//                                 to="/admin/roles"
//                                 className="nav-link text-white"
//                             >
//                                 <span className="mr-2">
//                                     <FaUserShield />
//                                 </span>{" "}
//                                 Roles
//                             </Link>
//                         </li>
//                     </ul>
//                 </div>

//                 {/* Main content */}
//                 <div className="col-md-9 col-lg-10 p-4">
//                     <div className="cont-title">
//                         <h2>Admins</h2>
//                         <Link to="/addUser">
//                             <Button variant="success">Add User</Button>
//                         </Link>
//                     </div>
//                     <div className="table-responsive">
//                         <table className="table table-bordered table-striped">
//                             <thead className="thead-dark">
//                                 <tr>
//                                     <th>Number</th>
//                                     <th>Name</th>
//                                     <th>Email</th>
//                                     <th>User Role</th>
//                                     <th>Image</th>
//                                     <th>Action</th>
//                                 </tr>
//                             </thead>
//                             <tbody>
//                                 <tr>
//                                     <td>1</td>
//                                     <td>Mohammad</td>
//                                     <td>mohammad@gmail.com</td>
//                                     <td>1</td>
//                                     <td>
//                                         <img
//                                             src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSwRPWpO-12m19irKlg8znjldmcZs5PO97B6A&s"
//                                             alt="Mohammad"
//                                             className="img-thumbnail"
//                                             style={{
//                                                 width: "50px",
//                                                 height: "50px",
//                                                 borderRadius: "50%",
//                                             }}
//                                         />
//                                     </td>
//                                     <td>
//                                         <button style={{ border: "none" }}>
//                                             <LiaEdit
//                                                 style={{
//                                                     fontSize: "25px",
//                                                     margin: "0 10px",
//                                                     color: "blue",
//                                                 }}
//                                             />
//                                         </button>
//                                         <button style={{ border: "none" }}>
//                                             <FaTrashCanArrowUp
//                                                 style={{
//                                                     fontSize: "20px",
//                                                     color: "red",
//                                                 }}
//                                             />
//                                         </button>
//                                         <button
//                                             style={{
//                                                 border: "none",
//                                                 marginLeft: "10px",
//                                             }}
//                                         >
//                                             See more ....
//                                             <LiaEdit
//                                                 style={{
//                                                     fontSize: "25px",
//                                                     color: "blue",
//                                                 }}
//                                             />
//                                         </button>
//                                     </td>
//                                 </tr>
//                             </tbody>
//                         </table>
//                     </div>
//                 </div>
//             </div>
//         </div>
//     );
// };

// export default AdminPanel;

//*** */ Fake Api from json ***//
import axios from "axios";
import React, { useEffect } from "react";
import { useState } from "react";

function AdminPanel() {
    const [data, setData] = useState(null);
    const [error, setError] = useState(null);
    const [loading, setLoading] = useState(true);
    useEffect(() => {
        const fetchData = async () => {
            try {
                const response = await axios.get("api/users");
                setData(response.data);
            } catch (error) {
                console.log("e h");
                setError(error.message);
            } finally {
                setLoading(false);
            }
        };
        fetchData();
    }, []);
    if (loading)
        return (
            <div>
                <h1>Loading ...</h1>
            </div>
        );

    if (error)
        return (
            <div>
                <h1>Error : {error}</h1>
            </div>
        );

    return (
        <div>
            <h1>Data from Api</h1>
            <pre>{JSON.stringify(data, null, 2)}</pre>
        </div>
    );
}

export default AdminPanel;

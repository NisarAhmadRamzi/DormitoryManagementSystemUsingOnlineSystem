import axios from "axios";
import "./AdminPanel.css"; // Assuming you are importing CSS file
import React, { useEffect, useState } from "react";
import { FaTrash } from "react-icons/fa";
import { CiEdit } from "react-icons/ci";
import {
    FaTachometerAlt,
    FaFileAlt,
    FaUsers,
    FaInfoCircle,
    FaCog,
    FaLock,
} from "react-icons/fa"; // Import icons for the sidebar

function AdminPanel() {
    const [data, setData] = useState([]);
    const [error, setError] = useState(null);
    const [loading, setLoading] = useState(true);

    useEffect(() => {
        const fetchData = async () => {
            try {
                const response = await axios.get("api/users"); // Fetch data from the API
                setData(response.data.data); // Update state with fetched data
            } catch (error) {
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
                <h1>Error: {error}</h1>
            </div>
        );

    return (
        <div className="d-flex">
            {/* Sidebar */}
            <div
                className="sidebar"
                style={{
                    width: "30%",
                    backgroundColor: "#333333",
                    height: "100vh",
                    color: "#00ff0d",
                    padding: "20px",
                }}
            >
                <h3 className="text-center">Admin Panel</h3>
                <ul className="list-unstyled">
                    <li className="li-margin">
                        <a
                            href="#"
                            style={{ color: "#00ff0d", textDecoration: "none" }}
                        >
                            <FaTachometerAlt /> Dashboard
                        </a>
                    </li>
                    <li className="li-margin">
                        <a
                            href="#"
                            style={{ color: "#00ff0d", textDecoration: "none" }}
                        >
                            <FaFileAlt /> Posts
                        </a>
                    </li>
                    <li className="li-margin">
                        <a
                            href="#"
                            style={{ color: "#00ff0d", textDecoration: "none" }}
                        >
                            <FaUsers /> Users
                        </a>
                    </li>
                    <li className="li-margin">
                        <a
                            href="#"
                            style={{ color: "#00ff0d", textDecoration: "none" }}
                        >
                            <FaInfoCircle /> About
                        </a>
                    </li>
                    <li className="li-margin">
                        <a
                            href="#"
                            style={{ color: "#00ff0d", textDecoration: "none" }}
                        >
                            <FaCog /> Settings
                        </a>
                    </li>
                    <li className="li-margin">
                        <a
                            href="#"
                            style={{ color: "#00ff0d", textDecoration: "none" }}
                        >
                            <FaLock /> Roles
                        </a>
                    </li>
                </ul>
            </div>

            {/* Main Content */}
            <div
                className="container"
                style={{ marginLeft: "250px", padding: "20px" }}
            >
                <h1>User Information</h1>
                <table className="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Image</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        {data?.map((user) => (
                            <tr key={user.user_id}>
                                <td>{user.user_id}</td>
                                <td>{user.name}</td>
                                <td>{user.email}</td>
                                <td>{user.user_role}</td>
                                <td>
                                    <img
                                        src={user.image || "/default-image.jpg"}
                                        alt={user.name}
                                        width={50}
                                        height={50}
                                    />
                                </td>
                                <td style={{ padding: "5px" }}>
                                    <button
                                        onClick={() => handleEdit(user.user_id)}
                                        className="btn btn-sm"
                                        title="Edit"
                                    >
                                        <CiEdit
                                            style={{
                                                color: "blue",
                                                fontSize: "25px",
                                            }}
                                        />{" "}
                                        {/* Edit icon */}
                                    </button>
                                    <button
                                        onClick={() =>
                                            handleDelete(user.user_id)
                                        }
                                        className="btn btn-sm"
                                        title="Delete"
                                    >
                                        <FaTrash style={{ color: "red" }} />{" "}
                                        {/* Delete icon */}
                                    </button>
                                </td>
                            </tr>
                        ))}
                    </tbody>
                </table>
            </div>
        </div>
    );

    // Example handler functions for the buttons
    function handleEdit(userId) {
        console.log("Edit user with ID:", userId);
        // Add your edit logic here (e.g., navigate to edit form)
    }

    function handleDelete(userId) {
        console.log("Delete user with ID:", userId);
        // Add your delete logic here (e.g., API call to delete user)
    }
}

export default AdminPanel;

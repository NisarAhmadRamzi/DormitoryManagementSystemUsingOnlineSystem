// import axios from "axios";
// import React, { useEffect } from "react";
// import { useState } from "react";
// import AdminItem from "../adminItem/AdminItem";

// function AdminPanel() {
//     const [data, setData] = useState(null);
//     const [error, setError] = useState(null);
//     const [loading, setLoading] = useState(true);
//     useEffect(() => {
//         const fetchData = async () => {
//             try {
//                 const response = await axios.get("api/users");
//                 setData(response.data);
//             } catch (error) {
//                 console.log("e h");
//                 setError(error.message);
//             } finally {
//                 setLoading(false);
//             }
//         };
//         fetchData();
//     }, []);
//     if (loading)
//         return (
//             <div>
//                 <h1>Loading ...</h1>
//             </div>
//         );

//     if (error)
//         return (
//             <div>
//                 <h1>Error : {error}</h1>
//             </div>
//         );

//     return (
//         <div>
//             <h1>Data from Api</h1>
//             <pre>{JSON.stringify(data, null, 2)}</pre>
//             <AdminItem />
//         </div>
//     );
// }

// export default AdminPanel;

import axios from "axios";
import React, { useEffect } from "react";
import { useState } from "react";
import AdminItem from "../adminItem/AdminItem";

function AdminPanel() {
    const [data, setData] = useState([]);
    const [error, setError] = useState(null);
    const [loading, setLoading] = useState(true);
    useEffect(() => {
        const fetchData = async () => {
            try {
                const response = await axios.get("api/users");
                setData(response.data.data);
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
            {data?.map((data1) => (
                <div className="div">
                    <AdminItem user={data1} />
                </div>
            ))}
        </div>
    );
}

export default AdminPanel;

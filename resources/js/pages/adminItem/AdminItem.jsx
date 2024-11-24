import React from "react";

function AdminItem({ user }) {
    console.log(user);
    return (
        <div>
            <h1>User information</h1>
            <p>User_id : {user.user_id}</p>
            <p>Name : {user.name}</p>
            <p>Email : {user.email}</p>
            <p>User Role : {user.user_role}</p>
        </div>
    );
}

export default AdminItem;

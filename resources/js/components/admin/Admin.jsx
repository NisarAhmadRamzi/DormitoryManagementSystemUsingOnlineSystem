import React from "react";
import "./Admin.css";
function Admin() {
    return (
        <div className="wrapper">
            <form action="#">
                <h2>Admin Login Page!</h2>
                <div className="input-field">
                    <input
                        type="text"
                        required
                        placeholder="Enter Your Email"
                    />
                    <label htmlFor=""></label>
                </div>
                <div className="input-field">
                    <input
                        type="password"
                        required
                        placeholder="Enter Your Password!"
                    />
                    <label htmlFor=""></label>
                </div>
                <div className="forget">
                    <label htmlFor="" for="remember">
                        <input type="checkbox" id="remember me" />
                        <p>Remember me</p>
                    </label>
                    <a href="#">Forget Password</a>
                </div>
                <button type="submit">Log In</button>
                <div className="register">
                    <p>
                        Don't have an account?
                        <a href="#">Register</a>
                    </p>
                </div>
            </form>
        </div>
    );
}

export default Admin;

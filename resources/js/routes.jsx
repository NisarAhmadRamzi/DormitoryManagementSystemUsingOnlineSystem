import Home from "./pages/home/Home";
import Admin from "./pages/admin/Admin";
import About from "./pages/about/About";
import Contact from "./pages/contact/Contact";
import View_Dorm from "./pages/view-dorm/View_Dorm";
import Member from "./pages/member/Member";
import AdminPanel from "./pages/adminPanel/AdminPanel";
import AddUser from "./pages/addUser/AddUser";
import EditUser from "./pages/editUser/EditUser";
export const allRoutes = [
    { path: "/", element: <Home /> },
    { path: "/admin", element: <Admin /> },
    { path: "/about", element: <About /> },
    { path: "/contact", element: <Contact /> },
    { path: "/view-dorm", element: <View_Dorm /> },
    { path: "/member", element: <Member /> },
    { path: "/adminPanel", element: <AdminPanel /> },
    { path: "/addUser", element: <AddUser /> },
    { path: "/editUser/:userId", element: <EditUser /> },
];

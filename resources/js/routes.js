import Home from './components/Home'
import Register from './components/Auth/Register'
import Login from "./components/Auth/Login";
import ApiCalling from "./components/ApiCalling";

const routes = [
    {
        path: '/home',
        component: Home,
        name: 'home',
    },
    {
        path: '/register',
        component: Register,
        name: 'register',
        meta: {
            auth: false
        }
    },
    {
        path: '/login',
        component: Login,
        name: 'login',
        meta: {
            auth: false
        }
    },
    {
        path: '/api-calling',
        component: ApiCalling,
        name: 'api_calling',
    },
];

export default routes;

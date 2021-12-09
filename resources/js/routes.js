import Home from './components/Home'
import Register from './components/Auth/Register'
import Login from "./components/Auth/Login";
import ApiCalling from "./components/ApiCalling";

var authen = (to, form, next) => {
    axios.get('/api/authenticated').then(()=>{
        next()
    }).catch(()=>{
        return next({name : 'login'})
    })
}

const routes = [
    {
        path: '/home',
        component: Home,
        name: 'home',
        meta: {requiresAuth: true},
    },
    {
        path: '/register',
        component: Register,
        name: 'register',
        meta: {guest: true}
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
        beforeEnter: (to, form, next) => {
            axios.get('/api/authenticated').then(()=>{
                next()
            }).catch(()=>{
                return next({name : 'login'})
            })
        }
    },
];


export default routes;

import guest from 'Middleware/guest.js'; 
import user from 'Middleware/user.js';

import Home from 'Components/Pages/Home.vue'
import Login from 'Components/Pages/Login.vue'
import Register from 'Components/Pages/Register.vue'
import Organizations from 'Components/Pages/Organization/Index.vue'
import OrganizationCreate from 'Components/Pages/Organization/Create.vue'
import OrganizationEdit from 'Components/Pages/Organization/Edit.vue'
import Users from 'Components/Pages/User/Index.vue'
import UserCreate from 'Components/Pages/User/Create.vue'
import UserEdit from 'Components/Pages/User/Edit.vue'

var routes = [
    { path: '/', name: 'home', component: Home, meta: {middleware: [guest]} },
    { path: '/login', name: 'login', component: Login, meta: {middleware: [user]} },
    { path: '/register', name: 'register', component: Register, meta: {middleware: [user]} },
    { path: '/organizations', component: Organizations, meta: {middleware: [guest]} },
    { path: '/organizations/create', component: OrganizationCreate, meta: {middleware: [guest]} },
    { path: '/organizations/edit/:id', component: OrganizationEdit, meta: {middleware: [guest]} },
    { path: '/users', component: Users, meta: {middleware: [guest]} },
    { path: '/users/create', component: UserCreate, meta: {middleware: [guest]} },
    { path: '/users/edit/:id', component: UserEdit, meta: {middleware: [guest]} },
]

export default routes
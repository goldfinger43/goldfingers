import Dashboard from '../components/intern/dashboard.vue';
import UsersIndex from '../components/intern/users/index.vue';
import UsersCreate from '../components/intern/users/create.vue';

export default [
    { path: '', name: 'dashboard', component: Dashboard },
    { path: 'users', name: 'users-index', component: UsersIndex },
    { path: 'users/create', name: 'users-create', component: UsersCreate },
]
import Dashboard from '../components/intern/dashboard.vue';
import UsersIndex from '../components/intern/users/index.vue';
import UsersCreate from '../components/intern/users/create.vue';
import UsersShow from '../components/intern/users/show.vue';
import UsersEdit from '../components/intern/users/edit.vue';

export default [
    { path: '', name: 'dashboard', component: Dashboard },

    // Users Routes
    { path: 'users', name: 'users-index', component: UsersIndex },
    { path: 'users/create', name: 'users-create', component: UsersCreate },
    { path: 'users/:slug', name: 'users-show', component: UsersShow, props: true },
    { path: 'users/:slug/edit', name: 'users-edit', component: UsersEdit, props: true },
]
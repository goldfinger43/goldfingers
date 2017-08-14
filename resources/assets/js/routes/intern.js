import Dashboard from '../components/intern/dashboard.vue';
import { UsersIndex, UsersCreate, UsersShow, UsersEdit } from './components/users.js';
import { TurniereIndex, TurniereCreate, TurniereShow, TurniereEdit } from './components/turniere.js';
import DivisionenIndex from '../components/intern/divisionen/index.vue';


export default [
    { path: '', name: 'dashboard', component: Dashboard },

    // Users
    { path: 'users', name: 'users-index', component: UsersIndex },
    { path: 'users/create', name: 'users-create', component: UsersCreate },
    { path: 'users/:slug', name: 'users-show', component: UsersShow, props: true },
    { path: 'users/:slug/edit', name: 'users-edit', component: UsersEdit, props: true },

    //Turniere
    { path: 'turniere', name: 'turniere-index', component: TurniereIndex },
    { path: 'turniere/create', name: 'turniere-create', component: TurniereCreate },
    { path: 'turniere/:slug', name: 'turniere-show', component: TurniereShow, props: true },
    { path: 'turniere/:slug/edit', name: 'turniere-edit', component: TurniereEdit, props: true },

    //Divisionen
    { path: 'divisionen', name: 'divisionen-index', component: DivisionenIndex },
]
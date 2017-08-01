import Dashboard from '../components/intern/dashboard.vue';
import UsersIndex from '../components/intern/users/index.vue';
import UsersCreate from '../components/intern/users/create.vue';
import UsersShow from '../components/intern/users/show.vue';
import UsersEdit from '../components/intern/users/edit.vue';
import TurniereIndex from '../components/intern/turniere/index.vue';
import TurniereCreate from '../components/intern/turniere/create.vue';
import TurniereShow from '../components/intern/turniere/show.vue';
import TurniereEdit from '../components/intern/turniere/edit.vue';

export default [
    { path: '', name: 'dashboard', component: Dashboard },

    // Users Routes
    { path: 'users', name: 'users-index', component: UsersIndex },
    { path: 'users/create', name: 'users-create', component: UsersCreate },
    { path: 'users/:slug', name: 'users-show', component: UsersShow, props: true },
    { path: 'users/:slug/edit', name: 'users-edit', component: UsersEdit, props: true },

    //Turniere Routes
    { path: 'turniere', name: 'turniere-index', component: TurniereIndex },
    { path: 'turniere/create', name: 'turniere-create', component: TurniereCreate },
    { path: 'turniere/:slug', name: 'turniere-show', component: TurniereShow, props: true },
    { path: 'turniere/:slug/edit', name: 'turniere-edit', component: TurniereEdit, props: true },
]
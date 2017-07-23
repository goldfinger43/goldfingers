import Startseite from '../components/public/startseite.vue';
import Login from '../components/public/login.vue';

export default [
    { path: '', name: 'startseite', component: Startseite },
    { path: 'login', name: 'login', component: Login },
]
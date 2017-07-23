import Public from '../components/public/public.vue';
import Intern from '../components/intern/intern.vue';
import publicChildRoutes from './public.js';
import internChildRoutes from './intern.js';

export const Routes = [
    { 
        path: '/', 
        component: Public, 
        children: publicChildRoutes
    },
    { 
        path: '/intern', component: Intern, // meta: { requiresAuth: true },
        children: internChildRoutes
    }
]
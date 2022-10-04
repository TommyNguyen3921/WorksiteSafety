import {createApp} from 'vue';


import Contact from './components/Contact.vue';
import { createRouter,createWebHistory } from 'vue-router';


const routes =[
    { name:'Contact',
      path: '/contact',
      component: Contact 
    }
];

const router = createRouter({
    history: createWebHistory(),
    routes

});
const app = createApp({})


app.use(router)
app.mount("#vuecomp");
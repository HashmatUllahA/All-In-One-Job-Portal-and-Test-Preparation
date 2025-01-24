// resources/js/app.js
import { createApp } from 'vue';
import app from './layouts/app.vue';
import 'bootstrap/dist/css/bootstrap.css';
import '@fortawesome/fontawesome-free/css/all.css';
import router from './routes'; // Corrected import statement for routes.js

import HeaderComponent from './components/HeaderComponent.vue';
import SidebarComponent from './components/SidebarComponent.vue';

const vueApp = createApp(app);

vueApp.use(router); // Use the router

vueApp.component('header-component', HeaderComponent);
vueApp.component('sidebar-component', SidebarComponent);

vueApp.mount('#app');


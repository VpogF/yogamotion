import './bootstrap';

import * as bootstrap from 'bootstrap';

import { createApp } from 'vue'

import prueba from './components/Prueba.vue';
import Navbar from './components/Navbar.vue';

const app = createApp({
    data() {
        return {
            authUser: window.authUser // Recibe los datos de Blade
        };
    }
});

app.component('pepe', prueba);
app.component('Navbar', Navbar);

app.mount('#app');


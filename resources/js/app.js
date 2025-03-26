import './bootstrap';

import * as bootstrap from 'bootstrap';

import { createApp } from 'vue'

import prueba from './components/Prueba.vue';
import CardIndex from './components/Card-index.vue';

const app = createApp({
    data() {
        return {
            authUser: window.authUser // Recibe los datos de Blade
        };
    }
});

app.component('prueba', prueba);
app.component('CardIndex', CardIndex);

app.mount('#app');


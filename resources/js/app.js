import './bootstrap';

import * as bootstrap from 'bootstrap';

import { createApp } from 'vue'

import prueba from './components/Prueba.vue';

const app = createApp({});

app.component('prueba', prueba);

app.mount('#app');


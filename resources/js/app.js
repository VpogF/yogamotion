import './bootstrap';

import * as bootstrap from 'bootstrap';

import { createApp } from 'vue'

import prueba from './components/Prueba.vue';
import CardIndex from './components/Card-index.vue';
import CardEvento from './components/CardEvento.vue';
import CreaEvento from './components/Crea-evento.vue';
import PanelOrg from './components/Panel-org.vue';

const app = createApp({
    data() {
        return {
            authUser: window.authUser // Recibe los datos de Blade
        };
    }
});

app.component('prueba', prueba);
app.component('CardIndex', CardIndex);
app.component('card-evento', CardEvento);
app.component('crea-evento', CreaEvento);
app.component('panel-org', PanelOrg);

app.mount('#app');


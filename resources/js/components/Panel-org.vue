<template lang="">
    <div class="contenedor-card-eventos">
        <h2>Tus eventos</h2>
        <!-- Mostrar eventos si existen, sino mostrar mensaje -->
        <div v-if="eventos.length > 0">
            <card v-for="evento in eventos" :key="evento.id" :evento="evento" />
        </div>
        <p v-else>Todavía no has creado ningún evento</p>
    </div>
    <button class="standar-botton" @click="toggleEventoVisibility">Crea tu evento</button>
    <crea-evento v-if="showEvento" :usuario-id="usuarioId" @evento-creado="manejarEventoCreado"></crea-evento>
</template>
<script>
import axios from "axios"; // Importamos axios para hacer la petición
import CreaEvento from './Crea-evento.vue'; // Si usas CreaEvento como componente hijo

export default {
    components: {
        CreaEvento
    },
    props: {
        usuarioId: {
            type: Number,
            required: true,
        },
    },
    data() {
        return {
            // Estado que controla si se muestra o no el componente crea-evento
            showEvento: false,
            eventos: [], // Guardar todos los eventos creados
        };
    },
    methods: {
        // Método que alterna la visibilidad del componente crea-evento
        toggleEventoVisibility() {
            this.showEvento = !this.showEvento;
        },

        // Manejar cuando un evento ha sido creado
        manejarEventoCreado(evento) {
            console.log("Evento recibido en panel-org:", evento);
            // Agregar el nuevo evento a la lista de eventos
            this.eventos.push(evento);

            // Opcional: actualizar los eventos desde la API
            // this.obtenerEventos();

            // Si deseas cerrar el formulario después de crear un evento
            this.showEvento = false;
        },

        // Obtener los eventos desde la API al cargar la página
        async obtenerEventos() {
            const me = this;
            try {
                const response = await axios.get(`http://localhost:8080/yogamotion/public/api/evento/${me.usuarioId}`);
                me.eventos = response.data; // Guardamos los eventos en el array
                console.log("Eventos cargados:", me.eventos);
            } catch (error) {
                console.error("Error al obtener eventos:", error);
            }
        },
    },
    mounted() {
        this.obtenerEventos(); // Cargar los eventos cuando el componente se monte
    }
};
</script>
<!-- <script>
import axios from "axios"; // Importamos axios para hacer la petición
export default {
    props: {
        usuarioId: {
            type: Number,
            required: true,
        },
    },
    data() {
        return {
            // Estado que controla si se muestra o no el componente crea-evento
            showEvento: false,
            eventos: [], // Guardar todos los eventos creados
        };
    },
    methods: {
        // Método que alterna la visibilidad del componente crea-evento
        toggleEventoVisibility() {
            this.showEvento = !this.showEvento;

        },
        manejarEventoCreado(evento) {
            console.log("Evento recibido en panel-org:", evento);
            this.eventos.push(evento); // Agregar el evento a la lista
        },async obtenerEventos() {
            try {
                const response = await axios.get(`http://localhost:8080/yogamotion/public/api/evento/${this.usuarioId}`);
                this.eventos = response.data; // Guardamos los eventos en el array
            } catch (error) {
                console.error("Error al obtener eventos:", error);
            }
        }
    },
    mounted() {
        this.obtenerEventos(); // Cargar los eventos cuando el componente se monte
    }

};
</script> -->
<style lang="">
</style>

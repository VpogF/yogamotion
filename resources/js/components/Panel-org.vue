<template lang="">
    <div class="contenedor-card-eventos">
        <h2>Tus eventos</h2>
        <div v-if="loading" class="text-center mt-4 mb-5">
            <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Cargando...</span>
            </div>
        </div>
        <!-- Mostrar eventos si existen, sino mostrar mensaje -->
        <div v-else>
            <div
                v-if="usuario.org_eventos.length > 0"
                class="eventos-container"
            >
                <card
                    v-for="evento in usuario.org_eventos"
                    :key="evento.id"
                    :evento="evento"
                    @eliminar="eliminarEvento"
                />
            </div>

            <p v-else>Todavía no has creado ningún evento</p>
        </div>
        <a
            :href="'/yogamotion/public/crear-evento?usuarioId=' + usuarioId"
            class="standar-botton"
            >Crea tu evento</a
        >
    </div>
</template>
<script>
import axios from "axios"; // Importamos axios para hacer la petición
import CreaEvento from "./Crea-evento.vue"; // Si usas CreaEvento como componente hijo

export default {
    components: {
        CreaEvento,
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
            // eventos: [], // Guardar todos los eventos creados
            usuario: {},
            loading: true, // <--- nuevo estado
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
            me.loading = true;
            try {
                const response = await axios.get(
                    `http://localhost:8080/yogamotion/public/api/usuario/${me.usuarioId}/eventos`
                );
                me.usuario = response.data; // Guardamos los eventos en el array
                console.log("Eventos cargados:", me.eventos);
            } catch (error) {
                console.error("Error al obtener eventos:", error);
            } finally {
                this.loading = false; // <-- lo desactivamos cuando termina
            }
        },
        async eliminarEvento(id) {
            const me = this;
            if (!confirm("¿Estás seguro de que quieres eliminar este evento?"))
                return;

            try {
                await axios.delete(
                    `http://localhost:8080/yogamotion/public/api/evento/${id}`
                );
                me.usuario.eventos = me.usuario.eventos.filter(
                    (evento) => evento.id !== id
                );
                console.log("Evento eliminado correctamente");
            } catch (error) {
                console.error("Error al eliminar el evento:", error);
                alert("Hubo un problema al eliminar el evento.");
            }
        },
    },
    mounted() {
        this.obtenerEventos(); // Cargar los eventos cuando el componente se monte
    },
};
</script>
<style scoped>
h2 {
    color: #5a5766;
}
.contenedor-card-eventos {
    justify-items: center;
    margin-bottom: 50px;
    gap: 10px;
}

.eventos-container {
    margin: 20px;
    height: fit-content;
    /* background-color: #edffec; */
    padding: 20px;
    padding-bottom: 50px;
    border-radius: 10px;
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 35px;
}
</style>

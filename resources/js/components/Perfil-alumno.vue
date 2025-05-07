<template>
    <div>
        <div>
            <a @click="volverAHome"
            class="boton-crear-evento"
            title="volver"
            >
            <i class="bi bi-arrow-left-circle"></i>
            </a>
            <h2 class="titulo">Eventos a los que estás apuntado</h2>
        </div>

        <div v-if="loading" class="text-center mt-4 mb-5">
            <div class="spinner-border text-primary" role="status">
            <span class="visually-hidden">Cargando...</span>
            </div>
        </div>

        <div class="eventos-container" v-else>
            <div v-if="eventos.length" class="eventos-list">
            <a
                v-for="evento in eventos"
                :key="evento.id"
                :href="`/yogamotion/public/detalle-evento?eventoId=${evento.id}`"
                class="evento-item"
            >
                <div class="thumb">
                <img
                    src="/public/img/claseyogaimg.webp"
                    alt="Imagen del evento"
                />
                </div>
                <div class="info">
                <h3>{{ evento.nom_evento }}</h3>
                <p class="meta">
                    <i class="bi bi-calendar-event"></i>
                    {{ new Date(evento.fecha_evento).toLocaleDateString() }}
                    &nbsp;|&nbsp;
                    <i class="bi bi-geo-alt"></i>
                    {{ evento.ubicacion }}
                </p>
                <a
                    class="ver-mas"
                    :href="`/yogamotion/public/detalle-evento?eventoId=${evento.id}`"
                >
                    Ver más <i class="bi bi-arrow-right-circle"></i>
                </a>
                </div>
            </a>
            </div>
            <div v-else class="no-eventos">
            <p>No estás apuntado a ningún evento.</p>
            </div>
        </div>
    </div>
</template>

<script>
import axios from "axios";

export default {
    props: {
    usuarioId: {
        type: Number,
        required: true,
    },
    },
    data() {
    return {
        eventos: [],
        loading: true,
    };
    },
    methods: {
    async obtenerEventosApuntados() {
        this.loading = true;
        try {
        const response = await axios.get(
            `http://localhost:8080/yogamotion/public/api/usuario/${this.usuarioId}/miseventos`
        );
        this.eventos = response.data;
        } catch (error) {
        console.error("Error al obtener eventos apuntados:", error);
        } finally {
        this.loading = false;
        }
    },

    volverAHome() {
            window.location.href = '/yogamotion/public/home'; // Redirigir al home
        },
    },
    mounted() {
    this.obtenerEventosApuntados();
    },
};
</script>

<style scoped>
.titulo {
  text-align: center;
  margin-top: 20px;
  margin-bottom: 30px; /* <-- Añade este margen */
  color: #EDFFEC;
  font-size: 2.5rem !important;
}

/* Contenedor de eventos */
.eventos-container {
    width: 80%;
    max-width: 800px;
    margin: 0 auto 40px;
    background-color: #edffec;
    padding: 20px;
    border-radius: 10px;
}

/* Grid de tarjetas */
.eventos-list {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
    gap: 20px;
}

/* Tarjeta individual */
.evento-item {
    display: flex;
    flex-direction: column;
    background: #fff;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    text-decoration: none;
    transition: transform 0.2s, box-shadow 0.2s;
}

.evento-item:hover {
    transform: translateY(-4px);
    box-shadow: 0 6px 18px rgba(0, 0, 0, 0.15);
}

.evento-item .thumb {
    width: 100%;
    height: 140px;
    overflow: hidden;
}

.evento-item .thumb img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.evento-item .info {
    padding: 15px;
    display: flex;
    flex-direction: column;
    flex: 1;
}

.evento-item .info h3 {
    margin: 0 0 8px;
    font-size: 1.2rem;
    color: #333;
}

.evento-item .info .meta {
    margin: 0 0 12px;
    font-size: 0.9rem;
    color: #666;
    display: flex;
    align-items: center;
    gap: 6px;
}

.evento-item .info .ver-mas {
    margin-top: auto;
    align-self: flex-start;
    color: #7f56d9;
    font-weight: 600;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 4px;
    transition: color 0.2s;
}

.evento-item .info .ver-mas:hover {
    color: #6a3fc6;
}

.no-eventos {
    text-align: center;
    color: #555;
    font-style: italic;
}

@media (max-width: 600px) {
    .eventos-container {
    width: 95%;
    }
}
</style>


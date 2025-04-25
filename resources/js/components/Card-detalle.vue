<template>
    <div class="detalle-container">

        <div v-if="evento" class="card-detalle">
            <div class="volver-btn" @click="volverAHome">×</div> <!-- Botón de cerrar -->
            <img
                class="detalle-img"
                src="/public/img/claseyogaimg.webp"
                alt="Imagen del evento"
            />

            <div class="detalle-info">
                <h2>{{ evento.nom_evento }}</h2>
                <p><strong>Descripción:</strong> {{ evento.descripcion }}</p>
                <p><strong>Fecha:</strong> {{ new Date(evento.fecha_evento).toLocaleDateString() }}</p>
                <p><strong>Ubicación:</strong> {{ evento.ubicacion }}</p>
                <p><strong>Duración:</strong> {{ evento.duracion }} horas</p>
                <p><strong>Cupo:</strong> {{ evento.cupo }}</p>
                <p><strong>Precio:</strong> {{ evento.precio }} €</p>

                <button class="standar-botton" @click="apuntarse">
                    Apuntarse
                </button>
            </div>
        </div>

        <p v-else>Cargando evento...</p>
    </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import axios from 'axios'

// Recibir props
const props = defineProps({
    eventoId: {
        type: [Number, String],
        required: true,
    }
})

const evento = ref(null)

onMounted(async () => {
    try {
        const response = await axios.get(
            `http://localhost:8080/yogamotion/public/api/evento/${props.eventoId}`
        )
        console.log("Respuesta de la API:", response.data)
        evento.value = response.data
    } catch (error) {
        console.error("Error al cargar el evento:", error)
        alert("Hubo un error al cargar el evento.")
    }
})

async function apuntarse() {
    try {
        const response = await axios.post(
            `http://localhost:8080/yogamotion/public/api/evento/${props.eventoId}/apuntarse`
        );
        alert("¡Te has apuntado correctamente!");
    } catch (error) {
        console.error("Error al apuntarse:", error);
        alert("Hubo un error al intentar apuntarte.");
    }
}


function volverAHome() {
    window.location.href = "/yogamotion/public/home";
}
</script>

<style scoped>
.detalle-container {
    display: flex;
    justify-content: center;
    padding: 4rem 2rem 2rem 2rem; /* Top padding más grande */
    position: relative;
}

.card-detalle {
    display: flex;
    gap: 2rem;
    max-width: 900px;
    background-color: #f8f8f8;
    padding: 2rem;
    border-radius: 12px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.detalle-img {
    width: 300px;
    height: auto;
    border-radius: 10px;
    object-fit: cover;
}

.detalle-info {
    flex: 1;
}

.btn-apuntarse {
    margin-top: 1rem;
    background-color: #28a745;
    color: white;
    padding: 0.8rem 1.5rem;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    font-size: 1rem;
}
.btn-apuntarse:hover {
    background-color: #218838;
}

.volver-btn {
    position: absolute;
    top: 20px;
    right: 20px; /* Cambiado de left a right */
    font-size: 2rem;
    font-weight: bold;
    cursor: pointer;
    color: #555;
    background: #eee;
    border-radius: 50%;
    width: 40px;
    height: 40px;
    text-align: center;
    line-height: 40px;
    transition: background 0.3s ease;
}

.volver-btn:hover {
    background: #ccc;
}
</style>

<template>
    <div v-if="evento" class="card-detalle-horizontal">
        <div class="boton-cerrar-detalle" @click="volverAHome">
        <i class="bi bi-x-lg"></i>
        </div>

        <div class="imagen-contenedor">
        <img class="detalle-img" src="/public/img/claseyogaimg.webp" alt="Imagen del evento" />
        </div>

        <div class="detalle-info">
        <h2>{{ evento.nom_evento }}</h2>
        <p><strong>Descripción:</strong> {{ evento.descripcion }}</p>
        <p><strong>Fecha:</strong> {{ new Date(evento.fecha_evento).toLocaleDateString() }}</p>
        <p><strong>Ubicación:</strong> {{ evento.ubicacion }}</p>
        <p><strong>Duración:</strong> {{ evento.duracion }} horas</p>
        <p><strong>Cupo:</strong> {{ evento.cupo }}</p>
        <p><strong>Precio:</strong> {{ evento.precio }} €</p>

        <button
            class="standar-botton"
            @click="usuarioApuntado ? desapuntarse() : apuntarse()"
        >
            {{ usuarioApuntado ? 'Desapuntarse' : 'Apuntarse' }}
        </button>
        </div>
    </div>
    <p v-else>Cargando evento...</p>
</template>

<script setup>
    import { ref, onMounted } from 'vue'
    import axios from 'axios'

    const props = defineProps({
    eventoId: {
        type: [Number, String],
        required: true,
    },
    usuarioId: {
        type: [Number, String],
        required: true,
    },
    })

    const evento = ref(null)
    const usuarioApuntado = ref(false)

    onMounted(async () => {
    try {
        // Obtener los datos del evento
        const response = await axios.get(
        `http://localhost:8080/yogamotion/public/api/evento/${props.eventoId}`
        )
        evento.value = response.data

        // Verificar si el usuario ya está apuntado
        const check = await axios.get(
        `http://localhost:8080/yogamotion/public/api/usuario/${props.usuarioId}/miseventos`
        )
        usuarioApuntado.value = check.data.some(e => e.id == props.eventoId)
    } catch (error) {
        console.error('Error al cargar el evento o verificar inscripción:', error)
    }
    })

    async function apuntarse() {
    try {
        const response = await axios.post(
        `http://localhost:8080/yogamotion/public/api/evento/${props.eventoId}/apuntarse`,
        { usuario_id: props.usuarioId }
        )
        usuarioApuntado.value = true
        alert(response.data.message)
    } catch (error) {
        console.error('Error al apuntarse:', error)
        alert('Hubo un error al intentar apuntarte.')
    }
    }

    async function desapuntarse() {
    try {
        const response = await axios.post(
        `http://localhost:8080/yogamotion/public/api/evento/${props.eventoId}/desapuntarse`,
        { usuario_id: props.usuarioId }
        )
        usuarioApuntado.value = false
        alert(response.data.message)
    } catch (error) {
        console.error('Error al desapuntarse:', error)
        alert('Hubo un error al intentar desapuntarte.')
    }
    }

    function volverAHome() {
    window.location.href = '/yogamotion/public/home'
    }
</script>

<style scoped>
.card-detalle-horizontal {
    display: flex;
    max-width: 900px;
    background-color: #ffffff;
    border-radius: 16px;
    box-shadow: 0 6px 16px rgba(0, 0, 0, 0.1);
    overflow: hidden;
    position: relative;
    margin: 2rem auto;
}

.imagen-contenedor {
    flex: 1;
    min-width: 300px;
    max-width: 320px;
    overflow: hidden;
}

.detalle-img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
}

.detalle-info {
    flex: 2;
    padding: 2rem;
    display: flex;
    flex-direction: column;
    justify-content: center;
}

.detalle-info h2 {
    margin-bottom: 1rem;
    color: #333;
    font-size: 1.8rem;
}

.detalle-info p {
    margin-bottom: 0.5rem;
    color: #555;
    line-height: 1.4;
}

.detalle-info strong {
    color: #333;
}

.boton-cerrar-detalle {
    position: absolute;
    top: 20px;
    right: 20px;
    width: 45px;
    height: 45px;
    background-color: white;
    color: #7FD297; /* púrpura */
    border: 2px solid #7FD297;
    border-radius: 50%;
    font-size: 28px;
    font-weight: bold;
    text-align: center;
    line-height: 40px;
    text-decoration: none;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.2);
    z-index: 10;
}

.boton-cerrar-detalle:hover {
    color: white;
    background-color: #7FD297;
}
</style>

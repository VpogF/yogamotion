<template>
    <div class="eventos-container">
        <!-- Lista de eventos -->
        <div v-if="eventos.length > 0" class="eventos-list">
            <div v-for="evento in eventos" :key="evento.id" class="evento-item">
                <h3>{{ evento.nom_evento }}</h3>
                <p>{{ evento.descripcion }}</p>
                <p><strong>Ubicación:</strong> {{ evento.ubicacion }}</p>
                <p><strong>Duración:</strong> {{ evento.duracion }} horas</p>
                <p><strong>Cupo:</strong> {{ evento.cupo }}</p>
            </div>
        </div>
        <!-- Mensaje cuando no hay eventos -->
        <div v-else>
            <p>No se encontraron eventos.</p>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            eventos: [], // Todos los eventos obtenidos desde la API
        };
    },
    created() {
        // Al cargar el componente, obtenemos todos los eventos
        axios
            .get("/yogamotion/public/api/evento") // Asegúrate de que la URL sea correcta
            .then((response) => {
                this.eventos = response.data;
            })
            .catch((error) => {
                console.error("Error al obtener los eventos:", error);
            });
    },
};
</script>

<style scoped>
.eventos-container {
    margin: 20px;
    width: 80%;
    background-color: grey;
}

.eventos-list {
    margin-top: 20px;
    display: flex;
    flex-direction: row;
    gap: 22px;
    flex-wrap: wrap;
}

.evento-item {
    background-color: #f8f9fa;
    padding: 15px;
    margin-bottom: 10px;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    width: 300px;
}

.evento-item h3 {
    font-size: 1.5rem;
    color: #007bff;
}

.evento-item p {
    margin: 5px 0;
}
</style>

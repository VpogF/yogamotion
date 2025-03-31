<template>
    <!-- Buscador -->
    <div class="buscador">
        <input
            v-model="filtroPractica"
            type="text"
            placeholder="Filtrar por tipo de práctica"
        />
        <input
            v-model="filtroCiudad"
            type="text"
            placeholder="Filtrar por ciudad"
        />
        <button @click="filtrarEventos">Buscar</button>
    </div>
    <div class="eventos-container">
        <!-- Lista de eventos -->
        <div v-if="eventosFiltrados.length > 0" class="eventos-list">
            <div
                v-for="evento in eventosFiltrados"
                :key="evento.id"
                class="evento-item"
            >
                <img src="/public/img/claseyogaimg.webp" />
                <h3>{{ evento.nom_evento }}</h3>
                <p>{{ evento.descripcion }}</p>
                <p><strong>Ubicación:</strong> {{ evento.ubicacion }}</p>
                <p><strong>Duración:</strong> {{ evento.duracion }} horas</p>
                <p><strong>Cupo:</strong> {{ evento.cupo }}</p>
                <p><strong>Coste:</strong> {{ evento.precio }} €</p>
                <p>
                    <strong>Tipo de practica:</strong>
                    {{ evento.tipo_practica.nom_practica }}
                </p>
            </div>
        </div>

        <!-- Mensaje cuando no hay eventos -->
        <div v-else>
            <p>No se encontraron eventos.</p>
        </div>
    </div>
</template>

<script>
import axios from "axios";

export default {
    data() {
        return {
            eventos: [], // Todos los eventos obtenidos desde la API
            filtroPractica: "",
            filtroCiudad: "",
        };
    },
    computed: {
        eventosFiltrados() {
            return this.eventos.filter((evento) => {
                const coincidePractica =
                    this.filtroPractica === "" ||
                    evento.tipo_practica.nom_practica
                        .toLowerCase()
                        .includes(this.filtroPractica.toLowerCase());
                const coincideCiudad =
                    this.filtroCiudad === "" ||
                    evento.ubicacion
                        .toLowerCase()
                        .includes(this.filtroCiudad.toLowerCase());
                return coincidePractica && coincideCiudad;
            });
        },
    },
    created() {
        axios
            .get("/yogamotion/public/api/evento")
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
    height: fit-content;
    background-color: grey;
    padding: 20px;
    border-radius: 10px;
}

.buscador {
    display: flex;
    gap: 10px;
    margin-bottom: 20px;
}

.buscador input {
    padding: 10px;
    border-radius: 5px;
    border: 1px solid #ccc;
    flex: 1;
}

.buscador button {
    padding: 10px 15px;
    border: none;
    background-color: #007bff;
    color: white;
    border-radius: 5px;
    cursor: pointer;
}

.eventos-list {
    display: flex;
    flex-direction: row;
    gap: 22px;
    flex-wrap: wrap;
}

.evento-item {
    background-color: #f8f9fa;
    padding: 15px;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    width: 300px;
}

.evento-item h3 {
    font-size: 1.5rem;
    color: #007bff;
}

img {
    max-width: 270px;
    height: 180px;
}
</style>

<template>
    <!-- Buscador centrado y al ancho del contenedor -->
    <div class="buscador-wrapper">
        <div class="buscador">
            <input
                v-model="filtroPractica"
                type="text"
                placeholder="Tipo de práctica"
            />
            <input v-model="filtroCiudad" type="text" placeholder="Ciudad" />
            <button @click="filtrarEventos">
                <i class="bi bi-search"></i>
            </button>
        </div>
    </div>

    <div class="eventos-container">
        <div v-if="eventosFiltrados.length" class="eventos-list">
            <a
                v-for="evento in eventosFiltrados"
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
/* Wrapper para centrar el buscador y limitar ancho */
.buscador-wrapper {
  display: flex;
  justify-content: center;
  margin: 20px 0;
  width: 95%;
}

.buscador {
  display: grid;
  /* Dos columnas de inputs iguales y luego botón */
  grid-template-columns: 1.2fr 1.2fr 0.6fr;
  gap: 10px;
  width: 80%;
  max-width: 800px;
}

.buscador input {
  padding: 10px 12px;
  border: 1px solid #ccc;
  border-radius: 6px;
  font-size: 0.95rem;
  transition: border-color 0.2s;
}

.buscador input:focus {
  border-color: #7f56d9;
  outline: none;
}

.buscador button {
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 6px;
  background-color: #7f56d9;
  color: #fff;
  border: none;
  border-radius: 6px;
  font-size: 1rem;
  cursor: pointer;
  transition: background 0.2s;
}

.buscador button:hover {
  background-color: #6a3fc6;
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
  box-shadow: 0 4px 12px rgba(0,0,0,0.1);
  text-decoration: none;
  transition: transform 0.2s, box-shadow 0.2s;
}

.evento-item:hover {
  transform: translateY(-4px);
  box-shadow: 0 6px 18px rgba(0,0,0,0.15);
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
</style>

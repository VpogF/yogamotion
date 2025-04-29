<template>
    <div class="evento-item">
        <!-- Botones de acción -->
        <div class="action-buttons">
            <button class="btn btn-edit" @click="$emit('editar', evento)">
                <i class="bi bi-pencil-fill"></i>
            </button>
            <button
                class="btn btn-delete"
                @click="$emit('eliminar', evento.id)"
            >
                <i class="bi bi-trash-fill"></i>
            </button>
        </div>

        <!-- Imagen -->
        <div class="image-container">
            <img src="/public/img/claseyogaimg.webp" alt="Imagen del evento" />
        </div>

        <!-- Contenido del evento -->
        <div class="event-info">
            <h4 :class="claseEstado(evento.estado.estado)">
                {{ capitalizar(evento.estado.estado) || "Estado desconocido" }}
            </h4>

            <h3>{{ evento.nom_evento }}</h3>
            <p class="descripcion">{{ evento.descripcion }}</p>

            <div class="event-grid">
                <div class="info-item">
                    <span class="label">📅 Fecha:</span>
                    <span>{{
                        new Date(evento.fecha_evento).toLocaleDateString()
                    }}</span>
                </div>
                <div class="info-item">
                    <span class="label">📍 Ubicación:</span>
                    <span>{{ evento.ubicacion }}</span>
                </div>
                <div class="info-item">
                    <span class="label">⏱️ Duración:</span>
                    <span>{{ evento.duracion }} h</span>
                </div>
                <div class="info-item">
                    <span class="label">👥 Cupo:</span>
                    <span>{{ evento.cupo }}</span>
                </div>
                <div class="info-item">
                    <span class="label">💰 Precio:</span>
                    <span>{{ evento.precio }} €</span>
                </div>
                <div class="info-item">
                    <span class="label">🧘 Tipo:</span>
                    <span>{{ evento.tipo_practica?.nom_practica }}</span>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
defineProps({
    evento: {
        type: Object,
        required: true,
    },
});
function capitalizar(texto) {
    if (!texto) return "";
    return texto.charAt(0).toUpperCase() + texto.slice(1).toLowerCase();
}
function claseEstado(estado) {
    if (!estado) return "";
    const estadoLower = estado.toLowerCase();
    if (estadoLower === "activo") return "activo";
    if (estadoLower === "cancelado") return "cancelado";
    if (estadoLower === "modificado") return "modificado";
    return "";
}
</script>

<style scoped>
.evento-item {
    background-color: #fff;
    padding: 20px;
    border-radius: 15px;
    border: 1px solid #ddd;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    width: 320px;
    position: relative;
    overflow: hidden;
}

.image-container {
    width: 100%;
    height: 180px;
    overflow: hidden;
    border-radius: 10px;
    margin-bottom: 15px;
}

img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
    border-radius: 10px;
}

/* Botones de acción */
.action-buttons {
    position: absolute;
    top: 10px;
    right: 10px;
    display: flex;
    gap: 8px;
    z-index: 10;
}

.action-buttons .btn {
    width: 36px;
    height: 36px;
    font-size: 1.2rem;
    border-radius: 6px;
    border: none;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    cursor: pointer;
    transition: transform 0.2s ease;
}

/* Botón azul sólido */
.btn-edit {
    background-color: #557db9;
}

/* Botón rojo sólido */
.btn-delete {
    background-color: rgb(155, 70, 70);
}

.btn:hover {
    transform: scale(1.1);
}

.event-info h3 {
    font-size: 1.3rem;
    color: #333;
    margin-bottom: 10px;
}

.event-info p {
    font-size: 0.95rem;
    color: #555;
    margin: 4px 0;
}

.event-info strong {
    color: #48435c;
}

.activo {
    background-color: #7fd297;
    width: 100%;
    color: #fff;
    align-items: center;
    border-radius: 5px;
    text-align: center;
}

.cancelado {
    background-color: rgb(155, 70, 70);
    width: 100%;
    color: #fff;
    align-items: center;
    border-radius: 5px;
    text-align: center;
}

.modificado {
    background-color: rgb(176, 176, 79);
    width: 100%;
    color: #fff;
    align-items: center;
    border-radius: 5px;
    text-align: center;
}

.descripcion {
  margin: 8px 0 15px;
  font-style: italic;
  color: #666;
}

/* Grid visual para los campos */
.event-grid {
  display: grid;
  grid-template-columns: 1fr;
  gap: 8px;
}

.info-item {
  display: flex;
  justify-content: space-between;
  background: #f4f4f4;
  padding: 6px 10px;
  border-radius: 6px;
  font-size: 0.9rem;
  color: #444;
}

.label {
  font-weight: 600;
  color: #48435C;
}
</style>

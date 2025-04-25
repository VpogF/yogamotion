<!-- <template>
    <div class="evento-item">
        <div class="action-buttons">
            <button class="btn btn-sm btn-primary" @click="$emit('editar', evento)">
                <i class="bi bi-pencil-fill"></i>
            </button>
            <button class="btn btn-sm btn-danger" @click="$emit('eliminar', evento.id)">
                <i class="bi bi-trash-fill"></i>
            </button>
        </div>
        <img src="/public/img/claseyogaimg.webp" alt="Imagen del evento" />
        <h3>{{ evento.nom_evento }}</h3>
        <p>{{ evento.descripcion }}</p>
        <p><strong>Fecha del Evento:</strong> {{ new Date(evento.fecha_evento).toLocaleDateString() }}</p>
        <p><strong>Ubicación:</strong> {{ evento.ubicacion }}</p>
        <p><strong>Duración:</strong> {{ evento.duracion }} horas</p>
        <p><strong>Cupo:</strong> {{ evento.cupo }}</p>
        <p><strong>Coste:</strong> {{ evento.precio }} €</p>
        <p>
            <strong>Tipo de práctica:</strong>
            {{ evento.tipo_practica?.nom_practica }}
        </p>
    </div>
</template>


<script setup>
// Definir la prop `evento` que recibirá el componente
defineProps({
    evento: {
        type: Object,
        required: true
    }
});
</script>

<style scoped>
.evento-item {
    background-color: #f8f9fa;
    padding: 15px;
    border-radius: 5px;
    border: 2px solid black;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    width: 300px;
    margin-bottom: 15px;
    position: relative; /* Para posicionar los botones encima */
}
img {
    max-width: 270px;
    height: 180px;
}
.action-buttons {
    position: absolute;
    top: 10px;
    right: 10px;
    display: flex;
    gap: 5px;
    z-index: 10;
}

.action-buttons .btn {
    padding: 4px 6px;
    font-size: 0.8rem;
    border-radius: 4px;
}
</style> -->
<template>
    <div class="evento-item">
        <!-- Botones de acción -->
        <div class="action-buttons">
            <button class="btn btn-edit" @click="$emit('editar', evento)">
                <i class="bi bi-pencil-fill"></i>
            </button>
            <button class="btn btn-delete" @click="$emit('eliminar', evento.id)">
                <i class="bi bi-trash-fill"></i>
            </button>
        </div>

        <!-- Imagen -->
        <div class="image-container">
            <img src="/public/img/claseyogaimg.webp" alt="Imagen del evento" />
        </div>

        <!-- Contenido del evento -->
        <div class="event-info">
            <h4 class="activo">{{ capitalizar(evento.estado.estado) || 'Estado desconocido' }}</h4>
            <h3>{{ evento.nom_evento }}</h3>
            <p>{{ evento.descripcion }}</p>
            <p><strong>Fecha del Evento:</strong> {{ new Date(evento.fecha_evento).toLocaleDateString() }}</p>
            <p><strong>Ubicación:</strong> {{ evento.ubicacion }}</p>
            <p><strong>Duración:</strong> {{ evento.duracion }} horas</p>
            <p><strong>Cupo:</strong> {{ evento.cupo }}</p>
            <p><strong>Coste:</strong> {{ evento.precio }} €</p>
            <p><strong>Tipo de práctica:</strong> {{ evento.tipo_practica?.nom_practica }}</p>
        </div>
    </div>
</template>

<script setup>
defineProps({
    evento: {
        type: Object,
        required: true
    }
});
function capitalizar(texto) {
  if (!texto) return '';
  return texto.charAt(0).toUpperCase() + texto.slice(1).toLowerCase();
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
    background-color: #0d6efd;
}

/* Botón rojo sólido */
.btn-delete {
    background-color: #dc3545;
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
    color: #48435C;
}

.activo{
    background-color: green;
    width: 100%;
    color: #fff;
    align-items: center;
    border-radius: 5px;
    text-align: center;
}
</style>

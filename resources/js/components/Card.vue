<template>
    <div class="evento-item">
        <img src="/public/img/claseyogaimg.webp" alt="Imagen del evento" />
        <h3>{{ evento.nom_evento }}</h3>
        <p>{{ evento.descripcion }}</p>
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
}
img {
    max-width: 270px;
    height: 180px;
}
</style>

<template>
    <form @submit.prevent="submitForm" class="form-container">
        <label for="nom_evento">Nombre del Evento:</label>
        <input v-model="form.nom_evento" type="text" id="nom_evento" class="input" required />

        <label for="fecha_evento">Fecha del Evento:</label>
        <input v-model="form.fecha_evento" type="date" id="fecha_evento" class="input" required />

        <label for="descripcion">Descripción:</label>
        <textarea v-model="form.descripcion" id="descripcion" class="input" rows="4" required></textarea>

        <label for="duracion">Duración (horas):</label>
        <input v-model.number="form.duracion" type="number" id="duracion" step="0.1" class="input" required />

        <label for="cupo">Cupo:</label>
        <input v-model.number="form.cupo" type="number" id="cupo" class="input" required />

        <label for="ubicacion">Ubicación:</label>
        <input v-model="form.ubicacion" type="text" id="ubicacion" class="input" required />

        <label for="tipo_practica_id">Tipo de Práctica:</label>
        <select v-model.number="form.tipo_practica_id" id="tipo_practica_id" class="input" required>
            <option v-for="practica in practicas" :key="practica.id" :value="practica.id">
                {{ practica.nombre }}
            </option>
        </select>

        <label for="estado_id">Estado del Evento:</label>
        <select v-model.number="form.estado_id" id="estado_id" class="input" required>
            <option v-for="estado in estados" :key="estado.id" :value="estado.id">
                {{ estado.nombre }}
            </option>
        </select>

        <label for="tipo_evento_id">Tipo de Evento:</label>
        <select v-model.number="form.tipo_evento_id" id="tipo_evento_id" class="input" required>
            <option v-for="tipo in tiposEvento" :key="tipo.id" :value="tipo.id">
                {{ tipo.nombre }}
            </option>
        </select>

        <label for="precio">Precio:</label>
        <input v-model.number="form.precio" type="number" id="precio" step="0.01" class="input" required />

        <input type="hidden" v-model="form.usuario_id" />
        <button type="submit" class="standar-botton">Guardar Evento</button>
    </form>
</template>

<script setup>
import { ref, defineProps, defineEmits, watchEffect } from "vue";
import axios from "axios";

const props = defineProps({
    usuarioId: {
        type: Number,
        required: true,
    },
});

const emit = defineEmits(["evento-creado"]);

const form = ref({
    nom_evento: '',
    descripcion: '',
    duracion: null,
    cupo: null,
    ubicacion: '',
    tipo_practica_id: null,
    estado_id: null,
    tipo_evento_id: null,
    precio: null,
    fecha_evento: '',
    usuario_id: props.usuarioId,
});

watchEffect(() => {
    form.value.usuario_id = props.usuarioId;
});

const practicas = [
    { id: 1, nombre: "Hatha Yoga" },
    { id: 2, nombre: "Vinyasa Yoga" },
    { id: 3, nombre: "Ashtanga Yoga" },
    { id: 4, nombre: "Bikram Yoga" },
    { id: 5, nombre: "Kundalini Yoga" },
    { id: 6, nombre: "Yin Yoga" },
    { id: 7, nombre: "Restorative Yoga" },
];

const estados = [
    { id: 1, nombre: "Activo" },
    { id: 2, nombre: "Cancelado" },
    { id: 3, nombre: "Modificado" },
];

const tiposEvento = [
    { id: 1, nombre: "Clase" },
    { id: 2, nombre: "Retiro" },
];

const submitForm = async () => {
    try {
        const response = await axios.post('http://localhost:8080/yogamotion/public/api/evento', form.value);
        emit('evento-creado', response.data);
        console.log('Evento creado:', response.data);
        alert("Evento creado exitosamente!");
                        window.location.href =
                            `http://localhost:8080/yogamotion/public/home?usuarioId=${props.usuarioId}`;

    } catch (error) {
        console.error('Error al crear el evento:', error);
        alert('Hubo un error al guardar el evento');
    }

};
</script>

<style scoped>
/* Contenedor del formulario */
.form-container {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
    padding: 2rem;
    background-color: white;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    border-radius: 8px;
    width: 80%;
    margin: 50px;
}

/* Estilo para los inputs, selects y el botón */
.input,
select,
.standar-botton {
    padding: 0.8rem;
    border-radius: 8px;
    border: 1px solid #ccc;
    font-size: 1rem;
}

.input,
select {
    width: 100%;
}

.standar-botton:hover {
    background-color: #9792e3;
}

/* Estilo para los labels */
label {
    font-size: 1rem;
    font-weight: 500;
}

textarea {
    width: 100%;
    padding: 0.8rem;
    border-radius: 8px;
    border: 1px solid #ccc;
    font-size: 1rem;
    resize: vertical; /* Permite redimensionar el campo verticalmente */
}
</style>

<template lang="">
    <div class="contenedor-card-eventos">

    </div>
    <button class="standar-botton" @click="toggleEventoVisibility">Crea tu evento</button>
    <crea-evento v-if="showEvento" :usuario-id="usuarioId"></crea-evento>
</template>
<script>
export default {
    props: {
        usuarioId: {
            type: Number,
            required: true,
        },
    },
    data() {
        return {
            // Estado que controla si se muestra o no el componente crea-evento
            showEvento: false,
        };
    },
    methods: {
        // Método que alterna la visibilidad del componente crea-evento
        toggleEventoVisibility() {
            this.showEvento = !this.showEvento;
        }
    },
    mounted(){
        console.log("pepe");
    }
};
</script>
<style lang="">
</style>

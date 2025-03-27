<template>
    <div class="card-index-container">
        <!-- Opciones como botones -->
        <div class="option-buttons">
            <label
                class="option-label"
                :class="{ active: selectedOption === 'opcion1' }"
            >
                <input
                    type="radio"
                    value="opcion1"
                    v-model="selectedOption"
                    class="hidden"
                />
                Crear Eventos
            </label>

            <label
                class="option-label"
                :class="{ active: selectedOption === 'opcion2' }"
            >
                <input
                    type="radio"
                    value="opcion2"
                    v-model="selectedOption"
                    class="hidden"
                />
                Agenda de Eventos
            </label>
        </div>

        <!-- Texto -->
        <div class="text-container">
            <h1 class="dynamic-text">
                {{ selectedOption === "opcion1" ? "Organiza tus eventos con facilidad. Crea experiencias únicas y transforma vidas." : "Tu agenda de Yoga en un solo lugar. Fluye y conecta con tu práctica." }}
            </h1>
        </div>

        <!-- Botón dinámico -->
        <a class="nav-link" :href="'/yogamotion/public/login'"><button class="dynamic-button">
            {{ selectedOption === "opcion1" ? "Acceder como Organizador" : "Acceder como Alumno" }}
        </button></a>
    </div>
</template>

<script>
export default {
    data() {
        return {
            selectedOption: "opcion1", // Opción inicial
        };
    },
};
</script>


<style scoped>
/* 🟢 Contenedor principal */
.card-index-container {
  display: flex;
  flex-direction: column;
  align-items: flex-start;
  justify-content: space-evenly;
  gap: 20px;
  width: 60vw; /* 3/5 del ancho en pantallas grandes */
  height: 50vh; /* 1/2 del alto en pantallas grandes */
  background-color: #EDFFEC;
  border-radius: 10px;
  padding: 20px 40px;
  margin: auto;
  box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
  transition: all 0.3s ease;
}

/* 🔵 Responsividad */
@media (max-width: 1024px) {
  .card-index-container {
    width: 80vw; /* En tablets y medianas, ocupa más espacio */
    height: 55vh;
  }
}

@media (max-width: 768px) {
  .card-index-container {
    width: 90vw; /* En móviles, casi todo el ancho */
    height: auto; /* Altura adaptable */
    padding: 15px;
  }
}

/* 🟡 Botones de opciones */
.option-buttons {
  display: flex;
  gap: 15px;
  border-bottom: 2px solid #ccc;
  width: 98%;
}

.option-label {
  padding: 12px 24px;
  /* border: 2px solid #ccc; */
  cursor: pointer;
  transition: all 0.3s ease;
  background-color: #EDFFEC;
  font-weight: bold;
}

/* Oculta el radio button */
.option-label input {
  display: none;
}

.option-label {
  padding: 12px 24px;
  cursor: pointer;
  transition: all 0.1s ease;
  color: #4D4646;
  background-color: #EDFFEC;
  font-weight: bold;
  border-bottom: 2px solid transparent; /* Borde inferior invisible por defecto */
}

/* Cuando el botón está seleccionado */
.option-label.active {
  border-bottom: 2px solid #7FD297; /* Solo el borde inferior se colorea */
  color: black;
}

/* 🟠 Texto */
.text-container h1 {
  text-align: left;
  font-size: 40px;
  color: black;
  max-width: 80%;
}

/* 🔴 Botón dinámico */
.dynamic-button {
  padding: 12px 24px;
  border: none;
  border-radius: 8px;
  cursor: pointer;
  background-color: #48435C;
  color: #EDFFEC;
  font-size: 18px;
  transition: background 0.3s ease;
}

.dynamic-button:hover {
  /* background-color: #218838; */
}

/* Ajustes en móviles */
@media (max-width: 768px) {
  .dynamic-button {
    font-size: 16px;
    padding: 10px 20px;
  }

  .text-container h1 {
    font-size: 24px;
    text-align: left;
  }
}
</style>

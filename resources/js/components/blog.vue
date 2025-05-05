<template>
    <div class="blog-carousel-container">
      <h3 class="titulo-blog">Blog de Deporte y Salud</h3>

      <div class="carousel-wrapper">
        <button class="arrow left" @click="prevSlide">
          <i class="bi bi-chevron-left"></i>
        </button>

        <div class="carousel">
          <div
            class="blog-card"
            v-for="(articulo, index) in visibleArticulos"
            :key="index"
          >
            <img :src="articulo.imagen" alt="Imagen del artículo" class="card-img" />
            <div class="card-content">
              <h3>{{ articulo.titulo }}</h3>
              <p>{{ articulo.descripcion }}</p>
              <a :href="articulo.link" class="leer-mas">
                Leer más <i class="bi bi-arrow-right-circle"></i>
              </a>
            </div>
          </div>
        </div>

        <button class="arrow right" @click="nextSlide">
          <i class="bi bi-chevron-right"></i>
        </button>
      </div>
    </div>
  </template>

  <script setup>
  import { ref, computed } from 'vue';

  const articulos = [
    {
      id: 1,
      titulo: "5 Beneficios del Yoga para tu Salud Mental",
      descripcion: "Descubre cómo el yoga puede ayudarte a reducir el estrés, mejorar el sueño y aumentar tu bienestar general.",
      imagen: "/yogamotion/public/img/blog-yoga.jpg",
      link: "#",
    },
    {
      id: 2,
      titulo: "Alimentación Saludable para Deportistas",
      descripcion: "Aprende qué alimentos potencian tu rendimiento físico y ayudan a una mejor recuperación muscular.",
      imagen: "/yogamotion/public/img/blog-yoga.jpg",
      link: "#",
    },
    {
      id: 3,
      titulo: "Entrenamiento Funcional: Qué es y por qué practicarlo",
      descripcion: "Un enfoque de ejercicio que mejora la movilidad, fuerza y equilibrio. Ideal para todas las edades.",
      imagen: "/yogamotion/public/img/blog-yoga.jpg",
      link: "#",
    },
    {
      id: 4,
      titulo: "Importancia del Descanso en el Rendimiento Deportivo",
      descripcion: "Dormir bien y descansar entre entrenamientos es clave para evitar lesiones y mejorar tu progreso.",
      imagen: "/yogamotion/public/img/blog-yoga.jpg",
      link: "#",
    },
    {
      id: 5,
      titulo: "Cómo Iniciar una Rutina de Ejercicio desde Cero",
      descripcion: "Consejos prácticos para principiantes que desean comenzar a entrenar sin frustrarse en el intento.",
      imagen: "/yogamotion/public/img/blog-yoga.jpg",
      link: "#",
    },
    {
      id: 6,
      titulo: "Hidratación: Clave para el Bienestar Físico y Mental",
      descripcion: "Mantente bien hidratado para mejorar tu energía, concentración y recuperación muscular.",
      imagen: "/yogamotion/public/img/blog-yoga.jpg",
      link: "#",
    }
  ];

  const currentIndex = ref(0);
  const total = articulos.length;
  const visibleCount = 3;

  const visibleArticulos = computed(() => {
    const result = [];
    for (let i = 0; i < visibleCount; i++) {
      result.push(articulos[(currentIndex.value + i) % total]);
    }
    return result;
  });

  const nextSlide = () => {
    currentIndex.value = (currentIndex.value + 1) % total;
  };

  const prevSlide = () => {
    currentIndex.value = (currentIndex.value - 1 + total) % total;
  };
  </script>

  <style scoped>
  .blog-carousel-container {
    padding: 2rem;
    max-width: 1000px;
    margin: 0 auto;
  }

  .titulo-blog {
    text-align: center;
    font-size: 2rem;
    margin-bottom: 1.5rem;
    color: #5a5766;
  }

  .carousel-wrapper {
    display: flex;
    align-items: center;
    justify-content: space-between;
    position: relative;
  }

  .carousel {
    display: flex;
    gap: 1.5rem;
    overflow: hidden;
    width: 100%;
    justify-content: center;
  }

  .blog-card {
    width: 300px;
    background-color: white;
    border-radius: 12px;
    box-shadow: 0 6px 16px rgba(0, 0, 0, 0.08);
    overflow: hidden;
    display: flex;
    flex-direction: column;
    transition: transform 0.3s ease;
  }

  .card-img {
    width: 100%;
    height: 180px;
    object-fit: cover;
  }

  .card-content {
    padding: 1rem;
    display: flex;
    flex-direction: column;
    flex: 1;
  }

  .card-content h3 {
    font-size: 1.2rem;
    margin-bottom: 0.5rem;
    color: #222;
  }

  .card-content p {
    flex: 1;
    font-size: 0.9rem;
    color: #555;
    margin-bottom: 1rem;
  }

  .leer-mas {
    text-decoration: none;
    color: #7FD297;
    font-weight: bold;
    display: inline-flex;
    align-items: center;
    gap: 5px;
    transition: color 0.3s;
  }

  .leer-mas:hover {
    color: #59b777;
  }

  .arrow {
    background: none;
    border: none;
    font-size: 2rem;
    color: white;
    cursor: pointer;
    transition: color 0.3s;
  }

  .arrow:hover {
    color: white;
  }

  .left {
    margin-right: 1rem;
  }

  .right {
    margin-left: 1rem;
  }

  @media (max-width: 960px) {
    .carousel {
      flex-direction: column;
      align-items: center;
    }

    .blog-card {
      width: 100%;
    }
  }
  </style>

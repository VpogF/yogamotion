# 🧘 Yogamotion: Aplicación de Gestión de Eventos (Yoga)

**Yogamotion** es una plataforma web diseñada para la gestión de eventos, enfocada en clases de yoga. Permite a los usuarios buscar clases disponibles según su ubicación (ciudad) y realizar inscripciones de manera sencilla.

---

## ✨ Características Principales

*   **Búsqueda de Eventos:** Los usuarios pueden filtrar clases por ciudad.
*   **Gestión de Inscripciones:** Facilita el proceso de registro a las clases.
*   **APIs Robustas:** Desarrollo de *endpoints* con Laravel para la comunicación fluida entre el front-end y el back-end.

---

## 🛠️ Tecnologías Utilizadas

Este proyecto fue desarrollado utilizando un *stack* tecnológico centrado en Laravel para el back-end y un front-end interactivo con JavaScript y Bootstrap:

*   **Back-end Framework:** Laravel v10 (PHP)
*   **ORM:** Eloquent (integrado en Laravel) para la interacción con la base de datos.
*   **Base de Datos:** MySQL
*   **Front-end:** JavaScript y Bootstrap
*   **Control de Versiones:** Git & GitHub

---

## ⚙️ Configuración y Ejecución Local

Para clonar este proyecto y ejecutarlo en tu entorno de desarrollo local, sigue estos pasos:

### Prerrequisitos

*   PHP (v8.1 o superior)
*   Composer
*   Node.js & npm
*   Servidor de Base de Datos MySQL
*   Docker (opcional, si usas la configuración Dockerfile)

### Instalación

1.  **Clona el repositorio:**
    ```bash
    git clone github.com
    ```

2.  **Navega al directorio del proyecto:**
    ```bash
    cd yogamotion
    ```

3.  **Instala las dependencias de Composer (PHP):**
    ```bash
    composer install
    ```

4.  **Configura el entorno y la base de datos:**
    *   Copia `.env.example` a `.env` y genera la clave de la aplicación (`php artisan key:generate`).
    *   Configura tu base de datos MySQL en el archivo `.env`.

5.  **Ejecuta migraciones** (y seeders si hay datos de prueba):
    ```bash
    php artisan migrate
    ```

6.  **Instala las dependencias de Node.js y compila los assets (front-end):**
    ```bash
    npm install
    npm run dev # O npm run build para producción
    ```

7.  **Inicia el servidor local de Laravel:**
    ```bash
    php artisan serve
    ```

Ahora deberías poder acceder a la aplicación en `http://localhost:8000`.

---

## 📫 Contacto

Si tienes preguntas sobre este proyecto, mi trabajo o si quieres colaborar, no dudes en contactarme a través de mi [perfil de LinkedIn](https://www.linkedin.com/in/vpoglonig/).


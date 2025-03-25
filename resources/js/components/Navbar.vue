<template>
    <nav class="navbar navbar-expand-lg bg-dark-purple">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Navbar</a>
            <button
                class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent"
                aria-expanded="false"
                aria-label="Toggle navigation"
            >
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#"
                            >Home</a
                        >
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Link</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a
                            class="nav-link dropdown-toggle"
                            href="#"
                            role="button"
                            data-bs-toggle="dropdown"
                            aria-expanded="false"
                        >
                            Dropdown
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a class="dropdown-item" href="#"
                                    >Cerrar Sesión</a
                                >
                            </li>
                            <li>
                                <a class="dropdown-item" href="#"
                                    >Another action</a
                                >
                            </li>
                            <li><hr class="dropdown-divider" /></li>
                            <li>
                                <a class="dropdown-item" href="#"
                                    >Something else here</a
                                >
                            </li>
                        </ul>
                    </li>
                </ul>

                <!-- Autenticación -->
                <div class="d-flex">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li v-if="isAuthenticated" class="nav-item dropdown">
                            <a
                                class="nav-link dropdown-toggle"
                                href="#"
                                role="button"
                                data-bs-toggle="dropdown"
                                aria-expanded="false"
                            >
                                {{ userEmail }}
                            </a>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="/logout">
                                    <i class="bi bi-box-arrow-right"></i> Logout
                                </a>
                                <a class="dropdown-item" href="/edit-profile">
                                    <i class="bi bi-pencil"></i> Editar perfil
                                </a>
                                <form
                                    :action="`/delete-user/${userId}`"
                                    method="POST"
                                >
                                    <button
                                        type="submit"
                                        class="dropdown-item text-danger"
                                    >
                                        <i class="bi bi-trash3"></i> Eliminar
                                        perfil
                                    </button>
                                </form>
                            </div>
                        </li>
                        <template v-else>
                            <li class="nav-item">
                                <a class="nav-link" href="/signin">
                                    <i class="fa fa-sign-in"></i> Signin
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" :href="'/yogamotion/public/login'">
                                    <i class="fa fa-sign-in"></i> Login
                                </a>
                            </li>
                        </template>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
</template>
<script setup>

// Recibe los datos de usuario como props
const props = defineProps({
    isAuthenticated: Boolean,
    userEmail: String,
    userId: Number,
});

</script>

<style scoped>
.bg-dark-purple {
    background-color: #48435c;
}
</style>

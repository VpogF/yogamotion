# Imagen base de PHP con FPM (para ejecutar Laravel)
FROM php:8.1-fpm-alpine AS php-fpm

# Instalar dependencias del sistema
RUN apk add --no-cache \
    bash \
    git \
    curl \
    libpng-dev \
    libjpeg-turbo-dev \
    libfreetype6-dev \
    zip \
    unzip \
    nodejs \
    npm \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql

# Instalar Composer (gestor de paquetes de PHP)
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Definir el directorio de trabajo para Laravel
WORKDIR /var/www

# Copiar el archivo de dependencias de Laravel
COPY composer.json composer.lock ./

# Instalar las dependencias de Laravel
RUN composer install --no-dev --optimize-autoloader

# Copiar el código fuente de Laravel
COPY . .

# Instalar dependencias del frontend (Vue.js)
RUN npm install && npm run build

# Cambiar permisos para evitar errores de escritura en storage y bootstrap/cache
RUN chmod -R 777 storage bootstrap/cache


# Imagen base de NGINX
FROM nginx:alpine AS nginx

# Copiar la configuración personalizada de NGINX
COPY nginx/default.conf /etc/nginx/conf.d/

# Copiar los archivos de Laravel desde la imagen de PHP
COPY --from=php-fpm /var/www /var/www

# Exponer el puerto 80 para la aplicación
EXPOSE 80

# Comando para iniciar NGINX
CMD ["nginx", "-g", "daemon off;"]


# Imagen base para MySQL
FROM mysql:5.7 AS mysql

# Configurar la base de datos
ENV MYSQL_ROOT_PASSWORD=mysql
ENV MYSQL_DATABASE=yogamotion
ENV MYSQL_USER=root
ENV MYSQL_PASSWORD=mysql

# Exponer el puerto 3306 para MySQL
EXPOSE 3306

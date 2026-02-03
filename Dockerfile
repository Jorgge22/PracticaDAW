FROM php:8.2-fpm

# Instalar dependencias
RUN apt-get update && apt-get install -y \
    git curl libpng-dev libonig-dev libxml2-dev libzip-dev zip unzip \
    && docker-php-ext-install pdo_mysql mbstring zip gd

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Crear usuario
RUN useradd -G www-data,root -u 1000 -d /home/daw daw \
    && mkdir -p /home/daw/.composer \
    && chown -R daw:daw /home/daw

WORKDIR /var/www

# Solo cambiar permisos, NO crear directorios manualmente
# Laravel los creará automáticamente con artisan commands
RUN chown -R daw:daw /var/www

USER daw
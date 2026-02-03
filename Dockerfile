FROM php:8.2-fpm

# 1. Instalar dependencias del sistema
RUN apt-get update && apt-get install -y \
    git curl libpng-dev libonig-dev libxml2-dev libzip-dev zip unzip \
    && docker-php-ext-install pdo_mysql mbstring zip gd \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# 2. Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# 3. Crear usuario
RUN groupadd -g 1000 daw && \
    useradd -u 1000 -g daw -G www-data -m -d /home/daw daw

# 4. Crear directorio y permisos
RUN mkdir -p /var/www && chown -R daw:daw /var/www

# 5. Directorio de trabajo
WORKDIR /var/www

# 6. Copiar composer.json y composer.lock
COPY --chown=daw:daw composer.json ./
COPY --chown=daw:daw composer.lock* ./

# 7. Cambiar a usuario daw
USER daw

# 8. Instalar dependencias (sin ejecutar scripts)
RUN composer install --prefer-dist --no-interaction --no-progress --no-scripts

# 9. Cambiar a root para copiar archivos
USER root

# 10. Copiar código y .env
COPY --chown=daw:daw . .
COPY --chown=daw:daw .env ./

# 11. Ejecutar autoload
RUN composer dump-autoload --optimize

# 12. Permisos finales
RUN chown -R daw:daw /var/www

# 13. Usuario no-root
USER daw
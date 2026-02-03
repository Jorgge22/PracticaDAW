# PracticaDAW

## COMANDOS **GIT**

Primero: `git clone https://github.com/Jorgge22/PracticaDAW`

Después **SI** o **SI** hacer `git pull` para descargar los cambios que ha subido el otro.

Cada vez que se cambia algo: `git add .` y luego `git commit -m "mensaje"`

Y despues `git push -u origin main`


## COMANDOS **LARAVEL**

Comando para crear el proyecto laravel `composer create-project laravel/laravel . --prefer-dist --remove-vcs`

Instalar dependencias de laravel `docker compose exec app composer install`

Crear migracion para sesiones `docker compose exec app composer install`

Ejecutar migraciones `docker compose exec app php artisan migrate`

## COMANDOS **DOCKER**

Primero creamos la imagen `docker compose build app`

Para iniciar el contenedor `docker compose up -d`





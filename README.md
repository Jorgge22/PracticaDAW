# PracticaDAW

## COMANDOS **GIT**

Primero: `git clone https://github.com/Jorgge22/PracticaDAW`

Después **SI** o **SI** hacer `git pull` para descargar los cambios que ha subido el otro.

Cada vez que se cambia algo: `git add .` y luego `git commit -m "mensaje"`

Y despues `git push -u origin main`

## COMANDOS **LARAVEL**

Ejecutar migraciones `docker compose exec -T app php artisan migrate`

Crear keys `docker compose exec -T app php artisan key:generate`

Instalar dependencias `docker compose exec app composer install`

Crear migraciones `php artisan make:migration create_entrenamiento_table` cambiando el nombre por la tabla que se quiera crear.

Ejecutar los seed `docker compose exec -T app php artisan db:seed`

Ejecutar migraciones `docker compose exec -T app php artisan migrate:fresh`

Para entrar en la base de datos `docker compose exec -it db mysql -u root -p`

Crear un nuevo controlador `php artisan make:controller AutenticarController`

Crear una nueva clase Model `php artisan make:model Ciclista`

Comprobar los usuarios en bbdd `docker compose exec -T db mysql -u daw_user -pdaw practica_daw -e "select * from ciclista;"`

## COMANDOS **DOCKER**

**Primera vez (crear imagen e iniciar):**

``` docker
docker compose down -v
docker compose build app
docker compose up -d
docker compose exec -T app php artisan key:generate
docker compose exec -T app php artisan db:seed
docker compose exec -T app php artisan migrate:fresh
```

**Iniciar despues:**

``` docker
docker compose up -d
```

**Detener:**

```docker
docker compose down
```

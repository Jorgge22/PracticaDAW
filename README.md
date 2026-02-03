# PracticaDAW

## COMANDOS **GIT**

Primero: ```git clone https://github.com/Jorgge22/PracticaDAW```

Después **SI** o **SI** hacer `git pull` para descargar los cambios que ha subido el otro.

Cada vez que se cambia algo: ```git add .``` y luego ```git commit -m "mensaje"```

Y despues ```git push -u origin main```


## COMANDOS **LARAVEL**

Ejecutar migraciones ```docker compose exec -T app php artisan migrate```

Crear keys ```docker compose exec -T app php artisan key:generate```

Instalar dependencias ```docker compose exec app composer install```

## COMANDOS **DOCKER**

**Primera vez (crear imagen e iniciar):**
```
docker compose down -v
docker compose build app
docker compose up -d
docker compose exec -T app php artisan key:generate
docker compose exec -T app php artisan migrate
```

**Iniciar despues:**
```
docker compose up -d
```

**Detener:**
```
docker compose down
```

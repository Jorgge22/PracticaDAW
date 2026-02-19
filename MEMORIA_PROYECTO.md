# MEMORIA DEL PROYECTO - GESTOR DE ENTRENAMIENTOS DE CICLISMO

---

## 1. PRESENTACIÓN DEL PROYECTO

**Nombre:** Hugo Maeso y Jorge Barrera
**Objetivo:** Crear una aplicación web que permita a los ciclistas gestionar sus entrenamientos, planes, bicicletas y registrar resultados de forma organizada.

---

## 2. CÓMO EJECUTAR EL PROYECTO

### Pasos de Instalación

#### Primera vez (Instalación completa)

``` docker
docker compose build app
docker compose up -d
docker compose exec app php artisan key:generate
docker compose exec app php artisan migrate:fresh --seed
```

#### Después (Solo iniciar)

```
docker compose up -d
```

#### Para detener

```
docker compose down
```

### Acceder a la Aplicación

- **URL:** <http://localhost:8000>
- **Usuario de Prueba:** <test1@prueba.com>
- **Contraseña:** password
**Nota:** Todos los usuarios de prueba (test1@prueba.com hasta test7@prueba.com) tienen la misma contraseña: **password**

### Acceder a la Base de Datos (opcional)

```
docker compose exec -it db mysql -u root -p
Password: daw
```

Luego: `USE practica_daw;`

---

## 3. DECISIONES TÉCNICAS TOMADAS

### Stack Tecnológico

**¿Por qué Laravel?**

- Framework robusto con arquitectura MVC clara
- Sistema de autenticación integrado
- ORM Eloquent para manejo de bases de datos
- Migraciones para control de versiones de BD
- Fácil de escalar y mantener

**¿Por qué MySQL?**

- Base de datos relacional robusta
- Soporta relaciones complejas entre tablas
- Perfecto para gestión de datos estructurados
- Compatible con Docker

**¿Por qué Docker?**

- Asegura que todos trabajen en el mismo entorno
- Facilita el despliegue en producción
- Aislamiento de dependencias
- Fácil de replicar

### Arquitectura de la Aplicación

**MVC (Model-View-Controller):**

- **Models:** Representan las entidades (Ciclista, Plan, Sesión, Bloque, etc.)
- **Controllers:** Lógica de negocio (crear, editar, eliminar)
- **Views:** Blade Templates para renderizar HTML

**API REST:**

- Menús dinámicos que se cargan desde la BD
- Endpoints JSON para obtener datos
- Facilita integración futura con aplicaciones móviles

---

## 4. PROCESO DE DESARROLLO

### 4.1 COMANDOS LARAVEL EJECUTADOS

#### Comandos de Autenticación

``` docker
docker compose exec app composer require laravel/ui --with-all-dependencies
docker compose exec app php artisan ui bootstrap --auth
```

Propósito: Genera las vistas y controladores de login/registro automáticamente.

#### Creación de Modelos

``` docker
docker compose exec app php artisan make:model Ciclista
docker compose exec app php artisan make:model PlanEntrenamiento
docker compose exec app php artisan make:model SesionEntrenamiento
docker compose exec app php artisan make:model BloqueEntrenamiento
docker compose exec app php artisan make:model Bicicleta
docker compose exec app php artisan make:model Entrenamiento
docker compose exec app php artisan make:model HistoricoCiclista
docker compose exec app php artisan make:model ComponentesBicicleta
docker compose exec app php artisan make:model TipoComponente
docker compose exec app php artisan make:model SesionBloque
```

#### Creación de Controladores

``` docker
docker compose exec app php artisan make:controller BicicletasController
docker compose exec app php artisan make:controller PlanesController
docker compose exec app php artisan make:controller SesionesController
docker compose exec app php artisan make:controller BloquesController
docker compose exec app php artisan make:controller ResultadosController
docker compose exec app php artisan make:controller MenuController
docker compose exec app php artisan make:controller PerfilController
docker compose exec app php artisan make:controller HomeController
```

#### Ejecución de Migraciones

``` docker
docker compose exec app php artisan migrate:fresh --seed
```

---

### 4.2 MIGRACIONES CREADAS Y EXPLICACIÓN

Las migraciones están en `database/migrations/`. Cada una crea una tabla y define su estructura.

#### 1. **create_ciclistas_table**

```
Campos:
- id (PK)
- nombre
- apellidos
- email (único)
- peso (kg)
- altura (cm)
- fcm (frecuencia cardíaca máxima)
- umbral_potencia (watts)
```

**Necesidad:** Almacenar datos personales y fisiológicos del ciclista para cálculos de intensidad.

---

#### 2. **create_plan_entrenamiento_table**

```
Campos:
- id (PK)
- id_ciclista (FK)
- nombre
- descripcion
- fecha_inicio
- fecha_fin
- objetivo
```

**Necesidad:** Agrupar sesiones de entrenamiento en planes (ej: "Plan de base 2026").

---

#### 3. **create_sesion_entrenamiento_table**

```
Campos:
- id (PK)
- id_plan (FK)
- nombre
- descripcion
- tipo
- duracion_minutos
- intensidad
```

**Necesidad:** Cada plan contiene sesiones individuales de entrenamiento.

---

#### 4. **create_bloque_entrenamiento_table**

```
Campos:
- id (PK)
- nombre
- descripcion
- tipo (ENUM: rodaje, intervalos, fuerza, recuperacion, test)
- duracion_estimada
- potencia_pct_min
- potencia_pct_max
- pulso_pct_max
- pulso_reserva_pct
```

**Necesidad:** Bloques reutilizables que se incluyen en sesiones (ej: "Calentamiento 10 min").

---

#### 5. **create_sesion_bloque_table**

```
Campos:
- id (PK)
- id_sesion_entrenamiento (FK)
- id_bloque_entrenamiento (FK)
- orden
- repeticiones
```

**Necesidad:** Relación muchos-a-muchos entre sesiones y bloques.

---

#### 6. **create_bicicleta_table**

```
Campos:
- id (PK)
- nombre
- tipo (carretera, mtb, gravel, rodillo)
- comentario
```

**Necesidad:** Registrar qué bicicleta se usó en cada entrenamiento.

---

#### 7. **create_entrenamiento_table**

```
Campos:
- id (PK)
- id_ciclista (FK)
- id_bicicleta (FK)
- id_sesion (FK)
- fecha
- duracion (minutos)
- kilometros
- recorrido
- pulso_medio
- pulso_max
- potencia_media
- potencia_normalizada
- velocidad_media
- puntos_estres_tss
- factor_intensidad_if
- ascenso_metros
- comentario
```

**Necesidad:** Registrar resultados reales de cada entrenamiento realizado.

---

#### 8. **create_componentes_bicicleta_table & create_tipo_componente_table**

```
Propósito: Permitir registro detallado de componentes de bicicletas.
```

#### 9. **create_historico_ciclista_table**

```
Campos:
- id (PK)
- id_ciclista (FK)
- fecha
- peso
- fcm
- umbral_potencia
```

**Necesidad:** Registrar cambios en datos fisiológicos del ciclista en el tiempo.

---

### 4.3 DOCUMENTACIÓN DEL API REST

Todas las rutas llevan el prefijo `/api` y requieren estar autenticado (`middleware('auth')`).

#### **Rutas del Menú Dinámico**

| Método | Ruta | Parámetros | Respuesta | Descripción |
|--------|------|-----------|-----------|-------------|
| GET | `/api/menus` | - | JSON Array | Obtiene estructura de menús principal |
| GET | `/api/planes` | - | JSON Array | Lista planes del usuario |
| GET | `/api/sesiones` | - | JSON Array | Lista sesiones paginas (primeras 5) |
| GET | `/api/bicicletas` | - | JSON Array | Lista bicicletas disponibles |
| GET | `/api/bloques` | - | JSON Array | Lista bloques de entrenamiento |
| GET | `/api/resultados` | - | JSON Array | Lista entrenamientos del usuario |
| GET | `/api/perfil` | - | JSON Object | Datos del perfil del usuario |

---

#### **Rutas de Planes (Web)**

| Método | Ruta | Parámetros | Descripción |
|--------|------|-----------|-------------|
| GET | `/planes` | - | Listar todos los planes |
| GET | `/planes/create` | - | Formulario crear plan |
| POST | `/planes` | nombre, descripcion, fecha_inicio, fecha_fin, objetivo | Guardar plan |
| GET | `/planes/{id}` | id (plan ID) | Ver detalles del plan |
| GET | `/planes/{id}/edit` | id (plan ID) | Formulario editar plan |
| PUT | `/planes/{id}` | mismo que POST | Actualizar plan |
| DELETE | `/planes/{id}` | id (plan ID) | Eliminar plan |

---

#### **Rutas de Sesiones (Web)**

| Método | Ruta | Parámetros | Descripción |
|--------|------|-----------|-------------|
| GET | `/sesiones` | - | Listar sesiones |
| GET | `/sesiones/create` | - | Formulario crear sesión |
| POST | `/sesiones` | id_plan, nombre, descripcion, tipo, duracion_minutos, intensidad | Guardar sesión |
| GET | `/sesiones/{id}` | id (sesion ID) | Ver detalles |
| GET | `/sesiones/{id}/edit` | id (sesion ID) | Formulario editar |
| PUT | `/sesiones/{id}` | mismo que POST | Actualizar |
| DELETE | `/sesiones/{id}` | id (sesion ID) | Eliminar |

---

#### **Rutas de Bicicletas (Web)**

| Método | Ruta | Parámetros | Descripción |
|--------|------|-----------|-------------|
| GET | `/bicicletas` | - | Listar bicicletas |
| GET | `/bicicletas/create` | - | Crear bicicleta |
| POST | `/bicicletas` | nombre, tipo, comentario | Guardar |
| GET | `/bicicletas/{id}` | id | Ver detalles |
| GET | `/bicicletas/{id}/edit` | id | Editar |
| PUT | `/bicicletas/{id}` | nombre, tipo, comentario | Actualizar |
| DELETE | `/bicicletas/{id}` | id | Eliminar |

---

#### **Rutas de Bloques (Web)**

| Método | Ruta | Parámetros | Descripción |
|--------|------|-----------|-------------|
| GET | `/bloques` | - | Listar bloques |
| GET | `/bloques/create` | - | Crear bloque |
| POST | `/bloques` | nombre, descripcion, tipo*, duracion_estimada, potencia_pct_min, potencia_pct_max, pulso_pct_max, pulso_reserva_pct | Guardar |
| GET | `/bloques/{id}` | id | Ver detalles |
| GET | `/bloques/{id}/edit` | id | Editar |
| PUT | `/bloques/{id}` | igual que POST | Actualizar |
| DELETE | `/bloques/{id}` | id | Eliminar |

*tipo ENUM: rodaje, intervalos, fuerza, recuperacion, test

---

#### **Rutas de Resultados (Web)**

| Método | Ruta | Parámetros | Descripción |
|--------|------|-----------|-------------|
| GET | `/resultados` | - | Listar entrenamientos |
| GET | `/resultados/create` | - | Registrar entrenamiento |
| POST | `/resultados` | id_bicicleta, id_sesion, fecha, duracion, kilometros, recorrido, pulso_medio, pulso_max, potencia_media, potencia_normalizada, velocidad_media, puntos_estres_tss, factor_intensidad_if, ascenso_metros, comentario | Guardar |
| GET | `/resultados/{id}` | id | Ver detalles |
| GET | `/resultados/{id}/edit` | id | Editar |
| PUT | `/resultados/{id}` | igual que POST | Actualizar |
| DELETE | `/resultados/{id}` | id | Eliminar |

---

### 4.4 PRUEBAS DEL BACKEND CON POSTMAN

#### Preparación

1. Abre Postman
2. Crea una nueva colección llamada "PracticaDAW"
3. En la pestaña "Authorization", selecciona "Bearer Token"
4. Primero necesitas obtener el token (login)

#### 1. LOGIN (Obtener Token)

```
MÉTODO: POST
URL: http://localhost:8000/api/login

RESPUESTA RECIBIDA:
{
  "token": "eyJ0eXAiOiJKV1QiLCJhbGc..."
}
```

Copia el token y úsalo en las siguientes peticiones.

---

#### 2. OBTENER MENÚS (API)

```
MÉTODO: GET
URL: http://localhost:8000/api/menus
HEADERS:
  Authorization: Bearer {token}
  Accept: application/json

RESPUESTA ESPERADA:
{
  "Mis Planes": {
    "nombre": "Mis Planes",
    "id": "1",
    "descripcion": "Plan Base Aeróbica 2026"
  },
  "Mis Sesiones": { ... },
  ...
}
```

---

#### 3. CREAR PLAN

```
MÉTODO: POST
URL: http://localhost:8000/planes
HEADERS:
  Content-Type: application/x-www-form-urlencoded
  
BODY (form-data):
- nombre = "Plan Nueva Primavera"
- descripcion = "Preparación para primavera 2026"
- fecha_inicio = 2026-03-01
- fecha_fin = 2026-05-31
- objetivo = "Mejorar resistencia"

RESPUESTA: Redirección a /planes
```

---

#### 4. LISTAR PLANES (API)

```
MÉTODO: GET
URL: http://localhost:8000/api/planes
HEADERS:
  Authorization: Bearer {token}

RESPUESTA ESPERADA:
{
  "1": {
    "id": 1,
    "nombre": "Plan Base Aeróbica 2026",
    "fecha_inicio": "2026-01-15",
    "objetivo": "Base aeróbica"
  }
}
```

---

#### 5. VER DETALLE DE UN PLAN

```
MÉTODO: GET
URL: http://localhost:8000/planes/1
HEADERS:
  Accept: application/json

RESPUESTA: Datos del plan (HTML renderizado)
```

---

#### 6. EDITAR UN PLAN

```
MÉTODO: PUT
URL: http://localhost:8000/planes/1
HEADERS:
  Content-Type: application/x-www-form-urlencoded

BODY (form-data):
- _method = PUT
- nombre = "Plan Modificado"
- (resto de campos)

RESPUESTA: Redirección a /planes
```

---

#### 7. ELIMINAR UN PLAN

```
MÉTODO: DELETE
URL: http://localhost:8000/planes/1
HEADERS:
  X-CSRF-TOKEN: {token_csrf}

RESPUESTA: Redirección a /planes
```

---

### 4.5 PROBLEMAS SURGIDOS Y SOLUCIONES

#### **Problema 1: Error ENUM en columna 'tipo' de bloques**

**Error:** `SQLSTATE[01000]: Warning: 1265 Data truncated for column 'tipo'`

**Causa:** La base de datos define el tipo como ENUM (valores específicos), pero intentábamos insertar "Prueba".

**Solución:** Cambiar el formulario de crear/editar bloques de input text a un SELECT con opciones fijas:

- rodaje
- intervalos
- fuerza
- recuperacion
- test

Aplicado en:

- `/resources/views/bloques/create.blade.php`
- `/resources/views/bloques/edit.blade.php`
- Validación en `BloquesController@store` y `BloquesController@update`

---

## 5. CONCLUSIONES

### Logros Alcanzados

**Aplicación funcional:** Se ha creado un sistema completo de gestión de entrenamientos.

**CRUD Completo:** Todos los módulos (Planes, Sesiones, Bicicletas, Bloques, Resultados) tienen operaciones Create, Read, Update, Delete.

**Autenticación Segura:** Sistema de login integrado con Laravel, protegiendo rutas sensibles.

**API REST:** Menús dinámicos que se cargan desde la BD en tiempo real.

**Interfaz Intuitiva:** Vistas con Bootstrap que proporcionan buena experiencia de usuario.

**Uso de contenedores:** Docker permite reproducir el entorno en cualquier máquina.

---

## APÉNDICE: ESTRUCTURA DE CARPETAS

``` 
PracticaDAW/
├── app/
│   ├── Http/
│   │   └── Controllers/
│   │       ├── BicicletasController.php
│   │       ├── BloquesController.php
│   │       ├── PlanesController.php
│   │       ├── SesionesController.php
│   │       ├── ResultadosController.php
│   │       └── MenuController.php
│   └── Models/
│       ├── Bicicleta.php
│       ├── BloqueEntrenamiento.php
│       ├── PlanEntrenamiento.php
│       └── (9 modelos más)
├── database/
│   ├── migrations/
│   │   └── (10 archivos de migraciones)
│   ├── factories/
│   │   └── (Factories para datos de prueba)
│   └── seeders/
│       └── (Seeds para llenar BD)
├── resources/
│   └── views/
│       ├── bicicletas/
│       ├── bloques/
│       ├── planes/
│       ├── sesiones/
│       ├── resultados/
│       └── layouts/
├── routes/
│   ├── web.php (Rutas principales)
│   └── api.php (Rutas API)
├── public/
│   ├── css/menu.css
│   └── js/menu-app.js
└── docker/
    └── nginx/default.conf
```

DROP DATABASE IF EXISTS entrenamientos;

CREATE DATABASE entrenamientos
DEFAULT CHARACTER SET utf8mb4
COLLATE utf8mb4_spanish_ci;

commit;

USE entrenamientos;

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


-- Eliminación de tablas antiguas
DROP TABLE IF EXISTS entrenamiento; /*singular*/
DROP TABLE IF EXISTS sesion_bloque;
DROP TABLE IF EXISTS sesion_entrenamiento;
DROP TABLE IF EXISTS bloque_entrenamiento;
DROP TABLE IF EXISTS plan_entrenamiento;
DROP TABLE IF EXISTS componentes_bicicleta;
DROP TABLE IF EXISTS bicicleta; /* singular */
DROP TABLE IF EXISTS tipo_componente;
DROP TABLE IF EXISTS historico_ciclista;
DROP TABLE IF EXISTS ciclista; /* singular y añadidos los campos de email y password para hacer login */ 



-- Tabla ciclistas
CREATE TABLE IF NOT EXISTS ciclista (
    id          INT AUTO_INCREMENT PRIMARY KEY,
    nombre      VARCHAR(80) NOT NULL,
    apellidos   VARCHAR(80) NOT NULL,
    fecha_nacimiento DATE NOT NULL,
    peso_base        DECIMAL(5,2),
    altura_base      INT,
    email 		VARCHAR(80) NOT NULL, 
    password 	VARCHAR(30) NOT NULL
) ENGINE=InnoDB;

-- Histórico de ciclista
CREATE TABLE historico_ciclista (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_ciclista INT NOT NULL,
    fecha DATE NOT NULL,
    peso DECIMAL(5,2),
    ftp INT,
    pulso_max INT,
    pulso_reposo INT,
    potencia_max INT,
    grasa_corporal DECIMAL(4,2),
    vo2max DECIMAL(4,1),
    comentario VARCHAR(255),
    CONSTRAINT fk_historico_ciclista
        FOREIGN KEY (id_ciclista)
        REFERENCES ciclista(id)
        ON DELETE CASCADE
        ON UPDATE CASCADE,
    CONSTRAINT uq_ciclista_fecha
        UNIQUE (id_ciclista, fecha)
) ENGINE=InnoDB;

-- Planes de entrenamiento
CREATE TABLE plan_entrenamiento (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_ciclista INT NOT NULL,
    nombre VARCHAR(100) NOT NULL,
    descripcion VARCHAR(255),
    fecha_inicio DATE NOT NULL,
    fecha_fin DATE NOT NULL,
    objetivo VARCHAR(100),
    activo BOOLEAN DEFAULT 1,
    CONSTRAINT fk_plan_ciclista
        FOREIGN KEY (id_ciclista)
        REFERENCES ciclista(id)
        ON DELETE CASCADE
        ON UPDATE CASCADE
) ENGINE=InnoDB;



-- Bloques de entrenamiento
CREATE TABLE bloque_entrenamiento (
    id          INT AUTO_INCREMENT PRIMARY KEY,
    nombre      VARCHAR(100) NOT NULL,
    descripcion VARCHAR(255),
    tipo ENUM('rodaje', 'intervalos', 'fuerza', 'recuperacion', 'test') NOT NULL,
    duracion_estimada TIME,
    potencia_pct_min DECIMAL(5,2),
    potencia_pct_max DECIMAL(5,2),
    pulso_pct_max DECIMAL(5,2),
    pulso_reserva_pct DECIMAL(5,2),
    comentario VARCHAR(255)
) ENGINE=InnoDB;

-- Sesiones de entrenamiento
CREATE TABLE sesion_entrenamiento (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_plan INT not NULL,
    fecha DATE NOT NULL,
    nombre VARCHAR(100),
    descripcion VARCHAR(255),
    completada BOOLEAN DEFAULT 0,
    CONSTRAINT fk_sesion_plan
        FOREIGN KEY (id_plan)
        REFERENCES plan_entrenamiento(id)
        ON DELETE CASCADE
        ON UPDATE CASCADE
) ENGINE=InnoDB;


-- Conjunto de bloques
CREATE TABLE sesion_bloque  (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_sesion_entrenamiento INT NOT NULL,
    id_bloque_entrenamiento INT NOT NULL, 
    orden INT NOT NULL,
    repeticiones INT DEFAULT 1,
        CONSTRAINT fk_sesion_bloque_sesion
        FOREIGN KEY (id_sesion_entrenamiento)
        REFERENCES sesion_entrenamiento(id)
        ON DELETE CASCADE
        ON UPDATE CASCADE,
    CONSTRAINT fk_sesion_bloque_bloque
        FOREIGN KEY (id_bloque_entrenamiento)
        REFERENCES bloque_entrenamiento(id)
        ON DELETE CASCADE
        ON UPDATE CASCADE
) ENGINE=InnoDB;


-- Tipos de componentes
CREATE TABLE tipo_componente (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL UNIQUE,
    descripcion VARCHAR(255) NULL
) ENGINE=InnoDB;



-- Bicicletas
CREATE TABLE bicicleta (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL,
    tipo ENUM('carretera', 'mtb', 'gravel', 'rodillo') NOT NULL,
    comentario VARCHAR(255)
) ENGINE=InnoDB;

-- Componentes de bicicleta
CREATE TABLE componentes_bicicleta (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_bicicleta INT NOT NULL,
    id_tipo_componente INT NOT NULL,
    marca VARCHAR(50) NOT NULL,
    modelo VARCHAR(50),
    especificacion VARCHAR(50),
    velocidad ENUM('9v','10v','11v','12v') NULL,
    posicion ENUM('delantera', 'trasera', 'ambas') NULL,
    fecha_montaje DATE NOT NULL,
    fecha_retiro DATE DEFAULT NULL,
    km_actuales DECIMAL(8,2) DEFAULT 0,
    km_max_recomendado DECIMAL(8,2),
    activo BOOLEAN DEFAULT 1,
    comentario VARCHAR(255),
    CONSTRAINT fk_componentes_bici
        FOREIGN KEY (id_bicicleta)
        REFERENCES bicicleta(id)
        ON DELETE CASCADE
        ON UPDATE CASCADE,
    CONSTRAINT fk_componentes_tipo
        FOREIGN KEY (id_tipo_componente)
        REFERENCES tipo_componente(id)
        ON DELETE RESTRICT
        ON UPDATE CASCADE,
    INDEX idx_componentes_activos (id_bicicleta, id_tipo_componente, activo)
) ENGINE=InnoDB;


-- Entrenamientos
CREATE TABLE entrenamiento (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_ciclista INT NOT NULL,
    id_bicicleta INT NOT NULL,
    id_sesion INT NULL,
    fecha DATETIME NOT NULL,
    duracion TIME NOT NULL,
    kilometros DECIMAL(6,2) NOT NULL,
    recorrido VARCHAR(150) NOT NULL,
    pulso_medio INT,
    pulso_max INT,
    potencia_media INT,
    potencia_normalizada INT NOT NULL,
    velocidad_media DECIMAL(5,2) NOT NULL,
    puntos_estres_tss DECIMAL(6,2),
    factor_intensidad_if DECIMAL(4,3),
    ascenso_metros INT,
    comentario VARCHAR(255),
    CONSTRAINT fk_entrenamientos_ciclista
        FOREIGN KEY (id_ciclista)
        REFERENCES ciclista(id)
        ON DELETE RESTRICT
        ON UPDATE CASCADE,
    CONSTRAINT fk_entrenamiento_bicicleta
        FOREIGN KEY (id_bicicleta)
        REFERENCES bicicleta(id)
        ON DELETE RESTRICT
        ON UPDATE CASCADE,
    CONSTRAINT fk_entrenamiento_sesion
        FOREIGN KEY (id_sesion)
        REFERENCES sesion_entrenamiento(id)
        ON DELETE SET NULL
        ON UPDATE CASCADE,
    INDEX idx_ciclista_fecha (id_ciclista, fecha),
    INDEX idx_fecha (fecha)
) ENGINE=InnoDB;


    
-- Inserción de ciclistas
INSERT INTO ciclista (nombre, apellidos, fecha_nacimiento, peso_base, altura_base, email, password)
VALUES
('Juan', 'Pérez', '1990-05-10', 70.5, 175, 'test1@prueba.com', 'prueba'),
('Ana', 'Rodríguez', '1992-08-20', 60.0, 165, 'test2@prueba.com', 'prueba'),
('Pedro', 'García', '1995-03-15', 80.0, 180, 'test3@prueba.com', 'prueba'),
('Carmen', 'García', '1998-09-05', 55.0, 160, 'test4@prueba.com', 'prueba'),
('Luis', 'Rodríguez', '1972-09-15', 62.0, 170, 'test5@prueba.com', 'prueba'),
('Maria', 'Rodríguez', '1972-09-15', 62.0, 170, 'test6@prueba.com', 'prueba'),
('Ricardo', 'García', '1982-09-15', 72.0, 170, 'test7@prueba.com', 'prueba');

-- Histórico de ciclistas
INSERT INTO historico_ciclista
(id_ciclista, fecha, peso, ftp, pulso_max, pulso_reposo, potencia_max, grasa_corporal, vo2max, comentario)
VALUES
(1, '2026-01-01', 72.5, 280, 185, 48, 1050, 14.5, 62.3, 'Inicio de temporada'),
(1, '2026-02-01', 71.8, 290, 185, 46, 1100, 14.0, 63.5, 'Mejora tras bloque base'),
(1, '2026-03-01', 70.9, 300, 186, 45, 1150, 13.6, 65.0, 'Pico de forma'),
(2, '2026-01-15', 78.2, 250, 180, 52, 980, 16.8, 58.0, 'Inicio plan umbral'),
(2, '2026-02-15', 77.5, 265, 181, 50, 1020, 16.0, 59.5, 'Mejora progresiva');

-- Planes de entrenamiento
INSERT INTO plan_entrenamiento
(id_ciclista, nombre, descripcion, fecha_inicio, fecha_fin, objetivo, activo)
VALUES
(1, 'Plan Base Aeróbica 2026', 'Mejora de resistencia y base aeróbica', '2026-01-01', '2026-03-31', 'Base aeróbica', 1),
(2, 'Plan Umbral 2026', 'Trabajo de umbral y sweet spot', '2026-01-15', '2026-04-15', 'Mejorar FTP', 1);

-- Bloques de entrenamiento
INSERT INTO bloque_entrenamiento
(nombre, descripcion, tipo, duracion_estimada,
 potencia_pct_min, potencia_pct_max,
 pulso_pct_max, pulso_reserva_pct, comentario)
VALUES
('Calentamiento', 'Rodaje suave progresivo', 'rodaje', '00:15:00',
 55.0, 65.0, 70.0, 50.0, 'Subir pulsaciones gradualmente'),
('Rodaje Z2', 'Resistencia aeróbica', 'rodaje', '01:00:00',
 65.0, 75.0, 80.0, 65.0, 'Base aeróbica'),
('Sweet Spot 8 min', 'Intervalos Sweet Spot', 'intervalos', '00:08:00',
 88.0, 94.0, 90.0, 80.0, 'Trabajo de umbral submáximo'),
('Recuperación', 'Pedaleo muy suave', 'recuperacion', '00:05:00',
 45.0, 55.0, 65.0, 45.0, 'Eliminar fatiga'),
('Enfriamiento', 'Vuelta a la calma', 'recuperacion', '00:10:00',
 50.0, 60.0, 70.0, 50.0, 'Normalizar pulsaciones');

-- Sesiones de entrenamiento
INSERT INTO sesion_entrenamiento
(id_plan, fecha, nombre, descripcion, completada)
VALUES
(1, '2026-01-03', 'Rodaje aeróbico', 'Sesión continua de resistencia', 1),
(1, '2026-01-05', 'Sweet Spot corto', 'Intervalos controlados', 1),
(2, '2026-01-20', 'Sweet Spot progresivo', 'Trabajo de umbral', 0);

-- Sesiones de bloques
INSERT INTO sesion_bloque
(id_sesion_entrenamiento, id_bloque_entrenamiento, orden, repeticiones)
VALUES
(1, 1, 1, 1),
(1, 2, 2, 1),
(1, 5, 3, 1),
(2, 1, 1, 1),
(2, 3, 2, 4),
(2, 4, 3, 3),
(2, 5, 4, 1);

-- Tipos de componentes
INSERT INTO tipo_componente (nombre, descripcion)
VALUES
('Cadena', 'Cadena de la bicicleta'),
('Bielas', 'Bielas del pedalier'),
('Pedales', 'Pedales de la bicicleta'),
('Ruedas', 'Juego de ruedas completo'),
('Sillín', 'Sillín o asiento'),
('Manillar', 'Manillar y potencia'),
('Cassette', 'Piñón o conjunto de piñones trasero');

-- Bicicletas
INSERT INTO bicicleta (nombre, tipo, comentario)
VALUES
('Tacx NEO2', 'rodillo', 'Rodillo inteligente'),
('Stevens A', 'carretera', 'Carretera de entrenamiento'),
('Stevens B', 'carretera', 'Carretera competición'),
('Kuota', 'carretera', 'Carretera ligera'),
('MTB', 'mtb', 'Mountain bike estándar'),
('MTB Electrica', 'mtb', 'Mountain bike eléctrica');

-- Componentes de bicicletas
-- Tacx NEO2
INSERT INTO componentes_bicicleta
(id_bicicleta, id_tipo_componente, marca, modelo, especificacion, velocidad, posicion, fecha_montaje, km_actuales, km_max_recomendado, activo)
VALUES
(1, 1, 'Shimano', 'XT', NULL, NULL, 'ambas', '2026-01-01', 0, 5000, 1), -- Cadena
(1, 7, 'Shimano', 'XT', '11-28', '11v', 'trasera', '2026-01-01', 0, 15000, 1), -- Cassette
(1, 4, 'Tacx', 'NeoWheel', NULL, NULL, 'ambas', '2026-01-01', 0, 20000, 1); -- Ruedas

-- Stevens A
INSERT INTO componentes_bicicleta
(id_bicicleta, id_tipo_componente, marca, modelo, especificacion, velocidad, posicion, fecha_montaje, km_actuales, km_max_recomendado, activo)
VALUES
(2, 1, 'Shimano', 'Durace', NULL, NULL, 'ambas', '2026-01-01', 0, 4000, 1), -- Cadena
(2, 7, 'Shimano', 'Durace', '11-25', '11v', 'trasera', '2026-01-01', 0, 12000, 1), -- Cassette
(2, 4, 'Campagnolo', 'Shamal', '700c', NULL, 'ambas', '2026-01-01', 0, 20000, 1); -- Ruedas

-- Stevens B
INSERT INTO componentes_bicicleta
(id_bicicleta, id_tipo_componente, marca, modelo, especificacion, velocidad, posicion, fecha_montaje, km_actuales, km_max_recomendado, activo)
VALUES
(3, 1, 'Shimano', 'Durace', NULL, NULL, 'ambas', '2026-01-01', 0, 4000, 1), -- Cadena
(3, 7, 'Shimano', 'Durace', '11-28', '11v', 'trasera', '2026-01-01', 0, 12000, 1), -- Cassette
(3, 4, 'Velozer', 'Tubular', '700c', NULL, 'ambas', '2026-01-01', 0, 20000, 1); -- Ruedas

-- Kuota
INSERT INTO componentes_bicicleta
(id_bicicleta, id_tipo_componente, marca, modelo, especificacion, velocidad, posicion, fecha_montaje, km_actuales, km_max_recomendado, activo)
VALUES
(4, 1, 'Shimano', 'Tiagra', NULL, NULL, 'ambas', '2026-01-01', 0, 3500, 1), -- Cadena
(4, 7, 'Shimano', 'Tiagra', '12-28', '10v', 'trasera', '2026-01-01', 0, 10000, 1), -- Cassette
(4, 4, 'Mavic', 'Ksyrium', '700c', NULL, 'ambas', '2026-01-01', 0, 20000, 1); -- Ruedas

-- MTB
INSERT INTO componentes_bicicleta
(id_bicicleta, id_tipo_componente, marca, modelo, especificacion, velocidad, posicion, fecha_montaje, km_actuales, km_max_recomendado, activo)
VALUES
(5, 1, 'Shimano', 'Alivio', NULL, NULL, 'ambas', '2026-01-01', 0, 3000, 1), -- Cadena
(5, 7, 'Shimano', 'Alivio', '32-12', '9v', 'trasera', '2026-01-01', 0, 10000, 1), -- Cassette
(5, 4, 'Diamondback', '26', '26', NULL, 'ambas', '2026-01-01', 0, 20000, 1); -- Ruedas

-- MTB Electrica
INSERT INTO componentes_bicicleta
(id_bicicleta, id_tipo_componente, marca, modelo, especificacion, velocidad, posicion, fecha_montaje, km_actuales, km_max_recomendado, activo)
VALUES
(6, 1, 'Shimano', 'Alivio', NULL, NULL, 'ambas', '2026-01-01', 0, 3000, 1), -- Cadena
(6, 7, 'Shimano', 'Alivio', '32-12', '9v', 'trasera', '2026-01-01', 0, 10000, 1), -- Cassette
(6, 4, 'Diamondback', '26', '26', NULL, 'ambas', '2026-01-01', 0, 20000, 1); -- Ruedas


-- Entrenamientos (igual que antes)
INSERT INTO entrenamiento (
    id_ciclista,
    id_bicicleta,
    fecha,
    duracion,
    kilometros,
    recorrido,
    pulso_medio,
    pulso_max,
    potencia_media,
    potencia_normalizada,
    velocidad_media,
    puntos_estres_tss,
    factor_intensidad_if,
    ascenso_metros,
    comentario
)
VALUES
(1, 1, '2026-01-01 07:30:00', '01:45:00', 55.2, 'Ruta Valle', 140, 170, 200, 210, 31.5, 60.5, 0.88, 800, 'Buen ritmo matutino'),
(2, 2, '2026-01-02 08:00:00', '02:10:00', 72.0, 'Sierra Norte', 145, 175, 210, 220, 32.0, 80.0, 0.91, 1200, 'Sensaciones normales'),
(3, 3, '2026-01-03 07:00:00', '01:30:00', 48.5, 'Ruta Lago', 138, 165, 190, 200, 30.2, 55.0, 0.85, 500, 'Entrenamiento suave');
-- (Puedes continuar agregando los entrenamientos restantes igual que antes)
--ciclista
-- ├── historico_ciclista
-- ├── plan_entrenamiento
-- │     └── sesion_entrenamiento
-- │           └── sesion_bloque
-- └── entrenamiento
--        └── (opcional) sesion_entrenamiento. (Puede haber entrenamientos "libre" sin plan) 


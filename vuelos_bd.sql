-- Base de datos: Sistema de Reservaciones de Vuelo (SQLite)
-- Este archivo se ejecuta automáticamente desde conexion.php la primera vez
-- que se crea vuelos_bd.sqlite. No requiere phpMyAdmin ni servidor MySQL.

CREATE TABLE IF NOT EXISTS usuarios (
    id_usuario      INTEGER PRIMARY KEY AUTOINCREMENT,
    nombre          VARCHAR(100) NOT NULL,
    apellido        VARCHAR(100) NOT NULL,
    calle           VARCHAR(150),
    colonia         VARCHAR(100),
    ciudad          VARCHAR(100),
    pais            VARCHAR(100),
    cp              VARCHAR(10),
    tel_casa        VARCHAR(20),
    tel_oficina     VARCHAR(20),
    fax             VARCHAR(20),
    email           VARCHAR(150) NOT NULL UNIQUE,
    login           VARCHAR(50)  NOT NULL UNIQUE,
    password        VARCHAR(255) NOT NULL,
    fecha_registro  DATETIME DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS tarjetas (
    id_tarjeta          INTEGER PRIMARY KEY AUTOINCREMENT,
    id_usuario          INTEGER NOT NULL,
    nombre_titular      VARCHAR(100) NOT NULL,
    num_tarjeta         VARCHAR(16)  NOT NULL,
    tipo                VARCHAR(20),
    fecha_vencimiento   VARCHAR(7),
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id_usuario) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS vuelos (
    id_vuelo        INTEGER PRIMARY KEY AUTOINCREMENT,
    aerolinea       VARCHAR(100),
    num_vuelo       VARCHAR(20),
    origen          VARCHAR(100),
    destino         VARCHAR(100),
    horario_salida  TIME,
    horario_llegada TIME,
    dias_operacion  VARCHAR(50),
    clase           VARCHAR(20),
    tarifa_ow       DECIMAL(10,2),
    tarifa_rf       DECIMAL(10,2),
    restricciones   VARCHAR(255),
    disponibilidad  INTEGER DEFAULT 0,
    status          VARCHAR(20) DEFAULT 'activo'
);

CREATE TABLE IF NOT EXISTS reservas (
    clave_reserva       INTEGER PRIMARY KEY AUTOINCREMENT,
    id_usuario          INTEGER NOT NULL,
    apellido            VARCHAR(100),
    nombre              VARCHAR(100),
    viajero_frecuente   VARCHAR(50),
    id_vuelo            INTEGER,
    aerolinea           VARCHAR(100),
    num_vuelo           VARCHAR(20),
    origen              VARCHAR(100),
    destino             VARCHAR(100),
    fecha               DATE,
    hora_salida         TIME,
    hora_llegada        TIME,
    asiento             VARCHAR(10),
    tipo_asiento        VARCHAR(10),
    clase               VARCHAR(20),
    num_comida          INTEGER DEFAULT 0,
    tipo_comida         VARCHAR(10),
    tarifa              DECIMAL(10,2),
    estado_pago         VARCHAR(20) DEFAULT 'pendiente',
    status              VARCHAR(20) DEFAULT 'activa',
    limite              INTEGER,
    fecha_registro      DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id_usuario),
    FOREIGN KEY (id_vuelo)   REFERENCES vuelos(id_vuelo)
);

CREATE TABLE IF NOT EXISTS pagos (
    id_pago             INTEGER PRIMARY KEY AUTOINCREMENT,
    clave_reserva       INTEGER NOT NULL,
    id_tarjeta          INTEGER,
    nombre_titular      VARCHAR(100),
    num_tarjeta         VARCHAR(16),
    tipo                VARCHAR(20),
    fecha_vencimiento   VARCHAR(7),
    tarifa              DECIMAL(10,2),
    tipo_operacion      VARCHAR(20) NOT NULL CHECK(tipo_operacion IN ('pago','reembolso')),
    fecha_operacion     DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (clave_reserva) REFERENCES reservas(clave_reserva),
    FOREIGN KEY (id_tarjeta)    REFERENCES tarjetas(id_tarjeta)
);

-- ============================================================
-- DATOS DE PRUEBA
-- ============================================================

-- Usuarios
-- Login: admin    | Password: admin123
-- Login: jperez   | Password: 123456
-- Login: mlopez   | Password: 123456
INSERT INTO usuarios (nombre, apellido, calle, colonia, ciudad, pais, cp, tel_casa, tel_oficina, fax, email, login, password) VALUES
('Administrador', 'Sistema',         'Av. Reforma 100', 'Centro',      'CDMX',        'México', '06000', '5555550100', '5555550101', '', 'admin@vuelos.com',  'admin',  'admin123'),
('Juan',          'Pérez García',     'Calle Pino 25',   'Las Flores',  'Guadalajara', 'México', '44100', '3333330200', '3333330201', '', 'jperez@correo.com', 'jperez', '123456'),
('María',         'López Hernández',  'Av. Hidalgo 88',  'Universidad', 'Monterrey',   'México', '64000', '8181810300', '8181810301', '', 'mlopez@correo.com', 'mlopez', '123456');

-- Tarjetas de los usuarios
INSERT INTO tarjetas (id_usuario, nombre_titular, num_tarjeta, tipo, fecha_vencimiento) VALUES
(1, 'Administrador Sistema', '4111111111111111', 'Visa',       '12/2028'),
(2, 'Juan Perez Garcia',     '5555444433332222', 'MasterCard', '08/2027'),
(2, 'Juan Perez Garcia',     '378282246310005',  'Amex',       '03/2026'),
(3, 'Maria Lopez Hernandez', '4012888888881881', 'Visa',       '11/2027');

-- Catálogo de vuelos
INSERT INTO vuelos (aerolinea, num_vuelo, origen, destino, horario_salida, horario_llegada, dias_operacion, clase, tarifa_ow, tarifa_rf, restricciones, disponibilidad, status) VALUES
('Aeroméxico',  'AM404', 'CDMX',        'Guadalajara', '07:30:00', '08:45:00', 'L,M,X,J,V,S,D', 'Turista',   1850.00, 3200.00, 'Equipaje 25kg', 120, 'activo'),
('Aeroméxico',  'AM410', 'CDMX',        'Monterrey',   '09:15:00', '10:45:00', 'L,M,X,J,V',     'Turista',   2100.00, 3850.00, 'Equipaje 25kg', 100, 'activo'),
('Volaris',     'Y4860', 'CDMX',        'Cancún',      '11:00:00', '13:15:00', 'L,M,X,J,V,S,D', 'Turista',   1990.00, 3500.00, 'Sin equipaje',  150, 'activo'),
('Volaris',     'Y4205', 'Guadalajara', 'Tijuana',     '14:20:00', '16:00:00', 'M,J,S',         'Turista',   1750.00, 3100.00, 'Sin equipaje',   90, 'activo'),
('VivaAerobus', 'VB1010','Monterrey',   'CDMX',        '06:45:00', '08:10:00', 'L,M,X,J,V,S,D', 'Turista',    980.00, 1800.00, 'Sin alimentos', 180, 'activo'),
('VivaAerobus', 'VB2330','CDMX',        'Mérida',      '16:30:00', '18:25:00', 'L,X,V,D',       'Turista',   1620.00, 2950.00, 'Sin alimentos', 140, 'activo'),
('Aeroméxico',  'AM018', 'CDMX',        'Nueva York',  '23:55:00', '06:30:00', 'L,M,X,J,V,S,D', 'Ejecutiva', 9850.00,18200.00, 'Pasaporte/Visa', 40, 'activo'),
('Aeroméxico',  'AM057', 'CDMX',        'Madrid',      '21:30:00', '14:50:00', 'L,X,V,D',       'Ejecutiva',15400.00,28900.00, 'Pasaporte',      30, 'activo'),
('Interjet',    'IJ500', 'Tijuana',     'CDMX',        '08:00:00', '11:30:00', 'L,V',           'Turista',   2350.00, 4100.00, 'En revisión',     0, 'inactivo');

-- Reservas de prueba
INSERT INTO reservas (id_usuario, apellido, nombre, viajero_frecuente, id_vuelo, aerolinea, num_vuelo, origen, destino, fecha, hora_salida, hora_llegada, asiento, tipo_asiento, clase, num_comida, tipo_comida, tarifa, estado_pago, status, limite) VALUES
(2, 'Pérez García',    'Juan',  'AM-9988', 1, 'Aeroméxico',  'AM404', 'CDMX',      'Guadalajara', '2026-06-15', '07:30:00', '08:45:00', '14A', 'Ventana',  'Turista',   1, 'Normal',     1850.00, 'pagado',    'activa', 45),
(2, 'Pérez García',    'Juan',  'AM-9988', 7, 'Aeroméxico',  'AM018', 'CDMX',      'Nueva York',  '2026-07-20', '23:55:00', '06:30:00', '03B', 'Pasillo',  'Ejecutiva', 1, 'Vegetariana',9850.00, 'pendiente', 'activa', 30),
(3, 'López Hernández', 'María', 'Y4-1234', 3, 'Volaris',     'Y4860', 'CDMX',      'Cancún',      '2026-06-28', '11:00:00', '13:15:00', '22C', 'Pasillo',  'Turista',   0, '',           1990.00, 'pagado',    'activa', 60),
(3, 'López Hernández', 'María', '',        5, 'VivaAerobus', 'VB1010','Monterrey', 'CDMX',        '2026-05-30', '06:45:00', '08:10:00', '08F', 'Ventana',  'Turista',   0, '',            980.00, 'pendiente', 'activa', 15);

-- Pagos asociados a las reservas pagadas
INSERT INTO pagos (clave_reserva, id_tarjeta, nombre_titular, num_tarjeta, tipo, fecha_vencimiento, tarifa, tipo_operacion) VALUES
(1, 2, 'Juan Perez Garcia',     '5555444433332222', 'MasterCard', '08/2027', 1850.00, 'pago'),
(3, 4, 'Maria Lopez Hernandez', '4012888888881881', 'Visa',       '11/2027', 1990.00, 'pago');

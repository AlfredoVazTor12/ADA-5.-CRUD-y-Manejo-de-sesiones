CREATE DATABASE IF NOT EXISTS tienda_sesiones CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE tienda_sesiones;

-- Tabla de usuarios (opcional para validar contra BD o registrar historial)
CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    correo VARCHAR(100) NOT NULL UNIQUE
);

-- Tabla de catálogo de productos
CREATE TABLE productos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    descripcion VARCHAR(255) NOT NULL,
    precio DECIMAL(10, 2) NOT NULL,
    stock INT NOT NULL DEFAULT 10
);

-- Insertar datos de prueba
INSERT INTO usuarios (nombre, correo) VALUES 
('Carlos Mendoza', 'carlos@ejemplo.com'),
('Ana Sofía López', 'ana@ejemplo.com');

INSERT INTO productos (nombre, descripcion, precio, stock) VALUES
('Teclado Mecánico RGB', 'Switches rojos, retroiluminación personalizable', 1250.00, 15),
('Mouse Inalámbrico Gamer', 'Sensor óptico de 16000 DPI, batería recargable', 680.50, 20),
('Monitor 24" Full HD', 'Panel IPS, 144Hz, 1ms de respuesta', 3499.00, 8),
('Audífonos Diadema 7.1', 'Sonido envolvente con micrófono con cancelación', 920.00, 12);
-- Crear tabla equipos
CREATE TABLE IF NOT EXISTS equipos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) UNIQUE NOT NULL,
    dorsal INT NOT NULL,
    precio DECIMAL(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Crear tabla jugadores
CREATE TABLE IF NOT EXISTS jugadores (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    posicion VARCHAR(50) NOT NULL,
    equipo_id INT,
    edad INT NOT NULL,
    FOREIGN KEY (equipo_id) REFERENCES equipos(id) ON DELETE SET NULL ON UPDATE CASCADE,
    INDEX idx_equipo_id (equipo_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Insertar equipos de prueba
INSERT INTO equipos (nombre, dorsal, precio) VALUES
('Barcelona', 10, 89.99),
('Real Madrid', 7, 94.99),
('Manchester United', 7, 79.99),
('Bayern Munich', 9, 84.99),
('PSG', 10, 99.99);

-- Insertar jugadores de prueba
INSERT INTO jugadores (nombre, posicion, equipo_id, edad) VALUES
('Lionel Messi', 'DC', 1, 36),
('Cristiano Ronaldo', 'DC', 2, 38),
('Sergio Busquets', 'MC', 1, 35),
('Luka Modrić', 'MC', 2, 38),
('Marc-André ter Stegen', 'PO', 1, 31),
('Thibaut Courtois', 'PO', 2, 31),
('Harry Maguire', 'DEF', 3, 30),
('Thomas Müller', 'DC', 4, 34);
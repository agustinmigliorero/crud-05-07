-- Crear base de datos
CREATE DATABASE IF NOT EXISTS videogame_db;
USE videogame_db;

-- Tabla: types
CREATE TABLE IF NOT EXISTS types (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL UNIQUE
);

-- Tabla: videogames
CREATE TABLE IF NOT EXISTS videogames (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(100) NOT NULL,
    release_year INT,
    developer VARCHAR(100),
    type_id INT,
    FOREIGN KEY (type_id) REFERENCES types(id)
        ON DELETE SET NULL
        ON UPDATE CASCADE
);

-- Tabla: usuarios
CREATE TABLE Usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
);

INSERT INTO types (name) VALUES 
('Acción'),
('Aventura'),
('RPG'),
('Estrategia'),
('Deportes'),
('Simulación');

INSERT INTO videogames (title, release_year, developer, type_id) VALUES
('The Legend of Zelda: Breath of the Wild', 2017, 'Nintendo', 2),
('The Witcher 3: Wild Hunt', 2015, 'CD Projekt Red', 3),
('FIFA 24', 2023, 'EA Sports', 5),
('Civilization VI', 2016, 'Firaxis Games', 4),
('Microsoft Flight Simulator', 2020, 'Asobo Studio', 6),
('DOOM Eternal', 2020, 'id Software', 1);



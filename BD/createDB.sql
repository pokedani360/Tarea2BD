CREATE DATABASE USTeaM;
USE USTeaM;

CREATE TABLE Consolas (
    id_consola INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100),
    marca VARCHAR(100),
    formato ENUM('sobremesa', 'portátil'),
    num_controles INT,
    unidades_disponibles INT
);

CREATE TABLE Videojuegos (
    id_videojuego INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100),
    descripcion TEXT,
    clasificacion ENUM('RP', 'E', 'E10+', 'T', 'M', 'A'),
    calificacion DECIMAL(2, 1),
    imagen_ref VARCHAR(255),
    unidades_disponibles INT
);

CREATE TABLE Carrito (
    id_item INT AUTO_INCREMENT PRIMARY KEY,
    tipo ENUM('consola', 'videojuego'),
    id_producto INT,
    cantidad INT,
    FOREIGN KEY (id_producto) REFERENCES Consolas(id_consola) ON DELETE CASCADE,
    FOREIGN KEY (id_producto) REFERENCES Videojuegos(id_videojuego) ON DELETE CASCADE
);
USE USteam;

CREATE TABLE Consolas (
    id_consola INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100),
    marca VARCHAR(100),
    formato ENUM('sobremesa', 'portátil'),
    num_controles INT,
    unidades_disponibles INT,
    precio INT
);

CREATE TABLE Videojuegos (
    id_videojuego INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100),
    descripcion TEXT,
    clasificacion ENUM('RP', 'E', 'E10+', 'T', 'M', 'A'),
    calificacion DECIMAL(2, 1),
    imagen_ref VARCHAR(255),
    unidades_disponibles INT,
    precio INT
);

CREATE TABLE Carrito (
    id_carrito INT AUTO_INCREMENT PRIMARY KEY
);

CREATE TABLE detalle_carrito (
    id_detalle INT AUTO_INCREMENT PRIMARY KEY,
    id_carrito INT,
    id_producto INT,
    cantidad INT,
    tipo_producto ENUM('consola', 'videojuego'),
    FOREIGN KEY (id_carrito) REFERENCES Carrito(id_carrito) ON DELETE CASCADE,
    FOREIGN KEY (id_producto) REFERENCES Consolas(id_consola) ON DELETE CASCADE,
    FOREIGN KEY (id_producto) REFERENCES Videojuegos(id_videojuego) ON DELETE CASCADE
);

ALTER TABLE Consolas ADD COLUMN imagen VARCHAR(255);
ALTER TABLE Videojuegos ADD COLUMN imagen VARCHAR(255);


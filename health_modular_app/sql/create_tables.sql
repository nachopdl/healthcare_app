CREATE DATABASE healthcare;
USE healthcare;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombres VARCHAR(100) NOT NULL,
    apellidos VARCHAR(100) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    dob DATE NOT NULL,
    genero VARCHAR(10) NOT NULL,
    estatura INT(3) NOT NULL,
    peso INT(3) NOT NULL,
    tipo_sangre VARCHAR(1O) NOT NULL,
    foto VARCHAR(255),
    created_at TIMESTAMP NOT NULL, 
    updated_at TIMESTAMP NOT NULL
);

CREATE TABLE medicos(
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    correo VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    especialidad VARCHAR(255) NOT NULL,
    telefono VARCHAR(20) NOT NULL
);

CREATE TABLE citas(
    cita_id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT NOT NULL,
    medico_id INT NOT NULL,
    fecha DATE NOT NULL,
    hora TIME NOT NULL,
    motivo TEXT NOT NULL,
    FOREIGN KEY (usuario_id) REFERENCES users(id),
    FOREIGN KEY (medico_id) REFERENCES medicos(id) 
);

CREATE TABLE entrenamientos(
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    descripcion TEXT NOT NULL,
    duracion INT NOT NULL,
    categoria VARCHAR(64) NOT NULL
);

CREATE TABLE entrenamiento_usuario(
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_usuario INT NOT NULL,
    id_entrenamiento INT NOT NULL,
    FOREIGN KEY (id_usuario) REFERENCES users(id),
    FOREIGN KEY (id_entrenamiento) REFERENCES entrenamientos(id)
);

CREATE TABLE dietas(
    dieta_id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    descripcion TEXT NOT NULL,
    fecha_inicio DATE NOT NULL,
    fecha_fin DATE NOT NULL
);

CREATE TABLE comidas(
    comida_id INT AUTO_INCREMENT PRIMARY KEY,
    dieta_id INT NOT NULL,
    nombre VARCHAR(255) NOT NULL,
    descripcion TEXT,
    calorias INT NOT NULL
);

CREATE TABLE dieta_usuario(
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_usuario INT NOT NULL,
    id_dieta INT NOT NULL,
    FOREIGN KEY (id_usuario) REFERENCES users(id),
    FOREIGN KEY (id_dieta) REFERENCES dietas(dieta_id)
);

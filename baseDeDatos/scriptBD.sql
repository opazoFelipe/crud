CREATE TABLE usuarios(
	nombre VARCHAR(200),
    apellido_paterno VARCHAR(200),
    apellido_materno VARCHAR(200),
    correo VARCHAR(100) NOT NULL,
    telefono VARCHAR(12),
    contrasenia VARCHAR(30),
    PRIMARY KEY(correo)
);
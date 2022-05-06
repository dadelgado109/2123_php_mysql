

Persona 
	* Nombres	        VARCHAR 50
	* Apellidos         VARCHAR 100
	* Fecha Nacimiento  DATE
	* Documento			CHAR 8 
	* Altura			FLOAT 
	* Sexo				ENUM (MASCULINO, FEMENINO, OTROS)
	* Celular			TINYINT 
	* Direccion			TEXT
	* Telefono			TINYINT
	

	
	
CREATE TABLE personas(

	nombre VARCHAR(50),
	apellidos VARCHAR(100),
	fechaNacimiento DATE,
	documento CHAR(8),
	altura FLOAT(10,2),
	sexo ENUM('Masculino','Femenino','Otros'),
	celular TINYINT(10),
	direccion TEXT,
	telefono TINYINT(10)

);


SHOW TABLES;

DROP TABLE personas;

SELECT * FROM personas;




	
CREATE TABLE personas(

	nombre VARCHAR(50),
	apellidos VARCHAR(100),
	fechaNacimiento DATE,
	documento CHAR(8),
	altura FLOAT(10,2),
	sexo ENUM('Masculino','Femenino','Otros'),
	celular TINYINT(10),
	direccion TEXT,
	telefono TINYINT(10)
);

DROP TABLE alumnos; 				

CREATE TABLE alumnos(
	
	documento VARCHAR(20),
	nombre VARCHAR(50),
	apellidos VARCHAR(50),
	tipoDocumento ENUM("CI", "Pasaporte"),
	fechaNacimiento DATE,
	PRIMARY KEY (documento)
	
);

SELECT * FROM alumnos;

INSERT INTO alumnos (documento,nombre,apellidos,tipoDocumento,fechaNacimiento)
VALUES ("44559966","Damian","Delgado","CI","1987-09-10");

INSERT INTO alumnos (documento,nombre,apellidos,tipoDocumento,fechaNacimiento)
VALUES ("556677","Alfredo","Imperial","CI","1985-06-15");

INSERT alumnos SET
	documento 	= "9988548",
	nombre		= "Javier",
	apellidos	= "Matorrales",
	tipoDocumento = "Pasaporte",
	fechaNacimiento = "1900-01-15";

INSERT alumnos SET
	documento 	= "54354353",
	nombre		= "Fabian",
	apellidos	= "Casco",
	tipoDocumento = "CI",
	fechaNacimiento = "1900-01-15";


INSERT alumnos SET
	documento 	= "64684546",
	nombre		= "Javier",
	apellidos	= "Matorrales",
	tipoDocumento = "Pasaporte",
	fechaNacimiento = "1900-01-15";

INSERT alumnos SET
	documento 	= "5432432",
	nombre		= "Ines",
	apellidos	= "Zamorano",
	tipoDocumento = "Pasaporte",
	fechaNacimiento = "1900-01-15";

INSERT alumnos SET
	documento 	= "5654784",
	nombre		= "Maria",
	apellidos	= "Perez",
	tipoDocumento = "CI",
	fechaNacimiento = "1900-01-15";


DELETE FROM alumnos;

-- 44559966

DELETE FROM alumnos WHERE documento = "44559966";

DELETE FROM alumnos WHERE documento = "44559966" LIMIT 4;


SELECT * FROM alumnos;

SELECT * FROM alumnos WHERE nombre = "DAMIAN";

SELECT * FROM alumnos WHERE apellidos = "Matorrales";

SELECT * FROM alumnos WHERE tipoDocumento = "Pasaportesss";
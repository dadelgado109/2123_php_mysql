

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




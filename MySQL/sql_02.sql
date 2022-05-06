

	
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


CREATE TABLE alumnos(
	
	documento VARCHAR(20),
	nombre VARCHAR(50),
	apellidos VARCHAR(50),
	tipoDocumento ENUM("CI", "Pasaporte"),
	fechaNacimiento DATE,
	PRIMARY KEY (documento)
	
);

CREATE TABLE tiposCursos(
	
	idTipoCurso INT(4) NOT NULL AUTO_INCREMENT,
	nombre VARCHAR(100),
	descripcion TEXT,
	PRIMARY KEY (idTipoCurso)
	
);

CREATE TABLE profesores(	
	documento VARCHAR(20),
	nombre VARCHAR(50),
	apellidos VARCHAR(50),
	fechaNacimiento DATE,
	PRIMARY KEY (documento)	
);

DROP TABLE profesores;
	
CREATE TABLE cursos(

	codigo INT(7) NOT NULL AUTO_INCREMENT,
	anio	YEAR NOT NULL,
	idTipoCurso INT(4),
	profesores 	VARCHAR(20),
	PRIMARY KEY (codigo),
	KEY c_idTipoCurso (idTipoCurso),
	KEY c_profesores (profesores),
	CONSTRAINT c_tipoCurso_fk1 FOREIGN KEY (idTipoCurso) REFERENCES tiposCursos (idTipoCurso),
	CONSTRAINT c_profesores_fk2 FOREIGN KEY (profesores) REFERENCES profesores (documento)
	
)



DROP TABLE tiposCursos; 				

SHOW TABLES;

SHOW CREATE TABLE tiposCursos;


SELECT * FROM tiposcursos ;



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
	documento 	= "665234",
	nombre		= "Antonio",
	apellidos	= "Delgado",
	tipoDocumento = "CI",
	fechaNacimiento = "1991-07-14";


-- No ejecutar querry MALA
-- DELETE FROM alumnos;

-- 44559966

DELETE FROM alumnos WHERE documento = "44559966";

DELETE FROM alumnos WHERE documento = "44559966" LIMIT 4;


SELECT * FROM alumnos;

SELECT * FROM alumnos WHERE nombre = "DAMIAN";

SELECT * FROM alumnos WHERE nombre = "Javier";

SELECT * FROM alumnos WHERE fechaNacimiento >= "1990-01-01"

SELECT * FROM alumnos WHERE fechaNacimiento <= "1990-01-01"

-- La clausal LIKE me permite buscar en parte de una palabra
SELECT * FROM alumnos WHERE nombre LIKE ("%ia%");
-- En este caso lo que hace es buscar los nombre que empiecen con "ian" y despues con el comidin
SELECT * FROM alumnos WHERE nombre LIKE ("ian%");
-- En este caso lo que hace es buscar con el comidin al principio y que terminen con "ian"
SELECT * FROM alumnos WHERE nombre LIKE ("%ian");
-- Esto lo que hace es buscar algun nombre que empiece con "F" comodin en el medio y termine con "ian"
SELECT * FROM alumnos WHERE nombre LIKE ("F%ian");

-- Con la clausula ORDER BY podemos ordenar 
SELECT * FROM alumnos ORDER BY nombre;

-- Asi lo ordenamos de forma descendente
SELECT * FROM alumnos ORDER BY nombre DESC;

-- 
SELECT * FROM alumnos ORDER BY nombre ASC; 

-- Para ordenar primero por el nombre y segundo por el apellido
SELECT * FROM alumnos ORDER BY nombre, apellidos ASC; 

SELECT * FROM alumnos ORDER BY apellidos, nombre ASC; 
	
SELECT * FROM alumnos ORDER BY fechaNacimiento ASC; 	
	

-- Para limitar cantidad de registros
SELECT * FROM alumnos a LIMIT 5;

-- Para limitar por seccion el primer valor me da el punto de salida y el segundo la cantidad
-- de registro que voy a traer
SELECT * FROM alumnos a LIMIT 0,3;

SELECT * FROM alumnos a LIMIT 5,3;

-- Contar la cantidad de registro que tiene una tabla
SELECT count(*) FROM alumnos;

-- Traigo los campos seleccione
SELECT apellidos,nombre,fechaNacimiento FROM alumnos;

-- Con el * Traigo todos los campos
SELECT * FROM alumnos;

-- Para agrupar registro en mysql
SELECT tipoDocumento FROM alumnos GROUP BY tipoDocumento;

-- Para agrupar registro en mysql
SELECT nombre FROM alumnos GROUP BY nombre;

-- De esta forma actualizamos los registro de la tabla alumnos
UPDATE alumnos SET
	nombre = "Agustin",
	apellidos = "Ferrer"
	WHERE documento = '556677';	
	
SELECT * FROM alumnos WHERE apellidos != "delgado";

-- Todos los de Nombre de los Delgado que nacieron despues de 01-01-1985
SELECT nombre FROM alumnos WHERE apellidos="Delgado" AND fechaNacimiento > "1985-01-01";

-- Con la clausula OR lo que hace es trae todos los registro que complan una parte y la otra 
SELECT * FROM alumnos WHERE apellidos = "delgado" OR apellidos = "Garcia" ;

-- la clausula NOT trae todos los opuestos al like 
SELECT * FROM alumnos WHERE nombre NOT LIKE ("%ian");

-- Yo quiero todos alumnos que nos sean delgado y no tenga la letra "e" en el nombre ordenados 
-- por fecha de nacimiento  

SELECT * FROM alumnos WHERE apellidos != "Delgado" AND nombre NOT LIKE ("%e%") ORDER BY fechaNacimiento;


-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

SELECT * FROM tiposcursos;

INSERT INTO tiposcursos 
	SET 
		nombre = "Excel Avanzado",
		descripcion = "Sentite un programador usando excel";


SELECT * FROM profesores ;

DELETE FROM profesores WHERE nombre = "TTOTOT";

INSERT INTO profesores 
	SET documento = "6666",
		nombre = "Ivana",
		apellidos = "Moreno",
		fechaNacimiento = "1988-10-04";
		
4444444
45678132
6666

	CONSTRAINT c_tipoCurso_fk1 FOREIGN KEY (idTipoCurso) REFERENCES tiposCursos (idTipoCurso),
	CONSTRAINT c_profesores_fk2 FOREIGN KEY (profesores) REFERENCES profesores (documento)
		
	SELECT * FROM cursos;		

	INSERT INTO cursos SET
		anio = 2013,
		idTipoCurso = 2,
		profesores = '6666';

	
	SELECT * FROM 
		cursos c 
	INNER JOIN tiposcursos t ON t.idTipoCurso = c.idTipoCurso;
		





		
		




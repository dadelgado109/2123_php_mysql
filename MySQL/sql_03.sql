



SHOW CREATE TABLE alumnos;

CREATE TABLE `alumnos` (
  `documento` varchar(20) NOT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `apellidos` varchar(50) DEFAULT NULL,
  `tipoDocumento` enum('CI','Pasaporte') DEFAULT NULL,
  `fechaNacimiento` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8

ALTER TABLE alumnos
	ADD PRIMARY KEY (documento);

CREATE TABLE `alumnos` (
  `documento` varchar(20) NOT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `apellidos` varchar(50) DEFAULT NULL,
  `tipoDocumento` enum('CI','Pasaporte') DEFAULT NULL,
  `fechaNacimiento` date DEFAULT NULL,
  PRIMARY KEY (`documento`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8

ALTER TABLE alumnos
	ADD peso INT(3);

CREATE TABLE `alumnos` (
  `documento` varchar(20) NOT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `apellidos` varchar(50) DEFAULT NULL,
  `tipoDocumento` enum('CI','Pasaporte') DEFAULT NULL,
  `fechaNacimiento` date DEFAULT NULL,
  `peso` int(3) DEFAULT NULL,
  PRIMARY KEY (`documento`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8

ALTER TABLE alumnos 
	DROP peso;

CREATE TABLE `alumnos` (
  `documento` varchar(20) NOT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `apellidos` varchar(50) DEFAULT NULL,
  `tipoDocumento` enum('CI','Pasaporte') DEFAULT NULL,
  `fechaNacimiento` date DEFAULT NULL,
  PRIMARY KEY (`documento`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8

-- ++++++++++++++++++++++++++++++++++++++++++++++++

	alumnos, tiposcursos, cursos, profesores	

	SELECT * FROM alumnos a; 
	SELECT * FROM tiposcursos t;
 
	INSERT INTO tiposcursos SET
		nombre = "Programacion PHP",
		descripcion = "El mejor cursos de todos"
	
	SELECT * FROM profesores p;  
	SELECT * FROM cursos c; 

	SELECT * FROM alumnos_cursos;
	/*
		Hacemos el join para traernos la informacion 
		de tiposCursos a cursos.
		Para utilizar solo los campos que queremos utilizamos
		los alizas en la tabla para traer los campos que precisamos
		y hacer las union de las 2 tablas
		
		(Alias = renombrar una tabla o campo para que sea mas
			facil su manupulacion )
	*/ 
	SELECT  c.codigo,
			c.anio,
			c.idTipoCurso,
			tc.nombre,
			profesores 
		FROM cursos c  
		INNER JOIN tiposcursos tc ON tc.idTipoCurso = c.idTipoCurso; 

		/*
		 * En esta consulta lo que hicimos juntamos(con group by)
		 * Todos los registro "idTipoCurso" y despues contamos cuantos
		 * cursos habia en cada tipo de curso
		 * */
		SELECT 	c.idTipoCurso,
				tc.nombre,
				count(codigo) AS total
		FROM cursos c  
		INNER JOIN tiposcursos tc ON tc.idTipoCurso = c.idTipoCurso
			GROUP BY c.idTipoCurso;
	
	
	CREATE TABLE alumnos_cursos(
		documento VARCHAR(20),
		codigo INT(7),
		KEY (documento),
		KEY (codigo),
		CONSTRAINT c_alumCurso_fk1 FOREIGN KEY (documento) REFERENCES alumnos (documento),
		CONSTRAINT c_alumCurso_fk2 FOREIGN KEY (codigo) REFERENCES cursos (codigo) 
	)
	
	SHOW TABLES;
	SELECT * FROM alumnos a; 
	SELECT * FROM cursos c; 

	INSERT INTO alumnos_cursos SET
		documento = "5432432",
		codigo = "12";
		

	
	
	
	-- En esta consulta sacamos que curso esta dando que profesor
	-- Donde a traves del inner join traemos los nombre de los cursos y de los profesores 
	SELECT  c.codigo,
			c.anio,
			tc.nombre,
			CONCAT(p.nombre," ",p.apellidos, " ",p.documento ) AS nombre_completo
		FROM cursos c  
		INNER JOIN tiposcursos tc ON tc.idTipoCurso = c.idTipoCurso
		INNER JOIN profesores p ON p.documento = c.profesores ;
	

	DROP TABLE personas ;

SELECT * FROM alumnos a ;
SELECT * FROM cursos c ORDER BY anio ;

	-- 1)Primero Armamos la consulta para tener los alumnos que cursos hicieron
	SELECT * FROM alumnos_cursos;
	-- 2)Devolvimos solos los campos de la consulta 
	SELECT 	ac.documento,
			ac.codigo
		FROM alumnos_cursos ac;
	-- 3) Anexamos alumnos a la consulta y contatemos el nombre completo y la fecha nacimiento
	SELECT 	ac.documento,
			CONCAT(a.nombre," ",a.apellidos) AS nombreCompleto,
			a.fechaNacimiento,
			ac.codigo
		FROM alumnos_cursos ac
		INNER JOIN alumnos a ON a.documento = ac.documento;
	-- 4) Anexmos los cursos a la cosulta agregando el idTipoCurso y anio(Año)
	SELECT 	ac.documento,
			CONCAT(a.nombre," ",a.apellidos) AS nombreCompleto,
			a.fechaNacimiento,
			ac.codigo,
			c.anio,
			c.idTipoCurso  
		FROM alumnos_cursos ac
		INNER JOIN alumnos a ON a.documento = ac.documento
		INNER JOIN cursos c ON c.codigo = ac.codigo	
	-- 5) Anezamos a la consulta tiposcursos a igualando contra cursos los idTipoCuros y devolvimos el nombre
	SELECT 	ac.documento,
			CONCAT(a.nombre," ",a.apellidos) AS nombreCompleto,
			a.fechaNacimiento,
			ac.codigo,
			c.anio,
			t.nombre 
		FROM alumnos_cursos ac
		INNER JOIN alumnos a ON a.documento = ac.documento
		INNER JOIN cursos c ON c.codigo = ac.codigo
		INNER JOIN tiposcursos t ON t.idTipoCurso = c.idTipoCurso 
	-- 6) Buscamos lo que hiceron los curso excel basico
	SELECT 	ac.documento,
			CONCAT(a.nombre," ",a.apellidos) AS nombreCompleto,
			a.fechaNacimiento,
			ac.codigo,
			c.anio,
			t.nombre 
		FROM alumnos_cursos ac
		INNER JOIN alumnos a ON a.documento = ac.documento
		INNER JOIN cursos c ON c.codigo = ac.codigo
		INNER JOIN tiposcursos t ON t.idTipoCurso = c.idTipoCurso 
		WHERE t.nombre LIKE ("%Excel Basico%");
	-- 7) Total de alumnos que tuvieron cada año 
		SELECT 	
			c.anio,
			COUNT(ac.documento) AS totalAlumno 
		FROM alumnos_cursos ac
		INNER JOIN alumnos a ON a.documento = ac.documento
		INNER JOIN cursos c ON c.codigo = ac.codigo
		INNER JOIN tiposcursos t ON t.idTipoCurso = c.idTipoCurso 
		GROUP BY anio
	-- 8) Total de alumnos por año y curso	
		
		SELECT 	
			c.anio,
			t.nombre,
			COUNT(ac.documento) AS totalAlumno 
		FROM alumnos_cursos ac
		INNER JOIN alumnos a ON a.documento = ac.documento
		INNER JOIN cursos c ON c.codigo = ac.codigo
		INNER JOIN tiposcursos t ON t.idTipoCurso = c.idTipoCurso 
			WHERE a.fechaNacimiento < DATE_FORMAT(DATE_SUB(NOW(), INTERVAL 20 YEAR), "%Y-%m-%d")
		GROUP BY c.anio,c.idTipoCurso 
		
		SELECT NOW();
		SELECT DATE_SUB(NOW(), INTERVAL 20 YEAR);		
		SELECT DATE_FORMAT(DATE_SUB(NOW(), INTERVAL 20 YEAR), "%Y-%m-%d");	
		-- 2002-05-10
	
		SELECT 	
			c.anio,
			CONCAT(a.nombre," ",a.apellidos) AS nombreCompleto,
			DATE_FORMAT(a.fechaNacimiento, "%d/%m/%Y" )
		FROM alumnos_cursos ac
		INNER JOIN alumnos a ON a.documento = ac.documento
		INNER JOIN cursos c ON c.codigo = ac.codigo
		INNER JOIN tiposcursos t ON t.idTipoCurso = c.idTipoCurso 
			WHERE c.anio = "2000"		
			AND a.fechaNacimiento < DATE_FORMAT(DATE_SUB(NOW(), INTERVAL 20 YEAR), "%Y-%m-%d")
		
	-- 9)Alumos que cursaron entre 2005 y 2010 pero unicos 
	
			SELECT 	
			 	a.documento,
			 	CONCAT(a.nombre," ",a.apellidos) AS nombreCompleto,
			 	COUNT(c.codigo) AS totalRealizados,
			 	GROUP_CONCAT(c.codigo) AS cursosRealizados 	
			FROM alumnos_cursos ac
			INNER JOIN alumnos a ON a.documento = ac.documento
			INNER JOIN cursos c ON c.codigo = ac.codigo
			INNER JOIN tiposcursos t ON t.idTipoCurso = c.idTipoCurso 
				WHERE c.anio BETWEEN "2005"	AND "2010"		
				GROUP BY a.documento 
			HAVING totalRealizados > 2;
	
			
			SELECT DISTINCT 	
			 	a.documento,
			 	CONCAT(a.nombre," ",a.apellidos) AS nombreCompleto
			FROM alumnos_cursos ac
			INNER JOIN alumnos a ON a.documento = ac.documento
			INNER JOIN cursos c ON c.codigo = ac.codigo
			INNER JOIN tiposcursos t ON t.idTipoCurso = c.idTipoCurso 
				WHERE c.anio BETWEEN "2005"	AND "2010";

			
			
			
INSERT INTO phpmysql.alumnos_cursos (documento,codigo) VALUES
	 ('34543215',10),
	 ('34543215',5),
	 ('34543215',11),
	 ('34543215',14),
	 ('34543215',16),
	 ('34543215',20),
	 ('5655484',20),
	 ('5655484',4),
	 ('5655484',6),
	 ('5655484',8);
INSERT INTO phpmysql.alumnos_cursos (documento,codigo) VALUES
	 ('5655484',10),
	 ('5655484',12),
	 ('5655484',14),
	 ('5655484',16),
	 ('88745621',16),
	 ('88745621',19),
	 ('88745621',12),
	 ('88745621',9),
	 ('88745621',8),
	 ('88745621',7);
INSERT INTO phpmysql.alumnos_cursos (documento,codigo) VALUES
	 ('88745621',1),
	 ('88745621',5),
	 ('54354353',5),
	 ('54354353',4),
	 ('54354353',7),
	 ('54354353',13),
	 ('54354353',16),
	 ('54354353',18),
	 ('54354353',20),
	 ('9988548',20);
INSERT INTO phpmysql.alumnos_cursos (documento,codigo) VALUES
	 ('9988548',17),
	 ('9988548',16),
	 ('9988548',10),
	 ('9988548',5),
	 ('9988548',1),
	 ('5432432',6),
	 ('5432432',7),
	 ('5432432',8),
	 ('5432432',9),
	 ('5432432',10);
INSERT INTO phpmysql.alumnos_cursos (documento,codigo) VALUES
	 ('5432432',11),
	 ('5432432',12);
	
	








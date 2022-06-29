<?php

	function persistirConsulta($sqlInsert){
		// String conexion a la base de datos
		include("configuracion/configuracion.php");

		$srtConexion 	= "mysql:".$DATABASE['host']."=localhost;dbname=".$DATABASE['database'];
		// Credenciales
		$usuario 		= $DATABASE['user'];
		$clave 			= $DATABASE['password'];
		$options = [
			PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
			PDO::ATTR_CASE => PDO::CASE_NATURAL,
			PDO::ATTR_ORACLE_NULLS => PDO::NULL_EMPTY_STRING
		];
		$conexion 	= new PDO($srtConexion, $usuario, $clave, $options); 	
		$preparo 	= $conexion->prepare($sqlInsert);
		$respuesta	= $preparo->execute(array());	

	}

$arraySQL = array();

$arraySQL[] = "
		SET FOREIGN_KEY_CHECKS=0;
		DROP TABLE IF EXISTS administradores;
		DROP TABLE IF EXISTS alumnos;
		DROP TABLE IF EXISTS profesores;
		DROP TABLE IF EXISTS tiposCursos;
		DROP TABLE IF EXISTS cursos;
		DROP TABLE IF EXISTS alumnos_cursos;
		SET FOREIGN_KEY_CHECKS=1;
";

$arraySQL[] = "CREATE TABLE `administradores` (
	`id` int(3) NOT NULL AUTO_INCREMENT,
	`nombre` varchar(30) DEFAULT NULL,
	`mail` varchar(50) DEFAULT NULL,
	`clave` varchar(50) DEFAULT NULL,
	`estado` tinyint(1) DEFAULT NULL,
	PRIMARY KEY (`id`)
) ;";

$arraySQL[] = "CREATE TABLE `alumnos` (
	`documento` varchar(20) NOT NULL,
	`nombre` varchar(50) DEFAULT NULL,
	`apellidos` varchar(50) DEFAULT NULL,
	`tipoDocumento` enum('CI','Pasaporte','Credencial') DEFAULT NULL,
	`fechaNacimiento` date DEFAULT NULL,
	`estado` tinyint(1) DEFAULT NULL,
	PRIMARY KEY (`documento`)
)";

$arraySQL[] = "CREATE TABLE `profesores` (
	`documento` varchar(20) NOT NULL,
	`nombre` varchar(50) DEFAULT NULL,
	`apellidos` varchar(50) DEFAULT NULL,
	`fechaNacimiento` date DEFAULT NULL,
	`estado` tinyint(1) DEFAULT NULL,
	PRIMARY KEY (`documento`)
) ";

$arraySQL[] = "CREATE TABLE `tiposCursos` (
	`idTipoCurso` int(4) NOT NULL AUTO_INCREMENT,
	`nombre` varchar(100) DEFAULT NULL,
	`descripcion` text,
	`estado` tinyint(1) DEFAULT NULL,
	PRIMARY KEY (`idTipoCurso`)
) ";

$arraySQL[] = "CREATE TABLE `cursos` (
	`codigo` int(7) NOT NULL AUTO_INCREMENT,
	`anio` year(4) NOT NULL,
	`idTipoCurso` int(4) DEFAULT NULL,
	`profesores` varchar(20) DEFAULT NULL,
	PRIMARY KEY (`codigo`),
	KEY `c_idTipoCurso` (`idTipoCurso`),
	KEY `c_profesores` (`profesores`),
	CONSTRAINT `c_profesores_fk2` FOREIGN KEY (`profesores`) REFERENCES `profesores` (`documento`),
	CONSTRAINT `c_tipoCurso_fk1` FOREIGN KEY (`idTipoCurso`) REFERENCES `tiposcursos` (`idTipoCurso`)
)";

$arraySQL[] = "CREATE TABLE `alumnos_cursos` (
	`documento` varchar(20) DEFAULT NULL,
	`codigo` int(7) DEFAULT NULL,
	KEY `documento` (`documento`),
	KEY `codigo` (`codigo`),
	CONSTRAINT `c_alumCurso_fk1` FOREIGN KEY (`documento`) REFERENCES `alumnos` (`documento`),
	CONSTRAINT `c_alumCurso_fk2` FOREIGN KEY (`codigo`) REFERENCES `cursos` (`codigo`)
)";

$arraySQL[] = "
		INSERT INTO `profesores` VALUES ('123456897','Maxi','Gomez','1985-10-19',1),('23554684','Beatriz','Gonzales','1960-01-13',1),('3326224','Sofia','Carrasco','2001-11-09',1),('3352145','Kiko','Gonzales','1990-06-08',1),('4444444','Damian','Delgado','1987-10-09',1),('45324325233','Alvaro','Ortega','1952-06-21',1),('456132','Ricardo','Fernandez','1998-06-14',1),('45678132','Nicola','Rotundo','1980-05-18',1),('5412156','Luis','Suarez','1985-06-21',0),('5464789152','Carolina','Gonzales','1996-06-14',1),('6666','Ivana','Moreno','1988-10-04',1),('6784512','Ingred','Delgado','2000-03-15',1);
";


foreach($arraySQL as $sql){
		print_r($sql);
		persistirConsulta($sql);
		print_r("\n\n");
}


?>

<?PHP


class generico_modelo {


    protected function ejecutarConsulta($sql, $arraySQL){

		$DATABASE = array(
			"host" => "localhost",
			"port" => "3306",
			"database" => "curso_2123",
			"user" => "root",
			"password" => ""
		);

		$srtConexion 	= "mysql:".$DATABASE['host']."=localhost;dbname=".$DATABASE['database'];
		// Credenciales
		$usuario 		= $DATABASE['user'];
		$clave 			= $DATABASE['password'];

		$options = [
			PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
			PDO::ATTR_CASE => PDO::CASE_NATURAL,
			PDO::ATTR_ORACLE_NULLS => PDO::NULL_EMPTY_STRING
		];
		// Realizo la conexion con el servidor
		$conexion 	= new PDO($srtConexion, $usuario, $clave, $options); 		
		$preparo 	= $conexion->prepare($sql);
		$preparo->execute($arraySQL);
		$lista 		= $preparo->fetchAll();
		return $lista;

	}

	protected function persistirConsulta($sqlInsert, $arrayInsert){

		// String conexion a la base de datos
		$DATABASE = array(
			"host" => "localhost",
			"port" => "3306",
			"database" => "curso_2123",
			"user" => "root",
			"password" => ""
		);

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
		$respuesta	= $preparo->execute($arrayInsert);	

	}

	public function validarPost($nombreParametro, $default = ""){
		/*	Operador ternario 
			variable  Condicion opcion1=Verdadero opcion2=Falso 
			$var    =  ()      ?"Verdero":"Falso"; 

		*/
		$retorno = isset($_POST[$nombreParametro])?$_POST[$nombreParametro]:$default;
		return $retorno;

	}

	public function subirImagen($rAlto,$rAncho){


		if(isset($_FILES)){

			$archivo = $_FILES;
			$rutaTMP = $_FILES['archivos']['tmp_name'];

			$tipos =  $_FILES['archivos']['type'];
			switch ($tipos){
					case "image/png":
						$tipo = "png";
						break;
					case "image/jpeg":
						$tipo = "jpg";
						break;
					case "image/jpg":
						$tipo = "jpg";
						break;
					case "image/PNG":
						$tipo = "PNG";
						break;
					case "image/JPEG":
						$tipo = "jpg";
						break;
					case "image/JPG":
						$tipo = "JPG";
						break;						
				}
			$nombre			= uniqid().".".$tipo;
			$rutaTMPlocal 	= "tmp/".$nombre;
			$rutaFinal		= "imagen/".$nombre;

			if(copy($rutaTMP, $rutaTMPlocal)){

				//Cargo en memoria la imagen que quiero redimensionar
				// antes de cargar verifico si la imagen es png  
				if($tipo == "png" || $tipo == "PNG"){
					$imagen_original = imagecreatefrompng($rutaTMPlocal);
				}else{
					$imagen_original = imagecreatefromjpeg($rutaTMPlocal);
				}
				//Obtengo el ancho de la imagen quecargue
				$ancho_original = imagesx($imagen_original);
				//Obtengo el alto de la imagen que cargue
				$alto_original = imagesy($imagen_original);
				//Va el alto y el ancho con que el que queda la foto
				$alto_final = $rAlto;
				$ancho_final = $rAncho;
				//Creo una imagen vacia, con el alto y el ancho que tendrla imagen redimensionada
				$imagen_redimensionada = imagecreatetruecolor($ancho_final, $alto_final);
				//Copio la imagen original con las nuevas dimensiones a la imagen en blanco que creamos en la linea anterior
				imagecopyresampled($imagen_redimensionada, $imagen_original, 0, 0, 0, 0, $ancho_final, $alto_final, $ancho_original, $alto_original);
				//Guardo la imagen ya redimensionada
				// antes de guardar la imagen valido si la misma es png
				if($tipo == "png" || $tipo == "PNG"){
					imagepng($imagen_redimensionada,$rutaFinal);
				}else{
					imagejpeg($imagen_redimensionada,$rutaFinal);
				}
				//Libero recursos, destruyendo las imagenes que estaban en memoria
				imagedestroy($imagen_original);
				imagedestroy($imagen_redimensionada);
				//Borramos la primera imagen subida al servidor
				unlink($rutaTMPlocal );
				return $rutaFinal; 

			}else{
				$error = array("estado"=>"Error", "mensaje"=>"Error al copiar la imagen" );
			}
			
		}else{
			return false;
		}
	}


	public function paginador($numPagina){

		// Valido si el $numPagina es un numero
		if(!is_numeric($numPagina)){
			// En caso de no ser un numero le asigno el numero 1
			$numPagina = 1;	
		}

		$paginaAtras 	= $numPagina - 1;
		// Valido si pagina atras es menor a 1
		if($paginaAtras < 1){
			// En caso que sea menor le asigo el valor 1
			$paginaAtras 	= 1;	
			$numPagina		= 1;

		}	
		// Primero obtengo el total de registros
		$totalRegistros	= $this->totalRegistros();
		// Despues sacamos la cuenta de cuantas paginas tenemos.
		// Con la funcion ceil($var) Siempre redondeamos para arriba el resultado
		$totalpaginas = ceil(($totalRegistros/10));	
		// Sumamos a la pagina actual 1 para indicar la pagina siguiente
		$paginaSiguiente = $numPagina + 1;
		// Revisamos si pagina siguente supera el maximo de pagina 
		if($paginaSiguiente >= $totalpaginas){
			// Si supera el maximo de pagina ponemos el maximo de pagima
			$paginaSiguiente = $totalpaginas;
		}	
		// Armo la respuesta
		$arrayPagina = array(
							"paginaAtras"		=>$paginaAtras,
							"pagina"			=>$numPagina,
							"paginaSiguiente"	=>$paginaSiguiente, 
							"totalPagina"		=>$totalpaginas
		);
		return $arrayPagina;

	}	

}

?>
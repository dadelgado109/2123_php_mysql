
<?php

		$arrayColores2 = [];

		$arrayColores = array();

		$arrayColores3 = array("Rojo","Azul","Verde","Amarillo");

		// De esta forma imprimo todo el array
		print_r($arrayColores3);
		echo("<hr>");
		// De esta forma solo imprimo el color azul en el array 
		// Para eso utilizamos el espacio 1
		print_r($arrayColores3[1]);
		echo("<hr>");
		print_r($arrayColores3[3]);    
		echo("<hr>");
		// Aca le agrego el color verde al array
		$arrayColores3[]    = "Verde";         
		$arrayColores3[16]  = "Indigo"; 
		$arrayColores3[]    = "Rosado";         
		$arrayColores3[10]  = "Celeste";
		$arrayColores3[3]	= "Turquesa";
		// Ordeno de menor a mayor segun su valor
		echo("Ordenados de menor a mayor segun su valor");
		asort($arrayColores3);
		print_r($arrayColores3);
		echo("<hr>");	
		echo("Ordenados de Mayor a menor segun su valor");
		arsort($arrayColores3);
		print_r($arrayColores3);
		echo("<hr>");
		echo("Ordenados de menor a mayor segun su clave");
		ksort($arrayColores3);
		print_r($arrayColores3);
		echo("<hr>");
		echo("Ordenados de mayor a nemor segun su clave");
		krsort($arrayColores3);
		print_r($arrayColores3);
		echo("<hr>");
		print_r($arrayColores3[10]);

	//--------------------------------------------------\\
	//--------------------------------------------------\\
		echo("<hr>");
		echo("<hr>");
			
		$arrayAss = array( 
						'azul' => '#0000ff', 
						'rojo' => '#ff0000', 
						'verde' => '#008000');

		print_r($arrayAss);
		echo("<hr>");
		print_r($arrayAss['azul']);
		echo("<hr>");
		$arrayAss['morado'] = "#800080"; 
		print_r($arrayAss);
		echo("<hr>");
		echo("<hr>");


		$persona = array();
		$persona[] = array("Nombre"=>"Damian", "Apellido"=>"Delgado", 'Edad'=>34);	
		$persona[] = array("Nombre"=>"Santiago", 'Apellido'=> 'Fagundez', 'Edad'=>20);
		$persona[] = array("Nombre"=>"Joaquin", "Apellido"=>'Gelpi', 'Edad'=>16);
		$persona[] = array("Nombre"=>"Gabriela", "Apellido"=>'Medina', 'Edad'=>30);
		$persona[] = array("Nombre"=>"Matias", "Apellido"=>'Sanchez', 'Edad'=>50);
		print_r($persona);
		echo("<hr>");
		$totalArray = count($persona);
		echo($totalArray);

		echo("<hr>");
		foreach($persona as $per ){

			print_r($per);
			echo("<br>");	

		}


?>













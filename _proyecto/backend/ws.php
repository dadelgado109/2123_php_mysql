<?php

	header('Access-Control-Allow-Origin: *');
	header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
	header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
	header('content-type: application/json; charset=utf-8');


	$arrayColores = array("Amarillo"=>"#fff408","Rojo"=>"#ff0808","Verde"=>"#31ff08","Azul"=>"#0848ff");	

	$jsonColores = json_encode($arrayColores);

	echo($jsonColores);

?>
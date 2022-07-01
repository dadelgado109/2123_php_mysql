<?php


	@session_start();
	
	if(isset($_SESSION['nombre'])){
		header('Location: sistema.php');
	}else{
		header('Location: login.php');
	}




?>
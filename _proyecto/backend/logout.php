<?php

	@session_start();
	unset($_SESSION['nombre']);
	unset($_SESSION['fecha']);
	unset($_SESSION['mail']);
	@session_destroy();

	header('Location: login.php');

?>

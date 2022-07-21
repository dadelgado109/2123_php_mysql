<?php


    @session_start();
    unset($_SESSION['documento']);
    @session_destroy();

    header('Location: index.php');


?>
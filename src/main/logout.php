<?php 
    session_start();
    session_destroy();
    header("LOCATION:home.php");
    exit;
?>

<?php

session_start();

require_once "config.php";

// Se déconnecter
if (isset($_GET['logout'])) {
    session_destroy();
    session_unset();
    unset($_SESSION['logged_in']);
    header('location: index.php');
}
?>

<?php

session_start();

require_once "config.php";

// Se déconnecter
if (isset($_GET['logout'])) {
    session_destroy();
    session_unset();
    header('location: index.php');
}
?>

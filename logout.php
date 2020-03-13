<?php

require_once "config.php";
session_start();
session_destroy();
session_unset();
unset($_SESSION['logged_in']);
header('location: index.php');
?>

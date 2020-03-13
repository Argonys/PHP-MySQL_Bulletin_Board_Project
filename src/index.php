<?php
session_start();
include "logout.php";
if (isset($_SESSION["logged_in"])) {
    include "header2.php";
} else {
    include "header1.php";
}

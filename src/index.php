<?php 

session_start();
require "config.php";
require "logout.php";

?>


<!DOCTYPE html>
    <html>
        <head>
        </head>
        <body>
            <div>
                <?php if (isset($_SESSION['logged_in'])): ?>
                    <?php include "header_on.php"; ?> 
                <?php else: ?>
                    <?php include "header_off.php" ?>
                <?php endif ?>
            </div>
        </body>
    </html>

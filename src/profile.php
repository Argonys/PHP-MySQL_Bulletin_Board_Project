<?php 

session_start(); 

require_once 'config.php';

// Si l'user n'est pas connecté, on le redirige vers la page d'accueil
if($_SESSION['logged_in'] = NULL) {
    header('location: index.php');
    exit;
}



?>


<!DOCTYPE html>
    <html>
        <head>
        </head>
        <body>
            <div>
                <?php include "header_on.php"; ?>          
            </div>
            <div>
                <h1>Votre profil</h1>
                <hr />
                <div class="avatar"></div>
                <div class="informations"></div>
                <div><p></p>
                    <li><p>Votre pseudo : <?php echo $_SESSION['username'] ?></p></li>
                    <li><p>Votre email : <?php echo $_SESSION['email'] ?> </p></li>
                    <li><p>Votre signature : <?php echo $_SESSION['signature'] ?></p></li>
                    <li><a href="profile.php?param='true'">Changer mes informations</a></li>
                </ul>
            </div>
        </body>
    </html>

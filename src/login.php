<?php
// On inclut le fichier de connexion à la database
require_once 'config.php';


// Si l'user est déjà connecté, on le redirige vers la page d'accueil
if(isset($_SESSION['logged_in'])) {
    header('location: index.php');
    exit;
}

// Initialisation des variables
$email = '';
$password = '';
$errors = array();

// On vérifie si le formulaire a bien été soumis
if(isset($_POST['login'])) {

    // On vérifie si l'email n'est pas vide
    if(empty($_POST['email'])) {
        array_push($errors, "L'adresse email est requise.");
    } else {
        $email = $_POST['email'];
    }


    // On vérifie si le password n'est pas vide
    if(empty($_POST['password'])) {
        array_push($errors, "Le mot de passe est requis.");
    } else {
        $password = $_POST['password'];
    }


    // On vérifie que les champs soient bien remplis et qu'il n'y a pas d'erreur
    if(empty($errors)) {

        // On prépare les options de la requête (requête préparée)
        $sql = 'SELECT * FROM users WHERE email LIKE :email';
        
        // On prépare la requête
        $req = $bdd->prepare($sql);

        $req->bindValue(':email', $email);

        // On essaie d'exécuter la requête
        $req->execute();

        // On récupère ce que vous renvoie la requête
        $userData = $req->fetch(PDO::FETCH_ASSOC);

        // On vérifie si l'email rentré correspond à celui de la database
        if ($userData['email'] === $email) {

            // Si oui, on vérifie si les passwords correspondent (sort true ou false)
            if(password_verify($password, $userData['password'])) {

                session_start();
                // On save les données de l'user dans la variable $_SESSION
                $_SESSION = $userData;
                $_SESSION['logged_in'] = "Vous êtes maintenant connecté.";
                header('location: index.php');
            } 
        }
    }
}
?>




<!DOCTYPE html>
    <html lang="en">
        <head>
            <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <title>Login page</title>
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
            <link rel="stylesheet" href="signin.css">
        </head>

        <body>
            <div class="login-form">
                <form action="" method="post">
                    <h2 class="text-center">Sign In</h2>
                    <!-- On affiche les erreurs ici -->
                    <?php include('errors.php'); ?>
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-user"></i></span>
                            <input type="text" class="form-control" placeholder="Email" name="email" required="required">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                            <input type="password" class="form-control" placeholder="Password" name="password" required="required">
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-block" name="login">Log in</button>
                    </div>
                    <p class="text-center small">Don't have an account! <a href="register.php">Sign up here</a>.</p>
                </form>
            </div>
        </body>
    </html>

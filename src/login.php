<?php
// On inclut le fichier de connexion à la database
require_once "connectionDBB.php";

// // Requête SQL qui renvoie TOUTES les données de la tables users
// $reponse = $bdd->query('SELECT * FROM users WHERE email="test@test.com"');


// // On prend la réponse de MySQL et on la fetch(), ce qui renvoie la première ligne
// // $donnees = $reponse->fetch();

// while ($donnees = $reponse->fetch()) {
//     echo 
// } 
// $req = $bdd->prepate("INSERT INTO users(username, email, password) VALUES('$username', '$email', '$password')");

// $reponse->closeCursor();

$email = addslashes($_POST['email']);
$password = addslashes($_POST['password']);
$sql = "SELECT * "
    . "FROM users "
    . "WHERE email = '" . $email . "'";
$req = $bdd->prepare($sql);
$req->execute();
$userData = $req->fetch(PDO::FETCH_ASSOC);
//var_dump($userData);
$email = addslashes($_POST['email']);
$password = addslashes($_POST['password']);
if ($userData) {

    // vérification du mdp saisi
    //$isValid = password_verify($password, $userData["password"]);

    if (password_verify($password, $userData["password"])) {
        // on stock les infos de l'user en session
        session_start();
        $_SESSION["email"] = $userData["email"];
        $_SESSION["password"] = $userData["password"];
        $_SESSION["logged_in"] = true;
        header('location: index.php');
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
    <style type="text/css">
        .login-form {
            width: 340px;
            margin: 50px auto;
        }

        .login-form form {
            margin-bottom: 15px;
            background: #f7f7f7;
            box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
            padding: 30px;
        }

        .login-form h2 {
            margin: 0 0 15px;
        }

        .form-control,
        .btn {
            min-height: 38px;
            border-radius: 2px;
        }

        .input-group-addon .fa {
            font-size: 18px;
        }

        .btn {
            font-size: 15px;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="login-form">
        <form action="" method="post">
            <h2 class="text-center">Sign In</h2>
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
                <button type="submit" class="btn btn-primary btn-block">Log in</button>
            </div>
            <p class="text-center small">Don't have an account! <a href="register.php">Sign up here</a>.</p>
        </form>
    </div>
</body>

</html>
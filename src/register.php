<?php

session_start();

// On inclut le fichier de connexion à la database
require_once "config.php";


// Si l'user est déjà connecté, on le redirige vers la page d'accueil
if (isset($_SESSION['logged_in'])) {
    header('location: index.php');
    exit;
}



$username = '';
$email = '';
$errors = array();
$password_1 = '';
$password_2 = '';
$creation_time = date('Y-m-d H:i:s');
$creation_date = date('d-m-Y');
$src = '';



// Si le bouton pour s'inscrire est cliqué, alors
if (isset($_POST['register'])) {

    // ATTENTION, addslashes n'est apparemment pas la meilleure fonction à utiliser ici

    // On récupère les données du form
    $username = addslashes($_POST['username']);
    $email = addslashes($_POST['email']);
    $password_1 = addslashes($_POST['password_1']);
    $password_2 = addslashes($_POST['password_2']);



    // On vérifie si le nom d'utilisateur n'est pas déjà pris dans la base de données
    $req = $bdd->prepare('SELECT username FROM users WHERE username LIKE :username');
    $req->bindValue(':username', $username);
    $req->execute();
    $userData = $req->fetch();
    if ($userData['username'] === $username) {
        array_push($errors, "Ce nom d'utilisateur est déjà pris.");
    }


    // On vérifie si le nom d'utilisateur n'est pas déjà pris dans la base de données
    $req = $bdd->prepare('SELECT email FROM users WHERE email LIKE :email');
    $req->bindValue(':email', $email);
    $req->execute();
    $userData = $req->fetch();
    if ($userData['email'] === $email) {
        array_push($errors, "Cette adresse email est déjà utilisée.");
    }


    // S'assurer que tous les champs sont remplis/valides
    if (empty($username)) {
        array_push($errors, "Le nom d'utilisateur est requis.");
    }

    if (empty($email)) {
        array_push($errors, "L'adresse email est requise.");
    }

    if (empty($password_1)) {
        array_push($errors, "Le mot de passe est requis.");
    }

    if ($password_1 != $password_2) {
        array_push($errors, "Les mots de passe ne correspondent pas.");
    }

    // Si tout est bon, envoyer les données de l'user dans la database
    if (empty($errors)) {
        // Hachage du password
        $hashed_password = password_hash($password_1, PASSWORD_DEFAULT);

        // Fonction pour avatar de base
        function get_gravatar(
            $email,
            $s = 100,
            $d = 'mp',
            $r = 'g',
            $img = false,
            $atts = array()
        ) {
            $url = 'https://www.gravatar.com/avatar/';
            $url .= md5(strtolower(trim($email)));
            $url .= "?s=$s&d=$d&r=$r";
            if ($img) {
                $url = '<img src="' . $url . '"';
                foreach ($atts as $key => $val) {
                    $url .= ' ' . $key . '="' . $val . '"';
                }
                $url .= ' />';
            }
            return $url;
        }

        $src = get_gravatar($email);

        $sql = 'INSERT INTO users (username, email, password, creation_time, creation_date, src_avatar) VALUES (:username, :email, :password, :creation_time, :creation_date, :src_avatar)';
        $req = $bdd->prepare($sql);
        $req->bindValue(':username', $username);
        $req->bindValue(':email', $email);
        $req->bindValue(':password', $hashed_password);
        $req->bindValue(':creation_time', $creation_time);
        $req->bindValue(':creation_date', $creation_date);
        $req->bindValue(':src_avatar', $src);
        $req->execute();

        if ($req) {
            // On va rechercher toutes les infos de l'user et on les save dans $_SESSION
            // Puis redirection vers l'accueil
            $sql = 'SELECT * FROM users WHERE email LIKE :email';
            $req = $bdd->prepare($sql);
            $req->bindValue(':email', $email);
            $req->execute();
            $user_data = $req->fetch(PDO::FETCH_ASSOC);
            $_SESSION = $user_data;
            $_SESSION['logged_in'] = true;
            header("location: index.php");
        } else {
            echo "Something went wrong. Please try again later.";
        }
    } else {
        echo "Error.";
    }
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700" rel="stylesheet">
    <title>Register page</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/register.css">
</head>

<body>
    <div class="signup-form">
        <form action="" method="post">
            <h2>Create Account</h2>
            <!-- On affiche les erreurs ici -->
            <?php include('errors.php'); ?>
            <div class="form-group">
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                    <input type="text" class="form-control" name="username" value="<?php echo $username; ?>" placeholder="Username" required="required">
                </div>
            </div>
            <div class="form-group">
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-paper-plane"></i></span>
                    <input type="email" class="form-control" name="email" value="<?php echo $email; ?>" placeholder="Email Address" required="required">
                </div>
            </div>
            <div class="form-group">
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                    <input type="password" class="form-control" name="password_1" placeholder="Password" required="required">
                </div>
            </div>
            <div class="form-group">
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="fa fa-lock"></i>
                        <i class="fa fa-check"></i>
                    </span>
                    <input type="password" class="form-control" name="password_2" placeholder="Confirm Password" required="required">
                </div>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-block btn-lg" name="register">Sign Up</button>
            </div>
            <div class="text-center">Already have an account? <a href="login.php">Login here</a>.
            </div>
        </form>
    </div>
</body>

</html>
<?php 

session_start();
// On inclut le fichier de connexion à la database
require_once "config.php";


// date_default_timezone_set('Europe/Brussels');


// Si l'user est déjà connecté, on le redirige vers la page d'accueil
if(isset($_SESSION['logged_in'])) {
    header('location: index.php');
    exit;
}



$username = '';
$email = '';
$errors = array();
$signature = '';
$password_1 = '';
$password_2 = '';
$time_creation = date('Y-m-d H:i:s');


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
        $req = $bdd->prepare('INSERT INTO users(username, email, password, time_creation) VALUES(:username, :email, :password, :time_creation)');
        $req->bindValue(':username', $username, PDO::PARAM_STR);
        $req->bindValue(':email', $email, PDO::PARAM_STR);
        $req->bindValue(':password', $hashed_password, PDO::PARAM_STR);
        $req->bindValue(':time_creation', $time_creation, PDO::PARAM_STR);
        $req->execute();
        
        
        $_SESSION['logged_in'] = "Bienvenue sur notre forum ! Vous êtes maintenant connecté.";
        $_SESSION['email'] = $email;
        $_SESSION['username'] = $username;
        $_SESSION['password'] = $hashed_password;
        $_SESSION['time_creation'] = $time_creation;

        // On redirige vers la page d'accueil
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

<?php

session_start();

// Si l'user est déjà connecté, on le redirige vers la page d'accueil
if(isset($_SESSION['logged_in'])) {
    header('location: index.php');
    exit;
}

// On inclut le fichier de connexion à la database
require_once "connectionDBB.php";


$username = '';
$email = '';
$errors = array();
$signature = '';


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
    print_r($userData);
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
        $req = $bdd->prepare('INSERT INTO users(username, email, password) VALUES(:username, :email, :password)');
        $req->bindValue(':username', $username, PDO::PARAM_STR);
        $req->bindValue(':email', $email, PDO::PARAM_STR);
        $req->bindValue(':password', $hashed_password, PDO::PARAM_STR);
        $req->execute();  
        
        $_SESSION['username'] = $username;
        $_SESSION['logged_in'] = "Bienvenue sur notre forum ! Vous êtes maintenant connecté.";

        // On redirige vers la page d'accueil
        header('location: index.php'); 
        
    }
} 









//     // Vérification des données entrées avec la database
//     $sql = "SELECT * "
//     . "FROM users "
//     . "WHERE email = '" . $email . "'";
//     $req = $bdd->prepare($sql);
//     $req->execute();
//     $userData = $req->fetch();
//     if($userData) {

//         // vérification du mdp saisi
//         $isValid = password_verify($password, $userData["password"]);
//         print_r($isValid);

//         if($isValid) {
//             // on stock les infos de l'user en session
//             $_SESSION["username"] = $username;
//             $_SESSION["loggedin"] = true;
//             $_SESSION["id"] = $id;

//             header('location: index.php');
//             echo "yes";
//         }
//     }
//     var_dump($_SESSION["username"]);
// }





// Se déconnecter
if (isset($_GET['logout'])) {
    session_destroy();
    session_unset();
    header('location: index.php');
}
?>

